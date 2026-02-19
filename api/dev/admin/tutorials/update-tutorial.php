<?php require_once '../../config/connection.php';?>
<?php require_once '../../config/admin-session-check.php';?>
<?php
try {
    if (!$checkBasicSecurity) {
        throw new ForbiddenException("Unauthorized access! Please log in and try again.");
    }
	if($check==0){
		throw new UnauthorizedException("SESSION EXPIRED! Please LogIn Again.");
	}

    // ////// get all input parameters
	$tutorial_id=trim($_POST['tutorial_id']);
  	$term_id=trim($_POST['term_id']);
	$department_id=trim($_POST['department_id']);
	$class_id=trim($_POST['class_id']);
	$subject_id=trim($_POST['subject_id']);		
	$week_id=trim($_POST['week_id']);
	$series_id=trim($_POST['series_id']);
	$topic=trim(strtoupper($_POST['topic']));
	$urls=trim($_POST['urls']);
	$seo_keywords=trim($_POST['seo_keywords']);
	$seo_description =trim($_POST['seo_description']);
	$summary=trim($_POST['summary']);
	$thumbnail=$_FILES['thumbnail']['name'];
	$video=$_FILES['video']['name'];
	$duration=trim($_POST['duration']);
	$material=$_FILES['material']['name'];
	$status_id=trim($_POST['status_id']);

    //// validate input parameters
	validateEmptyField($term_id, "TERM");
	validateEmptyField($department_id, "DEPARTMENT");
	validateEmptyField($class_id, "CLASS");
	validateEmptyField($subject_id, "SUBJECT");
	validateEmptyField($week_id, "WEEK");
	validateEmptyField($series_id, "SERIES");
	validateEmptyField($topic, "TOPIC");
	validateEmptyField($urls, "URLS");
	validateEmptyField($seo_keywords, "SEO KEYWORDS");
	validateEmptyField($seo_description, "SEO DESCRIPTION");
	validateEmptyField($summary, "SUMMARY");;
	validateEmptyField($duration, "DURATION");
	validateEmptyField($status_id, "STATUS");


	$term_array=$callclass->_get_term_details($conn, $term_id);
	$term_array = json_decode($term_array, true);
	$term_name= $term_array[0]['term_name'];

	$department_array=$callclass->_get_department_details($conn, $department_id);
	$department_array = json_decode($department_array, true);
	$department_name= $department_array[0]['department_name'];
	$department_urls= $department_array[0]['urls'];
	
	$class_array=$callclass->_get_class_details($conn, $class_id);
	$class_array = json_decode($class_array, true);
	$class_name= $class_array[0]['class_name'];
	$class_urls= $class_array[0]['urls'];

	$subject_array=$callclass->_get_subject_details($conn, $subject_id);
	$subject_array = json_decode($subject_array, true);
	$subject_name= $subject_array[0]['subject_name'];
	$subject_urls= $subject_array[0]['urls'];

	$week_array=$callclass->_get_week_details($conn, $week_id);
	$week_array = json_decode($week_array, true);
	$week_name= $week_array[0]['week_name'];

	$series_array=$callclass->_get_series_details($conn, $series_id);
	$series_array = json_decode($series_array, true);
	$series_name= $series_array[0]['series_name'];

	$query="SELECT * FROM tutorial_tab WHERE tutorial_id = ?";
	$params=[$tutorial_id];
	$result = selectQuery($conn, $query, 's', $params);
	$db_urls= $result[0]['urls'];
	$db_thumbnail= $result[0]['thumbnail'];
	$db_video= $result[0]['video'];
	$db_material= $result[0]['material'];


	///// confirm if TUTORIAL EXIST BY URL
	$query="SELECT * FROM tutorial_tab WHERE subject_id=? AND department_id=? AND class_id=? AND urls=? AND tutorial_id!=?";
	$params=[$subject_id, $department_id, $class_id, $urls, $tutorial_id];
	$result = selectQuery($conn, $query, 'sssss', $params);
	if (count($result) > 0) {
		$alert_detail="TUTORIAL REGISTRATION FAILED: Topic with URL: $urls can not be registered as its already exist. DETAIL: department/$department_urls/$class_urls/$urls";
		$callclass->_alert_sequence_and_update($conn,$login_staff_id,$login_staff_fullname,$login_role_id,$alert_detail,$ipAddress,$systemName);
		throw new BadRequestException("TUTORIAL EXIST BY URL! Topic with URL: $urls already exist");
	}

	//// validate thumbnail upload
	$allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png","PNG","GIF","webp","WEBP");
	$thumbnailExtension = pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION);
	if (in_array($thumbnailExtension, $allowedExts)){
		unlink($tutorialPixPath . $db_thumbnail);
		$thumbnail = $tutorial_id.'_'.$datetime.'_'.$thumbnail;
		$tutorialPixPath= $tutorialPixPath . $thumbnail;
		move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $tutorialPixPath);
	}

	$thumbnail= $thumbnail ? $thumbnail : $db_thumbnail;
	
	//// validate video upload
	$allowedExts = array("MP4", "mp4", "MOV", "mov", "AVI", "avi","WMV","wmv","AVCHD","avchd","WebM","FLV","flv");
	$videoExtension = pathinfo($_FILES['video']['name'], PATHINFO_EXTENSION);
	if (in_array($videoExtension, $allowedExts)){
		unlink($tutorialVideoPath . $db_video);
		$video = $tutorial_id.'_'.$datetime.'_'.$video;
		$tutorialVideoPath= $tutorialVideoPath . $video;
		move_uploaded_file($_FILES["video"]["tmp_name"], $tutorialVideoPath);
	}
	$video= $video ? $video : $db_video;

	//// validate material upload
	$allowedExts = array("PDF", "pdf");
	$materialExtension = pathinfo($_FILES['material']['name'], PATHINFO_EXTENSION);
	if (in_array($materialExtension, $allowedExts)){
		unlink($tutorialMaterialPath . $db_material);
		$material = $tutorial_id.'_'.$datetime.'_'.$material;
		$tutorialMaterialPath= $tutorialMaterialPath . $material;
		move_uploaded_file($_FILES["material"]["tmp_name"], $tutorialMaterialPath);
	}
	$material= $material ? $material : $db_material;

	///update tutorial
	$query="UPDATE `tutorial_tab` SET `subject_id`=?, `term_id`=?, `department_id`=?, `class_id`=?, `week_id`=?, `series_id`=?, `topic`=?, `urls`=?, `seo_keywords`=?, `seo_description`=?, `summary`=?, `thumbnail`=?, `video`=?, `duration`=?, `material`=?, `status_id`=?, `updated_time`=NOW(), `modified_by`=? WHERE tutorial_id=?";
	$params=[$subject_id, $term_id, $department_id, $class_id, $week_id, $series_id, $topic, $urls, $seo_keywords, $seo_description, $summary, $thumbnail, $video, $duration, $material, $status_id, $login_staff_id, $tutorial_id];
	$result = updateQuery($conn, $query, 'ssssiisssssssssiss', $params);

	$response = [
		'response' => 200,
		'success' => true,
		'message' => "TUTORIAL UPDATE SUCCESSFUL!",
		'tutorial_id' => $tutorial_id,
		'urls' => $urls,
		'db_urls' => $db_urls,
		'thumbnail' => $thumbnail,
		'db_thumbnail' => $db_thumbnail,
		'department_urls' => $department_urls,
		'class_urls' => $class_urls,
		'subject_urls' => $subject_urls
	];
	$alert_detail="TUTORIAL UPDATE SUCCESSFUL: Tutorial with topic name $topic has been updated successfully. DETAIL: $term_name - $department_name - $class_name - $subject_name - $week_name";
	$callclass->_alert_sequence_and_update($conn,$login_staff_id,$login_staff_fullname,$login_role_id,$alert_detail,$ipAddress,$systemName);

 }catch (Throwable $e) {
    ErrorHandler::handle($e);
}
http_response_code($response['response']); // sets HTTP status
echo json_encode($response);
?>