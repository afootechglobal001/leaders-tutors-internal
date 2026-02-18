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
$question_id=trim($_POST['question_id']);
$available_time=trim($_POST['available_time']);
		
if(empty($tutorial_id)){ 
	$response['response']=101;
	$response['success']=false;
	$response['message']="TUTORIAL ID REQUIRED! Provide TutorialID and try again.";
	goto end;
}
if(empty($question_id)){ 
	$response['response']=102;
	$response['success']=false;
	$response['message']="QUESTION ID REQUIRED! Provide questionId and try again.";
	goto end;
}
if(empty($available_time)){ 
	$response['response']=102;
	$response['success']=false;
	$response['message']="QUIZ TIME REQUIRED! Provide available time and try again.";
	goto end;
}
	/// update cbt_quiz_attempt_tab
	mysqli_query($conn,"UPDATE cbt_quiz_attempt_tab SET last_attempt_time='$available_time' WHERE user_id='$login_user_id' AND tutorial_id='$tutorial_id'")or die (mysqli_error($conn));

	$select="SELECT question_text, question_pix
	FROM cbt_question_bank_tab
	WHERE tutorial_id='$tutorial_id' AND question_id='$question_id'";

	$query=mysqli_query($conn,$select)or die (mysqli_error($conn));

	$response['response']=200;
	$response['success']=true;
	$response['tutorial_id']=$tutorial_id;
	$response['question_id']=$question_id;

	$fetch_query = mysqli_fetch_assoc($query);
	$fetch_query['questionsStoragePath'] = "$documentStoragePath/cbt-question-pix";

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

			/////// check if this question has been attempted before
			$select="SELECT option_picked
			FROM cbt_quiz_result_tab
			WHERE user_id='$login_user_id' AND tutorial_id='$tutorial_id' AND question_id='$question_id'";
			$option_query=mysqli_query($conn,$select);
			$fetch_option_query = mysqli_fetch_assoc($option_query);
			$fetch_query['selected_option']= $fetch_option_query['option_picked'];

			$response['questions'][] = $fetch_query;
	
end:
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>