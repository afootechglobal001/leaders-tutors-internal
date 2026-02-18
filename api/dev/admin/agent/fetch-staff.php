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
		$company_id=trim(strtoupper($_POST['company_id']));
		$staff_id=trim(($_POST['staff_id']));
		$search_keywords =trim(($_POST['search_keywords']));

		if(empty($company_id)){
			$response['response']=100;
			$response['success']=false;
			$response['message']="COMPANY ID REQUIRED! Check and try again.";
			goto end;
		}
	
		$select="SELECT a.*, b.role_name, c.status_name
		FROM  company_contacts_tab a, setup_role_tab b,  setup_status_tab c
		WHERE a.company_id LIKE '%$company_id%' AND a.staff_id LIKE '%$staff_id%' AND
		(a.name LIKE '%$search_keywords%' OR a.email LIKE '%$search_keywords%'  OR a.phone LIKE '%$search_keywords%') AND
		a.role_id=b.role_id AND a.status_id=c.status_id
		ORDER BY a.name ASC";

			$query=mysqli_query($conn,$select)or die (mysqli_error($conn));
			$all_record_count=mysqli_num_rows($query);
			if($all_record_count==0){///start if 1
				$response['response']=200;
				$response['success']=true;
				$response['message']="No Record found";
				goto end;
			}

			$response['response']=200;
			$response['success']=true;
			$response['all_record_count']=$all_record_count;
			$response['data'] = array(); // Initialize the data array
			while ($fetch_query = mysqli_fetch_assoc($query)) {
				$response['data'][] = $fetch_query;
			}

end:
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>