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

			$check_subscription=$callclass->_user_subscription_validation($conn, $login_user_id);
			$check_subscription_array = json_decode($check_subscription, true);
			$check= $check_subscription_array[0]['check'];
			$department_id= $check_subscription_array[0]['department_id'];
			$class_id= $check_subscription_array[0]['class_id'];
			if($check==0){ /// start if 2
				$response['response']=100; 
				$response['success']=False;
				$response['message']="SUSCRIPTION EXPIRED! Please subscribe again to continue."; 
			}else{/// else if 2
		
				$select="SELECT a.subject_id, b.subject_name
					FROM 
					department_class_subject_tab a, subjects_tab b
					WHERE
					a.subject_id=b.subject_id AND a.rank_id=2 AND
					a.department_id = '$department_id' AND a.class_id = '$class_id' AND b.status_id=1
					ORDER BY b.subject_name ASC";

					$query=mysqli_query($conn,$select)or die (mysqli_error($conn));
					$all_record_count=mysqli_num_rows($query);
					if($all_record_count==0){///start if 3
						$response['response']=200;
						$response['success']=false;
						$response['message']="No subject found"; 
					}else{///else if 3


						$department_array=$callclass->_get_department_details($conn, $department_id);
						$department_array = json_decode($department_array, true);
						$department_name= $department_array[0]['department_name'];
						
						$class_array=$callclass->_get_class_details($conn, $class_id);
						$class_array = json_decode($class_array, true);
						$class_name= $class_array[0]['class_name'];

						$response['response']=200;
						$response['success']=true;
						$response['all_record_count']=$all_record_count;
						$response['department_name']=$department_name;
						$response['class_name']=$class_name;
						$response['subjects'] = array(); // Initialize the data array

						while ($fetch_query = mysqli_fetch_assoc($query)) {
							///get subject_id
							$subject_id = $fetch_query['subject_id'];

							$getTermsQuery=mysqli_query($conn,"SELECT a.term_id, a.term_name,
							(SELECT COUNT(tutorial_id) FROM tutorial_tab b WHERE a.term_id=b.term_id AND b.department_id='$department_id' AND b.class_id='$class_id' AND b.subject_id='$subject_id' AND b.status_id=1 ) AS total_number_of_videos
							FROM setup_term_tab a")or die (mysqli_error($conn));
							$getTerms=array();
							while ($getTerm = mysqli_fetch_assoc($getTermsQuery)) {
								$getTerms[] = $getTerm;
							}

							$fetch_query['terms']= $getTerms;
							$response['subjects'][] = $fetch_query;
						}

					}/// end if 3
				}/// end if 2
	}/// end if 1
}/// end if 0
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>