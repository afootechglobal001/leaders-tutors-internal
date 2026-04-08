<?php
require_once '../../../config/connection.php';
require_once '../../../config/staff-session-check.php';

try {

    if (!$checkBasicSecurity) {
        throw new ForbiddenException("Unauthorized access! Please log in.");
    }

    if (!$checkSession) {
        throw new UnauthorizedException("SESSION EXPIRED! Please LogIn Again.");
    }

    ////////////////// Variables //////////////////
    $categoryName = trim($_POST['categoryName'] ?? '');
    $statusId     = trim($_POST['statusId'] ?? '');

    ////////////////// Validation //////////////////
    validateEmptyField($categoryName, 'CATEGORY NAME');
    validateEmptyField($statusId, 'STATUS ID');

    ////////////////// Check Duplicate //////////////////
    $checkQuery = "SELECT categoryId FROM INFORMATION_CATEGORY_TAB WHERE categoryName = ?";
    $existing = selectQuery($conn, $checkQuery, "s", [$categoryName]);
    if (!empty($existing)) {
        throw new ConflictException("CATEGORY EXIST! Category already exists by name. Check and try again.");
    }

    ////////////////// Generate Category ID //////////////////
    $sequence = $callclass->_get_sequence_count($conn, 'CAT');
    $seqArray = json_decode($sequence, true);
    $no = $seqArray[0]['no'];
    $categoryId = 'CAT' . $no . date("YmdHis");

    ////////////////// Insert Category //////////////////
    $insertQuery = "
        INSERT INTO INFORMATION_CATEGORY_TAB
        (categoryId, categoryName, statusId, createdBy, createdTime)
        VALUES (?, ?, ?, ?, NOW())
    ";
    $insertParams = [$categoryId, $categoryName, $statusId, $loginStaffId];
    insertQuery($conn, $insertQuery, "ssss", $insertParams);

    ////////////////// Fetch Created Category //////////////////
    $categoryQuery = "SELECT * FROM INFORMATION_CATEGORY_TAB WHERE categoryId = ?";
    $categories = selectQuery($conn, $categoryQuery, "s", [$categoryId]);

    foreach ($categories as &$category) {
        // Status
        $statusData = selectQuery($conn, "SELECT * FROM SETUP_STATUS_TAB WHERE statusId = ?", "s", [$category['statusId']]);
        $category['statusData'] = $statusData[0] ?? null;

        // Created By
        $createdBy = $category['createdBy'];
        $category['createdBy'] = _action_performed_by($conn, $createdBy) ?? null;
        // Updated By
        $updatedBy = $category['updatedBy'];
        $category['updatedBy'] = _action_performed_by($conn, $updatedBy) ?? null;
    }

    ////////////////// Response //////////////////
    $response = [
        'response' => 200,
        'success'  => true,
        'message'  => "INFORMATION CATEGORY CREATED SUCCESSFULLY!",
        'data'     => $categories
    ];

} catch (Throwable $e) {
    ErrorHandler::handle($e);
}

http_response_code($response['response'] ?? 500);
echo json_encode($response);
?>