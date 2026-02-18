<?php require_once '../../config/connection.php';?>
<?php if (!$checkBasicSecurity) {goto end;}?>

<?php

	//////////////////declaration of variables//////////////////////////////////////
	$user_id=trim($_POST['user_id']);
	$otp=trim($_POST['otp']);
	$password=$_POST['password'];
	$confirm_password=$_POST['confirm_password'];
	////////////////////////////////////////////////////////////////////////////////

	if ($user_id==""){/// start if 2
		$response['response']=100; 
		$response['success']=false;
		$response['message']="USER ID REQUIRED! Provide StaffID and try again"; 
	}elseif($otp==""){/// else if 2
		$response['response']=102; 
		$response['success']=false;
		$response['message']="OTP REQUIRED! Provide the OTP and try again"; 
	}elseif($password==""){/// else if 2
		$response['response']=103; 
		$response['success']=false;
		$response['message']="PASSWORD REQUIRED! Create password and try again"; 
	}elseif($confirm_password==""){/// else if 2
		$response['response']=104; 
		$response['success']=false;
		$response['message']="PASSWORD REQUIRED! Confirm password and try again"; 
	}else{/// else if 2
		if($password==$confirm_password){/// start if 3
			$password=md5($_POST['password']);
			$query=mysqli_query($conn,"SELECT * FROM users_tab WHERE user_id='$user_id' AND otp='$otp'") or die (mysqli_error($conn));
			$count_user=mysqli_num_rows($query);
				if ($count_user>0){ /// start if 4
					/// update user on staff_tab
					mysqli_query($conn,"UPDATE users_tab SET password='$password', updated_time=NOW() WHERE user_id='$user_id'")or die (mysqli_error($conn));
					$response['response']=200; 
					$response['success']=true;
					$response['message']="PASSWORD RESET SUCCESSFULLY! You may proceed to login.";
				}else{/// else if 4
					$response['response']=105; 
					$response['success']=false;
					$response['message']="INVALID OTP! Check the OTP and try again.";
				}/// end if 4
		}else{/// else if 3
					$response['response']=106; 
					$response['success']=false;
					$response['message']="PASSWORD NOT MATCH! Check the Passwords and try again.";
		}/// end if 3
		
	}/// end if 2
}/// end if 1
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);

?>