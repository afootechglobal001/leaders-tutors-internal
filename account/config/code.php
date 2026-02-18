<?php include '../../config/constants.php'?>
<script src="js/session_validation.js"></script>
<?php
  	$action=$_POST['action'];
switch ($action){

	
	case 'get_page':
		$page=$_POST['page'];
		$ids=$_POST['ids'];
		require_once '../content/page-content.php';
	break;


	case 'get_form':
		$page=$_POST['page'];
		require_once '../content/form-content.php';
	break;
	

	case 'get_form_with_id':
		$page=$_POST['page'];
		$ids=$_POST['ids'];
		require_once '../content/form-content.php';
	break;







}
?>
