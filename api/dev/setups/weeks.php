<?php require_once '../config/connection.php';?>
<?php if (!$checkBasicSecurity) {goto end;}?>

<?php

	//////////////////declaration of variables//////////////////////////////////////
	$week_id=trim(strtoupper($_POST['week_id']));
	$search_keywords =trim(($_POST['search_keywords']));
	////////////////////////////////////////////////////////////////////////////////

	if ($week_id !=''){
		$week_ids= "AND  week_id IN ($week_id)";
	}

	$select="SELECT
		*
		FROM 
		setup_week_tab
		WHERE 
		(week_name LIKE '%$search_keywords%' $week_ids)";

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