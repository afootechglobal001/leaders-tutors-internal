<?php require_once '../../config/connection.php';?>
<?php require_once '../../config/user-session-check.php';?>

<?php
    if (!$checkBasicSecurity){/// start if 1
        goto end;
    }
    if(!$checkSession){
        $response=[
            'response' => 99,
            'success' => false,
            'message' => "SESSION EXPIRED! Please LogIn Again.",
        ];
        goto end;
    }
?>

<?php
//////////////////declaration of variables//////////////////////////////////////
    $examRegistrationId=trim($_GET['examRegistrationId']);

    if($examRegistrationId!=""){
        $select="SELECT * FROM STUDENT_EXAMS_REGISTRATION_TAB WHERE studentId='$loginUserId' AND examRegistrationId='$examRegistrationId'";
    }else{
        $select="SELECT * FROM STUDENT_EXAMS_REGISTRATION_TAB WHERE studentId='$loginUserId'";
    }
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    $allRecordCount=mysqli_num_rows($query);
    if($allRecordCount==0){
        $response=[
            'response' => 101,
            'success' => false,
            'message' => "NO EXAM REGISTRATION FOUND! Please register for an exam and try again.",
        ];
        goto end;
    }
        $response=[
            'response' => 100,
            'success' => true,
            'message' => "EXAM REGISTRATION DETAILS FETCHED SUCCESSFULLY!",
            "allRecordsCount" => $allRecordCount,
            'data' => []
        ];
   
     while($fetchQuery=mysqli_fetch_assoc($query)){
        $examRegistrationId=$fetchQuery['examRegistrationId'];
        $examId=$fetchQuery['examId'];
        $locationId=$fetchQuery['locationId'];
        $centreId=$fetchQuery['centreId'];
        $genderId=$fetchQuery['genderId'];
        $statusId=$fetchQuery['statusId'];
        ///// fetch exam details
        $getExamQuery=mysqli_query($conn,"SELECT publishId AS examId, examLogo, regTitle AS examName, examAbbr FROM PUBLISH_TAB WHERE publishId='$examId'")or die (mysqli_error($conn));
        $getExamFetch=mysqli_fetch_assoc($getExamQuery);
        $fetchQuery['examData']=$getExamFetch;
        /////////////////// for  $locationId
        $getLocationQuery = mysqli_query($conn, "SELECT locationId, locationName FROM EXAM_LOCATION_TAB WHERE examId='$examId' AND locationId='$locationId'");
        $getLocationFetch = mysqli_fetch_assoc($getLocationQuery);
        $fetchQuery['locationData']= $getLocationFetch;
            /////////////////// for  $centreId
        $getCentreQuery = mysqli_query($conn, "SELECT centreId, centreName FROM EXAM_CENTRE_TAB WHERE locationId='$locationId' AND centreId='$centreId'");
        $getCentreFetch = mysqli_fetch_assoc($getCentreQuery);
        $fetchQuery['centreData']= $getCentreFetch;
            /////////////////// for  $genderId
        $getGenderQuery = mysqli_query($conn, "SELECT genderId, genderName FROM SETUP_GENDER_TAB WHERE genderId='$genderId'");
        $getGenderFetch = mysqli_fetch_assoc($getGenderQuery);
        $fetchQuery['genderData']= $getGenderFetch;
        /////////////////// for  $statusId
        $getStatusQuery = mysqli_query($conn, "SELECT * FROM SETUP_STATUS_TAB WHERE statusId='$statusId'");
        $getStatusFetch = mysqli_fetch_assoc($getStatusQuery);
        $fetchQuery['statusData']= $getStatusFetch;

        ///// for schools of interest
        $getSchoolsOfInterestQuery=mysqli_query($conn,"SELECT * FROM STUDENT_SCHOOL_OF_INTEREST_TAB WHERE examRegistrationId='$examRegistrationId'")or die (mysqli_error($conn));
        while($schoolsOfInterestFetch=mysqli_fetch_assoc($getSchoolsOfInterestQuery)){
            $programId=$schoolsOfInterestFetch['programId'];
            ///// for programId
            $getProgramQuery=mysqli_query($conn,"SELECT programId, programName FROM SETUP_PROGRAM_TAB WHERE programId='$programId'")or die (mysqli_error($conn));
            $getProgramFetch=mysqli_fetch_assoc($getProgramQuery);
            $schoolsOfInterestFetch['programData']=$getProgramFetch;

            $fetchQuery['schoolsOfInterest'][]=$schoolsOfInterestFetch;
        }

        $response['data'][] = $fetchQuery;
     }
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>