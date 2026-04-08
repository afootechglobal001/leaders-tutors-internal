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
    $departmentId = $_GET['departmentId'];
    $yearValue = trim($data['yearValue']);
    $exams = $data['exams'];
    $subjects = $data['subjects'];
    $statusId = trim($data['statusId']);
    ////////////////// Validation //////////////////
    validateEmptyField($departmentId, 'DEPARTMENT');
    validateEmptyField($yearValue, 'YEAR');
    validateEmptyField($statusId, 'STATUS ID');

    validateNumericField($departmentId, 'DEPARTMENT');
    validateNumericField($yearValue, 'YEAR');
    validateNumericField($statusId, 'STATUS ID');

    if (count($exams) == 0) {
        throw new BadRequestException("EXAMS REQUIRED! Please provide at least one exam.");
    }
    if (count($subjects) == 0) {
        throw new BadRequestException("SUBJECTS REQUIRED! Please provide at least one subject.");
    }

    //// check if the year already exists for the department
    $existingYear = selectQuery(
        $conn,
        "SELECT yearId FROM YEARS_TAB WHERE departmentId = ? AND yearValue = ?",
        "is",
        [$departmentId, $yearValue]
    );
    if (count($existingYear) > 0) {
        throw new ConflictException("YEAR ALREADY EXISTS! The year $yearValue already exists for the selected department.");
    }



    ////////////////// Generate Year ID //////////////////
    $sequence = _get_sequence_count($conn, 'YEAR');
    $yearId = 'YEAR' . $sequence['no'] . date("Ymdhis");
    ////// insert into database
    $insertQuery = "INSERT INTO `YEARS_TAB`
    (`yearId`, `departmentId`, `yearValue`, `statusId`, `createdBy`, `createdTime`) VALUES
    (?, ?, ?, ?, ?, NOW())";
    $insertParams = [$yearId, $departmentId, $yearValue, $statusId, $loginStaffId];
    insertQuery($conn, $insertQuery, 'siiis', $insertParams);

    foreach ($exams as $exam) {
        $examId = $exam['examId'];
        $insertExamQuery = "INSERT INTO YEAR_EXAMS_TAB (yearId, examId) VALUES (?, ?)";
        $insertExamParams = [$yearId, $examId];
        insertQuery($conn, $insertExamQuery, 'ss', $insertExamParams);
    }

    foreach ($subjects as $subject) {
        $subjectId = $subject['subjectId'];
        $insertSubjectQuery = "INSERT INTO YEAR_SUBJECTS_TAB (yearId, subjectId) VALUES (?, ?)";
        $insertSubjectParams = [$yearId, $subjectId];
        insertQuery($conn, $insertSubjectQuery, 'ss', $insertSubjectParams);
    }

    //// fetch the newly created year
    $yearData = selectQuery(
        $conn,
        "SELECT * FROM YEARS_TAB WHERE yearId = ?",
        "s",
        [$yearId]
    )[0];
    $departmentId = $yearData['departmentId'];
    $statusId = $yearData['statusId'];
    $createdBy = $yearData['createdBy'];
    $updatedBy = $yearData['updatedBy'];
    ///// fetch department details
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
        'message' => "YEAR CREATED SUCCESSFULLY!",
        'data' => $yearData
    ];

} catch (Throwable $e) {
    ErrorHandler::handle($e);
}

http_response_code($response['response'] ?? 500);
echo json_encode($response);