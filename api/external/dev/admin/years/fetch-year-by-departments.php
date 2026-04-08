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

    ///// fetch from SETUP_DEPARTMENTS_TAB
    $selectQuery = "SELECT * FROM SETUP_DEPARTMENTS_TAB";
    $departmentData = selectQuery($conn, $selectQuery);

    foreach ($departmentData as &$department) {
        $departmentId = $department['departmentId'];
        $department['yearsData'] = selectQuery(
            $conn,
            "SELECT yearId, yearValue FROM YEARS_TAB WHERE departmentId = ?",
            "i",
            [$departmentId]
        );
        //// get number of exams for each year
        foreach ($department['yearsData'] as &$year) {
            $yearId = $year['yearId'];
            $examsCount = selectQuery(
                $conn,
                "SELECT COUNT(*) as count FROM YEAR_EXAMS_TAB WHERE yearId = ?",
                "s",
                [$yearId]
            )[0]['count'] ?? 0;
            $year['examsCount'] = $examsCount;
        }

        /// get number of subjects for each year
        foreach ($department['yearsData'] as &$year) {
            $yearId = $year['yearId'];
            $subjectsCount = selectQuery(
                $conn,
                "SELECT COUNT(*) as count FROM YEAR_SUBJECTS_TAB WHERE yearId = ?",
                "s",
                [$yearId]
            )[0]['count'] ?? 0;
            $year['subjectsCount'] = $subjectsCount;
        }
    }


    $response = [
        'response' => 200,
        'success' => true,
        'message' => "YEAR DATA FETCHED SUCCESSFULLY",
        'allRecordCount' => count($departmentData),
        'data' => $departmentData,
    ];

} catch (Throwable $e) {
    ErrorHandler::handle($e);
}

http_response_code($response['response']);
echo json_encode($response);