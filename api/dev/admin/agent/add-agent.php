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

		$company_name=trim(($_POST['company_name']));
		$company_address=trim((str_replace("'", "\'", $_POST['company_address'])));
		$company_phone=trim($_POST['company_phone']);
		$company_email =trim($_POST['company_email']);
		$company_logo=$_FILES['company_logo']['name'];
		$company_status_id=trim($_POST['company_status_id']);

		$leaders_tutors_commission=trim(($_POST['leaders_tutors_commission']));
		$leaders_network_commission=trim(($_POST['leaders_network_commission']));
		$company_commission=trim($_POST['company_commission']);
		
		$contact_name=trim(strtoupper($_POST['contact_name']));
		$contact_email=trim($_POST['contact_email']);
		$contact_phone=trim($_POST['contact_phone']);
		$contact_role_id=trim($_POST['contact_role_id']);
		$contact_status_id=trim($_POST['contact_status_id']);
		
		
		
			
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
		if(empty($company_logo)){
			$response['response']=104;
			$response['success']=false;
			$response['message']="COMPANY LOGO REQUIRED! Check and try again.";
			goto end;
		}
		if(empty($company_status_id)){
			$response['response']=105;
			$response['success']=false;
			$response['message']="COMPANY STATUS REQUIRED! Select and try again.";
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
		if(empty($contact_name)){
			$response['response']=109;
			$response['success']=false;
			$response['message']="CONTACT NAME REQUIRED! Check and try again.";
			goto end;
		}
		if(empty($contact_email)){
			$response['response']=110;
			$response['success']=false;
			$response['message']="CONTACT EMAIL REQUIRED! Check and try again.";
			goto end;
		}
		if(empty($contact_phone)){
			$response['response']=111;
			$response['success']=false;
			$response['message']="CONTACT PHONE NUMBER REQUIRED! Check and try again.";
			goto end;
		}
		if(empty($contact_role_id)){
			$response['response']=112;
			$response['success']=false;
			$response['message']="CONTACT ROLE REQUIRED! Select and try again.";
			goto end;
		}
		if(empty($contact_status_id)){
			$response['response']=113;
			$response['success']=false;
			$response['message']="CONTACT STATUS REQUIRED! Select and try again.";
			goto end;
		}


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

			/////upload question pix
			$allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png","PNG","GIF","webp","WEBP");
			$company_logo_extension = pathinfo($_FILES['company_logo']['name'], PATHINFO_EXTENSION);
			if (!in_array($company_logo_extension, $allowedExts)){/// start if 4
				$response['response']=116;
				$response['success']=false;
				$response['message']="INVALID LOGO FORMAT! Upload .jpg or .png format";
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

				$query=mysqli_query($conn,"SELECT * FROM company_tab WHERE email='$company_email'") or die (mysqli_error($conn));
				$count_company=mysqli_num_rows($query);
				if ($count_company>0){
					$response['response']=117;
					$response['success']=false;
					$response['message']="EMAIL UNACCEPTABLE! A company with this email already exist.";
					goto end;
				}

				///////////////////////geting sequence//////////////////////////
				$sequence=$callclass->_get_sequence_count($conn, 'COM');
				$array = json_decode($sequence, true);
				$no= $array[0]['no'];
				////// generate company ID
				$company_id='COM'.$no.date("Ymdhis");

				///////////////////////geting sequence//////////////////////////
				$sequence=$callclass->_get_sequence_count($conn, 'CSTF');
				$array = json_decode($sequence, true);
				$no= $array[0]['no'];
				////// generate company staff ID
				$staff_id='CSTF'.$no.date("Ymdhis");

				//// upload company logo
				$company_logo = $company_id.'_'.date("Ymdhis").'.'.$company_logo_extension;
				$companyLogoPath= $companyLogoPath . $company_logo;
				move_uploaded_file($_FILES["company_logo"]["tmp_name"], $companyLogoPath);


				/// register company
				mysqli_query($conn,"INSERT INTO `company_tab`
				(`company_id`, `name`, `address`, `phone`, `email`, `logo`, `status_id`, `referral_code`, `modified_by`, `created_time`, `updated_time`) VALUES
				('$company_id',  '$company_name', '$company_address', '$company_phone','$company_email', '$company_logo', '$company_status_id', '$company_id', '$staff_id', NOW(), NOW())")or die (mysqli_error($conn));

				/// register company commission
				mysqli_query($conn,"INSERT INTO `company_commission_tab`
				(`company_id`, `leaders_tutors`, `leaders_network`, `company`, `modified_by`, `created_time`, `updated_time`) VALUES
				('$company_id',  '$leaders_tutors_commission', '$leaders_network_commission', '$company_commission','$login_staff_id', NOW(), NOW())")or die (mysqli_error($conn));
				
				/// register company staff
				mysqli_query($conn,"INSERT INTO `company_contacts_tab`
				(`company_id`, `staff_id`, `name`, `email`, `phone`, `role_id`, `status_id`, `modified_by`, `created_time`, `updated_time`) VALUES
				('$company_id',  '$staff_id', '$contact_name', '$contact_email','$contact_phone','$contact_role_id','$contact_status_id','$staff_id', NOW(), NOW())")or die (mysqli_error($conn));
				
				$alert_detail="AGENT REGISTRATION SUCCESSFUL: An agent whose name is  $company_name was successfully registered. DETAIL--- ID:$company_id, Email:$company_email, MobileNo:$company_phone";
				$callclass->_alert_sequence_and_update($conn,$login_staff_id,$login_staff_fullname,$login_role_id,$alert_detail,$ipAddress,$systemName);
				
				require_once('../../config/mail/user/add-agent.php');
				$response['response']=200;
				$response['success']=true;
				$response['message']="AGENT REGISTRATION SUCCESSFULLY!";
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
end:
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>