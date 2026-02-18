<?php require_once '../../config/connection.php';?>
<?php require_once '../../config/admin-session-check.php';?>
<?php
////////////////////////////////////////////////////////
///// check for API security
if ($apiKey!=$expected_api_key){/// start if 0
	$response['response']=98;
	$response['success']=false;
	$response['message']="SECURITY ACCESS DENIED! You are not allowed to execute this command due to security bridge."; 
}else{/// else if 0


	if($check==0){ /// start if 1
		$response['response']=99; 
		$response['success']=false;
		$response['message']="SESSION EXPIRED! Please LogIn Again.";
	}else{/// else if 1
		
		$response['response']=200;
		$response['success']=true;
		$response['message']="QUESTION TEMPLATE DOWNLOADED SUCCESSFULLY!";
		$response['url']="$documentStoragePath/cbt-question-template/template.csv";
		
	}/// end if 1
}/// end if 0
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>