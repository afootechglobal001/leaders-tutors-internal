<?php
require_once '../../config/connection.php';
require_once '../../config/staff-session-check.php';

try {

    if (!$checkBasicSecurity) {
        throw new UnauthorizedException("Unauthorized access.");
    }

    if (!$checkSession) {
        throw new UnauthorizedException("SESSION EXPIRED! Please LogIn Again.");
    }

    ////////////////// Variables //////////////////
    $branchId = trim($_GET['branchId'] ?? '');

    ////////////////// Validation //////////////////
    validateEmptyField($branchId, 'BRANCH');

    ////////////////// Check Branch //////////////////
    $branch = selectQuery(
        $conn,
        "SELECT logo FROM BRANCHES_TAB WHERE branchId=?",
        "s",
        [$branchId]
    );

    if (empty($branch)) {
        throw new NotFoundException("Branch not found.");
    }

    $oldLogoName = $branch[0]['logo'];

    ////////////////// Generate New Logo Name //////////////////
    $newLogoName = $branchId . uniqid() . '.jpg';

    ////////////////// Update Logo //////////////////
    updateQuery(
        $conn,
        "UPDATE BRANCHES_TAB SET logo=? WHERE branchId=?",
        "ss",
        [$newLogoName, $branchId]
    );

    ////////////////// Response //////////////////
    $response = [
        'response' => 200,
        'success'  => true,
        'message'  => "BRANCH LOGO UPDATED SUCCESSFULLY!",
        'data' => [
            'oldLogoName' => $oldLogoName,
            'newLogoName' => $newLogoName
        ]
    ];

} catch (Throwable $e) {

    ErrorHandler::handle($e);

}

http_response_code($response['response'] ?? 500);
echo json_encode($response);