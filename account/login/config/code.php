<?php include '../../../config/constants.php';?>

<?php
$action=$_POST['action'];

switch ($action){


	case 'get_page':
		$page=$_POST['page'];
		include '../content/page-content.php';
	break;

	case 'get_page_with_id':
		$page=$_POST['page'];
		include '../content/page-content.php';
	break;

	case 'reset_password':
		$page=$action;
		include '../content/page-content.php';
	break;

	
}
?>