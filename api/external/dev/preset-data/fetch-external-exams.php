<?php
require_once '../config/connection.php';

try {
	if (!$checkBasicSecurity) {
		throw new ForbiddenException("Unauthorized access! Please log in and try again.");
	}

	////////////////// declaration of variables //////////////////////
	$examId = $_GET['examId'] ?? null;

	////////////////// Build Query //////////////////
	$conditions = [];
	$params = [];
	$types = '';

	if (!empty($examId)) {
		$conditions[] = "examId = ?";
		$params[] = $examId;
		$types .= "s";
	}

	$where = !empty($conditions) ? "WHERE " . implode(" AND ", $conditions) : "";

	///// fetch from EXTERNAL_EXAMS_TAB
	$selectQuery = "SELECT examId, examName, examAbbreviation FROM EXTERNAL_EXAMS_TAB $where";

	$examData = selectQuery($conn, $selectQuery, $types, $params);

	$response = [
		'response' => 200,
		'success' => true,
		'message' => "EXAM DATA FETCHED SUCCESSFULLY",
		'data' => $examData,
	];

} catch (Throwable $e) {
	ErrorHandler::handle($e);
}

http_response_code($response['response']);
echo json_encode($response);
?>