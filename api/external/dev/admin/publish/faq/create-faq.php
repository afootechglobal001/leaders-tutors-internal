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
    $faqCatId     = trim($_POST['faqCatId'] ?? '');
    $faqQuestion  = trim($_POST['faqQuestion'] ?? '');
    $faqAnswer    = trim($_POST['faqAnswer'] ?? '');
    $statusId     = trim($_POST['statusId'] ?? '');

    ////////////////// Validation //////////////////
    validateEmptyField($faqCatId, 'FAQ CATEGORY');
    validateEmptyField($faqQuestion, 'FAQ QUESTION');
    validateEmptyField($faqAnswer, 'FAQ ANSWER');
    validateEmptyField($statusId, 'STATUS');

    ////////////////// Check Duplicate FAQ //////////////////
    $checkQuery = "SELECT faqId FROM FAQ_TAB WHERE faqQuestion = ?";
    $existingFAQ = selectQuery($conn, $checkQuery, "s", [$faqQuestion]);
    if (!empty($existingFAQ)) {
        throw new ConflictException("This FAQ with this question already exists. Please try another Question.");
    }

    ////////////////// Generate FAQ ID //////////////////
    $countId  = 'FAQ';
    $sequence = $callclass->_get_sequence_count($conn, $countId);
    $array    = json_decode($sequence, true);
    $no       = $array[0]['no'];
    $faqId    = $countId . $no . date("YmdHis");

    ////////////////// Insert FAQ //////////////////
    $insertQuery = "
        INSERT INTO FAQ_TAB (
            faqCatId,
            faqId,
            faqQuestion,
            faqAnswer,
            statusId,
            createdBy,
            createdTime
        ) VALUES (?,?,?,?,?,?,NOW())
    ";
    $insertParams = [$faqCatId, $faqId, $faqQuestion, $faqAnswer, $statusId, $loginStaffId];
    insertQuery($conn, $insertQuery, "ssssss", $insertParams);

    ////////////////// Fetch Created FAQ //////////////////
    $selectQuery = "SELECT * FROM FAQ_TAB WHERE faqId = ?";
    $faqData = selectQuery($conn, $selectQuery, "s", [$faqId]);

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
        'message'  => "FAQ CREATED SUCCESSFULLY!",
        'data'     => $faqData
    ];

} catch (Throwable $e) {
    ErrorHandler::handle($e);
}

http_response_code($response['response'] ?? 500);
echo json_encode($response);
?>