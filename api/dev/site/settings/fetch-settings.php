<?php require_once '../../config/connection.php';?>
<?php
////////////////////////////////////////////////////////
///// check for API security
if ($apiKey!=$expected_api_key){/// start if 0
	$response['response']=98; 
	$response['success']=false;
	$response['message']="SECURITY ACCESS DENIED! You are not allowed to execute this command due to security bridge."; 
}else{/// else if 0


		$select="SELECT a.* 
		FROM setup_backend_settings_tab a
		";
		
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
}
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>