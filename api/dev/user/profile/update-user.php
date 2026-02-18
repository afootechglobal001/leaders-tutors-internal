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

		$fullname =trim(strtoupper($_POST['fullname']));
		$email=trim(($_POST['email']));
		$mobile_no=trim(($_POST['mobile_no']));
			
		if($fullname==''){ ///start if 2
			$response['response']=100; 
			$response['success']=false;
			$response['message']="FULL NAME REQUIRED! Check the full name and try again."; 
		}elseif($mobile_no==''){ ///else if 2
			$response['response']=101; 
			$response['success']=false;
			$response['message']="PHONE NUMBER REQUIRED! Check phone number and try again."; 
		}elseif($email==''){ ///else if 2
			$response['response']=102; 
			$response['success']=false;
			$response['message']="EMAIL REQUIRED! Check email address and try again.";
		}else{ ///else if 2
			if(filter_var($email, FILTER_VALIDATE_EMAIL)){ ///start if 3
				$usercheck=mysqli_query($conn,"SELECT * FROM users_tab WHERE email='$email' AND user_id != '$user_id'") or die (mysqli_error($conn));
				$useremail=mysqli_num_rows($usercheck);
				if ($useremail>0){ ///start if 4
					$response['response']=106; 
					$response['success']=false;
					$response['message']="EMAIL NOT ACCETABLE! $email already used by another admin"; 
				}else{///else if 4	
					mysqli_query($conn,"UPDATE users_tab SET fullname='$fullname',mobile_no='$mobile_no', email='$email', updated_time=NOW() WHERE user_id='$user_id'") or die (mysqli_error($conn));
					$response['response']=200; 
					$response['success']=true;
					$response['message']="SUCCESS! User Updated Successful!";
					require_once '../component/login-details.php';

				}///end if 4
			}else{ ///else if 3
				$response['response']=107; 
				$response['success']=false;
				$response['message']="ERROR: $email is NOT a valid email address"; 
			} ///end if 3
		} ///end if 2
	}///end if 1
}///end if 0
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>