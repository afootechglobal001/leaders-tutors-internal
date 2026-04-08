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
    $q          = trim($_GET['q'] ?? '');
    $categoryId = trim($_GET['categoryId'] ?? '');
    $statusId   = trim($_GET['statusId'] ?? '');

    ////////////////// Build Filters //////////////////
    $filters = [];
    $params  = [];
    $types   = '';

    if (!empty($categoryId)) {
        $filters[] = "categoryId = ?";
        $params[]  = $categoryId;
        $types    .= 's';
    }

    if (!empty($statusId)) {
        $statusArray = explode(',', $statusId);
        $placeholders = implode(',', array_fill(0, count($statusArray), '?'));
        $filters[] = "statusId IN ($placeholders)";
        foreach ($statusArray as $s) {
            $params[] = trim($s);
            $types   .= 's';
        }
    }

    if (!empty($q)) {
        $filters[] = "categoryName LIKE ?";
        $params[]  = "%$q%";
        $types    .= 's';
    }

    $whereClause = '';
    if (!empty($filters)) {
        $whereClause = 'WHERE ' . implode(' AND ', $filters);
    }

    ////////////////// Fetch Categories //////////////////
    $select = "SELECT * FROM INFORMATION_CATEGORY_TAB $whereClause ORDER BY categoryName ASC";
    $categories = selectQuery($conn, $select, $types, $params);

    if (empty($categories)) {
        throw new NotFoundException("No Record found");
    } 
    
    foreach ($categories as &$cat) {

        // Status Data
        $statusDataQuery = "SELECT * FROM SETUP_STATUS_TAB WHERE statusId = ?";
        $cat['statusData'] = selectQuery($conn, $statusDataQuery, "s", [$cat['statusId']])[0] ?? null;

        // Created By
        $createdBy = $cat['createdBy'];
        $cat['createdBy'] = _action_performed_by($conn, $createdBy) ?? null;
        // Updated By
        $updatedBy = $cat['updatedBy'];
        $cat['updatedBy'] = _action_performed_by($conn, $updatedBy) ?? null;
    }

    $response = [
        'response' => 200,
        'success' => true,
        'message' => "INFORMATION CATEGORY FETCHED SUCCESSFULLY!",
        'allRecordCount' => count($categories),
        'data' => $categories
    ];
    

} catch (Throwable $e) {
    ErrorHandler::handle($e);
}

http_response_code($response['response'] ?? 500);
echo json_encode($response);
?>