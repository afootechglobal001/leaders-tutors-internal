<?php require_once '../../config/connection.php';?>
<?php require_once '../../config/agent-session-check.php';?>
<?php

///// check for API security
if ($apiKey!=$expected_api_key){/// start if 1
	$response['response']=98;
	$response['success']=false;
	$response['message']="SECURITY ACCESS DENIED! You are not allowed to execute this command due to security bridge.";
	goto end;
}
if($check==0){ /// start if 1
	$response['response']=99;
	$response['success']=false;
	$response['message']="SESSION EXPIRED! Please LogIn Again.";
	goto end;
}

		//////////////////declaration of variables//////////////////////////////////////
		$company_id=trim(($_POST['company_id']));
		$company_referral_code=trim($_POST['company_referral_code']);
		$company_logo=$_FILES['company_logo']['name'];
		
		if(empty($company_id)){
			$response['response']=100;
			$response['success']=false;
			$response['message']="COMPANY ID REQUIRED! Check and try again.";
			goto end;
		}

		if(empty($company_referral_code)){
			$response['response']=101;
			$response['success']=false;
			$response['message']="COMPANY REFERRAL CODE REQUIRED! Check and try again.";
			goto end;
		}
		
				/////// check for company existing record
				$query=mysqli_query($conn,"SELECT * FROM company_tab WHERE referral_code='$company_referral_code' AND company_id!='$company_id'") or die (mysqli_error($conn));
				$count_company=mysqli_num_rows($query);
				if ($count_company>0){
					$response['response']=117;
					$response['success']=false;
					$response['message']="REFERRAL CODE UNACCEPTABLE! An agent with this code already exist.";
					goto end;
				}

			
				/// update company
				mysqli_query($conn,"UPDATE `company_tab` SET
				`referral_code`='$company_referral_code'
				WHERE company_id='$company_id'")or die (mysqli_error($conn));
				


				
				/////upload question pix
				$allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png","PNG","GIF","webp","WEBP");
				$company_logo_extension = pathinfo($_FILES['company_logo']['name'], PATHINFO_EXTENSION);
				if (in_array($company_logo_extension, $allowedExts)){/// start if 4
					$company_array=$callclass->_get_company_details($conn, $company_id);
					$company_array = json_decode($company_array, true);
					$db_logo= $company_array[0]['logo'];
					unlink($companyLogoPath . $db_logo);
					//// upload company logo
					$company_logo = $company_id.'_'.date("Ymdhis").'.'.$company_logo_extension;
					$companyLogoPath= $companyLogoPath . $company_logo;
					if (move_uploaded_file($_FILES["company_logo"]["tmp_name"], $companyLogoPath)){/// start if 7
						mysqli_query($conn,"UPDATE `company_tab` SET logo='$company_logo' WHERE company_id='$company_id'")or die (mysqli_error($conn));
					}
				}

				
				$alert_detail="AGENT UPDATED SUCCESSFUL: An agent whose name is  $company_name was successfully updated. DETAIL--- ID:$company_id, Email:$company_email, MobileNo:$company_phone";
				$callclass->_alert_sequence_and_update($conn,$login_agent_staff_id,$login_agent_fullname,$login_agent_role_id,$alert_detail,$ipAddress,$systemName);
							
				$response['response']=200;
				$response['success']=true;
				$response['message']="AGENT PROFILE UPDATED SUCCESSFULLY!";
				require_once '../component/login-details.php';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
end:
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>