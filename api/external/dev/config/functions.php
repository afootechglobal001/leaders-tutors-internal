<?php
function _staff_accesskey_validation($conn, $accessKey)
{
    $getQuery = "SELECT * FROM STAFF_VIEW WHERE accessKey=? AND statusId=?";
    $getParams = [$accessKey, 1];
    $getResult = selectQuery($conn, $getQuery, 'si', $getParams);
    $count = count($getResult);
    if ($count > 0) {
        $userData = $getResult[0];
        $firstName = $userData['firstName'];
        $lastName = $userData['lastName'];
        $response = [
            "checkSession" => true,
            "loginStaffId" => $userData['staffId'],
            "loginFullname" => "$firstName $lastName",
            "loginRoleid" => $userData['roleId']
        ];
    } else {
        $response = [
            "checkSession" => false
        ];
    }
    return ($response);
}

///////////////////////////////////////////////////////////////////////////////////////////////////
function _get_sequence_count($conn, $counterId)
{
    $getQuery = "SELECT counterValue FROM SETUP_COUNTER_TAB WHERE counterId = ? FOR UPDATE";
    $getParams = [$counterId];
    $getResult = selectQuery($conn, $getQuery, 's', $getParams);
    $count = $getResult[0]['counterValue'];
    $num = $count + 1;
    ///// update the counter value in the database
    $updateQuery = "UPDATE `SETUP_COUNTER_TAB` SET `counterValue` = ? WHERE counterId = ?";
    $updateParams = [$num, $counterId];
    updateQuery($conn, $updateQuery, 'is', $updateParams);
    if ($num < 10) {
        $no = '00' . $num;
    } elseif ($num >= 10 && $num < 100) {
        $no = '0' . $num;
    } else {
        $no = $num;
    }
    $response = ["no" => $no];
    return ($response);
}

function _get_setup_backend_settings_detail($conn, $settingsId)
{
    $getQuery = "SELECT * FROM SETUP_BACKEND_SETTINGS_TAB WHERE settingsId = ?";
    $getParams = [$settingsId];
    $getResult = selectQuery($conn, $getQuery, 's', $getParams);
    return ($getResult[0]);
}

///////////////////////////////////////////////////////////////////////////////////////////////////
function _action_performed_by($conn, $staffId)
{
    $getQuery = "SELECT CONCAT(firstName,' ',lastName) AS fullname, emailAddress FROM STAFF_TAB WHERE staffId = ?";
    $getParams = [$staffId];
    $getResult = selectQuery($conn, $getQuery, 's', $getParams);
    return ($getResult[0]);
}

////// get STATUS details
function _get_status_details($conn, $statusId)
{
    $getQuery = "SELECT statusId, statusName FROM SETUP_STATUS_TAB WHERE statusId = ?";
    $getParams = [$statusId];
    $getResult = selectQuery($conn, $getQuery, 's', $getParams);
    return ($getResult[0]);
}

////// get DEPARTMENT details
function _get_department_details($conn, $departmentId)
{
    $getQuery = "SELECT departmentId, departmentName FROM SETUP_DEPARTMENTS_TAB WHERE departmentId = ?";
    $getParams = [$departmentId];
    $getResult = selectQuery($conn, $getQuery, 'i', $getParams);
    return ($getResult[0]);
}

////// get EXTERNAL EXAM details
function _get_external_exam_details($conn, $examId)
{
    $getQuery = "SELECT examId, examName FROM EXTERNAL_EXAMS_TAB WHERE examId = ?";
    $getParams = [$examId];
    $getResult = selectQuery($conn, $getQuery, 's', $getParams);
    return ($getResult[0]);
}