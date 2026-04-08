<?php
$headers = getallheaders();
$accessKey = isset($headers['Authorization']) ? trim(str_replace('Bearer ', '', $headers['Authorization'])) : null;
///////////auth/////////////////////////////////////////
validateEmptyField($accessKey, 'ACCESS KEY');

$response = _staff_accesskey_validation($connAdmin, $accessKey);
$checkSession = $response['checkSession'];
$loginStaffId = $response['loginStaffId'];
$loginStaffFullname = $response['loginFullname'];
$loginRoleId = $response['loginRoleid'];