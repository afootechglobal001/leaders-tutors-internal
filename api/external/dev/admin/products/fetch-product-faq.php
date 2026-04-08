<?php
require_once '../../config/connection.php';
require_once '../../config/staff-session-check.php';

try {
    if (!$checkBasicSecurity) {
        throw new ForbiddenException("Unauthorized access! Please log in.");
    }

    if (!$checkSession) {
        throw new UnauthorizedException("SESSION EXPIRED! Please LogIn Again.");
    }

    ////////////////// Variables //////////////////
    $productId = trim($_GET['productId'] ?? '');

    ////////////////// Validation //////////////////
    validateEmptyField($productId, 'PRODUCT');

    ////////////////// Fetch Product FAQ //////////////////
    $faqQuery = "SELECT * FROM PRODUCT_FAQ WHERE productId = ?";
    $faqData = selectQuery($conn, $faqQuery, "s", [$productId]);

    if (empty($faqData)) {
        throw new NotFoundException("No Record found");
    }

    ////////////////// Fetch Created By //////////////////
    foreach ($faqData as &$faq) {
        $createdBy = $faq['createdBy'];
        $faq['createdBy'] = _action_performed_by($conn, $createdBy) ?? null;
    }

    ////////////////// Response //////////////////
    $response = [
        'response' => 200,
        'success' => true,
        'message' => "PRODUCT FAQ FETCHED SUCCESSFULLY!",
        'data' => $faqData
    ];

} catch (Throwable $e) {
    ErrorHandler::handle($e);
}

http_response_code($response['response'] ?? 500);
echo json_encode($response);