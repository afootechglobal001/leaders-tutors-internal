<?php include '../../../config/constants.php';?>

<?php
$action=$_POST['action'];

switch ($action){
    
	case 'get_form':
		$page=$_POST['page'];
		require_once('../content/form.php');
	break;

	case 'otp_form':
		$email=$_POST['email'];
		$page=$action;
		require_once('../content/form.php');
	break;
}
?>