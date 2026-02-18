<?php require_once '../../config/connection.php';?>
<?php

///// check for API security
if ($apiKey!=$expected_api_key){/// start if 1
	$response['response']=98; 
	$response['success']=false;
	$response['message']="SECURITY ACCESS DENIED! You are not allowed to execute this command due to security bridge.";
	goto end;
}

	$fullname =trim(strtoupper($_POST['fullname']));
	$email=trim(($_POST['email']));
	$mobile_no=trim(($_POST['mobile_no']));
	$department_id=trim(($_POST['department_id']));
	$class_id=trim(($_POST['class_id']));
	$create_password=trim(($_POST['create_password']));
	$confirm_password=trim(($_POST['confirm_password']));
	$referral_type=trim(($_POST['referral_type'])); /// code or link
	$referral_id=trim(($_POST['referral_id']));
	
	if(empty($fullname)){ ///start if 1
		$response['response']=100; 
		$response['success']=false;
		$response['message']="FULL NAME REQUIRED! Check the field and try again."; 
		goto end;
	}
	if(empty($email)){
		$response['response']=101; 
		$response['success']=false;
		$response['message']="EMAIL REQUIRED!  Check the field and try again.";
		goto end;
	}
	if(empty($mobile_no)){
		$response['response']=102; 
		$response['success']=false;
		$response['message']="MOBILE NUMBER REQUIRED!  Check the field and try again.";
		goto end;
	}
	if(empty($department_id)){
		$response['response']=104; 
		$response['success']=false;
		$response['message']="DEPARTMENT REQUIRED!  Select your department and try again.";
		goto end;
	}
	if(empty($class_id)){
		$response['response']=105; 
		$response['success']=false;
		$response['message']="CLASS REQUIRED!  Select your current class and try again.";
		goto end;
	}
	if(empty($create_password)){
		$response['response']=106; 
		$response['success']=false;
		$response['message']="PASSWORD REQUIRED! Create a password and try again.";
		goto end;
	}
	if(empty($confirm_password)){
		$response['response']=107; 
		$response['success']=false;
		$response['message']="PASSWORD REQUIRED! Confirm your password and try again.";
		goto end;
	}

	if(empty($referral_type)){
		$response['response']=108; 
		$response['success']=false;
		$response['message']="REFERRAL TYPE REQUIRED! Confirm your password and try again.";
		goto end;
	}

		
			if($create_password!=$confirm_password){
				$response['response']=109; 
				$response['success']=false;
				$response['message']="PASSWORD NOT MATCH! Check your password and try again.";
				goto end;
			}

				if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
					$response['response']=110; 
					$response['success']=false;
					$response['message']="INVALID EMAIL ADDRESS! Enter a valid email address and try again";
					goto end;
				}

					$check_user_query=mysqli_query($conn,"SELECT * FROM users_tab WHERE email='$email' AND status_id IN (1,2)");
					$count_user=mysqli_num_rows($check_user_query);
						if ($count_user>0){
							$response['response']=111; 
							$response['success']=false;
							$response['message']="USER ALREADY EXIST! Kindly login or reset your password.";
							goto end;
						}

						if(($referral_type!='code')&&($referral_type!='link')){ //// for agents
							$response['response']=112; 
							$response['success']=false;
							$response['message']="USER ERROR! Reload this page and try again.";
							goto end;
						}

						if($referral_type=='code'){ //// for agents
							if(!empty($referral_id)){
								$referral_id_query=mysqli_query($conn,"SELECT * FROM company_tab WHERE referral_code='$referral_id' AND status_id=1");
								$count_referral_id=mysqli_num_rows($referral_id_query);
	
								if ($count_referral_id==0){
									$response['response']=113; 
									$response['success']=false;
									$response['message']="INVALID REFERRAL CODE! Check and try again.";
									goto end;
								}
							}
						}

						if($referral_type=='link'){
							$referral_id_query=mysqli_query($conn,"SELECT * FROM users_tab WHERE user_id='$referral_id' AND status_id=1");
							$count_referral_id=mysqli_num_rows($referral_id_query);

							if ($count_referral_id==0){
								$response['response']=114; 
								$response['success']=false;
								$response['message']="INVALID REFERRAL LINK! Check and try again.";
								goto end;
							}
						}
						

							/// delete redundants 
							mysqli_query($conn,"DELETE FROM `users_tab` WHERE email='$email'");
							mysqli_query($conn,"DELETE FROM `payment_transactions_tab` WHERE email='$email'");
							mysqli_query($conn,"DELETE FROM `subscriptions_tab` WHERE email='$email'");

							///////////////////////geting sequence//////////////////////////
							$sequence=$callclass->_get_sequence_count($conn, 'LTU');
							$array = json_decode($sequence, true);
							$no= $array[0]['no'];
							//$num= $array[0]['num'];
							$user_id='LTU'.$no.date("Ymdhis");
							$password=md5($create_password);
							/// Generate login access key
							$access_key=trim(md5($user_id.date("Ymdhis")));
							////////////////////// inserting to users_tab//////////////////////////
							mysqli_query($conn,"INSERT INTO `users_tab`
							(`user_id`,`referral_id`, `access_key`, `fullname`, `email`, `mobile_no`, `password`, `profile_pix`, `status_id`, `created_time`) VALUES
							('$user_id','$referral_id','$access_key','$fullname','$email','$mobile_no','$password','avatar.jpg', 3, NOW())")or die (mysqli_error($conn));

							///////////////////////geting sequence//////////////////////////
							$sequence=$callclass->_get_sequence_count($conn, 'TRANS');
							$array = json_decode($sequence, true);
							$no= $array[0]['no'];
							//$num= $array[0]['num'];
							$transaction_id='TRANS'.$no.date("Ymdhis");

							$array=$callclass->_get_setup_backend_settings_detail($conn, 'BK_ID001');
							$fetch = json_decode($array, true);
							$subcription_amount=$fetch[0]['subcription_amount'];
							$paystack_payment_key=$fetch[0]['paystack_payment_key'];
							////////////////////// inserting to payment_transactions_tab//////////////////////////
							mysqli_query($conn,"INSERT INTO `payment_transactions_tab`
							(`user_id`,  `email`, `transaction_id`, `amount`, `transaction_type_id`, `payment_method_id`, `status_id`, `created_time`) VALUES
							('$user_id', '$email', '$transaction_id', $subcription_amount, 'SUB', 'DO', 3, NOW())")or die (mysqli_error($conn));

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

							$alert_detail="REGISTRATION ALERT: A user whose name is $fullname with ID: $user_id attempt yo register and subscribe on leaders tutors application. DETAILS:--- Email: $email, Phone Number: $mobile_no";
							$callclass->_alert_sequence_and_update($conn,$user_id,$fullname,0,$alert_detail,$ipAddress,$systemName);

							$response = [
								'response'=> 200,
								'success'=> true,
								'message'=> '70% REGISTRATION COMPLETED! Proceed to payment.',
								'user_id'=> $user_id,
								'access_key'=> $access_key,
								'subscription_id'=> $subscription_id,
								'transaction_id'=> $transaction_id,
								'amount'=> $subcription_amount,
								'email'=> $email,
								'paystack_payment_key'=> $paystack_payment_key,
								'referral_type'=> $referral_type,
								'referral_id'=> $referral_id
							];
end:
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>