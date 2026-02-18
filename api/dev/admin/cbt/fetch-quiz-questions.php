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
		}else{
			
			
			$query=mysqli_query($conn,"SELECT * FROM tutorial_tab WHERE tutorial_id='$tutorial_id'")or die (mysqli_error($conn));
            $fetch_query=mysqli_fetch_array($query);
        	$department_id=$fetch_query['department_id'];
        	$class_id=$fetch_query['class_id'];
        	$term_id=$fetch_query['term_id'];
        	$subject_id=$fetch_query['subject_id'];
        	$quiz_status=$fetch_query['quiz_status'];
        	$quiz_duration=$fetch_query['quiz_duration'];
            	
            $status_array=$callclass->_get_status_details($conn, $quiz_status);
			$status_array = json_decode($status_array, true);
			$quiz_status_name= $status_array[0]['status_name'];


			$select="SELECT a.*, b.*, c.fullname AS staff_name
					FROM cbt_quiz_question_tab a, cbt_question_bank_tab b, staff_tab c
					WHERE  a.question_id=b.question_id AND b.modified_by=c.staff_id AND a.tutorial_id='$tutorial_id'
					ORDER BY a.sn ASC";

			$query=mysqli_query($conn,$select)or die (mysqli_error($conn));
			$all_record_count=mysqli_num_rows($query);
			if($all_record_count==0){///start if 3
				$response['response']=200;
				$response['success']=true;
				$response['message']="No Record found";
			}else{///else if 3
				$response['response']=200;
				$response['success']=true;
				$response['all_record_count']=$all_record_count;
				$response['quiz_status']=$quiz_status;
				$response['quiz_status_name']=$quiz_status_name;
				$response['quiz_duration']=$quiz_duration;
				$response['tutorial_id']=$tutorial_id;
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
						$response['questions'][] = $fetch_query;
				}
			}/// end if 3
		}/// end if 2
	}/// end if 1
}/// end if 0

//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>
