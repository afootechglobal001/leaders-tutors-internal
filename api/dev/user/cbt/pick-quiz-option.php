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
$selected_option=trim($_POST['selected_option']);
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
if(empty($selected_option)){ 
	$response['response']=103;
	$response['success']=false;
	$response['message']="OPTION REQUIRED! Select at least one option and try again.";
	goto end;
}
if(empty($available_time)){ 
	$response['response']=104;
	$response['success']=false;
	$response['message']="QUIZ TIME REQUIRED! Provide available time and try again.";
	goto end;
}
	/// update cbt_quiz_attempt_tab
	mysqli_query($conn,"UPDATE cbt_quiz_attempt_tab SET last_attempt_time='$available_time' WHERE user_id='$login_user_id' AND tutorial_id='$tutorial_id'")or die (mysqli_error($conn));

	$select="SELECT answer
	FROM cbt_question_bank_tab
	WHERE tutorial_id='$tutorial_id' AND question_id='$question_id'";
	$question_query=mysqli_query($conn,$select)or die (mysqli_error($conn));
	$fetch_query = mysqli_fetch_assoc($question_query);
	$answer = $fetch_query['answer'];

	$score=($answer==$selected_option) ? 1 : 0;

	$query=mysqli_query($conn,"SELECT * FROM `cbt_quiz_result_tab` WHERE user_id='$login_user_id' AND tutorial_id='$tutorial_id' AND question_id='$question_id'")or die (mysqli_error($conn));
	$record_count=mysqli_num_rows($query);
	
	if($record_count>0){
		mysqli_query($conn,"UPDATE cbt_quiz_result_tab SET answer='$answer', option_picked='$selected_option', score='$score', attempted_at='$available_time' WHERE user_id='$login_user_id' AND tutorial_id='$tutorial_id' AND question_id='$question_id'")or die (mysqli_error($conn));
	}else{
	mysqli_query($conn, "INSERT INTO `cbt_quiz_result_tab`
	(`user_id`, `tutorial_id`, `question_id`, `answer`, `option_picked`, `score`, `attempted_at`, `created_time`) VALUES 
	('$login_user_id', '$tutorial_id', '$question_id', '$answer', '$selected_option', '$score', '$available_time', NOW())")or die (mysqli_error($conn));
	}
	$response['response']=200;
	$response['success']=true;
	$response['message']="QUESTION ATTEMPTED! Well done.";
end:
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>