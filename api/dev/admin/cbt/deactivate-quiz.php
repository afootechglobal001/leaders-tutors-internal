<?php require_once '../../config/connection.php';?>
<?php require_once '../../config/admin-session-check.php';?>
<?php
	
////////////////////////////////////////////////////////
///// check for API security
if ($apiKey!=$expected_api_key){/// start if 0
	$response['response']=98;
	$response['success']=false;
	$response['message']="SECURITY ACCESS DENIED! You are not allowed to execute this command due to security bridge.";
}else{/// else if 0


	if($check==0){ /// start if 1
		$response['response']=99;
		$response['success']=false;
		$response['message']="SESSION EXPIRED! Please LogIn Again.";
	}else{/// else if 1

		//////////////////declaration of variables//////////////////////////////////////
		$tutorial_id=trim($_POST['tutorial_id']);
		

		if(empty($tutorial_id)){ ///start if 2
			$response['response']=101;
			$response['success']=false;
			$response['message']="TUTORIAL ID REQUIRED! Provide TutorialID and try again.";
		}else{ ///else if 2

// 			$tutorial_array=$callclass->_get_tutorial_details($conn, $tutorial_id);
// 			$tutorial_array = json_decode($tutorial_array, true);
// 			$department_id= $tutorial_array[0]['department_id'];
// 			$class_id= $tutorial_array[0]['class_id'];
// 			$subject_id= $tutorial_array[0]['subject_id'];
// 			$term_id= $tutorial_array[0]['term_id'];
// 			$week_id= $tutorial_array[0]['week_id'];
// 			$topic= $tutorial_array[0]['topic'];
// 			$duration= $tutorial_array[0]['duration'];
// 			$quiz_status= $tutorial_array[0]['quiz_status'];
// 			$quiz_duration= $tutorial_array[0]['quiz_duration'];


// 				$department_array=$callclass->_get_department_details($conn, $department_id);
// 				$department_array = json_decode($department_array, true);
// 				$department_name= $department_array[0]['department_name'];
				
// 				$class_array=$callclass->_get_class_details($conn, $class_id);
// 				$class_array = json_decode($class_array, true);
// 				$class_name= $class_array[0]['class_name'];
	
// 				$subject_array=$callclass->_get_subject_details($conn, $subject_id);
// 				$subject_array = json_decode($subject_array, true);
// 				$subject_name= $subject_array[0]['subject_name'];
	
// 				$term_array=$callclass->_get_term_details($conn, $term_id);
// 				$term_array = json_decode($term_array, true);
// 				$term_name= $term_array[0]['term_name'];
	
// 				$week_array=$callclass->_get_week_details($conn, $week_id);
// 				$week_array = json_decode($week_array, true);
// 				$week_name= $week_array[0]['week_name'];



			///// deactivate quiz_status on tutorial_tab
			mysqli_query($conn,"UPDATE `tutorial_tab`
			SET `quiz_status`=7,`quiz_duration`='00:00:00'
			WHERE `tutorial_id`='$tutorial_id'")or die (mysqli_error($conn));

			///// deactivate status_id on cbt_quiz_question_tab
			mysqli_query($conn,"UPDATE `cbt_quiz_question_tab`
			SET `status_id`=7
			WHERE `tutorial_id`='$tutorial_id'")or die (mysqli_error($conn));

			$response['response']=200;
			$response['success']=true;
			$response['message']="QUIZ DEACTIVATED SUCCESSFULLY!";
			$alert_detail="QUIZ DEACTIVATED SUCCESSFUL: A quiz was successfully deactivated. DETAIL: $term_name - $department_name - $class_name - $subject_name - $week_name - $topic";
			$callclass->_alert_sequence_and_update($conn,$login_staff_id,$login_staff_fullname,$login_role_id,$alert_detail,$ipAddress,$systemName);


		}/// end if 2
	}/// end if 1
}/// end if 0

//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>
