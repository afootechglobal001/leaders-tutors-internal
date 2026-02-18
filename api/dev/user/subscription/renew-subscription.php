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
		$check_subscription=$callclass->_user_subscription_validation($conn, $login_user_id);
		$check_subscription_array = json_decode($check_subscription, true);
		$check= $check_subscription_array[0]['check'];
		if($check==0){ /// start if 2

			//////////////////declaration of variables//////////////////////////////////////
			$department_id=trim($_POST['department_id']);
			$class_id=trim($_POST['class_id']);
			$payment_method_id=trim($_POST['payment_method_id']);

			$user_id=$login_user_id;
			$user_array=$callclass->_get_user_details($conn, $user_id);
			$user_fetch = json_decode($user_array, true);
				$fullname=$user_fetch[0]['fullname'];
				$email=$user_fetch[0]['email'];
				$mobile_no=$user_fetch[0]['mobile_no'];
				$wallet_balance=$user_fetch[0]['wallet_balance'];


				$department_array=$callclass->_get_department_details($conn, $department_id);
				$department_array = json_decode($department_array, true);
				$department_name= $department_array[0]['department_name'];
				
				$class_array=$callclass->_get_class_details($conn, $class_id);
				$class_array = json_decode($class_array, true);
				$class_name= $class_array[0]['class_name'];

				$query=mysqli_query($conn,"SELECT * FROM department_class_subject_tab WHERE department_id='$department_id' AND `class_id`='$class_id' AND rank_id = 1") or die (mysqli_error($conn));
				$count=mysqli_num_rows($query);

				if ($count>0){ /// start if 4
					$array=$callclass->_get_setup_backend_settings_detail($conn, 'BK_ID001');
					$fetch = json_decode($array, true);
					$subcription_amount=$fetch[0]['subcription_amount'];
					$paystack_payment_key=$fetch[0]['paystack_payment_key'];

					if($payment_method_id=='WAL'){///// payment by wallet
						
						if($subcription_amount<=$wallet_balance){

							$user_new_wallet_balance=$wallet_balance - $subcription_amount;
							mysqli_query($conn,"UPDATE `users_tab` SET wallet_balance=$user_new_wallet_balance WHERE user_id='$user_id'")or die (mysqli_error($conn));
							///////////////////////geting sequence//////////////////////////
							$sequence=$callclass->_get_sequence_count($conn, 'TRANS');
							$array = json_decode($sequence, true);
							$no= $array[0]['no'];
							//$num= $array[0]['num'];
							$transaction_id='TRANS'.$no.date("Ymdhis");
							////////////////////// inserting to payment_transactions_tab//////////////////////////
							mysqli_query($conn,"INSERT INTO `payment_transactions_tab`
							(`user_id`,  `email`, `transaction_id`, `balance_before`, `amount`, `balance_after`, `transaction_type_id`, `payment_method_id`, `status_id`, `created_time`) VALUES
							('$user_id', '$email', '$transaction_id', $wallet_balance,  $subcription_amount,  $user_new_wallet_balance, 'SUB', 'WAL', 5, NOW())")or die (mysqli_error($conn));
				
							///////////////////////geting sequence//////////////////////////
							$sequence=$callclass->_get_sequence_count($conn, 'SUB');
							$array = json_decode($sequence, true);
							$no= $array[0]['no'];
							//$num= $array[0]['num'];
							$subscription_id='SUB'.$no.date("Ymdhis");
							////////////////////// inserting to subscriptions_tab//////////////////////////
							mysqli_query($conn,"INSERT INTO `subscriptions_tab`
							( `user_id`,  `email`, `subscription_id`, `transaction_id`, `department_id`, `class_id`, `status_id`, `subscription_start_date`, `subscription_end_date`) VALUES
							('$user_id','$email', '$subscription_id', '$transaction_id', '$department_id', '$class_id', 1, NOW(), DATE_ADD(NOW(), INTERVAL 30 DAY) )")or die (mysqli_error($conn));
							
							$alert_detail="SUBSCRIPTION SUCCESS ALERT: A user whose name is $fullname with ID: $user_id has successfully subscribe on leaders tutors application. DETAILS--- Department: $department_name, Class: $class_name";
							$response['response']=200; 
							$response['success']=true;
							$response['message']="SUBSCRIPTION SUCCESSFUL!";
							require_once '../component/login-details.php'; 
						}else{
							$response['response']=101; 
							$response['success']=False;
							$response['message']="INSUFFICIENT FUND! Kindly load your wallet to continue"; 
							$alert_detail="SUBSCRIPTION FAILED ALERT: A user whose name is $fullname with ID: $user_id tried to subscribe on leaders tutors application but failed due to insufficient fund. DETAILS--- Department: $department_name, Class: $class_name";
						}
						$callclass->_alert_sequence_and_update($conn,$user_id,$fullname,0,$alert_detail,$ipAddress,$systemName);
					}else{//// pay with debit card
						//// cancel all pending transactions
						mysqli_query($conn,"UPDATE `payment_transactions_tab` SET status_id=4 WHERE user_id='$user_id' AND status_id=3")or die (mysqli_error($conn));
						mysqli_query($conn,"UPDATE `subscriptions_tab` SET status_id=4 WHERE user_id='$user_id' AND status_id=3")or die (mysqli_error($conn));

							///////////////////////geting sequence//////////////////////////
							$sequence=$callclass->_get_sequence_count($conn, 'TRANS');
							$array = json_decode($sequence, true);
							$no= $array[0]['no'];
							//$num= $array[0]['num'];
							$transaction_id='TRANS'.$no.date("Ymdhis");
							////////////////////// inserting to payment_transactions_tab//////////////////////////
							mysqli_query($conn,"INSERT INTO `payment_transactions_tab`
							(`user_id`,  `email`, `transaction_id`, `balance_before`, `amount`, `balance_after`, `transaction_type_id`, `payment_method_id`, `status_id`, `created_time`) VALUES
							('$user_id', '$email', '$transaction_id', $wallet_balance,  $subcription_amount,  $wallet_balance, 'SUB', 'DO', 3, NOW())")or die (mysqli_error($conn));
				
							///////////////////////geting sequence//////////////////////////
							$sequence=$callclass->_get_sequence_count($conn, 'SUB');
							$array = json_decode($sequence, true);
							$no= $array[0]['no'];
							//$num= $array[0]['num'];
							$subscription_id='SUB'.$no.date("Ymdhis");
							////////////////////// inserting to subscriptions_tab//////////////////////////
							mysqli_query($conn,"INSERT INTO `subscriptions_tab`
							( `user_id`,  `email`, `subscription_id`, `transaction_id`, `department_id`, `class_id`, `status_id`, `subscription_start_date`, `subscription_end_date`) VALUES
							('$user_id','$email', '$subscription_id', '$transaction_id', '$department_id', '$class_id', 3, NOW(), NOW() )")or die (mysqli_error($conn));
					
							$alert_detail="SUBSCRIPTION ALERT: A user whose name is $fullname with ID: $user_id attempt to re-subscribe on leaders tutors application. DETAILS:--- Email: $email, Phone Number: $mobile_no, Department: $department_name, Class: $class_name";
							$callclass->_alert_sequence_and_update($conn,$user_id,$fullname,0,$alert_detail,$ipAddress,$systemName);

							$response['response']=200; 
							$response['success']=true;
							$response['user_id']=$user_id;
							$response['subscription_id']=$subscription_id;
							$response['transaction_id']=$transaction_id;
							$response['amount']=$subcription_amount;
							$response['email']=$email;
							$response['paystack_payment_key']=$paystack_payment_key;
							$response['message']="YOUR SUBSCRIPTION IS IN PROGRESS! Proceed to payment.";		
					}
				}else{
					$response['response']=100; 
					$response['success']=False;
					$response['message']="USER ERROR! Department and class does not match."; 
				}
			}else{/// else if 2
				$response['response']=100; 
				$response['success']=False;
				$response['message']="SUSCRIPTION FAIED! Your previous subscription is still active."; 
			}
			
	}/// end if 1
}/// end if 0
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>