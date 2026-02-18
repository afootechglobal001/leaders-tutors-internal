<?php
$headers = getallheaders();
$access_key = isset($headers['Authorization']) ? trim(str_replace('Bearer ', '', $headers['Authorization'])) : null;

///////////auth/////////////////////////////////////////
$fetch=$callclass->_user_accesskey_validation($conn,$access_key);
$array = json_decode($fetch, true);
$check=$array[0]['check'];
$login_user_id=$array[0]['user_id'];
$login_user_fullname=$array[0]['fullname'];
$login_user_email=$array[0]['email'];
$login_user_mobile_no=$array[0]['mobile_no'];
?>