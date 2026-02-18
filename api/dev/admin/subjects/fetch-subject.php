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

	//////////////////declaration of variables//////////////////////////////////////
	$subject_id=trim($_POST['subject_id']);
	$status_id=trim(strtoupper($_POST['status_id']));
	$search_keywords =trim(($_POST['search_keywords']));
	////////////////////////////////////////////////////////////////////////////////

	$select="SELECT
		a.sn, a.subject_id, a.subject_name, a.urls, a.thumbnail, a.status_id, a.created_time, a.updated_time, a.modified_by,
		b.status_name, c.fullname AS staff_name
		FROM 
		subjects_tab a, setup_status_tab b, staff_tab c
		WHERE 
		a.subject_id LIKE '%$subject_id%' AND a.status_id LIKE '%$status_id%' AND
		(a.subject_name LIKE '%$search_keywords%' OR a.urls LIKE '%$search_keywords%') AND
		a.status_id=b.status_id AND a.modified_by=c.staff_id 
		ORDER BY a.subject_name ASC";

		$query=mysqli_query($conn,$select)or die (mysqli_error($conn));
		$all_record_count=mysqli_num_rows($query);
		if($all_record_count==0){///start if 2
			$response['response']=200;
			$response['success']=true;
			$response['message']="No Record found"; 
		}else{///else if 2

			$response['response']=200;
			$response['success']=true;
			$response['all_record_count']=$all_record_count;
			$response['data'] = array(); // Initialize the data array

			while ($fetch_query = mysqli_fetch_assoc($query)) {
				$fetch_query['documentStoragePath'] = "$documentStoragePath/subject-pix";
				$response['data'][] = $fetch_query;
			}

		}/// end if 2
	}/// end if 1
}/// end if 0
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>