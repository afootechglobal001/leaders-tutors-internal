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
		$amount=trim(($_POST['amount']));
		$paystack_payment_key=trim(($_POST['payment_key']));

		if($transaction_id==''){ ///else if 2
			$response['response']=102; 
			$response['success']=false;
			$response['message']="TRANSACTION ID REQUIRED!  Check the field and try again."; 
		}elseif($subscription_id==''){ ///else if 2
			$response['response']=103; 
			$response['success']=false;
			$response['message']="SUBSCRIPTION ID REQUIRED!  Check the field and try again."; 
		}elseif($amount==''){ ///else if 2
			$response['response']=104; 
			$response['success']=false;
			$response['message']="AMOUNT REQUIRED!  Check the field and try again.";
		}elseif($paystack_payment_key==''){ ///else if 2
			$response['response']=105; 
			$response['success']=false;
			$response['message']="PAYMENT KEY REQUIRED!  Select your current class and try again.";
		}else{ ///else if 2


			$query=mysqli_query($conn,"SELECT * FROM subscriptions_tab WHERE user_id='$user_id' AND subscription_id='$subscription_id' AND status_id=3") or die (mysqli_error($conn));
			$check=mysqli_num_rows($query);
			if($check>0){ /// start if 2

				$settings_array=$callclass->_get_setup_backend_settings_detail($conn, 'BK_ID001');
				$settings_fetch = json_decode($settings_array, true);
				$subcription_amount=$settings_fetch[0]['subcription_amount'];
				$db_paystack_payment_key=$settings_fetch[0]['paystack_payment_key'];

				if($paystack_payment_key!=$db_paystack_payment_key){///start if 3
					$response['response']=106; 
					$response['success']=false;
					$response['message']="FRAUD ALERT! You cannot complete this transaction with wrong key.";

					$alert_detail="FRAUD ALERT: A user whose name is $fullname with ID: $user_id attempt to re-subscribe with a wrong payment key $paystack_payment_key";
					$callclass->_alert_sequence_and_update($conn,$user_id,$fullname,0,$alert_detail,$ipAddress,$systemName);
				}else{///else if 3
					if($amount!=$subcription_amount){///start if 4
						$response['response']=107; 
						$response['success']=false;
						$response['message']="FRAUD ALERT! You cannot complete this transaction with wrong amount.";

						$alert_detail="FRAUD ALERT: A prospective user whose name is $fullname with ID: $user_id attempt to re-subscribe with $amount instead of $subcription_amount";
						$callclass->_alert_sequence_and_update($conn,$user_id,$fullname,0,$alert_detail,$ipAddress,$systemName);
					}else{///else if 4

						mysqli_query($conn,"UPDATE `payment_transactions_tab` SET status_id=5 WHERE user_id='$user_id' AND transaction_id='$transaction_id' AND status_id=3")or die (mysqli_error($conn));
						mysqli_query($conn, "UPDATE `subscriptions_tab` SET status_id = 1, subscription_end_date = DATE_ADD(NOW(), INTERVAL 30 DAY) WHERE user_id = '$user_id' AND subscription_id = '$subscription_id' AND status_id=3") or die(mysqli_error($conn));

						$response['response']=200; 
						$response['success']=true;
						$response['message']="SUBSCRIPTION SUCCESSFUL!";
						require_once '../component/login-details.php';

						$alert_detail="SUBSCRIPTION SUCCESS ALERT: A user whose name is $fullname with ID: $user_id has successfully subscribe on leaders tutors application. DETAILS--- Department: $department_name, Class: $class_name, transaction_id: $transaction_id";
						$callclass->_alert_sequence_and_update($conn,$user_id,$fullname,0,$alert_detail,$ipAddress,$systemName);
					}///end if 4
				}///end if 3

			}else{/// else if 2
				$response['response']=100; 
				$response['success']=False;
				$response['message']="SUSCRIPTION FAIED! Please try again."; 
			}
		}

	}/// end if 1
}/// end if 0
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>