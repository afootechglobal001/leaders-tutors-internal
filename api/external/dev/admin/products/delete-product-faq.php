<?php
require_once '../../config/connection.php';
require_once '../../config/staff-session-check.php';

try {
    ////////////////// Security Checks //////////////////
    if (!$checkBasicSecurity) {
        throw new ForbiddenException("Unauthorized access! Please log in.");
    }

    if (!$checkSession) {
        throw new UnauthorizedException("SESSION EXPIRED! Please LogIn Again.");
    }

    ////////////////// Variables //////////////////
    $questionId = trim($_GET['questionId'] ?? '');

    ////////////////// Validation //////////////////
    validateEmptyField($questionId, 'QUESTION ID');

    ////////////////// Delete FAQ //////////////////
    $deleteQuery = "DELETE FROM PRODUCT_FAQ WHERE questionId = ?";
    deleteQuery($conn, $deleteQuery, "s", [$questionId]); // <-- call deleteQuery here

    ////////////////// Response //////////////////
    $response = [
        'response' => 200,
        'success'  => true,
        'message'  => "PRODUCT FAQ DELETED SUCCESSFULLY!"
    ];

} catch (Throwable $e) {
    ErrorHandler::handle($e);
}

http_response_code($response['response'] ?? 500);
echo json_encode($response);
?>