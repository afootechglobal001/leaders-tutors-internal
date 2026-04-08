<?php
require_once '../../config/connection.php';
require_once '../../config/staff-session-check.php';

try {
    // Security checks
    if (!$checkBasicSecurity) {
        throw new ForbiddenException("Unauthorized access! Please log in.");
    }
    if (!$checkSession) {
        throw new UnauthorizedException("SESSION EXPIRED! Please LogIn Again.");
    }

    ////////////////// Variables //////////////////
    $productId = trim($_GET['productId'] ?? '');
    $question  = strtoupper(trim($_POST['question'] ?? ''));
    $answer    = strtoupper(trim($_POST['answer'] ?? ''));

    ////////////////// Validation //////////////////
    validateEmptyField($productId, 'PRODUCT');
    validateEmptyField($question, 'QUESTION');
    validateEmptyField($answer, 'ANSWER');

    ////////////////// Generate Question ID //////////////////
    $sequence = _get_sequence_count($conn, 'FAQ');
    $array    = json_decode($sequence, true);
    $no       = $array[0]['no'];
    $questionId = 'FAQ' . $no . date("YmdHis");

    ////////////////// Insert FAQ //////////////////
    $insertQuery = "
        INSERT INTO PRODUCT_FAQ 
        (productId, questionId, question, answer, createdBy, createdTime) 
        VALUES (?, ?, ?, ?, ?, NOW())
    ";
    insertQuery($conn, $insertQuery, "sssss", [$productId, $questionId, $question, $answer, $loginStaffId]);

    ////////////////// Response //////////////////
    $response = [
        'response' => 200,
        'success'  => true,
        'message'  => "PRODUCT FAQ CREATED SUCCESSFULLY!",
        'data'     => [
            'questionId' => $questionId,
            'productId'  => $productId,
            'question'   => $question,
            'answer'     => $answer
        ]
    ];

} catch (Throwable $e) {
    ErrorHandler::handle($e);
}

echo json_encode($response);
?>