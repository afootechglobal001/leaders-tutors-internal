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

		$old_password=$_POST['old_password'];
		$new_password=$_POST['new_password'];
		$confirm_password=$_POST['confirm_password'];

		$oldpassword=md5($old_password);
		$password=md5($new_password);

		if($old_password==''){ ///start if 2
			$response['response']=100; 
			$response['success']=false;
			$response['message']="OLD PASSWORD REQUIRED! Kindly check and try again."; 
		}elseif($new_password==''){ ///else if 2
			$response['response']=101; 
			$response['success']=false;
			$response['message']="NEW PASSWORD REQUIRED! Kindly check and try again."; 
		}elseif($confirm_password==''){ ///else if 2
			$response['response']=102; 
			$response['success']=false;
			$response['message']="CONFIRM PASSWORD REQUIRED! Kindly check and try again.";
		}else{ ///else if 2
			
			if($new_password==$confirm_password){///start if 3
				$check_query=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM staff_tab WHERE staff_id='$login_staff_id' AND password='$oldpassword'"));
				if ($check_query>0){///start if 4
					$access_key=md5($login_staff_id.date("Ymdhis"));
					mysqli_query($conn,"UPDATE staff_tab SET access_key='$access_key', password='$password' WHERE staff_id='$login_staff_id'") or die (mysqli_error($conn));
					
					$response['response']=200; 
					$response['success']=true;
					$response['message']="PASSWORD UPDATED SUCCESSFULLY!";
					$alert_detail="PASSWORD UPDATED SUCCESSFULLY: A staff whose name is  $login_staff_fullname with ID: $login_staff_id have successfully reset his/her password.";
					$callclass->_alert_sequence_and_update($conn,$login_staff_id,$login_staff_fullname,$login_role_id,$alert_detail,$ipAddress,$systemName);	
				}else{///else if 4
					$response['response']=104; 
					$response['success']=false;
					$response['message']="INCORRECT OLD PASSWORD! Kindly check and try again.";
				}///end if 4
			}else{///else if 3
				$response['response']=104; 
				$response['success']=false;
				$response['message']="PASSWORD NOT MATCH! Kindly check and try again.";
			}///end if 3
		}///end if 2
	}///end if 1
}///end if 0
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>