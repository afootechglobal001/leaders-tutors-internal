<?php require_once '../../config/connection.php';?>
<?php require_once '../../config/admin-session-check.php';?>
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

		$smtp_host=trim($_POST['smtp_host']);
		$smtp_username=trim($_POST['smtp_username']);
		$smtp_password=trim($_POST['smtp_password']);
		$smtp_port=trim($_POST['smtp_port']);
		$sender_name=trim($_POST['sender_name']);
		$support_email=trim($_POST['support_email']);
		$subcription_amount=trim($_POST['subcription_amount']);
		$paystack_payment_key=trim($_POST['paystack_payment_key']);
			
		if($smtp_host==''){ ///start if 2
			$response['response']=100; 
			$response['success']=false;
			$response['message']="SMTP HOST REQUIRED! Kindly check and try again."; 
		}elseif($smtp_username==''){ ///else if 2
			$response['response']=101; 
			$response['success']=false;
			$response['message']="SMTP USERNAME REQUIRED! Kindly check and try again."; 
		}elseif($smtp_password==''){ ///else if 2
			$response['response']=102; 
			$response['success']=false;
			$response['message']="SMTP PASSWORD REQUIRED! Kindly check and try again.";
		}elseif($smtp_port==''){ ///else if 2
			$response['response']=103; 
			$response['success']=false;
			$response['message']="SMTP PORT REQUIRED! Kindly check and try again.";
		}elseif($sender_name==''){ ///else if 2
			$response['response']=104; 
			$response['success']=false;
			$response['message']="SENDER NAME REQUIRED! Kindly check and try again."; 
		}elseif($support_email==''){ ///else if 2
			$response['response']=105; 
			$response['success']=false;
			$response['message']="SUPPORT EMAIL REQUIRED! Kindly check and try again.";  
		}elseif($subcription_amount==''){ ///else if 2
			$response['response']=106; 
			$response['success']=false;
			$response['message']="SUBSCRIPTION AMOUNT REQUIRED! Kindly check and try again.";
		}elseif($paystack_payment_key==''){ ///else if 2
			$response['response']=106; 
			$response['success']=false;
			$response['message']="PAYMENT KEY REQUIRED! Kindly check and try again.";
		}else{ ///else if 2
			
			mysqli_query($conn,"UPDATE setup_backend_settings_tab SET smtp_host='$smtp_host',smtp_username='$smtp_username',
			smtp_password='$smtp_password', smtp_port='$smtp_port',  sender_name='$sender_name', support_email='$support_email',
			subcription_amount='$subcription_amount', paystack_payment_key='$paystack_payment_key', updated_by='$login_staff_id'
			WHERE backend_setting_id='BK_ID001'") or die (mysqli_error($conn));
			$response['response']=200; 
			$response['success']=true;
			$response['message']="SYSTEM SETTINGS UPDATED! settings Updated Successful!";
			$alert_detail="SYSTEM SETTINGS UPDATED SUCCESSFULLY: The system setting was updated by $login_staff_fullname";
			$callclass->_alert_sequence_and_update($conn,$login_staff_id,$login_staff_fullname,$login_role_id,$alert_detail,$ipAddress,$systemName);	
		} ///end if 2
	}///end if 1
}///end if 0
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>