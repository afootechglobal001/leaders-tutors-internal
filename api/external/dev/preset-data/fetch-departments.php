<?php
require_once '../config/connection.php';

try {
	if (!$checkBasicSecurity) {
		throw new ForbiddenException("Unauthorized access! Please log in and try again.");
	}

	////////////////// declaration of variables //////////////////////
	$departmentId = $_GET['departmentId'] ?? null;

	////////////////// Build Query //////////////////
	$conditions = [];
	$params = [];
	$types = '';

	if (!empty($departmentId)) {
		$conditions[] = "departmentId = ?";
		$params[] = $departmentId;
		$types .= "i";
	}

	$where = !empty($conditions) ? "WHERE " . implode(" AND ", $conditions) : "";

	///// fetch from SETUP_DEPARTMENTS_TAB
	$selectQuery = "SELECT * FROM SETUP_DEPARTMENTS_TAB $where";

	$departmentData = selectQuery($conn, $selectQuery, $types, $params);

	$response = [
		'response' => 200,
		'success' => true,
		'message' => "DEPARTMENT DATA FETCHED SUCCESSFULLY",
		'data' => $departmentData,
	];

} catch (Throwable $e) {
	ErrorHandler::handle($e);
}

http_response_code($response['response']);
echo json_encode($response);
?>