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
    $passportPhotograph=$_FILES['passportPhotograph']['name'];
    $internationalPassport=$_FILES['internationalPassport']['name'];
    $oldPassportPhotograph=trim($_GET['oldPassportPhotograph']);
    $oldInternationalPassport=trim($_GET['oldInternationalPassport']);

    //////////////////check for empty fields//////////////////////////////////////
    if (!empty($passportPhotograph)) { /// start if 3
        $newPassportPhotograph=$examRegistrationId.uniqid().'.jpg';
    }else{
        $newPassportPhotograph=$oldPassportPhotograph;
    }
    if (!empty($internationalPassport)) { /// start if 4
        $newInternationalPassport=$examRegistrationId.uniqid().'.jpg';
    }else{
        $newInternationalPassport=$oldInternationalPassport;
    }
    ///// update record
    mysqli_query($conn,"UPDATE STUDENT_EXAMS_REGISTRATION_TAB SET passportPhotograph='$newPassportPhotograph' WHERE examRegistrationId='$examRegistrationId'")or die (mysqli_error($conn));

    ///// update record
    mysqli_query($conn,"UPDATE STUDENT_EXAMS_REGISTRATION_TAB SET internationalPassport='$newInternationalPassport' WHERE examRegistrationId='$examRegistrationId'")or die (mysqli_error($conn));
   
    $response = [
        'response' => 200,
        'success' => true,
        'message' => "FILE PROCCESSED SUCCESSFULLY.",
        'data' => [
            'examRegistrationId' => $examRegistrationId,
            'files' => [
                'newPassportPhotograph' => $newPassportPhotograph,
                'newInternationalPassport' => $newInternationalPassport
            ]
        ]
    ];

//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>