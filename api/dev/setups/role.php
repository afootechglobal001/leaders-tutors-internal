<?php require_once '../config/connection.php';?>
<?php

///// check for API security
if ($apiKey!=$expected_api_key){/// start if 1
	$response['response']=98; 
	$response['success']=false;
	$response['message']="SECURITY ACCESS DENIED! You are not allowed to execute this command due to security bridge.";
}else{/// else if 1

	//////////////////declaration of variables//////////////////////////////////////
	$login_role_id=trim(strtoupper($_POST['login_role_id']));
	$role_id=trim(strtoupper($_POST['role_id']));
	$search_keywords =trim(($_POST['search_keywords']));
	////////////////////////////////////////////////////////////////////////////////

	$select="SELECT * FROM setup_role_tab WHERE (role_name LIKE '%$search_keywords%' AND role_id<=$login_role_id)";

		$query=mysqli_query($conn,$select)or die (mysqli_error($conn));
		$all_record_count=mysqli_num_rows($query);
		if($all_record_count==0){///start if 1
			$response['response']=200;
			$response['success']=true;
			$response['message']="No Record found";
		}else{///else if 1

			$response['response']=200;
			$response['success']=true;
			$response['all_record_count']=$all_record_count;
			$response['data'] = array(); // Initialize the data array

			while ($fetch_query = mysqli_fetch_assoc($query)) {
				$response['data'][] = $fetch_query;
			}

		}
}/// end if 1
	//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);

?>