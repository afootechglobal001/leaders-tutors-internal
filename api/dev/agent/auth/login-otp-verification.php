<?php require_once '../../config/connection.php';?>
<?php
////////////////////////////////////////////////////////
///// check for API security
if ($apiKey!=$expected_api_key){/// start if 0
	$response['response']=98;
	$response['success']=false;
	$response['message']="SECURITY ACCESS DENIED! You are not allowed to execute this command due to security bridge.";
	goto end;
}

		//////////////////declaration of variables//////////////////////////////////////
		$email=trim(($_POST['email']));

		/// validate  contact_email
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$response['response']=100;
			$response['success']=false;
			$response['message']="INVALID EMAIL! Check and try again.";
			goto end;
		}

		$select="SELECT *
		FROM  company_contacts_tab
		WHERE email = '$email'
		LIMIT 1";

			$query=mysqli_query($conn,$select)or die (mysqli_error($conn));
			$all_record_count=mysqli_num_rows($query);
			if($all_record_count==0){///start if 1
				$response['response']=101;
				$response['success']=false;
				$response['message']="USER EEROR! No record attached to this email.";
				goto end;
			}
			/// delete the previous record
			mysqli_query($conn,"DELETE FROM `company_contacts_login_verification_tab` WHERE email='$email'");
			/// Generate otp
			$otp = rand(111111,999999);
			/// Insert new record for verification
			mysqli_query($conn,"INSERT INTO `company_contacts_login_verification_tab`
			(`email`, `otp`) VALUES
			('$email',  '$otp')")or die (mysqli_error($conn));
			
			require_once('../../config/mail/user/login-otp-verification.php');
			$response['response']=200;
			$response['success']=true;
			$response['email']=$email;
			$response['message']="OTP SENT SUCCESSFULLY!";
				
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
end:
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>