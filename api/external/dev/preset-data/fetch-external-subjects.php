<?php
require_once '../config/connection.php';

try {
	if (!$checkBasicSecurity) {
		throw new ForbiddenException("Unauthorized access! Please log in and try again.");
	}

	////////////////// declaration of variables //////////////////////
	$subjectId = $_GET['subjectId'] ?? null;

	////////////////// Build Query //////////////////
	$conditions = [];
	$params = [];
	$types = '';

	if (!empty($subjectId)) {
		$conditions[] = "subject_id = ?";
		$params[] = $subjectId;
		$types .= "s";
	}

	$where = !empty($conditions) ? "WHERE " . implode(" AND ", $conditions) : "WHERE status_id = 1";

	///// fetch from subjects_tab
	$selectQuery = "SELECT subject_id, subject_name FROM subjects_tab $where";

	$subjectData = selectQuery($connAdmin, $selectQuery, $types, $params);

	$response = [
		'response' => 200,
		'success' => true,
		'message' => "SUBJECTS DATA FETCHED SUCCESSFULLY",
		'data' => $subjectData,
	];

} catch (Throwable $e) {
	ErrorHandler::handle($e);
}

http_response_code($response['response']);
echo json_encode($response);
?>