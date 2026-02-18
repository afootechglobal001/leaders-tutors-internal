<?php require_once '../../config/connection.php';?>
<?php require_once '../../config/user-session-check.php';?>

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
		$response['success']=False;
		$response['message']="SESSION EXPIRED! Please LogIn Again."; 
	}else{/// else if 1

		//////////////////declaration of variables//////////////////////////////////////
		$user_id=$login_user_id;
		$fullname=$login_user_fullname;
		$email=$login_user_email;
		$mobile_no=$login_user_mobile_no;

		$transaction_id=trim($_POST['transaction_id']);

		$array=$callclass->_get_transaction_details($conn, $transaction_id);
		$fetch = json_decode($array, true);
		$amount=$fetch[0]['amount'];
		////////////////////////////////////////////////////////////////////////////////
		mysqli_query($conn,"UPDATE `payment_transactions_tab` SET status_id=4 WHERE user_id='$user_id' AND transaction_id='$transaction_id'")or die (mysqli_error($conn));
		
		$alert_detail="LOAD WALLET ALERT: A user whose name is $fullname with ID: $user_id cancelled  the process of loading N$amount to his/her leaders tutors wallet. DETAILS:--- Email: $email, Phone Number: $mobile_no";
		$callclass->_alert_sequence_and_update($conn,$user_id,$fullname,0,$alert_detail,$ipAddress,$systemName);

		$response['response']=200; 
		$response['success']=true;
		$response['message']="LOAD WALLET ALERT! Load wallet process was cancelled.";
		
	}/// end if 1
}/// end if 0
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>