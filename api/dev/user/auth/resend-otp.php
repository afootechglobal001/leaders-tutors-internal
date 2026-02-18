<?php require_once '../../config/connection.php';?>
<?php if (!$checkBasicSecurity) {goto end;}?>

<?php

	//////////////////declaration of variables//////////////////////////////////////
	$user_id=trim($_POST['user_id']);
	////////////////////////////////////////////////////////////////////////////////
	if ($user_id==""){/// start if 2
		$response['response']=100; 
		$response['success']=false;
		$response['message']="USER ID FIELD REQUIRED! User ID field cannot be empty"; 
	}else{/// else if 2
		$query=mysqli_query($conn,"SELECT * FROM users_tab WHERE user_id='$user_id'") or die (mysqli_error($conn));
		$count_user=mysqli_num_rows($query);
		
		if ($count_user>0){ /// start if 3
			$fetch_query=mysqli_fetch_array($query);
			$email=$fetch_query['email']; 
			$fullname=$fetch_query['fullname']; 
			/// Generate otp
			$otp = rand(111111,999999);
			/// update user on staff_tab
			mysqli_query($conn,"UPDATE users_tab SET otp='$otp', updated_time=NOW() WHERE user_id='$user_id'")or die (mysqli_error($conn));
			////// send otp to email
			require_once('../../config/mail/user/reset-password.php');	
			$response['response']=200; 
			$response['success']=true;
			$response['message']="OTP RE-SENT! Enter the OTP sent to your email address and proceed.";

			$alert_detail="RESET PASSWORD OTP RE-SENT: A user whose name is $fullname with ID: $user_id attempt to reset his/her password and an OTP has been re-sent for acount verification.";
			$callclass->_alert_sequence_and_update($conn,$user_id,$fullname,0,$alert_detail,$ipAddress,$systemName);
		}else{/// else if 3
			$response['response']=101; 
			$response['success']=false;
			$response['message']="INVALID USER ID! Start the process allover."; 
		}/// end if 3
	}/// end if 2
}/// end if 1
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>