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
		$company_email=trim(($_POST['company_email']));
		$contact_email=trim(($_POST['contact_email']));

		
		if(!filter_var($company_email, FILTER_VALIDATE_EMAIL)){
			$response['response']=114;
			$response['success']=false;
			$response['message']="INVALID COMPANY EMAIL! Check and try again.";
			goto end;
		}

		if(!filter_var($contact_email, FILTER_VALIDATE_EMAIL)){
			$response['response']=115;
			$response['success']=false;
			$response['message']="INVALID CONATCT EMAIL! Check and try again.";
			goto end;
		}

		$query=mysqli_query($conn,"SELECT * FROM company_tab WHERE email='$company_email'") or die (mysqli_error($conn));
		$count_company=mysqli_num_rows($query);
		if ($count_company>0){
			$response['response']=117;
			$response['success']=false;
			$response['message']="EMAIL UNACCEPTABLE! A company with this email already exist.";
			goto end;
		}


			/// delete the previous record
			mysqli_query($conn,"DELETE FROM `company_contacts_login_verification_tab` WHERE email='$contact_email'");
			/// Generate otp
			$otp = rand(111111,999999);
			/// Insert new record for verification
			mysqli_query($conn,"INSERT INTO `company_contacts_login_verification_tab`
			(`email`, `otp`) VALUES
			('$contact_email',  '$otp')")or die (mysqli_error($conn));

			////// sent OTP
			require_once('../../config/mail/agent/signup-otp-verification.php');
			$response['response']=200;
			$response['success']=true;
			$response['email']=$contact_email;
			$response['message']="OTP SENT SUCCESSFULLY!";
				
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
end:
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>