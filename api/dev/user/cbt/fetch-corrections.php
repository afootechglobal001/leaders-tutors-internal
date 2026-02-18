<?php require_once '../../config/connection.php';?>
<?php require_once '../../config/user-session-check.php';?>

<?php
///// check for API security
if ($apiKey!=$expected_api_key){
	$response['response']=98;
	$response['success']=false;
	$response['message']="SECURITY ACCESS DENIED! You are not allowed to execute this command due to security bridge.";
	goto end;
}
if($check==0){
	$response['response']=99;
	$response['success']=false;
	$response['message']="SESSION EXPIRED! Please LogIn Again.";
	goto end;
}

//////////////////declaration of variables//////////////////////////////////////
$tutorial_id=trim($_POST['tutorial_id']);
$quiz_summary_id=trim($_POST['quiz_summary_id']);

		
if(empty($tutorial_id)){ 
	$response['response']=101;
	$response['success']=false;
	$response['message']="TUTORIAL ID REQUIRED! Provide TutorialID and try again.";
	goto end;
}
if(empty($quiz_summary_id)){ 
	$response['response']=102;
	$response['success']=false;
	$response['message']="QUIZ SUMMARY ID REQUIRED! Please check and try again.";
	goto end;
}

	$select="SELECT a.*, b.*
	FROM cbt_quiz_question_tab a, cbt_question_bank_tab b
	WHERE a.tutorial_id=b.tutorial_id AND a.question_id=b.question_id  AND a.tutorial_id='$tutorial_id'
	ORDER BY b.sn ASC";

		$query=mysqli_query($conn,$select)or die (mysqli_error($conn));
		$all_record_count=mysqli_num_rows($query);
		if($all_record_count==0){///start if 3
			$response['response']=200;
			$response['success']=true;
			$response['message']="No Record found";
			goto end;
		}
			$response['response']=200;
			$response['success']=true;
			$response['message']="Correction fetched!";
			$response['questions'] = array(); // Initialize the data array

			while ($fetch_query = mysqli_fetch_assoc($query)) {
				$fetch_query['questionsStoragePath'] = "$documentStoragePath/cbt-question-pix";
				///get question_id
				$question_id = $fetch_query['question_id'];

				$getQuestionOptionsQuery=mysqli_query($conn,"SELECT
					*
					FROM cbt_options_tab
					WHERE question_id='$question_id'
					ORDER BY option_id ASC")or die (mysqli_error($conn));

					$getQuestionOptions=array();
					while ($getQuestionOption = mysqli_fetch_assoc($getQuestionOptionsQuery)) {
						$getQuestionOption['optionsStoragePath'] = "$documentStoragePath/cbt-option-pix";
						$getQuestionOptions[] = $getQuestionOption;
					}
					$fetch_query['options']= $getQuestionOptions;

					/////// check if this question was attempted before
					$option_query=mysqli_query($conn,"SELECT *
					FROM cbt_quiz_result_backup_tab
					WHERE user_id='$login_user_id' AND tutorial_id='$tutorial_id' AND question_id='$question_id' AND quiz_summary_id='$quiz_summary_id'");
					$fetch_option_query = mysqli_fetch_assoc($option_query);
					$fetch_query['selected_option']= $fetch_option_query['option_picked'];

					$response['questions'][] = $fetch_query;
			}
end:
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>