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
    $staffId = trim($_GET['staffId'] ?? '');
    $statusId = trim($_GET['statusId'] ?? '');

    ////////////////// Dynamic Conditions //////////////////

    $conditions = [];
    $params = [];
    $types = '';

    if (!empty($staffId)) {
        $conditions[] = "staffId = ?";
        $params[] = $staffId;
        $types .= "s";
    }

    if (!empty($statusId)) {
        $conditions[] = "statusId IN ($statusId)";
    }

    $extraWhere = '';
    if (!empty($conditions)) {
        $extraWhere = " AND " . implode(" AND ", $conditions);
    }

    ////////////////// Search Query //////////////////

    $searchClause = "
        (
            firstName LIKE ?
            OR middleName LIKE ?
            OR lastName LIKE ?
            OR mobileNumber LIKE ?
            OR address LIKE ?
        )
    ";

    $searchValue = "%{$q}%";

    $params = array_merge([$searchValue,$searchValue,$searchValue,$searchValue,$searchValue], $params);
    $types = "sssss" . $types;

    $selectQuery = "
        SELECT *
        FROM STAFF_VIEW
        WHERE $searchClause
        $extraWhere
        ORDER BY firstName ASC
    ";

    $staffData = selectQuery($conn, $selectQuery, $types, $params);
    $allRecordCount = count($staffData);

    if ($allRecordCount === 0) {
        throw new NotFoundException("No Record found");
    }

    ////////////////// Process Data //////////////////

    foreach ($staffData as &$staff) {

        $staff['fullName'] = $staff['firstName'] . " " . $staff['lastName'];

        $createdBy = $staff['createdBy'];
        $updatedBy = $staff['updatedBy'];

        ////////////////// Created By //////////////////
        $staff['createdBy'] = _action_performed_by($conn, $createdBy) ?? null;
        ////////////////// Updated By //////////////////
        $staff['updatedBy'] = _action_performed_by($conn, $updatedBy) ?? null;
    }

    ////////////////// Response //////////////////

    $response = [
        'response' => 200,
        'success' => true,
        'message' => "STAFF FETCH SUCCESSFULLY!",
        'allRecordCount' => $allRecordCount,
        'data' => $staffData
    ];

} catch (Throwable $e) {
    ErrorHandler::handle($e);
}

http_response_code($response['response'] ?? 500);
echo json_encode($response);
?>