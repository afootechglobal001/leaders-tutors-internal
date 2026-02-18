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
		$term_id=trim($_POST['term_id']);
		$subject_id=trim($_POST['subject_id']);
		////////////////////////////////////////////////////////////////////////////////
		if($department_id==''){ ///start if 2
			$response['response']=100; 
			$response['success']=false;
			$response['message']="DEPARTMENT REQUIRED!"; 
		}elseif($class_id==''){ ///else if 2
			$response['response']=101; 
			$response['success']=false;
			$response['message']="CLASS REQUIRED!";
		}elseif($term_id==''){ ///else if 2
			$response['response']=102; 
			$response['success']=false;
			$response['message']="TERM REQUIRED!";
		}elseif($subject_id==''){ ///else if 2
			$response['response']=103; 
			$response['success']=false;
			$response['message']="SUBJECT REQUIRED!";
		}else{

			$term_array=$callclass->_get_term_details($conn, $term_id);
			$term_array = json_decode($term_array, true);
			$term_name= $term_array[0]['term_name'];

			$department_array=$callclass->_get_department_details($conn, $department_id);
			$department_array = json_decode($department_array, true);
			$department_name= $department_array[0]['department_name'];
			
			$class_array=$callclass->_get_class_details($conn, $class_id);
			$class_array = json_decode($class_array, true);
			$class_name= $class_array[0]['class_name'];

			$subject_array=$callclass->_get_subject_details($conn, $subject_id);
			$subject_array = json_decode($subject_array, true);
			$subject_name= $subject_array[0]['subject_name'];


			$select="SELECT 
				a.week_id, b.week_name,
				(SELECT COUNT(a.tutorial_id)) AS total_number_of_videos
				FROM 
				tutorial_tab a, setup_week_tab b
				WHERE
				a.week_id=b.week_id AND 
				a.department_id = '$department_id' AND a.class_id = '$class_id'  AND a.term_id = '$term_id'  AND a.subject_id = '$subject_id'
				GROUP BY a.week_id ORDER BY b.week_name ASC ";

				$query=mysqli_query($conn,$select)or die (mysqli_error($conn));
				$all_record_count=mysqli_num_rows($query);
				if($all_record_count==0){///start if 2
					$response['response']=200;
					$response['success']=true;
					$response['department_name']=$department_name;
					$response['class_name']=$class_name;
					$response['term_name']=$term_name;
					$response['subject_name']=$subject_name;
					$response['message']="No Record found"; 
				}else{///else if 2
					

					$response['response']=200;
					$response['success']=true;
					$response['department_name']=$department_name;
					$response['class_name']=$class_name;
					$response['term_name']=$term_name;
					$response['subject_name']=$subject_name;
					$response['all_record_count']=$all_record_count;
					$response['data'] = array(); // Initialize the data array

					while ($fetch_query = mysqli_fetch_assoc($query)) {
						///get week_id
						$week_id = $fetch_query['week_id'];

						$getWeekVideosQuery=mysqli_query($conn,"SELECT 
						a.tutorial_id, a.topic, a.summary, a.thumbnail, a.status_id, a.duration, a.quiz_status, a.quiz_question_counts, b.status_name
						FROM tutorial_tab a, setup_status_tab b
						WHERE a.status_id=b.status_id AND a.department_id = '$department_id' AND a.class_id = '$class_id'  AND a.term_id = '$term_id'  AND a.subject_id = '$subject_id' AND a.week_id='$week_id'
						ORDER BY series_id ASC")or die (mysqli_error($conn));
						$getWeekVideos=array();
						while ($getWeekVideo = mysqli_fetch_assoc($getWeekVideosQuery)) {
							$getWeekVideo['documentStoragePath'] = "$documentStoragePath/tutorial-pix";
							$getWeekVideos[] = $getWeekVideo;
						}

						$fetch_query['week_videos']= $getWeekVideos;
						$response['data'][] = $fetch_query;
					}

				}/// end if 2
		}
	}/// end if 1
}/// end if 0
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>