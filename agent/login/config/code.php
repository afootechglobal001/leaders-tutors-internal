<?php include '../../../config/constants.php';?>

<?php
$action=$_POST['action'];

switch ($action){
	case 'otp_form':
		$email=$_POST['email'];
		$page=$action;
		require_once('page-content.php');
	break;
}
?>

