<?php require_once '../../config/connection.php';?>
<?php require_once '../../config/admin-session-check.php';?>
<?php
////////////////////////////////////////////////////////
///// check for API security
if ($apiKey!=$expected_api_key){/// start if 0
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
		$company_name=trim(($_POST['company_name']));
		$company_address=trim((str_replace("'", "\'", $_POST['company_address'])));
		$company_phone=trim($_POST['company_phone']);
		$company_email =trim($_POST['company_email']);
		$company_logo=$_FILES['company_logo']['name'];
		$company_status_id=trim($_POST['company_status_id']);
		$company_referral_code=trim($_POST['company_referral_code']);

		$leaders_tutors_commission=trim(($_POST['leaders_tutors_commission']));
		$leaders_network_commission=trim(($_POST['leaders_network_commission']));
		$company_commission=trim($_POST['company_commission']);
		
		
		if(empty($company_id)){
			$response['response']=100;
			$response['success']=false;
			$response['message']="COMPANY ID REQUIRED! Check and try again.";
			goto end;
		}
		if(empty($company_name)){
			$response['response']=100;
			$response['success']=false;
			$response['message']="COMPANY NAME REQUIRED! Check and try again.";
			goto end;
		}
		if(empty($company_address)){
			$response['response']=101;
			$response['success']=false;
			$response['message']="COMPANY ADDRESS REQUIRED! Check and try again.";
			goto end;
		}
		if(empty($company_phone)){
			$response['response']=102;
			$response['success']=false;
			$response['message']="COMPANY PHONE NUMBER REQUIRED! Check and try again.";
			goto end;
		}
		if(empty($company_email)){
			$response['response']=103;
			$response['success']=false;
			$response['message']="COMPANY EMAIL REQUIRED! Check and try again.";
			goto end;
		}
		
		if(empty($company_status_id)){
			$response['response']=105;
			$response['success']=false;
			$response['message']="COMPANY STATUS REQUIRED! Select and try again.";
			goto end;
		}
		if(empty($company_referral_code)){
			$response['response']=109;
			$response['success']=false;
			$response['message']="COMPANY REFERRAL CODE REQUIRED! Check and try again.";
			goto end;
		}
		if(empty($leaders_tutors_commission)){
			$response['response']=106;
			$response['success']=false;
			$response['message']="LEADERS TUTORS COMMISSION REQUIRED! Check and try again.";
		}elseif(empty($leaders_network_commission)){
			$response['response']=107;
			$response['success']=false;
			$response['message']="LEADERS NETWORK COMMISSION REQUIRED! Check and try again.";
			goto end;
		}
		if(empty($company_commission)){
			$response['response']=108;
			$response['success']=false;
			$response['message']="COMPANY COMMISSION REQUIRED! Check and try again.";
			goto end;
		}
			/// validate company_email
			if(!filter_var($company_email, FILTER_VALIDATE_EMAIL)){
				$response['response']=114;
				$response['success']=false;
				$response['message']="INVALID COMPANY EMAIL! Check and try again.";
				goto end;
			}
			
				//////// chech sum of commission
				$commission_percentage=$leaders_tutors_commission+$leaders_network_commission+$company_commission;
				if($commission_percentage!=100){
					$response['response']=116;
					$response['success']=false;
					$response['message']="INVALID REVENUE SHARE! Sum (commission) must be equal to 100.";
					goto end;
				}
				/////// check for company existing record
				$query=mysqli_query($conn,"SELECT * FROM company_tab WHERE email='$company_email' AND company_id!='$company_id'") or die (mysqli_error($conn));
				$count_company=mysqli_num_rows($query);
				if ($count_company>0){
					$response['response']=117;
					$response['success']=false;
					$response['message']="EMAIL UNACCEPTABLE! A company with this email already exist.";
					goto end;
				}

			
				/// update company
				mysqli_query($conn,"UPDATE `company_tab` SET
				`name`='$company_name', `address`='$company_address', `phone`='$company_phone', `email`='$company_email', `status_id`='$company_status_id', `referral_code`='$company_referral_code'
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

				/// delete the previous record
				mysqli_query($conn,"DELETE FROM `company_commission_tab` WHERE company_id='$company_id'");
				/// register company commission
				mysqli_query($conn,"INSERT INTO `company_commission_tab`
				(`company_id`, `leaders_tutors`, `leaders_network`, `company`, `modified_by`, `created_time`, `updated_time`) VALUES
				('$company_id',  '$leaders_tutors_commission', '$leaders_network_commission', '$company_commission','$login_staff_id', NOW(), NOW())")or die (mysqli_error($conn));
				
				$alert_detail="AGENT UPDATED SUCCESSFUL: An agent whose name is  $company_name was successfully updated. DETAIL--- ID:$company_id, Email:$company_email, MobileNo:$company_phone";
				$callclass->_alert_sequence_and_update($conn,$login_staff_id,$login_staff_fullname,$login_role_id,$alert_detail,$ipAddress,$systemName);
				
				require_once('../../config/mail/user/update-agent.php');				
				$response['response']=200;
				$response['success']=true;
				$response['message']="AGENT UPDATED SUCCESSFULLY!";
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
end:
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>