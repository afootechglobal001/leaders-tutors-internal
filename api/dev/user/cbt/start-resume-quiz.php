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

			$query=mysqli_query($conn,"SELECT * FROM `cbt_quiz_attempt_tab` WHERE user_id='$login_user_id' AND tutorial_id='$tutorial_id'")or die (mysqli_error($conn));
			$all_record_count=mysqli_num_rows($query);
			$quiz_statred=false;
			
			if($all_record_count==0){ // have not attempt at all
				$roll_question_query=mysqli_query($conn,"SELECT * FROM `cbt_quiz_question_tab` WHERE tutorial_id='$tutorial_id' ORDER BY RAND()")or die (mysqli_error($conn));
				$no=0;
				while ($fetch_query = mysqli_fetch_assoc($roll_question_query)) {
					$no++;
					$question_id = $fetch_query['question_id'];
					mysqli_query($conn, "INSERT INTO `cbt_quiz_ongoing_tab`
					(`user_id`, `tutorial_id`, `display_question_no`, `question_id`) VALUES
					('$login_user_id', '$tutorial_id', '$no', '$question_id')")or die (mysqli_error($conn));
					
					if($no==1){
						$display_question_id=$question_id;
					}
				}

				/// register an attempt
				$tutorial_array=$callclass->_get_tutorial_details($conn, $tutorial_id);	
				$tutorial_array = json_decode($tutorial_array, true);
				$quiz_duration= $tutorial_array[0]['quiz_duration'];

				mysqli_query($conn, "INSERT INTO `cbt_quiz_attempt_tab`
				(`user_id`, `tutorial_id`, `last_attempt_time`) VALUES
				('$login_user_id', '$tutorial_id', '$quiz_duration')")or die (mysqli_error($conn));
				$display_question_no=1;

			}else{

				//// confirm if any question has been attempted
				$query=mysqli_query($conn,"SELECT * FROM `cbt_quiz_result_tab` WHERE user_id='$login_user_id' AND tutorial_id='$tutorial_id'")or die (mysqli_error($conn));
				$record_count=mysqli_num_rows($query);
				
				if($record_count>0){ 

					//// get the last question attempted first (get display_question_id)
					$last_question_attempt_query=mysqli_query($conn,"SELECT * FROM `cbt_quiz_result_tab` WHERE user_id='$login_user_id' AND tutorial_id='$tutorial_id' ORDER BY updated_time DESC LIMIT 1")or die (mysqli_error($conn));
					$fetch_query = mysqli_fetch_array($last_question_attempt_query);
					$display_question_id = $fetch_query['question_id'];

					/// get display_question_no
					$display_question_no_query=mysqli_query($conn,"SELECT * FROM `cbt_quiz_ongoing_tab` WHERE user_id='$login_user_id' AND tutorial_id='$tutorial_id' AND question_id='$display_question_id'")or die (mysqli_error($conn));
					$fetch_query = mysqli_fetch_array($display_question_no_query);
					$display_question_no = $fetch_query['display_question_no'];
				}else{
					$display_question_no=1;
					/// get display_question_id
					$display_question_id_query=mysqli_query($conn,"SELECT * FROM `cbt_quiz_ongoing_tab` WHERE user_id='$login_user_id' AND tutorial_id='$tutorial_id' AND display_question_no='$display_question_no'")or die (mysqli_error($conn));
					$fetch_query = mysqli_fetch_array($display_question_id_query);
					$display_question_id = $fetch_query['question_id'];
				}
			}

			$response = [
				'response'=> 200,
				'success'=> true,
				'tutorial_id'=> $tutorial_id,
				'display_question_no'=> $display_question_no,
				'display_question_id'=> $display_question_id,
				'buttons'=> array(),
			]; 

			$question_query=mysqli_query($conn,"SELECT * FROM `cbt_quiz_ongoing_tab` WHERE user_id='$login_user_id' AND tutorial_id='$tutorial_id'")or die (mysqli_error($conn));
			while ($fetch_query = mysqli_fetch_assoc($question_query)) {
				$question_id = $fetch_query['question_id'];
				//// confirm if this question has been done
				$query=mysqli_query($conn,"SELECT * FROM `cbt_quiz_result_tab` WHERE user_id='$login_user_id' AND tutorial_id='$tutorial_id'AND question_id='$question_id'")or die (mysqli_error($conn));
				$record_count=mysqli_num_rows($query);
				$fetch_query['attempted'] = $record_count > 0 ? 'yes' : 'no';
				
				$response['buttons'][] = $fetch_query;
			}

end:
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>