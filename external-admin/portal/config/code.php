<?php include '../../config/constants.php';?>
<script src="<?php echo $websiteUrl?>/portal/js/session_validation.js"></script>

<?php
$action=$_POST['action'];

switch ($action){

	case 'get_page':
		$page=$_POST['page'];
		$ids=$_POST['ids'];
		require_once('dashboard-content.php');
		require_once('exam-content.php');
		require_once('years-content.php');
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
		require_once('years-content.php');
		require_once('student-content.php');
		require_once('subscription-content.php');
		require_once('tutorial-content.php');
		require_once('cbt-content.php');
	break;

	case 'uploadExamLogo':
		$oldExamLogo = $_POST['oldExamLogo'] ?? '';
		$newExamLogo = $_POST['newExamLogo'] ?? '';
		$examLogo = $_POST['examLogo'] ?? '';
	
		///// Validate Exam Logo /////
		if (!empty($examLogo)) {
    		$examLogo = preg_replace('#^data:image/\w+;base64,#i', '', $examLogo);
			$examLogo = str_replace(' ', '+', $examLogo);
			$examLogo = base64_decode($examLogo);
		}
		
		//// Upload Exam Logo ////
		$uploadExamLogoDir = "../../uploaded_files/examLogo/";

		//// Create Directory If Not Exists ////
		if(!empty($newExamLogo)){
			if($newExamLogo!=$oldExamLogo){
				unlink($uploadExamLogoDir . $oldExamLogo);
				file_put_contents($uploadExamLogoDir . $newExamLogo, $examLogo);
			}
		}
    break;
}
?>