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
	$question_id=trim($_POST['question_id']);

    //// validate input parameters
	validateEmptyField($tutorial_id, "TUTORIAL ID");
	if($question_id!=""){
		$question_ids= "AND a.question_id='$question_id'";
	}

	/// get tutorial details
	$query="SELECT * FROM tutorial_tab WHERE tutorial_id=?";
	$params=[$tutorial_id];
	$result = selectQuery($conn, $query, 's', $params);
	$fetch_query = $result[0];
	$department_id=$fetch_query['department_id'];
	$class_id=$fetch_query['class_id'];
	$term_id=$fetch_query['term_id'];
	$subject_id=$fetch_query['subject_id'];
	$quiz_status=$fetch_query['quiz_status'];
				
	$status_array=$callclass->_get_status_details($conn, $quiz_status);
	$status_array = json_decode($status_array, true);
	$quiz_status_name= $status_array[0]['status_name'];

	$select="SELECT a.*, 
			b.fullname AS staff_name
			FROM cbt_question_bank_tab a
			JOIN staff_tab b ON a.modified_by=b.staff_id
			WHERE a.department_id=? 
			AND a.class_id=? 
			AND a.term_id=? 
			AND a.subject_id=? 
			$question_ids
			ORDER BY a.created_time DESC";
	$params=[$department_id, $class_id, $term_id, $subject_id];
	$result = selectQuery($conn, $select, 'ssss', $params);
	$all_record_count=count($result);
	if ($all_record_count === 0) {
		throw new NotFoundException("NO RECORD FOUND! No question found for the specified tutorial.");
	} 
	foreach ($result as &$fetch_query) {
		$fetch_query['questionsStoragePath'] = "$documentStoragePath/cbt-question-pix";
		///get question_id
		$question_id = $fetch_query['question_id'];

		$getQuestionOptionsQuery="SELECT
				*
				FROM cbt_options_tab
				WHERE question_id=?
				ORDER BY option_id ASC";
		$params=[$question_id];
		$optionsResult = selectQuery($conn, $getQuestionOptionsQuery, 's', $params);
		
		foreach ($optionsResult as &$getQuestionOption) {
			$getQuestionOption['optionsStoragePath'] = "$documentStoragePath/cbt-option-pix";
		}
		$fetch_query['options']= $optionsResult;
	}
	
	$response = [
		'response' => 200,
		'success' => true,
		'all_record_count' => $all_record_count,
		'quiz_status' => $quiz_status,
		'quiz_status_name' => $quiz_status_name,
		'questions' => $result
	];
	

 }catch (Throwable $e) {
    ErrorHandler::handle($e);
}
http_response_code($response['response']); // sets HTTP status
echo json_encode($response);
?>