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
    $q         = trim($_GET['q'] ?? '');
    $productId = trim($_GET['productId'] ?? '');
    $statusId  = trim($_GET['statusId'] ?? '');

    ////////////////// Build query dynamically //////////////////
    $params = [];
    $types  = "";
    $where  = ["productLevel=1"];

    if (!empty($q)) {
        $where[] = "(productTags LIKE ?)";
        $params[] = "%$q%";
        $types .= "s";
    }
    if (!empty($productId)) {
        $where[] = "productId = ?";
        $params[] = $productId;
        $types .= "s";
    }
    if (!empty($statusId)) {
        // Assuming statusId is comma-separated string: "1,2,3"
        $statusArray = explode(",", $statusId);
        $placeholders = implode(",", array_fill(0, count($statusArray), "?"));
        $where[] = "statusId IN ($placeholders)";
        $params = array_merge($params, $statusArray);
        $types .= str_repeat("s", count($statusArray));
    }

    $whereClause = implode(" AND ", $where);
    $select = "SELECT * FROM PRODUCTS_TAB WHERE $whereClause";

    ////////////////// Execute query //////////////////
    $productData = selectQuery($conn, $select, $types, $params);

    if (empty($productData)) {
       throw new NotFoundException("No Record found");
    } 
        foreach ($productData as &$product) {
            $productId = $product['productId'];
            $statusId  = $product['statusId'];
            $createdBy = $product['createdBy'];
            $updatedBy = $product['updatedBy'];

            // Number of products in this category
            $countQuery = "SELECT COUNT(*) AS numberOfProducts FROM PRODUCTS_TAB WHERE parentId = ?";
            $countResult = selectQuery($conn, $countQuery, "s", [$productId]);
            $product['numberOfProducts'] = $countResult[0]['numberOfProducts'] ?? 0;

            // Product pictures
            $product['picturesData'] = selectQuery($conn, "SELECT * FROM PRODUCT_PIX_TAB WHERE productId = ?", "s", [$productId]);

            // Status data
            $statusData = selectQuery($conn, "SELECT * FROM SETUP_STATUS_TAB WHERE statusId = ?", "s", [$statusId]);
            $product['statusData'] = $statusData[0] ?? null;

            // Created by
            $product['createdBy'] = _action_performed_by($conn, $createdBy) ?? null;
            // Updated by
            $product['updatedBy'] = _action_performed_by($conn, $updatedBy) ?? null;
        }

        $response = [
            'response' => 200,
            'success' => true,
            'message' => "PRODUCT CATEGORY FETCHED SUCCESSFULLY!",
            'data' => $productData
        ];

} catch (Throwable $e) {
    ErrorHandler::handle($e);
}

http_response_code($response['response'] ?? 500);
echo json_encode($response);
?>