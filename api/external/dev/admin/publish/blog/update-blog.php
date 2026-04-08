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
    $blogId        = trim($_GET['blogId'] ?? '');
    $pageCategoryId= trim($_GET['pageCategoryId'] ?? '');
    $blogCatId     = trim($_POST['blogCatId'] ?? '');
    $blogTitle     = trim($_POST['blogTitle'] ?? '');
    $blogPixFile   = $_FILES['blogPix']['name'] ?? '';
    $statusId      = trim($_POST['statusId'] ?? '');

    ////////////////// Validation //////////////////
    validateEmptyField($blogId, 'BLOG ID');
    validateEmptyField($pageCategoryId, 'PAGE CATEGORY ID');
    validateEmptyField($blogCatId, 'BLOG CATEGORY');
    validateEmptyField($blogTitle, 'BLOG TITLE');
    validateEmptyField($statusId, 'STATUS');

    // Check for duplicate blog title
    $checkQuery = "SELECT blogId FROM BLOG_TAB WHERE blogTitle = ? AND blogId != ?";
    $existingBlog = selectQuery($conn, $checkQuery, "ss", [$blogTitle, $blogId]);
    if (!empty($existingBlog)) {
        throw new ConflictException("This Blog with name ('$blogTitle') is already in use. Please try another Name.");
    }

    ////////////////// Get old picture //////////////////
    $oldPixQuery = "SELECT blogPix FROM BLOG_TAB WHERE blogId = ?";
    $oldPixData  = selectQuery($conn, $oldPixQuery, "s", [$blogId]);
    $oldBlogPix  = $oldPixData[0]['blogPix'] ?? '';

    $newBlogPix = $oldBlogPix;

    ////////////////// Handle new picture //////////////////
    if (!empty($blogPixFile)) {

        $extension = pathinfo($blogPixFile, PATHINFO_EXTENSION);
        $allowedExts = ["jpg","jpeg","gif","png","webp"];
        if (!in_array(strtolower($extension), $allowedExts)) {
            throw new ValidationException("INVALID PICTURE FORMAT! Check the picture format and try again.");
        }

        $newBlogPix = $blogId . $blogPixFile;

        $updatePixQuery = "UPDATE BLOG_TAB SET blogPix = ? WHERE blogId = ?";
        insertQuery($conn, $updatePixQuery, "ss", [$newBlogPix, $blogId]);
    }

    ////////////////// Update blog //////////////////
    $updateQuery = "
        UPDATE BLOG_TAB SET
            pageCategoryId = ?,
            blogCatId     = ?,
            blogTitle     = ?,
            statusId      = ?,
            updatedBy     = ?,
            updatedTime   = NOW()
        WHERE blogId = ?
    ";
    $updateParams = [$pageCategoryId, $blogCatId, $blogTitle, $statusId, $loginStaffId, $blogId];
    insertQuery($conn, $updateQuery, "ssssss", $updateParams);

    ////////////////// Fetch updated blog //////////////////
    $selectQuery = "SELECT * FROM BLOG_TAB WHERE blogId = ?";
    $blogData = selectQuery($conn, $selectQuery, "s", [$blogId]);

    foreach ($blogData as &$blog) {
        // Blog Category
        $blogCat = selectQuery($conn, "SELECT categoryId, categoryName FROM INFORMATION_CATEGORY_TAB WHERE categoryId = ?", "s", [$blog['blogCatId']]);
        $blog['blogCatData'] = $blogCat[0] ?? null;

        // Status
        $status = selectQuery($conn, "SELECT * FROM SETUP_STATUS_TAB WHERE statusId = ?", "s", [$blog['statusId']]);
        $blog['statusData'] = $status[0] ?? null;

        // Created By
        $createdBy = $blog['createdBy'];
        $blog['createdBy'] = _action_performed_by($conn, $createdBy) ?? null;
        // Updated By
        $updatedBy = $blog['updatedBy'];
        $blog['updatedBy'] = _action_performed_by($conn, $updatedBy) ?? null;
    }

    ////////////////// Response //////////////////
    $response = [
        'response'     => 200,
        'success'      => true,
        'message'      => "BLOG UPDATED SUCCESSFULLY!",
        'oldBlogPix'   => $oldBlogPix,
        'newBlogPix'   => $newBlogPix,
        'data'         => $blogData
    ];

} catch (Throwable $e) {
    ErrorHandler::handle($e);
}

http_response_code($response['response'] ?? 500);
echo json_encode($response);
?>