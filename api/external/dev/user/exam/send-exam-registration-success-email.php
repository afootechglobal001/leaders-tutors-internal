<?php require_once '../../config/connection.php';?>

<?php
    if (!$checkBasicSecurity){/// start if 1
        goto end;
    }
?>

<?php
//////////////////declaration of variables//////////////////////////////////////
    $examRegistrationId=trim($_GET['examRegistrationId']);
   
    $select="SELECT * FROM STUDENT_EXAMS_REGISTRATION_TAB WHERE studentId='$loginUserId' AND examRegistrationId='$examRegistrationId'";
    $query=mysqli_query($conn, $select);
    $fetchQuery=mysqli_fetch_assoc($query);
    $countryId=$fetchQuery['countryId'];
    $fullName=$fetchQuery['firstName'].' '.$fetchQuery['middleName'].' '.$fetchQuery['lastName'];

    $examId=$fetchQuery['examId'];
    $locationId=$fetchQuery['locationId'];
    $centreId=$fetchQuery['centreId'];
    $genderId=$fetchQuery['genderId'];
    $statusId=$fetchQuery['statusId'];
    ///// fetch exam details
    $getExamQuery=mysqli_query($conn,"SELECT regTitle AS examName, examAbbr FROM PUBLISH_TAB WHERE publishId='$examId'")or die (mysqli_error($conn));
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
    $getStatusQuery = mysqli_query($conn, "SELECT * FROM SETUP_STATUS_TAB WHERE statusId='$statusId'")or die (mysqli_error($conn));
    $getStatusFetch = mysqli_fetch_assoc($getStatusQuery);
    $fetchQuery['statusData']= $getStatusFetch;


    $examAbbr=$fetchQuery['examData']['examAbbr'];
    $paymentChoice=$fetchQuery['paymentChoice'];


    //// get schools of interest
    $schools=[];
    $getSchoolsQuery=mysqli_query($conn,"SELECT nameOfInstitution, institutionCode, institutionLocation, programId, courseOfStudy FROM STUDENT_SCHOOL_OF_INTEREST_TAB WHERE examRegistrationId='$examRegistrationId'")or die (mysqli_error($conn));
    while($getSchoolsFetch=mysqli_fetch_assoc($getSchoolsQuery)){
        $schools[]=$getSchoolsFetch;
    }

    //// get exam amount
    $getExamAmountQuery=mysqli_query($conn,"SELECT currency, amount FROM BRANCH_EXAM_PRICING_TAB WHERE examId='$examId' AND countryId='$countryId'")or die (mysqli_error($conn));
    $getExamAmountFetch=mysqli_fetch_assoc($getExamAmountQuery);
    $fetchQuery['examAmountData']=$getExamAmountFetch;

    ////get bank details
    $getBankDetailsQuery=mysqli_query($conn,"SELECT bankName, accountName, accountNumber, dollarAccountBank, dollarAccountName, dollarAccountNumber FROM COUNTRY_TAB WHERE countryId='$countryId'")or die (mysqli_error($conn));
    $getBankDetailsFetch=mysqli_fetch_assoc($getBankDetailsQuery);
    $fetchQuery['bankDetailsData']=$getBankDetailsFetch;

    if($paymentChoice=="payLater"){
        $subject="$examAbbr exam registration for $fullName. Registration ID $examRegistrationId. Payment Choice: Pay Later.";
        require_once '../../mail/user/exam-registration-pay-later-email.php';
    }

    if($paymentChoice=="payNow"){
        ///// get transaction details
        $getTransactionDetailsQuery=mysqli_query($conn,"SELECT * FROM TRANSACTION_TAB WHERE referenceId='$examRegistrationId'")or die (mysqli_error($conn));
        $getTransactionDetailsFetch=mysqli_fetch_assoc($getTransactionDetailsQuery);
        $fetchQuery['transactionData']=$getTransactionDetailsFetch;

        $paymentMethodId=$getTransactionDetailsFetch['paymentMethodId'];
        $statusId=$getTransactionDetailsFetch['statusId'];

        /// get payment method details
        $getPaymentMethodQuery=mysqli_query($conn,"SELECT paymentMethodId, paymentMethodName FROM SETUP_PAYMENT_METHOD_TAB WHERE paymentMethodId='$paymentMethodId'")or die (mysqli_error($conn));
        $getPaymentMethodFetch=mysqli_fetch_assoc($getPaymentMethodQuery); 
        $fetchQuery['paymentMethodData']=$getPaymentMethodFetch;


        /// get payment status details
        $getPaymentStatusQuery=mysqli_query($conn,"SELECT statusId, statusName FROM SETUP_STATUS_TAB WHERE statusId='$statusId'")or die (mysqli_error($conn));
        $getPaymentStatusFetch=mysqli_fetch_assoc($getPaymentStatusQuery);
        $fetchQuery['paymentStatusData']=$getPaymentStatusFetch;
        
        
        $subject="$examAbbr exam registration for $fullName. Registration ID $examRegistrationId. Payment Choice: Pay Online.";
        require_once '../../mail/user/exam-registration-pay-now-email.php';
    }
    $response = [
        'response' => 200,
        'success' => true,
        'message' => "EXAM REGISTRATION SUCCESSFUL EMAIL SENT!",
    ];

//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>