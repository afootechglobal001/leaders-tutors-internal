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
    $faqId      = trim($_GET['faqId'] ?? '');
    $faqCatId   = trim($_POST['faqCatId'] ?? '');
    $faqQuestion= trim($_POST['faqQuestion'] ?? '');
    $faqAnswer  = trim($_POST['faqAnswer'] ?? '');
    $statusId   = trim($_POST['statusId'] ?? '');

    ////////////////// Validation //////////////////
    validateEmptyField($faqId, 'FAQ ID');
    validateEmptyField($faqCatId, 'FAQ CATEGORY');
    validateEmptyField($faqQuestion, 'FAQ QUESTION');
    validateEmptyField($faqAnswer, 'FAQ ANSWER');
    validateEmptyField($statusId, 'STATUS');

    // Check if FAQ question already exists for another FAQ
    $existingFaq = selectQuery(
        $conn,
        "SELECT faqId FROM FAQ_TAB WHERE faqQuestion = ? AND faqId != ?",
        "ss",
        [$faqQuestion, $faqId]
    );

    if (!empty($existingFaq)) {
        throw new ConflictException("This FAQ with question already exists. Please try another Question.");
    }

    ////////////////// Update FAQ //////////////////
    $updateSQL = "
        UPDATE FAQ_TAB SET
            faqCatId = ?,
            faqQuestion = ?,
            faqAnswer = ?,
            statusId = ?,
            updatedBy = ?,
            updatedTime = NOW()
        WHERE faqId = ?
    ";
    $updateParams = [$faqCatId, $faqQuestion, $faqAnswer, $statusId, $loginStaffId, $faqId];
    insertQuery($conn, $updateSQL, "ssssss", $updateParams);

    ////////////////// Fetch Updated FAQ //////////////////
    $faqData = selectQuery($conn, "SELECT * FROM FAQ_TAB WHERE faqId = ?", "s", [$faqId]);

    foreach ($faqData as &$faq) {
        // FAQ Category
        $faqCat = selectQuery($conn, "SELECT categoryId, categoryName FROM INFORMATION_CATEGORY_TAB WHERE categoryId = ?", "s", [$faq['faqCatId']]);
        $faq['faqCatData'] = $faqCat[0] ?? null;

        // Status
        $status = selectQuery($conn, "SELECT * FROM SETUP_STATUS_TAB WHERE statusId = ?", "s", [$faq['statusId']]);
        $faq['statusData'] = $status[0] ?? null;

        // Created By
        $createdBy = $faq['createdBy'];
        $faq['createdBy'] = _action_performed_by($conn, $createdBy) ?? null;
        // Updated By
        $updatedBy = $faq['updatedBy'];
        $faq['updatedBy'] = _action_performed_by($conn, $updatedBy) ?? null;

    }

    ////////////////// Response //////////////////
    $response = [
        'response' => 200,
        'success'  => true,
        'message'  => "FAQ UPDATED SUCCESSFULLY!",
        'data'     => $faqData
    ];

} catch (Throwable $e) {
    ErrorHandler::handle($e);
}

http_response_code($response['response'] ?? 500);
echo json_encode($response);
?>