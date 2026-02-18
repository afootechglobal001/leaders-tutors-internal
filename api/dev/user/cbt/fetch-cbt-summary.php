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
		
if(empty($tutorial_id)){ 
	$response['response']=101;
	$response['success']=false;
	$response['message']="TUTORIAL ID REQUIRED! Provide TutorialID and try again.";
	goto end;
}

			$tutorial_array=$callclass->_get_tutorial_details($conn, $tutorial_id);	
			$tutorial_array = json_decode($tutorial_array, true);
			$department_id= $tutorial_array[0]['department_id'];
			$class_id= $tutorial_array[0]['class_id'];
			$subject_id= $tutorial_array[0]['subject_id'];
			$term_id= $tutorial_array[0]['term_id'];
			$week_id= $tutorial_array[0]['week_id'];
			$topic= $tutorial_array[0]['topic'];
			$duration= $tutorial_array[0]['duration'];
			$quiz_status= $tutorial_array[0]['quiz_status'];
			$quiz_duration= $tutorial_array[0]['quiz_duration'];
			$quiz_question_counts= $tutorial_array[0]['quiz_question_counts'];

			$term_array=$callclass->_get_term_details($conn, $term_id);
			$term_array = json_decode($term_array, true);
			$term_name= $term_array[0]['term_name'];

			$department_array=$callclass->_get_department_details($conn, $department_id);
			$department_array = json_decode($department_array, true);
			$department_name= $department_array[0]['department_name'];
			
			$class_array=$callclass->_get_class_details($conn, $class_id);
			$class_array = json_decode($class_array, true);
			$class_name= $class_array[0]['class_name'];

			$subject_array=$callclass->_get_subject_details($conn, $subject_id);
			$subject_array = json_decode($subject_array, true);
			$subject_name= $subject_array[0]['subject_name'];

			$week_array=$callclass->_get_week_details($conn, $week_id);
			$week_array = json_decode($week_array, true);
			$week_name= $week_array[0]['week_name'];

			$query=mysqli_query($conn,"SELECT last_attempt_time FROM `cbt_quiz_attempt_tab` WHERE user_id='$login_user_id' AND tutorial_id='$tutorial_id'")or die (mysqli_error($conn));
			$all_record_count=mysqli_num_rows($query);
			$quiz_started=false;
			if($all_record_count>0){
				$quiz_started=true;
				$fetch_query = mysqli_fetch_assoc($query);
				$quiz_duration=$fetch_query['last_attempt_time'];
			}

			$response = [
				'response'=> 200,
				'success'=> true,
				'user_fullname'=> $login_user_fullname,
				'tutorial_id'=> $tutorial_id,
				'department_name'=> $department_name,
				'class_name'=> $class_name,
				'term_name'=> $term_name,
				'subject_name'=> $subject_name,
				'week_name'=> $week_name,
				'topic'=> $topic,
				'quiz_status'=> $quiz_status,
				'quiz_duration'=> $quiz_duration,
				'quiz_question_counts'=> $quiz_question_counts,
				'quiz_started'=> $quiz_started,
			]; 

end:
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>