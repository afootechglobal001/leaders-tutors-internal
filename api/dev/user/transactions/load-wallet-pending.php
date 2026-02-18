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

		$amount=trim($_POST['amount']);
		////////////////////////////////////////////////////////////////////////////////
		if (!is_numeric($amount)) { /// start if 2
			$response['response']=101; 
			$response['success']=false;
			$response['message']="USER ERROR! Kindly enter a valid amount";
		} else { /// else if 2
			if($amount<=0){ ///start if 3
				$response['response']=102; 
				$response['success']=false;
				$response['message']="USER ERROR! Amount must be greater than 0";
			}else{ /// else if 3
				//// cancel all pending transactions
				mysqli_query($conn,"UPDATE `payment_transactions_tab` SET status_id=4 WHERE user_id='$user_id' AND status_id=3")or die (mysqli_error($conn));

				///////////////////////geting sequence//////////////////////////
				$sequence=$callclass->_get_sequence_count($conn, 'TRANS');
				$array = json_decode($sequence, true);
				$no= $array[0]['no'];
				//$num= $array[0]['num'];
				$transaction_id='TRANS'.$no.date("Ymdhis");

				$array=$callclass->_get_setup_backend_settings_detail($conn, 'BK_ID001');
				$fetch = json_decode($array, true);
				$paystack_payment_key=$fetch[0]['paystack_payment_key'];
				////////////////////// inserting to payment_transactions_tab//////////////////////////
				mysqli_query($conn,"INSERT INTO `payment_transactions_tab`
				(`user_id`,  `email`, `transaction_id`, `balance_before`, `amount`, `balance_after`, `transaction_type_id`, `payment_method_id`, `status_id`, `created_time`) VALUES
				('$user_id', '$email', '$transaction_id', $wallet_balance,  $amount,  $wallet_balance, 'CRD', 'DO', 3, NOW())")or die (mysqli_error($conn));
				
				$alert_detail="LOAD WALLET ALERT: A user whose name is $fullname with ID: $user_id attempt to load N$amount to his/her leaders tutors wallet. DETAILS:--- Email: $email, Phone Number: $mobile_no";
				$callclass->_alert_sequence_and_update($conn,$user_id,$fullname,0,$alert_detail,$ipAddress,$systemName);
				//// for super admin
				$alert_detail="LOAD WALLET ALERT: A user whose name is $fullname with ID: $user_id attempt to load N$amount to his/her leaders tutors wallet. DETAILS:--- Email: $email, Phone Number: $mobile_no, PayKey: $paystack_payment_key";
				$callclass->_alert_sequence_and_update($conn,'ADMIN',$fullname,3,$alert_detail,$ipAddress,$systemName);

				$response['response']=200; 
				$response['success']=true;
				$response['transaction_id']=$transaction_id;
				$response['fullname']=$fullname;
				$response['amount']=$amount;
				$response['email']=$email;
				$response['paystack_payment_key']=$paystack_payment_key;
				$response['message']="TRANSACTION IN PROGRESS! Proceed to payment.";	
			} /// end if 3
		} /// end if 2
	}/// end if 1
}/// end if 0
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>