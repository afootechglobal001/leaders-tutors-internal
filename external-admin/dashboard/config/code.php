<?php include '../../config/constants.php';?>
<script src="<?php echo $websiteUrl?>/admin/dashboard/js/session_validation.js"></script>

<?php
$action=$_POST['action'];

switch ($action){

	case 'get_page':
		$page=$_POST['page'];
		$ids=$_POST['ids'];
		require_once('dashboard-content.php');
		require_once('exam-content.php');
		require_once('student-content.php');
		require_once('subscription-content.php');
		require_once('tutorial-content.php');
		require_once('cbt-content.php');
	break;

	case 'get_form':
		$page=$_POST['page'];
		$id=$_POST['id'];
		$modalLayer=$_POST['modalLayer'];
		require_once('dashboard-content.php');
		require_once('exam-content.php');
		require_once('student-content.php');
		require_once('subscription-content.php');
		require_once('tutorial-content.php');
		require_once('cbt-content.php');
	break;
}
?>