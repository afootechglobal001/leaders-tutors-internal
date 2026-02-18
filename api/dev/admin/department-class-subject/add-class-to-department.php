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
		$all_class_id=trim(($_POST['all_class_id']));

		if($department_id==''){ ///start if 2
			$response['response']=101; 
			$response['success']=false;
			$response['message']="DEPARTMENT ID REQUIRED! Check and try again."; 
		}elseif($all_class_id==''){ ///else if 2
			$response['response']=102; 
			$response['success']=false;
			$response['message']="AT LEAST CLASS IS REQUIRED! Check and try again.";
		}else{ ///else if 2
			$rank_id=1;
			mysqli_query($conn,"DELETE FROM department_class_subject_tab WHERE department_id='$department_id' AND rank_id='$rank_id'");
			$department_array=$callclass->_get_department_details($conn, $department_id);
			$department_array = json_decode($department_array, true);
			$department_name= strtolower($department_array[0]['department_name']);
			$department_url= $department_array[0]['urls'];


			///////////////////////loop each subjects//////////////////
			$each_class_ids = explode(',',$all_class_id);
			foreach($each_class_ids as $class_id){
				
			$class_array=$callclass->_get_class_details($conn, $class_id);
			$class_array = json_decode($class_array, true);
			$class_name= strtolower($class_array[0]['class_name']);

			$all_classes_addes .="$class_name, ";
			
			$page_title="Online tutorials for $department_name department $class_name class";
			$seo_keywords="Online tutoring platform for $class_name students, Leaders Tutors: Elevate $department_name Department Learning, Interactive online classes for $class_name $department_name department students, Personalized education for $class_name $department_name department learners, Engaging online learning for $class_name $department_name department curriculum, Best online tutors for $class_name $department_name department subjects, Leaders Tutors: Empowering $class_name $department_name department Education, Accessible online education for $class_name $department_name department level, Expert tutors for $class_name $department_name department students, Enhance $class_name $department_name department learning with Leaders Tutors";
			$seo_description="Leaders Tutors offers personalized online classes for $department_name department $class_name students, enhancing learning through expert tutors and interactive curriculum.";
			
			mysqli_query($conn,"INSERT INTO department_class_subject_tab
			(rank_id, department_id, class_id, page_title, seo_keywords, seo_description, created_time) VALUES
			('$rank_id','$department_id', '$class_id', '$page_title', '$seo_keywords', '$seo_description', NOW())")or die (mysqli_error($conn));								
			}

			$response['response']=200; 
			$response['success']=true;
			$response['message']="CLASSES ADDED SUCCESSFULLY!";
			$response['department_id']=$department_id;
			$response['department_url']=$department_url;

			$select="SELECT a.class_id, b.class_name, b.thumbnail, b.urls, a.page_title, a.seo_keywords, a.seo_description,
			(SELECT COUNT(c.subject_id) FROM department_class_subject_tab c WHERE c.class_id=b.class_id AND c.department_id = '$department_id' AND c.rank_id=2) AS no_of_subjects
			FROM department_class_subject_tab a, classes_tab b
			WHERE a.class_id=b.class_id AND a.department_id = '$department_id' AND rank_id=1 
			ORDER BY a.sn ASC";

			$query=mysqli_query($conn,$select)or die (mysqli_error($conn));
			$response['data'] = array(); // Initialize the data array

				while ($fetch_query = mysqli_fetch_assoc($query)) {
					$response['data'][] = $fetch_query;
				}

		$alert_detail="CLASSES ADDED SUCCESSFUL: $all_classes_addes was successfully addesd to $department_name department.";
					
		$callclass->_alert_sequence_and_update($conn,$login_staff_id,$login_staff_fullname,$login_role_id,$alert_detail,$ipAddress,$systemName);
		} ///end if 2
	}///end if 1
}///end if 0
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>