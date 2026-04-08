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
    $publishId = trim($_GET['publishId'] ?? '');

    ////////////////// Validation //////////////////
    validateEmptyField($publishId, 'PUBLISH ID');

    ////////////////// Fetch Page //////////////////
    $pageData = selectQuery($conn, "SELECT * FROM PAGES_TAB WHERE publishId = ?", "s", [$publishId]);

    if (empty($pageData)) {
        throw new NotFoundException("No page found with the provided PUBLISH ID.");
    }

    ////////////////// Check for product pictures //////////////////
    foreach ($pageData as &$page) {
        $pageCategory = $page['pageCategory'] ?? '';
        if ($pageCategory === 'product-category' || $pageCategory === 'product') {
            $productPix = selectQuery($conn, "SELECT * FROM PRODUCT_PIX_TAB WHERE productId = ?", "s", [$publishId]);
            $page['productPictures'] = $productPix;
        }
    }

    ////////////////// Response //////////////////
    $response = [
        'response' => 200,
        'success'  => true,
        'message'  => "PAGE FETCHED SUCCESSFULLY!",
        'data'     => $pageData
    ];

} catch (Throwable $e) {
    ErrorHandler::handle($e);
}

http_response_code($response['response'] ?? 500);
echo json_encode($response);
?>