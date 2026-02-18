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

		$department_id=trim(strtoupper($_POST['department_id']));
		$class_id=trim(strtoupper($_POST['class_id']));
		$all_subject_id=trim(($_POST['all_subject_id']));

		if($department_id==''){ ///start if 2
			$response['response']=101; 
			$response['success']=false;
			$response['message']="DEPARTMENT ID REQUIRED! Check and try again.";
		}elseif($class_id==''){ ///else if 2
			$response['response']=102; 
			$response['success']=false;
			$response['message']="CLASS ID REQUIRED! Check and try again.";
		}elseif($all_subject_id==''){ ///else if 2
			$response['response']=102; 
			$response['success']=false;
			$response['message']="AT LEAST 1 SUBJECT IS REQUIRED! Check and try again.";
		}else{ ///else if 2
			$rank_id=2;
			mysqli_query($conn,"DELETE FROM department_class_subject_tab WHERE department_id='$department_id' AND class_id='$class_id' AND rank_id=$rank_id");
			$department_array=$callclass->_get_department_details($conn, $department_id);
			$department_array = json_decode($department_array, true);
			$department_name= strtolower($department_array[0]['department_name']);
			$department_url= strtolower($department_array[0]['urls']);

			$class_array=$callclass->_get_class_details($conn, $class_id);
			$class_array = json_decode($class_array, true);
			$class_name= strtolower($class_array[0]['class_name']);
			$class_url= strtolower($class_array[0]['urls']);

			///////////////////////loop each subjects//////////////////
			$each_subject_ids = explode(',',$all_subject_id);
			foreach($each_subject_ids as $subject_id){

				$subject_array=$callclass->_get_subject_details($conn, $subject_id);
				$subject_array = json_decode($subject_array, true);
				$subject_name= strtolower($subject_array[0]['subject_name']);
				
				$all_subject_added .="$subject_name, ";
				
				$page_title="Interactive $department_name department $class_name $subject_name class";
				$seo_keywords="Online $subject_name tutoring for $class_name student, Leaders Tutors: $subject_name education for $department_name department $class_name student, Interactive $subject_name classes for $department_name department $class_name, Personalized $subject_name learning for$department_name department $class_name, $department_name department $class_name $subject_name tutors online, Leaders Tutors: Elevate $department_name department $class_name $subject_name, Engaging online $subject_name lessons, $department_name department $class_name $subject_name curriculum online, Expert $subject_name tutors for$department_name department $class_name, Leaders Tutors: Empower $department_name department $class_name $subject_name learning";
				$seo_description="Discover Leaders Tutors: Your go-to platform for interactive $department_name department $class_name $subject_name classes. Expert tutors, personalized learning, and engaging curriculum await!";
				
				mysqli_query($conn,"INSERT INTO department_class_subject_tab
				(rank_id, department_id, class_id, subject_id, page_title, seo_keywords, seo_description, created_time) VALUES
				('$rank_id','$department_id', '$class_id','$subject_id', '$page_title', '$seo_keywords', '$seo_description', NOW())")or die (mysqli_error($conn));								
			}


		$response['response']=200; 
		$response['success']=true;
		$response['message']="SUBJECT ADDED SUCCESSFULLY!";
		$response['department_id']=$department_id;
		$response['department_url']=$department_url;
		$response['class_id']=$class_id;
		$response['class_url']=$class_url;

		$select="SELECT a.subject_id, b.subject_name, b.thumbnail, b.urls, a.page_title, a.seo_keywords, a.seo_description
		FROM department_class_subject_tab a, subjects_tab b
		WHERE a.subject_id=b.subject_id AND a.department_id = '$department_id' AND a.class_id = '$class_id' AND rank_id=2
		ORDER BY a.sn ASC";
		$query=mysqli_query($conn,$select)or die (mysqli_error($conn));
			$response['data'] = array(); // Initialize the data array

				while ($fetch_query = mysqli_fetch_assoc($query)) {
					$response['data'][] = $fetch_query;
				}


		$alert_detail="SUBJECT ADDED SUCCESSFUL: $all_subject_added was successfully addesd to $department_name department $class_name class.";
					
		$callclass->_alert_sequence_and_update($conn,$login_staff_id,$login_staff_fullname,$login_role_id,$alert_detail,$ipAddress,$systemName);
		} ///end if 2
	}///end if 1
}///end if 0
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>