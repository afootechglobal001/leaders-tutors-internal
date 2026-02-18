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
		$response['success']=false;
		$response['message']="SESSION EXPIRED! Please LogIn Again.";
	}else{/// else if 1

	//////////////////declaration of variables//////////////////////////////////////
	$tutorial_id=trim($_POST['tutorial_id']);
	$status_id=trim(strtoupper($_POST['status_id']));
	$search_keywords =trim(($_POST['search_keywords']));
	////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
        if($tutorial_id==''){ ///start if 2
        	$response['response']=101;
        	$response['success']=false;
        	$response['message']="TUTORIAL ID REQUIRED! Provide tutorialID and try again.";
        }else{ ///else if 2
    	    $select="SELECT
    			a.*, b.subject_name, c.term_name, d.department_name, e.class_name, f.subject_name, g.week_name, h.status_name, i.series_name, j.fullname AS staff_name
    			FROM
    			tutorial_tab a, subjects_tab b, setup_term_tab c, departments_tab d, classes_tab e, subjects_tab f, setup_week_tab g, setup_status_tab h, setup_video_series_tab i, staff_tab j
    			WHERE
    			a.tutorial_id LIKE '%$tutorial_id%' AND a.status_id LIKE '%$status_id%' AND
    			(a.topic LIKE '%$search_keywords%' OR a.urls LIKE '%$search_keywords%') AND
    			a.subject_id=b.subject_id AND a.term_id=c.term_id AND a.department_id=d.department_id AND a.class_id=e.class_id AND a.subject_id=f.subject_id AND a.week_id=g.week_id AND a.status_id=h.status_id AND a.series_id=i.series_id AND a.modified_by=j.staff_id
    			ORDER BY a.sn ASC";

    		$query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    		$all_record_count=mysqli_num_rows($query);
    		if($all_record_count==0){///start if 3
    			$response['response']=200;
    			$response['success']=true;
    			$response['message']="No Record found";
    		}else{///else if 3
    			$response['response']=200;
    			$response['success']=true;
    			$response['all_record_count']=$all_record_count;
    			$response['data'] = array(); // Initialize the data array

    			while ($fetch_query = mysqli_fetch_assoc($query)) {
    				$fetch_query['documentStoragePath_pix'] = "$documentStoragePath/tutorial-pix";
    				$fetch_query['documentStoragePath_material'] = "$documentStoragePath/tutorial-material";
    				$fetch_query['documentStoragePath_video'] = "$documentStoragePath/tutorial-video";
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
