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
    $publishId     = trim($_GET['publishId'] ?? '');
    $pageCategory  = trim($_GET['pageCategory'] ?? '');
    $pageTitle     = trim($_POST['pageTitle'] ?? '');
    $pageUrl       = trim($_POST['pageUrl'] ?? '');
    $seoKeywords   = trim($_POST['seoKeywords'] ?? '');
    $seoDescription= trim($_POST['seoDescription'] ?? '');
    $pageContent   = trim($_POST['pageContent'] ?? '');
    $seoFlyers     = $_FILES['seoFlyer'] ?? null;
    $seoFlyerCount = $seoFlyers ? count($seoFlyers['name']) : 0;

    ////////////////// Validation //////////////////
    validateEmptyField($publishId, 'PAGE IDENTIFIER');
    validateEmptyField($pageCategory, 'PAGE CATEGORY');
    validateEmptyField($pageUrl, 'PAGE URL');
    validateEmptyField($pageTitle, 'PAGE TITLE');
    validateEmptyField($seoKeywords, 'SEO KEYWORDS');
    validateEmptyField($seoDescription, 'SEO DESCRIPTION');
    validateEmptyField($pageContent, 'PAGE CONTENT');

    ////////////////// Check if page URL exists //////////////////
    $existingPage = selectQuery(
        $conn,
        "SELECT publishId FROM PAGES_TAB WHERE pageCategory = ? AND pageUrl = ? AND publishId != ?",
        "sss",
        [$pageCategory, $pageUrl, $publishId]
    );

    if (!empty($existingPage)) {
        throw new ConflictException("PAGE EXIST! Page already exists by URL. Check and try again.");
    }

    ////////////////// Check if page exists //////////////////
    $pageData = selectQuery($conn, "SELECT * FROM PAGES_TAB WHERE publishId = ?", "s", [$publishId]);
    $isUpdate = !empty($pageData);
    $oldPageUrl = $isUpdate ? $pageData[0]['pageUrl'] : null;
    $oldSeoFlyer = $isUpdate ? $pageData[0]['seoFlyer'] : null;

    if ($isUpdate) {
        // Update existing page
        $updateSQL = "
            UPDATE PAGES_TAB SET
                pageUrl = ?, pageTitle = ?, seoKeywords = ?, seoDescription = ?, pageContent = ?,
                updatedBy = ?, updatedTime = NOW()
            WHERE publishId = ?
        ";
        insertQuery($conn, $updateSQL, "sssssss", [$pageUrl, $pageTitle, $seoKeywords, $seoDescription, $pageContent, $loginStaffId, $publishId]);
        $message = "PAGE UPDATED SUCCESSFULLY!";
    } else {
        // New page requires at least 1 SEO flyer
        if ($seoFlyerCount === 0) {
            throw new ValidationException("SEO FLYER REQUIRED! Check the fields and try again.");
        }

        $insertSQL = "
            INSERT INTO PAGES_TAB
            (publishId, pageCategory, pageUrl, pageTitle, seoKeywords, seoDescription, pageContent, createdBy, createdTime)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())
        ";
        insertQuery($conn, $insertSQL, "ssssssss", [$publishId, $pageCategory, $pageUrl, $pageTitle, $seoKeywords, $seoDescription, $pageContent, $loginStaffId]);
        $message = "PAGE CREATED SUCCESSFULLY!";
    }

    ////////////////// Handle SEO Flyers //////////////////
    $newSeoFlyers = [];
    if ($seoFlyerCount > 0) {
        for ($i = 0; $i < $seoFlyerCount; $i++) {
            $imageName = $seoFlyers['name'][$i];
            $extension = pathinfo($imageName, PATHINFO_EXTENSION);
            $newImageName = $publishId . "_" . $i . uniqid() . "." . $extension;

            // Update SEO flyer in DB
            $updateFlyerSQL = "UPDATE PAGES_TAB SET seoFlyer = ? WHERE publishId = ?";
            insertQuery($conn, $updateFlyerSQL, "ss", [$newImageName, $publishId]);

            $newSeoFlyers[] = $newImageName;
        }
    }

    ////////////////// Fetch updated page //////////////////
    $updatedPage = selectQuery($conn, "SELECT * FROM PAGES_TAB WHERE publishId = ?", "s", [$publishId]);

    ////////////////// Response //////////////////
    $response = [
        'response'     => 200,
        'success'      => true,
        'message'      => $message,
        'oldPageUrl'   => $oldPageUrl,
        'oldSeoFlyer'  => $oldSeoFlyer,
        'newSeoFlyers' => $newSeoFlyers,
        'data'         => $updatedPage
    ];

} catch (Throwable $e) {
    ErrorHandler::handle($e);
}

http_response_code($response['response'] ?? 500);
echo json_encode($response);
?>