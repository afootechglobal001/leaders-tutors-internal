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
		$contact_name=trim(strtoupper($_POST['contact_name']));
		$contact_email=trim($_POST['contact_email']);
		$contact_phone=trim($_POST['contact_phone']);
		$contact_role_id=trim($_POST['contact_role_id']);
		$contact_status_id=trim($_POST['contact_status_id']);
		
		
		
			
		if(empty($company_id)){
			$response['response']=100;
			$response['success']=false;
			$response['message']="COMPANY ID REQUIRED! Check and try again.";
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

			/// validate  contact_email
			if(!filter_var($contact_email, FILTER_VALIDATE_EMAIL)){
				$response['response']=115;
				$response['success']=false;
				$response['message']="INVALID CONATCT EMAIL! Check and try again.";
				goto end;
			}

			/////// check for company existing record
			$query=mysqli_query($conn,"SELECT * FROM company_contacts_tab WHERE email='$contact_email' AND company_id='$company_id'") or die (mysqli_error($conn));
			$count_company=mysqli_num_rows($query);
			if ($count_company>0){
				$response['response']=117;
				$response['success']=false;
				$response['message']="EMAIL UNACCEPTABLE! A staff with this email already exist for this agent.";
				goto end;
			}
				$company_array=$callclass->_get_company_details($conn, $company_id);
				$company_array = json_decode($company_array, true);
				$company_name= $company_array[0]['name'];
				$company_email= $company_array[0]['email'];
				$company_phone= $company_array[0]['phone'];

				///////////////////////geting sequence//////////////////////////
				$sequence=$callclass->_get_sequence_count($conn, 'CSTF');
				$array = json_decode($sequence, true);
				$no= $array[0]['no'];
				////// generate company staff ID
				$staff_id='CSTF'.$no.date("Ymdhis");

				/// register company staff
				mysqli_query($conn,"INSERT INTO `company_contacts_tab`
				(`company_id`, `staff_id`, `name`, `email`, `phone`, `role_id`, `status_id`, `modified_by`, `created_time`, `updated_time`) VALUES
				('$company_id',  '$staff_id', '$contact_name', '$contact_email','$contact_phone','$contact_role_id','$contact_status_id','ADMIN', NOW(), NOW())")or die (mysqli_error($conn));
				
				$alert_detail="AGENT STAFF ADDED SUCCESSFUL: A staff  whose name is  $contact_name was successfully added to an agent list. DETAIL--- ID:$company_id, name:$company_name, Email:$company_email, MobileNo:$company_phone";
				$callclass->_alert_sequence_and_update($conn,$login_staff_id,$login_staff_fullname,$login_role_id,$alert_detail,$ipAddress,$systemName);
				
				require_once('../../config/mail/user/add-agent-staff.php');				
				$response['response']=200;
				$response['success']=true;
				$response['message']="AGENT STAFF ADDED SUCCESSFULLY!";
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
end:
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>