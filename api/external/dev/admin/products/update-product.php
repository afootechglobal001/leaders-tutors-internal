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
    $productId       = trim($_POST['productId'] ?? '');
    $parentId        = trim($_POST['productCategoryId'] ?? '');
    $productName     = trim(strtoupper($_POST['productName'] ?? ''));
    $productTags     = trim(strtoupper(str_replace("'", "\'", $_POST['productTags'] ?? '')));
    $statusId        = trim($_POST['statusId'] ?? '');
    $productPixCount = !empty($_FILES["productPix"]["name"]) ? count($_FILES["productPix"]["name"]) : 0;

    ////////////////// Validation //////////////////
    validateEmptyField($productId, 'PRODUCT');
    validateEmptyField($parentId, 'PRODUCT CATEGORY');
    validateEmptyField($productName, 'PRODUCT NAME');
    validateEmptyField($productTags, 'PRODUCT TAGS');
    validateEmptyField($statusId, 'PRODUCT STATUS');

    // Check for duplicate product name at level 2
    $checkQuery = "SELECT * FROM PRODUCTS_TAB WHERE productLevel = 2 AND productName = ? AND productId != ?";
    $existingProduct = selectQuery($conn, $checkQuery, "ss", [$productName, $productId]);
    if (!empty($existingProduct)) {
        throw new ConflictException("PRODUCT EXIST! Product already exists by name.");
    }

    ////////////////// Update product //////////////////
    $updateQuery = "
        UPDATE PRODUCTS_TAB SET
            parentId = ?,
            productName = ?,
            productTags = ?,
            statusId = ?,
            updatedBy = ?,
            updatedTime = NOW()
        WHERE productId = ?
    ";
    updateQuery($conn, $updateQuery, "ssssss", [$parentId, $productName, $productTags, $statusId, $loginStaffId, $productId]);

    ////////////////// Handle Product Images //////////////////
    $oldProductPixNames = '';
    $newProductPixNames = '';

    if ($productPixCount > 0) {
        // Get old pictures
        $oldPixQuery = "SELECT productPix FROM PRODUCT_PIX_TAB WHERE productId = ?";
        $oldPixData = selectQuery($conn, $oldPixQuery, "s", [$productId]);
        foreach ($oldPixData as $pix) {
            $oldProductPixNames .= $pix['productPix'] . ",";
        }

        // Delete old pictures
        $deletePixQuery = "DELETE FROM PRODUCT_PIX_TAB WHERE productId = ?";
        deleteQuery($conn, $deletePixQuery, "s", [$productId]);

        // Insert new pictures
        for ($i = 0; $i < $productPixCount; $i++) {
            $imageName = $_FILES["productPix"]["name"][$i];
            $extension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
            $newImageName = $productId . "_" . $i . uniqid() . "." . $extension;

            $insertPixQuery = "INSERT INTO PRODUCT_PIX_TAB (productId, productPix, createdTime) VALUES (?, ?, NOW())";
            insertQuery($conn, $insertPixQuery, "ss", [$productId, $newImageName]);

            $newProductPixNames .= $newImageName . ",";
        }
    }

    ////////////////// Fetch Updated Product //////////////////
    $selectProductQuery = "SELECT * FROM PRODUCTS_TAB WHERE productId = ?";
    $products = selectQuery($conn, $selectProductQuery, "s", [$productId]);
 
    foreach ($products as &$product) {
        $pid      = $product['productId'];
        $statusId = $product['statusId'];
        $createdBy = $product['createdBy'];
        $updatedBy = $product['updatedBy'];
        $parentId  = $product['parentId'];

        // Parent Product
        $parentQuery = "SELECT * FROM PRODUCTS_TAB WHERE productId = ?";
        $product['parentProductData'] = selectQuery($conn, $parentQuery, "s", [$parentId]);

        // Product images
        $pixQuery = "SELECT * FROM PRODUCT_PIX_TAB WHERE productId = ?";
        $product['picturesData'] = selectQuery($conn, $pixQuery, "s", [$pid]);

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
        'message' => "PRODUCT CATEGORY UPDATED SUCCESSFULLY!",
        'oldProductPixNames' => rtrim($oldProductPixNames, ','),
        'newProductPixNames' => rtrim($newProductPixNames, ','),
        'data' => $products
    ];

} catch (Throwable $e) {
    ErrorHandler::handle($e);
}

http_response_code($response['response'] ?? 500);
echo json_encode($response);
?>