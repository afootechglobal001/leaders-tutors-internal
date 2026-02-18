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
	$department_id=trim($_POST['department_id']);
	$class_id=trim($_POST['class_id']);
	////////////////////////////////////////////////////////////////////////////////
		if($department_id==''){ ///start if 2
			$response['response']=100; 
			$response['success']=false;
			$response['message']="DEPARTMENT ID REQUIRED! Check and try again."; 
		}elseif($class_id==''){ ///else if 2
			$response['response']=102; 
			$response['success']=false;
			$response['message']="CLASS ID REQUIRED! Check and try again.";
		}else{ ///else if 2
		$department_array=$callclass->_get_department_details($conn, $department_id);
		$department_array = json_decode($department_array, true);
		$department_name= strtoupper($department_array[0]['department_name']);

		$class_array=$callclass->_get_class_details($conn, $class_id);
		$class_array = json_decode($class_array, true);
		$class_name= $class_array[0]['class_name'];

		$select="SELECT a.subject_id, b.subject_name, b.thumbnail, b.urls, a.page_title, a.seo_keywords, a.seo_description
		FROM department_class_subject_tab a, subjects_tab b
		WHERE a.subject_id=b.subject_id AND a.department_id = '$department_id' AND a.class_id = '$class_id' AND rank_id=2
		ORDER BY a.sn ASC";

			$query=mysqli_query($conn,$select)or die (mysqli_error($conn));
			$all_record_count=mysqli_num_rows($query);
			if($all_record_count==0){///start if 3
				$response['response']=200;
				$response['success']=true;
				$response['department_id']=$department_id;
				$response['department_name']=$department_name;
				$response['class_id']=$class_id;
				$response['class_name']=$class_name;
				$response['message']="No Record found"; 
			}else{///else if 3
				
				$response['response']=200;
				$response['success']=true;
				$response['department_id']=$department_id;
				$response['department_name']=$department_name;
				$response['class_id']=$class_id;
				$response['class_name']=$class_name;
				$response['no_of_subjects']=$all_record_count;
				$response['data'] = array(); // Initialize the data array

				while ($fetch_query = mysqli_fetch_assoc($query)) {
					$fetch_query['documentStoragePath'] = "$documentStoragePath/subject-pix";
					$response['data'][] = $fetch_query;
				}
			

			}/// end if 3
		}/// end if 2
	}/// end if 1
}/// end if 0
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>