<?php
require_once '../../config/connection.php';
require_once '../../config/staff-session-check.php';

try {

    if (!$checkBasicSecurity) {
        throw new ForbiddenException("Unauthorized access! Please log in.");
    }

    if (!$checkSession) {
        throw new UnauthorizedException("SESSION EXPIRED! Please LogIn Again.");
    }

    ////////////////// Variables //////////////////
    $name = trim(strtoupper($data['name'] ?? ''));
    $mobileNumber = trim($data['mobileNumber'] ?? '');
    $stateId = trim($data['stateId'] ?? '');
    $lgaId = trim($data['lgaId'] ?? '');
    $address = trim(strtoupper(str_replace("'", "\'", $data['address'] ?? '')));
    $smtpHost = trim($data['smtpHost'] ?? '');
    $smtpUsername = trim($data['smtpUsername'] ?? '');
    $smtpPassword = trim($data['smtpPassword'] ?? '');
    $smtpPort = trim($data['smtpPort'] ?? '');
    $supportEmail = trim($data['supportEmail'] ?? '');
    $paymentKey = trim($data['paymentKey'] ?? '');
    $aggregatePurchasePrice = $data['aggregatePurchasePrice'] ?? 0;
    $flatServiceCharges = $data['flatServiceCharges'] ?? 0;
    $additionalServicePercentage = $data['additionalServicePercentage'] ?? 0;
    $staffId = trim($data['managerId'] ?? '');
    $statusId = trim($data['statusId'] ?? '');

    ////////////////// Validation //////////////////
    validateEmptyField($name, 'BRANCH NAME');
    validateEmptyField($mobileNumber, 'MOBILE NUMBER');
    validateEmptyField($stateId, 'BRANCH STATE');
    validateEmptyField($lgaId, 'BRANCH LGA');
    validateEmptyField($address, 'BRANCH ADDRESS');
    validateEmptyField($smtpHost, 'SMTP HOST');
    validateEmptyField($smtpUsername, 'SMTP USERNAME');
    validateEmptyField($smtpPassword, 'SMTP PASSWORD');
    validateEmptyField($smtpPort, 'SMTP PORT');
    validateEmptyField($supportEmail, 'SUPPORT EMAIL');
    validateEmptyField($paymentKey, 'PAYMENT CHANNEL');
    validateEmptyField($aggregatePurchasePrice, 'AGGREGATE PURCHASE PRICE');
    validateEmptyField($flatServiceCharges, 'FLAT SERVICE CHARGES');
    validateEmptyField($additionalServicePercentage, 'ADDITIONAL SERVICE PERCENTAGE');
    validateEmptyField($staffId, 'BRANCH MANAGER');
    validateEmptyField($statusId, 'BRANCH STATUS');
    ////////////////validate others///////////////////////////////////////////////////////////////
    validateNumericField($aggregatePurchasePrice, 'AGGREGATE PURCHASE PRICE');
    validateNumericField($flatServiceCharges, 'FLAT SERVICE CHARGES');
    validateNumericField($additionalServicePercentage, 'ADDITIONAL SERVICE PERCENTAGE');
    validateNumericField($statusId, 'STATUS');
    validateEmailField($smtpUsername, 'SMTP USERNAME');
    validateEmailField($supportEmail, 'SUPPORT EMAIL');

    ////////////////// Check Duplicate Branch //////////////////
    $branchExist = selectQuery(
        $conn,
        "SELECT branchId FROM BRANCHES_TAB WHERE name=?",
        "s",
        [$name]
    );

    if (!empty($branchExist)) {
        throw new ConflictException("BRANCH EXIST! Branch already exists by name.");
    }

    ////////////////// Check SMTP Username //////////////////
    $smtpExist = selectQuery(
        $conn,
        "SELECT branchId FROM BRANCHES_TAB WHERE smtpUsername=?",
        "s",
        [$smtpUsername]
    );

    if (!empty($smtpExist)) {
        throw new ConflictException("BRANCH EXIST! Branch already exists by smtpUsername.");
    }

    ////////////////// Generate Branch ID //////////////////
    $sequence = _get_sequence_count($conn, 'GFSB');
    $array = json_decode($sequence, true);
    $no = $array[0]['no'];

    $branchId = 'GFSB' . $no . date("Ymdhis");

    ////////////////// Insert Branch //////////////////
    insertQuery(
        $conn,
        "INSERT INTO BRANCHES_TAB
        (branchId,name,mobileNumber,stateId,lgaId,address,smtpHost,smtpUsername,smtpPassword,smtpPort,supportEmail,paymentKey,aggregatePurchasePrice,flatServiceCharges,additionalServicePercentage,managerId,statusId,createdBy,createdTime)
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW())",
        "ssssssssssssdddsis",
        [
            $branchId,
            $name,
            $mobileNumber,
            $stateId,
            $lgaId,
            $address,
            $smtpHost,
            $smtpUsername,
            $smtpPassword,
            $smtpPort,
            $supportEmail,
            $paymentKey,
            $aggregatePurchasePrice,
            $flatServiceCharges,
            $additionalServicePercentage,
            $staffId,
            $statusId,
            $loginStaffId
        ]
    );

    ////////////////// Fetch Created Branch //////////////////
    $branches = selectQuery(
        $conn,
        "SELECT * FROM BRANCH_VIEW WHERE branchId=?",
        "s",
        [$branchId]
    );

    foreach ($branches as &$branch) {

        $createdBy = $branch['createdBy'];
        $updatedBy = $branch['updatedBy'];

        ////////////////// Created By //////////////////
        $branch['createdBy'] = _action_performed_by($conn, $createdBy) ?? null;
        ////////////////// Updated By //////////////////
        $branch['updatedBy'] = _action_performed_by($conn, $updatedBy) ?? null;
    }

    ////////////////// Response //////////////////
    $response = [
        'response' => 200,
        'success' => true,
        'message' => "BRANCH CREATED SUCCESSFULLY!",
        'data' => $branches
    ];

} catch (Throwable $e) {
    ErrorHandler::handle($e);
}

http_response_code($response['response'] ?? 500);
echo json_encode($response);