<?php require_once '../../config/connection.php';?>
<?php require_once '../../config/user-session-check.php';?>

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

		//////////////////declaration of variables//////////////////////////////////////
		$subscription_id=trim($_POST['subscription_id']);
		$user_id=$login_user_id;
		$user_array=$callclass->_get_user_details($conn, $user_id);
		$user_fetch = json_decode($user_array, true);
			$fullname=$user_fetch[0]['fullname'];
			$email=$user_fetch[0]['email'];
			$mobile_no=$user_fetch[0]['mobile_no'];
			$wallet_balance=$user_fetch[0]['wallet_balance'];

		$select="SELECT a.*, b.department_name, c.class_name, d.status_name
		FROM subscriptions_tab a, departments_tab b, classes_tab c, setup_status_tab d 
		WHERE a.user_id ='$user_id' AND a.subscription_id LIKE '%$subscription_id%' AND a.department_id=b.department_id AND a.class_id=c.class_id AND a.status_id=d.status_id 
		ORDER BY a.subscription_end_date DESC";

		$query=mysqli_query($conn,$select)or die (mysqli_error($conn));
		$all_record_count=mysqli_num_rows($query);
		if ($all_record_count>0){ /// start if 2
			$response['response']=200;
			$response['success']=true;
			$response['all_record_count']=$all_record_count;
			$response['data'] = array(); // Initialize the data array
			while ($fetch_query = mysqli_fetch_assoc($query)) {
				$response['data'][] = $fetch_query;
			}
		}else{ /// else if 2
			$response['response']=100; 
			$response['success']=False;
			$response['message']="NO RECORD FOUND!"; 
		} /// end if 2
	}/// end if 1
}/// end if 0
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>