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
		$response['success']=False;
		$response['message']="SESSION EXPIRED! Please LogIn Again."; 
	}else{/// else if 1

		
			$query=mysqli_query($conn,"SELECT
			(SELECT COUNT(*) FROM staff_tab WHERE status_id=1) AS total_active_staff_count,
			(SELECT COUNT(*) FROM subjects_tab WHERE status_id=1) AS total_active_subjects_count,
			(SELECT COUNT(*) FROM classes_tab WHERE status_id=1) AS total_active_classes_count,
			(SELECT COUNT(*) FROM departments_tab WHERE status_id=1) AS total_active_departments_count");

			$response['response']=200;
			$response['success']=true;
			$response['data'] = array(); // Initialize the data array

			while ($fetch_query = mysqli_fetch_assoc($query)) {
				$response['data'][] = $fetch_query;
			}
	
	}///end if 1
}///end if 0
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>