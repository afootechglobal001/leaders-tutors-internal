<?php include '../../config/constants.php';?>
<?php
$action=$_POST['action'];

switch ($action){

	case 'get_form':
		$page=$_POST['page'];
		include '../content/form.php';
	break;

	case 'get_form_with_id':
		$page=$_POST['page'];
		$ids=$_POST['ids'];
		include '../content/form.php';
	break;

	case 'get_secondary_form_with_id':
		$page=$_POST['page'];
		$ids=$_POST['ids'];
		$company_id=$_POST['company_id'];
		$staff_id=$_POST['staff_id'];
		include '../content/form.php';
	break;

	case 'get_page_details':
		$page=$_POST['page'];
		$ids=$_POST['ids'];
		include '../content/form.php';
	break;

}
?>