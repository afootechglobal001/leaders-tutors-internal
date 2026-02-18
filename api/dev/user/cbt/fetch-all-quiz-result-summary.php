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


			$query=mysqli_query($conn,"SELECT * FROM `cbt_quiz_result_summary_tab` WHERE user_id='$login_user_id' AND tutorial_id='$tutorial_id' ORDER BY created_time DESC")or die (mysqli_error($conn));
			$all_record_count=mysqli_num_rows($query);
			if($all_record_count==0){
				$response['response']=200;
				$response['success']=true;
				$response['all_record_count']=$all_record_count;
				$response['message']="No Record found"; 
				goto end;
			}

			$response['response']=200;
			$response['success']=true;
			$response['message']="Result Summary Fetched!";
			$response['all_record_count']=$all_record_count;
			$response['data']=array();

			while ($fetch_query = mysqli_fetch_assoc($query)) {
				$response['data'][] = $fetch_query;
			}

	
end:
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>