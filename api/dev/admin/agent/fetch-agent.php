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
		$status_id=trim(strtoupper($_POST['status_id']));
		$search_keywords =trim(($_POST['search_keywords']));

		
			$select="SELECT a.*, b.status_name
			FROM  company_tab a, setup_status_tab b
			WHERE a.company_id LIKE '%$company_id%' AND a.status_id LIKE '%$status_id%' AND
			(a.name LIKE '%$search_keywords%' OR a.address LIKE '%$search_keywords%' OR a.email LIKE '%$search_keywords%' OR a.phone LIKE '%$search_keywords%') AND
			a.status_id=b.status_id
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
				///get company_id
				$company_id = $fetch_query['company_id'];

				$getCompanyCommissionQuery=mysqli_query($conn,"SELECT 
				a.*, b.fullname AS staff_name
				FROM company_commission_tab a, staff_tab b
				WHERE a.modified_by=b.staff_id AND a.company_id='$company_id'")or die (mysqli_error($conn));
				$getCompanyCommissions=array();

				while ($getCompanyCommission = mysqli_fetch_assoc($getCompanyCommissionQuery)) {
					$getCompanyCommissions[] = $getCompanyCommission;
				}
				$fetch_query['commission']= $getCompanyCommissions;
				$fetch_query['documentStoragePath'] = "$documentStoragePath/company-logo";
				$response['data'][] = $fetch_query;
			}

end:
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>