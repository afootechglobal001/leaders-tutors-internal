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
    $yearId = trim($_GET['yearId'] ?? '');
    ////////////////// Validation //////////////////
    validateEmptyField($yearId, 'YEAR');


    ///// fetch from YEARS_TAB
    $selectQuery = "SELECT * FROM YEARS_TAB WHERE yearId = ?";
    $types = "i";
    $params = [$yearId];
    $yearData = selectQuery($conn, $selectQuery, $types, $params)[0];
    ////////////////// Build Year Data //////////////////

    $departmentId = $yearData['departmentId'];
    $statusId = $yearData['statusId'];
    $createdBy = $yearData['createdBy'];
    $updatedBy = $yearData['updatedBy'];
    $yearData['departmentData'] = _get_department_details($conn, $departmentId) ?? null;

    ////////////////// status //////////////////
    $yearData['statusData'] = _get_status_details($conn, $statusId) ?? null;
    ////////////////// Created By //////////////////
    $yearData['createdByData'] = _action_performed_by($connAdmin, $createdBy) ?? null;
    ////////////////// Updated By //////////////////
    $yearData['updatedByData'] = _action_performed_by($connAdmin, $updatedBy) ?? null;

    ///// get list of exams for the year
    $yearData['examsData'] = selectQuery(
        $conn,
        "SELECT b.examId, b.examName, b.examAbbreviation FROM YEAR_EXAMS_TAB a JOIN EXTERNAL_EXAMS_TAB b ON a.examId = b.examId WHERE a.yearId = ?",
        "s",
        [$yearId]
    );

    ///// get list of subjects for the year
    $subjects = selectQuery(
        $conn,
        "SELECT subjectId FROM YEAR_SUBJECTS_TAB WHERE yearId = ?",
        "s",
        [$yearId]
    );

    foreach ($subjects as &$subject) {
        $subjectId = $subject['subjectId'];
        $subjectData = selectQuery(
            $connAdmin,
            "SELECT subject_id, subject_name FROM subjects_tab WHERE subject_id = ?",
            "s",
            [$subjectId]
        )[0];
        $subject['subjectName'] = $subjectData['subject_name'] ?? null;
    }
    $yearData['subjectsData'] = $subjects;


    $response = [
        'response' => 200,
        'success' => true,
        'message' => "YEAR DATA FETCHED SUCCESSFULLY",
        'allRecordCount' => count($yearData),
        'data' => $yearData,
    ];

} catch (Throwable $e) {
    ErrorHandler::handle($e);
}

http_response_code($response['response']);
echo json_encode($response);