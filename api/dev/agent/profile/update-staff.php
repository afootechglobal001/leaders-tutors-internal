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
				$staff_id=trim(($_POST['staff_id']));
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
				if(empty($staff_id)){
					$response['response']=100;
					$response['success']=false;
					$response['message']="COMPANY STAFF ID REQUIRED! Check and try again.";
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
					$query=mysqli_query($conn,"SELECT * FROM company_contacts_tab WHERE email='$contact_email' AND company_id='$company_id' AND staff_id!='$staff_id'") or die (mysqli_error($conn));
					$count_company=mysqli_num_rows($query);
					if ($count_company>0){
						$response['response']=117;
						$response['success']=false;
						$response['message']="EMAIL UNACCEPTABLE! A staff with this email already exist for this agent.";
						goto end;
					}
						
				/// update company commission
				mysqli_query($conn,"UPDATE `company_contacts_tab` SET
				`name`='$contact_name', `email`='$contact_email', `phone`='$contact_phone', `role_id`='$contact_role_id', `status_id`='$contact_status_id'
				WHERE company_id='$company_id' AND staff_id='$staff_id'")or die (mysqli_error($conn));
				
				$alert_detail="AGENT STAFF UPDATED SUCCESSFUL: A staff  whose name is  $contact_name was successfully added to an agent list. DETAIL--- ID:$company_id, name:$company_name, Email:$company_email, MobileNo:$company_phone";
				$callclass->_alert_sequence_and_update($conn,$login_agent_staff_id,$login_agent_fullname,$login_agent_role_id,$alert_detail,$ipAddress,$systemName);

				$response['response']=200;
				$response['success']=true;
				$response['message']="STAFF UPDATED SUCCESSFULLY!";
				require_once '../component/login-details.php';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
end:
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>