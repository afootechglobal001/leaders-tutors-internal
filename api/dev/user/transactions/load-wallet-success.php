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
		$user_array=$callclass->_get_user_details($conn, $user_id);
		$user_fetch = json_decode($user_array, true);
			$fullname=$user_fetch[0]['fullname'];
			$email=$user_fetch[0]['email'];
			$mobile_no=$user_fetch[0]['mobile_no'];
			$wallet_balance=$user_fetch[0]['wallet_balance'];

		$transaction_id=trim($_POST['transaction_id']);

		$query=mysqli_query($conn,"SELECT * FROM payment_transactions_tab WHERE transaction_id='$transaction_id' AND status_id=3")or die (mysqli_error($conn));
		$count_transaction=mysqli_num_rows($query);
		if ($count_transaction>0){ /// start if 4
			$fetch_query=mysqli_fetch_array($query);
			$amount=$fetch_query['amount'];

			$balance_after=$wallet_balance + $amount;
			////////////////////////////////////////////////////////////////////////////////
			mysqli_query($conn,"UPDATE `payment_transactions_tab` SET balance_after=$balance_after,  status_id=5 WHERE user_id='$user_id' AND transaction_id='$transaction_id'")or die (mysqli_error($conn));
			mysqli_query($conn,"UPDATE `users_tab` SET wallet_balance=$balance_after WHERE user_id='$user_id'")or die (mysqli_error($conn));
			
			$alert_detail="LOAD WALLET ALERT: A user whose name is $fullname with ID: $user_id have succesfully loaded  N$amount to his/her leaders tutors wallet. DETAILS:--- Email: $email, Phone Number: $mobile_no";
			$callclass->_alert_sequence_and_update($conn,$user_id,$fullname,0,$alert_detail,$ipAddress,$systemName);

			$response['response']=200; 
			$response['success']=true;
			$response['message']="LOAD WALLET ALERT! Wallet loaded successfully.";
			require_once '../component/login-details.php';
		}else{
			$response['response']=100; 
			$response['success']=False;
			$response['message']="TRANSACTION CANCELLED! Please start the process again."; 
		}
	}/// end if 1
}/// end if 0
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>