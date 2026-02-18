<?php require_once '../../config/connection.php';?>
<?php

///// check for API security
if ($apiKey!=$expected_api_key){/// start if 1
	$response['response']=98; 
	$response['success']=false;
	$response['message']="SECURITY ACCESS DENIED! You are not allowed to execute this command due to security bridge.";
	goto end;
}
	//////////////////declaration of variables//////////////////////////////////////
	$email=trim($_POST['email']);
	$otp=trim($_POST['otp']);
	////////////////////////////////////////////////////////////////////////////////
	/// validate  contact_email
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$response['response']=100;
		$response['success']=false;
		$response['message']="INVALID EMAIL! Check and try again.";
		goto end;
	}

	if(empty($otp)){
		$response['response']=101;
		$response['success']=false;
		$response['message']="OTP REQUIRED! Check and try again.";
		goto end;
	}

		$query=mysqli_query($conn,"SELECT * FROM company_contacts_login_verification_tab WHERE email='$email' AND `otp`='$otp'") or die (mysqli_error($conn));
		$count_user=mysqli_num_rows($query);

		if($count_user!=1){
			$response['response']=102;
			$response['success']=false;
			$response['message']="INVALID OTP! Check and try again.";
			goto end;
		}

			/// Generate login access key
			$access_key = trim(md5($email . date("Ymdhis")));
			/// update user on company_contacts_login_verification_tab
			mysqli_query($conn, "UPDATE company_contacts_login_verification_tab SET access_key='$access_key', last_login_time=NOW() WHERE email='$email' AND `otp`='$otp'") or die(mysqli_error($conn));

			$query = mysqli_query($conn, "SELECT * FROM company_contacts_login_verification_tab WHERE email='$email' AND `otp`='$otp'") or die(mysqli_error($conn));
			$fetch = mysqli_fetch_assoc($query);
			$last_login_date = $fetch['last_login_time'];

			$response['response'] = 200;
			$response['success'] = true;
			$response['message'] = "LOGIN SUCCESSFUL!";
			$response['email'] = $email;
			$response['access_key'] = $access_key;
			$response['last_login_date'] = $last_login_date;
			require_once '../component/login-details.php';
end:
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);

?>