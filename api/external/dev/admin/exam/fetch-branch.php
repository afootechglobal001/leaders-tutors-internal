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
    $q = trim($_GET['q'] ?? '');
    $branchId = trim($_GET['branchId'] ?? '');
    $statusId = trim($_GET['statusId'] ?? '');

    ////////////////// Build Query //////////////////
    $conditions = [];
    $params = [];
    $types = '';

    if (!empty($q)) {
        $conditions[] = "(name LIKE ? OR address LIKE ?)";
        $params[] = "%$q%";
        $params[] = "%$q%";
        $types .= "ss";
    }

    if (!empty($branchId)) {
        $conditions[] = "branchId = ?";
        $params[] = $branchId;
        $types .= "s";
    }

    if (!empty($statusId)) {
        $conditions[] = "statusId IN ($statusId)";
    }

    $where = !empty($conditions) ? "WHERE " . implode(" AND ", $conditions) : "";

    $select = "SELECT * FROM BRANCH_VIEW $where";

    $branches = selectQuery($conn, $select, $types, $params);

    if (empty($branches)) {
        throw new NotFoundException("No Record found");
    }

    ////////////////// Process Branch Data //////////////////
    foreach ($branches as &$branch) {

        $branchId = $branch['branchId'];
        $createdBy = $branch['createdBy'];
        $updatedBy = $branch['updatedBy'];

        /// createdBy
        $createdByData = selectQuery(
            $conn,
            "SELECT CONCAT(firstName,' ',lastName) AS fullname,emailAddress FROM STAFF_TAB WHERE staffId=?",
            "s",
            [$createdBy]
        );

        $branch['createdBy'] = $createdByData[0] ?? null;

        /// updatedBy
        $updatedByData = selectQuery(
            $conn,
            "SELECT CONCAT(firstName,' ',lastName) AS fullname,emailAddress FROM STAFF_TAB WHERE staffId=?",
            "s",
            [$updatedBy]
        );

        $branch['updatedBy'] = $updatedByData[0] ?? null;

        /// total staff
        $staffCount = selectQuery(
            $conn,
            "SELECT COUNT(*) AS count FROM STAFF_TAB WHERE branchId=?",
            "s",
            [$branchId]
        );

        $branch['totalNumberOfStaff'] = $staffCount[0]['count'] ?? 0;

        ////////////////// Product Categories //////////////////
        $activeProductCategories = [];

        $categories = selectQuery(
            $conn,
            "SELECT productId AS productCategoryId, productName 
             FROM PRODUCTS_TAB 
             WHERE statusId=1 AND productLevel=1"
        );

        foreach ($categories as $category) {

            $productCategoryId = $category['productCategoryId'];

            $productCount = selectQuery(
                $conn,
                "SELECT COUNT(*) AS count 
                 FROM BRANCH_PRODUCTS_TAB 
                 WHERE branchId=? 
                 AND productCategoryId=? 
                 AND statusId=1",
                "ss",
                [$branchId, $productCategoryId]
            );

            $category['totalNumberOfProducts'] = $productCount[0]['count'] ?? 0;

            $activeProductCategories[] = $category;
        }

        $branch['productCategories'] = $activeProductCategories;
    }

    ////////////////// Response //////////////////
    $response = [
        'response' => 200,
        'success' => true,
        'message' => "BRANCH FETCH SUCCESSFULLY!",
        'allRecordCount' => count($branches),
        'data' => $branches
    ];

} catch (Throwable $e) {

    ErrorHandler::handle($e);

}

http_response_code($response['response'] ?? 500);
echo json_encode($response);