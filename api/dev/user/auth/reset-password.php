<?php require_once '../../config/connection.php';?>
<?php if (!$checkBasicSecurity) {goto end;}?>

<?php

	//////////////////declaration of variables//////////////////////////////////////
	$email=trim($_POST['email']);
	////////////////////////////////////////////////////////////////////////////////

	if ($email==""){/// start if 2
		$response['response']=100; 
		$response['success']=false;
		$response['message']="EMAIL FIELD REQUIRED! Email address field cannot be empty"; 
	}else{/// else if 2
		if(filter_var($email, FILTER_VALIDATE_EMAIL)){ /// start if 3
			$query=mysqli_query($conn,"SELECT * FROM users_tab WHERE email='$email'") or die (mysqli_error($conn));
			$count_user=mysqli_num_rows($query);
		
				if ($count_user>0){ /// start if 4
					$fetch_query=mysqli_fetch_array($query);
					$user_id=$fetch_query['user_id']; 
					$fullname=$fetch_query['fullname'];
					$email=$fetch_query['email']; 
					$status_id=$fetch_query['status_id'];
					
					
						if($status_id==1){ /// start if 5 (check if the user is active)
							/// Generate otp
							$otp = rand(111111,999999);
		
							/// update user on staff_tab
							mysqli_query($conn,"UPDATE users_tab SET otp='$otp', updated_time=NOW() WHERE user_id='$user_id'")or die (mysqli_error($conn));
							////// send otp to email
							require_once('../../config/mail/user/reset-password.php');	
		
							$response['response']=200; 
							$response['success']=true;
							$response['message']="OTP SENT! Enter the OTP sent to your email address and proceed."; 
							$response['user_id']=$user_id;
							$response['fullname']=$fullname;
							$response['email']=$email;  

							$alert_detail="RESET PASSWORD ALERT: A user whose name is $fullname with ID: $user_id attempt to reset his/her password and an OTP has been sent for acount verification.";
							$callclass->_alert_sequence_and_update($conn,$user_id,$fullname,0,$alert_detail,$ipAddress,$systemName);
						}else if($status_id==2){/// else if 5
							$response['response']=101; 
							$response['success']=false;
							$response['message']="ACCOUNT SUSPENDED! Contact the administrator for more info.";

							$alert_detail="RESET PASSWORD FAILED: A user whose name is $fullname with ID: $user_id attempt to reset his/her password but failed due to account suspension.";
							$callclass->_alert_sequence_and_update($conn,$user_id,$fullname,0,$alert_detail,$ipAddress,$systemName);
						}else{ /// else if 5
							$response['response']=102; 
							$response['success']=false;
							$response['message']="ACCOUNT UNDER REVIEW! Contact the administrator for more info.";

							$alert_detail="RESET PASSWORD FAILED: A user whose name is $fullname with ID: $user_id attempt to reset his/her password but failed due to account under review.";
							$callclass->_alert_sequence_and_update($conn,$user_id,$fullname,0,$alert_detail,$ipAddress,$systemName);

						} /// end if 5
			
				}else{/// else if 4
		
					$response['response']=103; 
					$response['success']=false;
					$response['message']="NO RECORD MATCH! Kindly check the email and try again."; 
				}/// end if 4
		}else{ /// else if 3
			$response['response']=104; 
			$response['success']=false;
			$response['message']="INVALID EMAIL ADDRESS! Enter a valid email address and try again"; 
		}/// end if 3
	}/// start if 2

}/// start if 1
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);

?>