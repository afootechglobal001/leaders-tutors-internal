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
    $examId = trim($_GET['examId'] ?? '');
    $examName = trim($_POST['examName']);
    $examAbbreviation = trim($_POST['examAbbreviation']);
    $examLogo = $_FILES['examLogo']['name'];
    $statusId = trim($_POST['statusId']);
    ////////////////// Validation //////////////////
    validateEmptyField($examId, 'EXAM ID');
    validateEmptyField($examName, 'EXAM NAME');
    validateEmptyField($examAbbreviation, 'EXAM ABBREVIATION');
    validateEmptyField($statusId, 'STATUS ID');

    ////////////////// Check Duplicate Exam //////////////////
    $examExist = selectQuery(
        $conn,
        "SELECT examId FROM EXTERNAL_EXAMS_TAB WHERE examAbbreviation=? AND examId != ?",
        "ss",
        [$examAbbreviation, $examId]
    );
    if (!empty($examExist)) {
        throw new ConflictException("EXAM EXIST! Exam already exists by name.");
    }

    ////////////////// Update Exam //////////////////
    $updateQuery = "UPDATE EXTERNAL_EXAMS_TAB SET examName = ?, examAbbreviation = ?, statusId = ?, updatedBy = ? WHERE examId = ?";
    $updateParams = [$examName, $examAbbreviation, $statusId, $loginStaffId, $examId];
    $updateTypes = "ssiss";
    updateQuery($conn, $updateQuery, $updateTypes, $updateParams);

    ///////////////////////getting image extention//////////////////////////
    $allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png", "PNG", "GIF", "webp", "WEBP");
    $extension = pathinfo($_FILES['examLogo']['name'], PATHINFO_EXTENSION);

    if (in_array(($extension), $allowedExts)) {
        //// get old exam logo name to delete from folder
        $getExamDetails = _get_external_exam_details($conn, $examId);
        $oldExamLogo = $getExamDetails['examLogo'];

        $examLogoName = $examId . date("Ymdhis") . '_.jpg'; // Assuming the logo will be saved with this name
        $updateLogoQuery = "UPDATE EXTERNAL_EXAMS_TAB SET examLogo = ? WHERE examId = ?";
        $updateLogoParams = [$examLogoName, $examId];
        updateQuery($conn, $updateLogoQuery, "ss", $updateLogoParams);
    }


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
        'message' => "EXAM UPDATED SUCCESSFULLY!",
        'oldExamLogo' => $oldExamLogo ?? null,
        'data' => $examData
    ];

} catch (Throwable $e) {
    ErrorHandler::handle($e);
}

http_response_code($response['response'] ?? 500);
echo json_encode($response);