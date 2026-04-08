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
    $categoryId   = trim($_GET['categoryId'] ?? '');
    $categoryName = trim($_POST['categoryName'] ?? '');
    $statusId     = trim($_POST['statusId'] ?? '');

    ////////////////// Validation //////////////////
    validateEmptyField($categoryName, 'CATEGORY NAME');
    validateEmptyField($statusId, 'STATUS ID');

    ////////////////// Check Duplicate //////////////////
    $checkQuery = "SELECT categoryId FROM INFORMATION_CATEGORY_TAB WHERE categoryName = ? AND categoryId != ?";
    $existing = selectQuery($conn, $checkQuery, "ss", [$categoryName, $categoryId]);
    if (!empty($existing)) {
        throw new ConflictException("CATEGORY EXIST! Category already exists by name. Check and try again.");
    }

    ////////////////// Update Category //////////////////
    $updateQuery = "
        UPDATE INFORMATION_CATEGORY_TAB
        SET categoryName = ?, statusId = ?, updatedBy = ?, updatedTime = NOW()
        WHERE categoryId = ?
    ";
    $updateParams = [$categoryName, $statusId, $loginStaffId, $categoryId];
    insertQuery($conn, $updateQuery, "ssis", $updateParams);

    ////////////////// Fetch Updated Category //////////////////
    $categoryQuery = "SELECT * FROM INFORMATION_CATEGORY_TAB WHERE categoryId = ?";
    $categories = selectQuery($conn, $categoryQuery, "s", [$categoryId]);

    foreach ($categories as &$category) {
        // Status
        $statusData = selectQuery($conn, "SELECT * FROM SETUP_STATUS_TAB WHERE statusId = ?", "s", [$category['statusId']]);
        $category['statusData'] = $statusData[0] ?? null;

        // Created By
        $category['createdBy'] = _action_performed_by($conn, $category['createdBy']) ?? null;
        // Updated By
        $category['updatedBy'] = _action_performed_by($conn, $category['updatedBy']) ?? null;
    }

    ////////////////// Response //////////////////
    $response = [
        'response' => 200,
        'success'  => true,
        'message'  => "INFORMATION CATEGORY UPDATED SUCCESSFULLY!",
        'data'     => $categories
    ];

} catch (Throwable $e) {
    ErrorHandler::handle($e);
}

http_response_code($response['response'] ?? 500);
echo json_encode($response);
?>