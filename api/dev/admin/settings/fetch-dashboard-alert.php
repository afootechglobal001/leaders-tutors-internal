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
		
		$select="SELECT * FROM  0_alert_tab WHERE role_id<='$login_role_id' AND seen_status<'$login_role_id'";
				
		$query=mysqli_query($conn,$select."  ORDER BY created_time DESC LIMIT 5")or die (mysqli_error($conn));

		$unread_alert_query=mysqli_query($conn,$select)or die (mysqli_error($conn));
		$unread_alert_count=mysqli_num_rows($unread_alert_query);

		$all_record_count=mysqli_num_rows($query);
		if($all_record_count==0){///start if 1
			$response['response']=200;
			$response['success']=true;
			$response['message']="No Record found"; 
		}else{///else if 1

			$response['response']=200;
			$response['success']=true;
			$response['unread_alert']=$unread_alert_count;
			$response['data'] = array(); // Initialize the data array

			while ($fetch_query = mysqli_fetch_assoc($query)) {
				$response['data'][] = $fetch_query;
			}

		}
	}
}
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>