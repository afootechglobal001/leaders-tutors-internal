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
    $examId = trim($_GET['examId'] ?? '');
    $statusId = trim($_GET['statusId'] ?? '');

    ////////////////// Build Query //////////////////
    $conditions = [];
    $params = [];
    $types = '';

    if (!empty($q)) {
        $conditions[] = "(examName LIKE ? OR examAbbreviation LIKE ?)";
        $params[] = "%$q%";
        $params[] = "%$q%";
        $types .= "ss";
    }

    if (!empty($examId)) {
        $conditions[] = "examId = ?";
        $params[] = $examId;
        $types .= "s";
    }

    if (!empty($statusId)) {
        $conditions[] = "statusId IN ($statusId)";
    }


    $where = !empty($conditions) ? "WHERE " . implode(" AND ", $conditions) : "";

    ///// fetch from EXTERNAL_EXAMS_TAB
    $selectQuery = "SELECT * FROM EXTERNAL_EXAMS_TAB $where";
    $examData = selectQuery($conn, $selectQuery, $types, $params);
    ////////////////// Build Exam Data //////////////////
    foreach ($examData as &$exam) {
        $statusId = $exam['statusId'];
        $createdBy = $exam['createdBy'];
        $updatedBy = $exam['updatedBy'];
        ////////////////// status //////////////////
        $exam['statusData'] = _get_status_details($conn, $statusId) ?? null;
        ////////////////// Created By //////////////////
        $exam['createdByData'] = _action_performed_by($connAdmin, $createdBy) ?? null;
        ////////////////// Updated By //////////////////
        $exam['updatedByData'] = _action_performed_by($connAdmin, $updatedBy) ?? null;
    }

    $response = [
        'response' => 200,
        'success' => true,
        'message' => "EXAM DATA FETCHED SUCCESSFULLY",
        'allRecordCount' => count($examData),
        'data' => $examData,
    ];

} catch (Throwable $e) {
    ErrorHandler::handle($e);
}

http_response_code($response['response']);
echo json_encode($response);