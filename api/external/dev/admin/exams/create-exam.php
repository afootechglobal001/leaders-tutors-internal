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
    $examName = trim($_POST['examName']);
    $examAbbreviation = trim($_POST['examAbbreviation']);
    $examLogo = $_FILES['examLogo']['name'];
    $statusId = trim($_POST['statusId']);
    ////////////////// Validation //////////////////
    validateEmptyField($examName, 'EXAM NAME');
    validateEmptyField($examAbbreviation, 'EXAM ABBREVIATION');
    validateEmptyField($statusId, 'STATUS ID');
    ///////////////////////getting image extention//////////////////////////
    $allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png", "PNG", "GIF", "webp", "WEBP");
    $extension = pathinfo($_FILES['examLogo']['name'], PATHINFO_EXTENSION);

    if (!in_array(($extension), $allowedExts)) {
        throw new BadRequestException("INVALID IMAGE FORMAT! Allowed formats are: " . implode(", ", $allowedExts));
    }

    ////////////////// Check Duplicate Exam //////////////////
    $examExist = selectQuery(
        $conn,
        "SELECT examId FROM EXTERNAL_EXAMS_TAB WHERE examAbbreviation=?",
        "s",
        [$examAbbreviation]
    );
    if (!empty($examExist)) {
        throw new ConflictException("EXAM EXIST! Exam already exists by name.");
    }


    ////////////////// Generate Branch ID //////////////////
    $sequence = _get_sequence_count($conn, 'EXAM');
    $examId = 'EXAM' . $sequence['no'] . date("Ymdhis");

    $examLogo = $examId . date("Ymdhis") . '_.jpg'; // Assuming the logo will be saved with this name

    ////// insert into database
    $insertQuery = "INSERT INTO EXTERNAL_EXAMS_TAB 
    (examId, examName, examAbbreviation, examLogo, statusId, createdBy, createdTime) VALUES 
    (?, ?, ?, ?, ?, ?, NOW())";
    $insertParams = [$examId, $examName, $examAbbreviation, $examLogo, $statusId, $loginStaffId];
    insertQuery($conn, $insertQuery, 'ssssis', $insertParams);

    //// fetch the newly created exam
    $examData = selectQuery(
        $conn,
        "SELECT * FROM EXTERNAL_EXAMS_TAB WHERE examId = ?",
        "s",
        [$examId]
    )[0];
    $statusId = $examData['statusId'];
    $createdBy = $examData['createdBy'];
    $updatedBy = $examData['updatedBy'];
    ////////////////// status //////////////////
    $examData['statusData'] = _get_status_details($conn, $statusId) ?? null;
    ////////////////// Created By //////////////////
    $examData['createdByData'] = _action_performed_by($connAdmin, $createdBy) ?? null;
    ////////////////// Updated By //////////////////
    $examData['updatedByData'] = _action_performed_by($connAdmin, $updatedBy) ?? null;

    $response = [
        'response' => 200,
        'success' => true,
        'message' => "EXAM CREATED SUCCESSFULLY!",
        'data' => $examData
    ];

} catch (Throwable $e) {
    ErrorHandler::handle($e);
}

http_response_code($response['response'] ?? 500);
echo json_encode($response);