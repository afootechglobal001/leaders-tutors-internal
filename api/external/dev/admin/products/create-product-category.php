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
    $productName      = strtoupper(trim($_POST['productName'] ?? ''));
    $productTags      = strtoupper(trim($_POST['productTags'] ?? ''));
    $statusId         = trim($_POST['statusId'] ?? '');
    $productPixCount  = !empty($_FILES['productPix']['name']) ? count($_FILES['productPix']['name']) : 0;

    ////////////////// Validation //////////////////
    validateEmptyField($productName, 'PRODUCT NAME');
    validateEmptyField($productTags, 'PRODUCT TAGS');
    validateEmptyField($statusId, 'PRODUCT STATUS');

    if ($productPixCount === 0) {
        throw new ValidationException("PRODUCT PICTURES REQUIRED! Check the fields and try again.");
    }

    ////////////////// Check Existing Product //////////////////
    $existingProduct = selectQuery($conn, "SELECT productId FROM PRODUCTS_TAB WHERE productLevel=1 AND productName = ?", "s", [$productName]);
    if (!empty($existingProduct)) {
        throw new ConflictException("PRODUCT EXIST! Product already exists by name.");
    }

    ////////////////// Generate Product ID //////////////////
    $sequence = _get_sequence_count($conn, 'GFSP');
    $array    = json_decode($sequence, true);
    $no       = $array[0]['no'];
    $productId = 'GFSP' . $no . date("YmdHis");

    ////////////////// Insert Product //////////////////
    $insertProductQuery = "
        INSERT INTO PRODUCTS_TAB
        (productLevel, productId, productName, productTags, statusId, createdBy, createdTime)
        VALUES (?, ?, ?, ?, ?, ?, NOW())
    ";
    insertQuery($conn, $insertProductQuery, "isssis", [1, $productId, $productName, $productTags, $statusId, $loginStaffId]);

    ////////////////// Upload Product Pictures //////////////////
    $newProductPixNames = '';
    for ($i = 0; $i < $productPixCount; $i++) {
        $imageName      = $_FILES["productPix"]["name"][$i];
        $imageExtension = pathinfo($imageName, PATHINFO_EXTENSION);
        $newImageName   = $productId . "_" . $i . uniqid() . "." . $imageExtension;

        $insertPixQuery = "INSERT INTO PRODUCT_PIX_TAB (productId, productPix, createdTime) VALUES (?, ?, NOW())";
        insertQuery($conn, $insertPixQuery, "ss", [$productId, $newImageName]);

        $newProductPixNames .= "$newImageName,";
    }

    ////////////////// Fetch Created Product //////////////////
    $productData = selectQuery($conn, "SELECT * FROM PRODUCTS_TAB WHERE productId = ?", "s", [$productId]);

    foreach ($productData as &$product) {
        // Product pictures
        $productPix = selectQuery($conn, "SELECT * FROM PRODUCT_PIX_TAB WHERE productId = ?", "s", [$productId]);
        $product['picturesData'] = $productPix;

        // Status
        $statusData = selectQuery($conn, "SELECT * FROM SETUP_STATUS_TAB WHERE statusId = ?", "i", [$product['statusId']]);
        $product['statusData'] = $statusData;

        // Created by
        $createdBy = $product['createdBy'];
        $product['createdBy'] = _action_performed_by($conn, $createdBy) ?? null;
        // Updated by
        $updatedBy = $product['updatedBy'];
        $product['updatedBy'] = _action_performed_by($conn, $updatedBy) ?? null;
    }

    ////////////////// Response //////////////////
    $response = [
        'response'          => 200,
        'success'           => true,
        'message'           => "PRODUCT CATEGORY CREATED SUCCESSFULLY!",
        'oldProductPixNames' => '',
        'newProductPixNames' => $newProductPixNames,
        'data'              => $productData
    ];

} catch (Throwable $e) {
    ErrorHandler::handle($e);
}

http_response_code($response['response'] ?? 500);
echo json_encode($response);
?>