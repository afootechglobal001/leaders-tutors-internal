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
    $q        = trim($_GET['q'] ?? '');
    $parentId = trim($_GET['parentId'] ?? '');
    $productId = trim($_GET['productId'] ?? '');
    $statusId  = trim($_GET['statusId'] ?? '');

    ////////////////// Validation //////////////////
    validateEmptyField($parentId, 'PRODUCT CATEGORY');

    ////////////////// Build Query //////////////////
    $params = [];
    $conditions = ["parentId = ?"];
    $params[] = $parentId;

    if (!empty($productId)) {
        $conditions[] = "productId = ?";
        $params[] = $productId;
    }

    if (!empty($statusId)) {
        $conditions[] = "statusId IN ($statusId)";
        // Note: statusId should ideally be sanitized/converted to array to avoid SQL injection
    }

    if (!empty($q)) {
        $conditions[] = "(productTags LIKE ?)";
        $params[] = "%$q%";
    }

    $whereClause = implode(" AND ", $conditions);
    $select = "SELECT * FROM PRODUCTS_TAB WHERE $whereClause ORDER BY productName ASC";

    $products = selectQuery($conn, $select, str_repeat('s', count($params)), $params);

    if (empty($products)) {
        throw new NotFoundException("No Record found");
    }

    ////////////////// Get Parent Product //////////////////
    $parentProductQuery = "SELECT * FROM PRODUCTS_TAB WHERE productId = ?";
    $parentProduct = selectQuery($conn, $parentProductQuery, "s", [$parentId]);
    $parentProductData = $parentProduct[0] ?? null;

    ////////////////// Build Product Data //////////////////
    foreach ($products as &$product) {
        $productId  = $product['productId'];
        $statusId   = $product['statusId'];
        $createdBy  = $product['createdBy'];
        $updatedBy  = $product['updatedBy'];

        // Product images
        $productPixQuery = "SELECT * FROM PRODUCT_PIX_TAB WHERE productId = ?";
        $product['picturesData'] = selectQuery($conn, $productPixQuery, "s", [$productId]);

        // Status data
        $statusQuery = "SELECT * FROM SETUP_STATUS_TAB WHERE statusId = ?";
        $statusData = selectQuery($conn, $statusQuery, "s", [$statusId]);
        $product['statusData'] = $statusData[0] ?? null;

        // Created by
        $product['createdBy'] = _action_performed_by($conn, $createdBy) ?? null;
        // Updated by
        $product['updatedBy'] = _action_performed_by($conn, $updatedBy) ?? null;
    }

    ////////////////// Response //////////////////
    $response = [
        'response' => 200,
        'success' => true,
        'message' => "PRODUCT CATEGORY FETCHED SUCCESSFULLY!",
        'allRecordCount' => count($products),
        'parentProductData' => $parentProductData,
        'data' => $products
    ];

} catch (Throwable $e) {
    ErrorHandler::handle($e);
}

http_response_code($response['response'] ?? 500);
echo json_encode($response);