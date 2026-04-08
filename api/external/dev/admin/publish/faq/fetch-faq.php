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
    $q       = trim($_GET['q'] ?? '');
    $faqId   = trim($_GET['faqId'] ?? '');
    $statusId= trim($_GET['statusId'] ?? '');

    ////////////////// Build Query //////////////////
    $whereClauses = [];
    $params = [];
    $types = '';

    if (!empty($q)) {
        $whereClauses[] = "(faqQuestion LIKE ?)";
        $params[] = "%$q%";
        $types .= 's';
    }

    if (!empty($faqId)) {
        $whereClauses[] = "faqId = ?";
        $params[] = $faqId;
        $types .= 's';
    }

    if (!empty($statusId)) {
        // Assuming $statusId could be comma-separated
        $statusArray = array_map('trim', explode(',', $statusId));
        $placeholders = implode(',', array_fill(0, count($statusArray), '?'));
        $whereClauses[] = "statusId IN ($placeholders)";
        $params = array_merge($params, $statusArray);
        $types .= str_repeat('s', count($statusArray));
    }

    $whereSQL = $whereClauses ? 'WHERE ' . implode(' AND ', $whereClauses) : '';
    $selectSQL = "SELECT * FROM FAQ_TAB $whereSQL ORDER BY updatedTime DESC";

    ////////////////// Fetch FAQ //////////////////
    $faqData = selectQuery($conn, $selectSQL, $types, $params);
    $allRecordCount = count($faqData);

    if ($allRecordCount === 0) {
       throw new NotFoundException("No Record found");
    }
        
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

        $response = [
            'response' => 200,
            'success'  => true,
            'message'  => "FAQ FETCH SUCCESSFULLY!",
            'allRecordCount' => $allRecordCount,
            'data'     => $faqData
        ];
    

} catch (Throwable $e) {
    ErrorHandler::handle($e);
}

http_response_code($response['response'] ?? 500);
echo json_encode($response);
?>