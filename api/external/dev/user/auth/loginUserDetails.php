<?php
///// fetch the user that just logged in
$selectQuery = "SELECT userId, accessKey, walletBalance, fullName, emailAddress, phoneNumber, departmentId, examId, lastLoginTime FROM USERS_TAB WHERE userId = ?";
$params = [$userId];
$userData = selectQuery($conn, $selectQuery, "s", $params)[0];

$departmentDetails = _get_department_details($conn, $userData['departmentId']);
$examDetails = _get_external_exam_details($conn, $userData['examId']);

$userData['departmentData'] = $departmentDetails;
$userData['examData'] = $examDetails;