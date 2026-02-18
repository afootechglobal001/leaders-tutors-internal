<?php
$headers = getallheaders();
$access_key = isset($headers['Authorization']) ? trim(str_replace('Bearer ', '', $headers['Authorization'])) : null;

///////////auth/////////////////////////////////////////
$fetch=$callclass->_agent_accesskey_validation($conn,$access_key);
$array = json_decode($fetch, true);
$check=$array[0]['check'];
$login_agent_email=$array[0]['email'];
$email=$login_agent_email;


//////////////////declaration of variables//////////////////////////////////////
$company_id=trim($_POST['company_id']);
if(!empty($company_id)){
    $fetch=$callclass->_get_agent_details($conn,$company_id,$login_agent_email);
    $array = json_decode($fetch, true);
    $login_agent_staff_id=$array[0]['staff_id'];
    $login_agent_fullname=$array[0]['name'];
    $login_agent_phone=$array[0]['phone'];
    $login_agent_role_id=$array[0]['role_id'];
    $login_agent_status_id=$array[0]['status_id'];
    $login_agent_isApproved=$array[0]['isApproved'];

    $fetch=$callclass->_get_company_details($conn,$company_id);
    $array = json_decode($fetch, true);
    $company_name=$array[0]['name'];
    $company_email=$array[0]['email'];
    $company_phone=$array[0]['phone'];
    $company_address=$array[0]['address'];
}
?>