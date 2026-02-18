<?php require_once '../../config/connection.php';?>
<?php
	
////////////////////////////////////////////////////////
///// check for API security
if ($apiKey!=$expected_api_key){/// start if 0
	$response['response']=98; 
	$response['success']=false;
	$response['message']="SECURITY ACCESS DENIED! You are not allowed to execute this command due to security bridge."; 
}else{/// else if 0


	//////////////////declaration of variables//////////////////////////////////////
	$department_id=trim($_POST['department_id']);
	$search_keywords =trim(($_POST['search_keywords']));
	////////////////////////////////////////////////////////////////////////////////

	$select="SELECT
		a.sn, a.department_id, a.department_name, a.urls, a.seo_keywords, a.seo_description, a.thumbnail, a.status_id, a.created_time, a.updated_time, a.modified_by,
		b.status_name, c.fullname AS staff_name,
		(SELECT COUNT(d.class_id) FROM department_class_subject_tab d WHERE a.department_id=d.department_id AND d.rank_id=1) AS no_of_classes
		FROM 
		departments_tab a, setup_status_tab b, staff_tab c
		WHERE 
		a.department_id LIKE '%$department_id%' AND a.status_id =1 AND
		(a.department_name LIKE '%$search_keywords%' OR a.urls LIKE '%$search_keywords%' OR a.seo_keywords LIKE '%$search_keywords%' OR a.seo_description LIKE '%$search_keywords%' ) AND
		a.status_id=b.status_id AND a.modified_by=c.staff_id 
		ORDER BY a.sn ASC";

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
				$response['data'][] = $fetch_query;
			}
		

		}/// end if 2
}/// end if 0
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>