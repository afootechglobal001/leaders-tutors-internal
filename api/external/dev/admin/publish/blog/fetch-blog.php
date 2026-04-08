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
    $q        = trim($_GET['q'] ?? '');
    $blogId   = trim($_GET['blogId'] ?? '');
    $statusId = trim($_GET['statusId'] ?? '');

    ////////////////// Build dynamic filters //////////////////
    $filters = [];
    $params  = [];
    $types   = '';

    if (!empty($blogId)) {
        $filters[] = "blogId = ?";
        $params[]  = $blogId;
        $types .= 's';
    }

    if (!empty($statusId)) {
        $statusList = explode(',', $statusId);
        $placeholders = implode(',', array_fill(0, count($statusList), '?'));
        $filters[] = "statusId IN ($placeholders)";
        $params = array_merge($params, $statusList);
        $types .= str_repeat('s', count($statusList));
    }

    if (!empty($q)) {
        $filters[] = "blogTitle LIKE ?";
        $params[] = "%$q%";
        $types .= 's';
    }

    $where = '';
    if (!empty($filters)) {
        $where = 'WHERE ' . implode(' AND ', $filters);
    }

    ////////////////// Fetch Blogs //////////////////
    $select = "SELECT * FROM BLOG_TAB $where ORDER BY updatedTime DESC";
    $blogs = selectQuery($conn, $select, $types, $params);

    if (empty($blogs)) {
       throw new NotFoundException("No Record found");
    }

    ////////////////// Enrich Blog Data //////////////////
    foreach ($blogs as &$blog) {

        // Blog Category
        $blogCatQuery = "SELECT categoryId, categoryName FROM INFORMATION_CATEGORY_TAB WHERE categoryId = ?";
        $blogCatData = selectQuery($conn, $blogCatQuery, "s", [$blog['blogCatId']]);
        $blog['blogCatData'] = $blogCatData[0] ?? null;

        // Status
        $statusQuery = "SELECT * FROM SETUP_STATUS_TAB WHERE statusId = ?";
        $statusData = selectQuery($conn, $statusQuery, "s", [$blog['statusId']]);
        $blog['statusData'] = $statusData[0] ?? null;

        // Created By
        $createdBy = $blog['createdBy'];
        $blog['createdBy'] = _action_performed_by($conn, $createdBy) ?? null;
        // Updated By
        $updatedBy = $blog['updatedBy'];
        $blog['updatedBy'] = _action_performed_by($conn, $updatedBy) ?? null;
    }

    ////////////////// Response //////////////////
    $response = [
        'response' => 200,
        'success' => true,
        'message' => "BLOG FETCH SUCCESSFULLY!",
        'allRecordCount' => count($blogs),
        'data' => $blogs
    ];

} catch (Throwable $e) {
    ErrorHandler::handle($e);
}

http_response_code($response['response'] ?? 500);
echo json_encode($response);
?>