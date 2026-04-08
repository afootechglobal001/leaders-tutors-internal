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
    $parentId       = trim($_GET['productCategoryId'] ?? '');
    $productName    = trim(strtoupper($_POST['productName'] ?? ''));
    $productTags    = trim(strtoupper($_POST['productTags'] ?? ''));
    $productPixArr  = $_FILES['productPix']['name'] ?? [];
    $statusId       = trim($_POST['statusId'] ?? '');

    ////////////////// Validation //////////////////
    validateEmptyField($parentId, 'PRODUCT CATEGORY ID');
    validateEmptyField($productName, 'PRODUCT NAME');
    validateEmptyField($productTags, 'PRODUCT TAGS');
    if (count($productPixArr) === 0) {
        throw new ValidationException("PRODUCT PICTURES REQUIRED! Check the fields and try again.");
    }
    validateEmptyField($statusId, 'PRODUCT STATUS');

    // Check if product already exists
    $existingProduct = selectQuery(
        $conn,
        "SELECT productId FROM PRODUCTS_TAB WHERE productLevel = 2 AND productName = ?",
        "s",
        [$productName]
    );

    if (!empty($existingProduct)) {
        throw new ConflictException("PRODUCT EXIST! Product already exists by name.");
    }

    ////////////////// Generate Product ID //////////////////
    $sequence = _get_sequence_count($conn, 'GFSP');
    $array    = json_decode($sequence, true);
    $no       = $array[0]['no'];
    $productId= 'GFSP'.$no.date("YmdHis");

    ////////////////// Insert Product //////////////////
    insertQuery(
        $conn,
        "INSERT INTO PRODUCTS_TAB 
            (parentId, productLevel, productId, productName, productTags, statusId, createdBy, createdTime) 
         VALUES (?,?,?,?,?,?,?,NOW())",
        "sisssss",
        [$parentId, 2, $productId, $productName, $productTags, $statusId, $loginStaffId]
    );

    ////////////////// Upload Product Pictures //////////////////
    $newProductPixNames = [];
    foreach ($productPixArr as $i => $imageName) {
        $imageExt = pathinfo($imageName, PATHINFO_EXTENSION);
        $newImageName = $productId . "_{$i}_" . uniqid() . "." . $imageExt;

        insertQuery(
            $conn,
            "INSERT INTO PRODUCT_PIX_TAB (productId, productPix, createdTime) VALUES (?,?,NOW())",
            "ss",
            [$productId, $newImageName]
        );

        $newProductPixNames[] = $newImageName;
    }

    ////////////////// Fetch Created Product //////////////////
    $productData = selectQuery($conn, "SELECT * FROM PRODUCTS_TAB WHERE productId = ?", "s", [$productId]);

    foreach ($productData as &$product) {
        // Parent Product
        $parentProduct = selectQuery($conn, "SELECT * FROM PRODUCTS_TAB WHERE productId = ?", "s", [$product['parentId']]);
        $product['parentProductData'] = $parentProduct;

        // Product Pictures
        $pictures = selectQuery($conn, "SELECT * FROM PRODUCT_PIX_TAB WHERE productId = ?", "s", [$productId]);
        $product['picturesData'] = $pictures;

        // Status
        $status = selectQuery($conn, "SELECT * FROM SETUP_STATUS_TAB WHERE statusId = ?", "s", [$product['statusId']]);
        $product['statusData'] = $status;

            // Created by
        $createdBy = $product['createdBy'];
        $product['createdBy'] = _action_performed_by($conn, $createdBy) ?? null;
        // Updated by
        $updatedBy = $product['updatedBy'];
        $product['updatedBy'] = _action_performed_by($conn, $updatedBy) ?? null;
    }

    ////////////////// Response //////////////////
    $response = [
        'response' => 200,
        'success'  => true,
        'message'  => "PRODUCT CATEGORY CREATED SUCCESSFULLY!",
        'newProductPixNames' => implode(',', $newProductPixNames),
        'data'     => $productData
    ];

} catch (Throwable $e) {
    ErrorHandler::handle($e);
}

http_response_code($response['response'] ?? 500);
echo json_encode($response);
?>