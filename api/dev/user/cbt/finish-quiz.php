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
$available_time=trim($_POST['available_time']);
		
if(empty($tutorial_id)){ 
	$response['response']=101;
	$response['success']=false;
	$response['message']="TUTORIAL ID REQUIRED! Provide TutorialID and try again.";
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

		///// generate quiz_summary_id
		$sequence=$callclass->_get_sequence_count($conn, 'QUIZ');
		$array = json_decode($sequence, true);
		$no= $array[0]['no'];
		$datetime=date("Ymdhi");
		$quiz_summary_id='QUIZ'.$no.$datetime;
		//////////////////////
		$tutorial_array=$callclass->_get_tutorial_details($conn, $tutorial_id);	
		$tutorial_array = json_decode($tutorial_array, true);
		$total_number_of_question= $tutorial_array[0]['quiz_question_counts'];
		$time_allowed= $tutorial_array[0]['quiz_duration'];
		//// get questions_attempted
		$query=mysqli_query($conn,"SELECT * FROM `cbt_quiz_result_tab` WHERE user_id='$login_user_id' AND tutorial_id='$tutorial_id'")or die (mysqli_error($conn));
		$questions_attempted=mysqli_num_rows($query);
		///////////////
		$questions_not_attempted=$total_number_of_question-$questions_attempted;

		//// get questions_passed
		$query = mysqli_query($conn, "SELECT IFNULL(SUM(score), 0) AS total_score FROM `cbt_quiz_result_tab` WHERE user_id='$login_user_id' AND tutorial_id='$tutorial_id'") or die(mysqli_error($conn));
		$row = mysqli_fetch_array($query);
		$questions_passed = $row['total_score'];
		//////////////////
		$questions_failed=$questions_attempted-$questions_passed;


		////////// get time_taken
		$query=mysqli_query($conn,"SELECT last_attempt_time FROM `cbt_quiz_attempt_tab` WHERE user_id='$login_user_id' AND tutorial_id='$tutorial_id'")or die (mysqli_error($conn));
		$fetch_query = mysqli_fetch_assoc($query);
		$time_left=$fetch_query['last_attempt_time'];
		$time_allowed_seconds = strtotime($time_allowed) - strtotime('TODAY');
		$time_left_seconds = strtotime($time_left) - strtotime('TODAY');
		$time_used_seconds = $time_allowed_seconds - $time_left_seconds;
		$time_taken = gmdate("H:i:s", $time_used_seconds);

		$percentage=(($questions_passed/$total_number_of_question)*100);
	
		//////// submit the quiz summary
		mysqli_query($conn, "INSERT INTO `cbt_quiz_result_summary_tab`
		(`quiz_summary_id`, `user_id`, `tutorial_id`, `total_number_of_question`, `questions_attempted`, `questions_not_attempted`, `questions_passed`, `questions_failed`, `time_allowed`, `time_taken`, `percentage`, `created_time`) VALUES 
		('$quiz_summary_id', '$login_user_id', '$tutorial_id', '$total_number_of_question', '$questions_attempted', '$questions_not_attempted', '$questions_passed', '$questions_failed', '$time_allowed',  '$time_taken',  '$percentage', NOW())")or die (mysqli_error($conn));

		/// delete record from cbt_quiz_attempt_tab
		mysqli_query($conn,"DELETE FROM  cbt_quiz_attempt_tab WHERE user_id='$login_user_id' AND tutorial_id='$tutorial_id'")or die (mysqli_error($conn));
		
		/// delete record from cbt_quiz_ongoing_tab
		mysqli_query($conn,"DELETE FROM  cbt_quiz_ongoing_tab WHERE user_id='$login_user_id' AND tutorial_id='$tutorial_id'")or die (mysqli_error($conn));

		//// backup quiz for correction
		$query=mysqli_query($conn,"SELECT * FROM `cbt_quiz_result_tab` WHERE user_id='$login_user_id' AND tutorial_id='$tutorial_id'")or die (mysqli_error($conn));
		while ($fetch_query = mysqli_fetch_assoc($query)) {
			$question_id = $fetch_query['question_id'];
			$answer = $fetch_query['answer'];
			$selected_option = $fetch_query['option_picked'];
			$score = $fetch_query['score'];
			$attempted_at = $fetch_query['attempted_at'];
			$created_time = $fetch_query['updated_time'];

			mysqli_query($conn, "INSERT INTO `cbt_quiz_result_backup_tab`
			(`user_id`, `quiz_summary_id`, `tutorial_id`, `question_id`, `answer`, `option_picked`, `score`, `attempted_at`,`created_time`) VALUES 
			('$login_user_id','$quiz_summary_id', '$tutorial_id', '$question_id', '$answer', '$selected_option', '$score',  '$attempted_at', '$created_time')")or die (mysqli_error($conn));
		}
		/// delete record from cbt_quiz_ongoing_tab
		mysqli_query($conn,"DELETE FROM  cbt_quiz_result_tab WHERE user_id='$login_user_id' AND tutorial_id='$tutorial_id'")or die (mysqli_error($conn));

	$response['response']=200;
	$response['success']=true;
	$response['message']="QUIZ SUBMITTED! Your quiz exercise has been submitted successfully.";
end:
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>