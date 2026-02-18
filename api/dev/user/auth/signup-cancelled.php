<?php require_once '../../config/connection.php';?>
<?php require_once '../../config/user-session-check.php';?>
<?php if (!$checkBasicSecurity) {goto end;}?>

<?php
	if($check==0){ /// start if 1
		$response['response']=99; 
		$response['success']=False;
		$response['message']="SESSION EXPIRED! Please LogIn Again.";
	}else{/// else if 1

		$user_array=$callclass->_get_user_details($conn, $login_user_id);
		$user_fetch = json_decode($user_array, true);
		$user_fullname=$user_fetch[0]['user_fullname'];
		$email=$user_fetch[0]['user_email'];
		$mobile_no=$user_fetch[0]['user_mobile_no'];

		/// delete redundants 
		mysqli_query($conn,"DELETE FROM `users_tab` WHERE user_id='$login_user_id'");
		mysqli_query($conn,"DELETE FROM `payment_transactions_tab` WHERE user_id='$login_user_id'");
		mysqli_query($conn,"DELETE FROM `subscriptions_tab` WHERE user_id='$login_user_id'");
		
		$alert_detail="CANCEL REGISTRATION ALERT: A user whose name is $user_fullname with ID: $login_user_id cancelled his/her regitration on leaders tutors application. DETAILS:--- Email: $email, Phone Number: $mobile_no";
		$callclass->_alert_sequence_and_update($conn,$login_user_id,$fullname,0,$alert_detail,$ipAddress,$systemName);

		$response['response']=200; 
		$response['success']=true;
		$response['message']="REGISTRATION CANCLLED!";	
	}
		
}
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>