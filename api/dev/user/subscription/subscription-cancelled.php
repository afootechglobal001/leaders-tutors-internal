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

		$user_id=$login_user_id;
		$user_array=$callclass->_get_user_details($conn, $user_id);
		$user_fetch = json_decode($user_array, true);
		$fullname=$user_fetch[0]['fullname'];
		$email=$user_fetch[0]['email'];
		$mobile_no=$user_fetch[0]['mobile_no'];
		$wallet_balance=$user_fetch[0]['wallet_balance'];

		$transaction_id=trim(($_POST['transaction_id']));
		$subscription_id=trim(($_POST['subscription_id']));

		if($transaction_id==''){ ///else if 2
			$response['response']=102; 
			$response['success']=false;
			$response['message']="TRANSACTION ID REQUIRED!  Check the field and try again."; 
		}elseif($subscription_id==''){ ///else if 2
			$response['response']=103; 
			$response['success']=false;
			$response['message']="SUBSCRIPTION ID REQUIRED!  Check the field and try again."; 
		}else{ ///else if 2

			mysqli_query($conn,"UPDATE `payment_transactions_tab` SET status_id=4 WHERE user_id='$user_id' AND transaction_id='$transaction_id' AND status_id=3")or die (mysqli_error($conn));
			mysqli_query($conn, "UPDATE `subscriptions_tab` SET status_id = 4 WHERE user_id = '$user_id' AND subscription_id = '$subscription_id' AND status_id=3") or die(mysqli_error($conn));

			$response['response']=200; 
			$response['success']=true;
			$response['message']="SUBSCRIPTION CANCELLED SUCCESSFUL!";
			require_once '../component/login-details.php';

			$alert_detail="SUBSCRIPTION CANCELLED: A user whose name is $fullname with ID: $user_id has cancelled a subscription payment on leaders tutors application. DETAILS--- transaction_id: $transaction_id";
			$callclass->_alert_sequence_and_update($conn,$user_id,$fullname,0,$alert_detail,$ipAddress,$systemName);
			
		}

	}/// end if 1
}/// end if 0
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>