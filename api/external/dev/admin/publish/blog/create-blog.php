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
    $pageCategoryId = trim($_GET['pageCategoryId'] ?? '');
    $blogCatId     = trim($_POST['blogCatId'] ?? '');
    $blogTitle     = trim($_POST['blogTitle'] ?? '');
    $blogPixFile   = $_FILES['blogPix']['name'] ?? '';
    $statusId      = trim($_POST['statusId'] ?? '');

    ////////////////// Validation //////////////////
    validateEmptyField($pageCategoryId, 'PAGE CATEGORY ID');
    validateEmptyField($blogCatId, 'BLOG CATEGORY');
    validateEmptyField($blogTitle, 'BLOG TITLE');
    validateEmptyField($blogPixFile, 'PICTURE');
    validateEmptyField($statusId, 'STATUS');

    // Check for duplicate blog title
    $checkQuery = "SELECT blogId FROM BLOG_TAB WHERE blogTitle = ?";
    $existingBlog = selectQuery($conn, $checkQuery, "s", [$blogTitle]);
    if (!empty($existingBlog)) {
        throw new ConflictException("This Blog with title ('$blogTitle') is already in use. Please try another name.");
    }

    ////////////////// Image Validation //////////////////
    $allowedExts = ["jpg", "jpeg", "gif", "png", "webp"];
    $extension = strtolower(pathinfo($blogPixFile, PATHINFO_EXTENSION));
    if (!in_array($extension, $allowedExts)) {
        throw new ValidationException("INVALID PICTURE FORMAT! Check the picture format and try again.");
    }

    ////////////////// Generate Blog ID //////////////////
    $sequence = _get_sequence_count($conn, 'BLOG');
    $seqArray = json_decode($sequence, true);
    $no = $seqArray[0]['no'];
    $blogId = 'BLOG' . $no . date("YmdHis");

    $blogPix = $blogId . $blogPixFile;

    ////////////////// Insert Blog //////////////////
    $insertQuery = "
        INSERT INTO BLOG_TAB
        (pageCategoryId, blogCatId, blogId, blogTitle, blogPix, statusId, createdBy, createdTime)
        VALUES (?, ?, ?, ?, ?, ?, ?, NOW())
    ";
    $insertParams = [$pageCategoryId, $blogCatId, $blogId, $blogTitle, $blogPix, $statusId, $loginStaffId];
    insertQuery($conn, $insertQuery, "sssssss", $insertParams);

    ////////////////// Fetch Created Blog //////////////////
    $blogQuery = "SELECT * FROM BLOG_TAB WHERE blogId = ?";
    $blogs = selectQuery($conn, $blogQuery, "s", [$blogId]);

    foreach ($blogs as &$blog) {
        // Blog Category
        $blogCatData = selectQuery($conn, "SELECT categoryId, categoryName FROM INFORMATION_CATEGORY_TAB WHERE categoryId = ?", "s", [$blog['blogCatId']]);
        $blog['blogCatData'] = $blogCatData[0] ?? null;

        // Status
        $statusData = selectQuery($conn, "SELECT * FROM SETUP_STATUS_TAB WHERE statusId = ?", "s", [$blog['statusId']]);
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
        'response'     => 200,
        'success'      => true,
        'oldBlogPix'   => '',
        'newBlogPix'   => $blogPix,
        'message'      => "BLOG CREATED SUCCESSFULLY!",
        'data'         => $blogs
    ];

} catch (Throwable $e) {
    ErrorHandler::handle($e);
}

http_response_code($response['response'] ?? 500);
echo json_encode($response);
?>