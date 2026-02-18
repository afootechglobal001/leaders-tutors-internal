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
	$company_id=trim($_POST['company_id']);
	////////////////////////////////////////////////////////////////////////////////

	if(empty($company_id)){
		$response['response']=101;
		$response['success']=false;
		$response['message']="COMPANY ID REQUIRED! Check and try again.";
		goto end;
	}
	if($login_agent_isApproved=='NO'){
		$response['response']=102;
		$response['success']=false;
		$response['message']="COMPANY INVITATION ALREADY DECLINED!";
		goto end;
	}

	mysqli_query($conn,"UPDATE company_contacts_tab SET isApproved='NO', updated_time=NOW() WHERE company_id='$company_id' AND staff_id='$login_agent_staff_id'") or die (mysqli_error($conn));
	require_once('../../config/mail/agent/decline-invitation.php');
	$alert_detail="AGENT INVITATION DECLINED: A staff whose name is $login_agent_fullname has declined the invitation of agent ($company_name) on leaders tutors application. DETAILS: email: $login_agent_email, phone number: $login_agent_phone";
	$callclass->_alert_sequence_and_update($conn,$login_agent_staff_id,$login_agent_fullname,0,$alert_detail,$ipAddress,$systemName);
	
	$response['response']=200;
	$response['success']=true;
	$response['message']="SUCCESS! Agent Invitation Declined.";
	require_once '../component/login-details.php';
/////////////////////////////////////////////////////////////////////////////////////
end:
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);

?>