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
    $paymentChoice=trim($data['paymentChoice']) ? $data['paymentChoice'] : "payNow"; /// can be payNow or payLater
    $examRegistrationId=trim($_GET['examRegistrationId']);
    $countryId=trim($loginUserCountryId);
    $studentId=trim($loginUserId);
	$examId=trim(($data['examId']));
    $locationId=trim(($data['locationId']));
    $centreId=trim(($data['centreId']));
    $examDate=trim(($data['examDate']));
    $altExamDate=trim(($data['altDate']));
    $firstName=trim(strtoupper($data['firstName']));
    $middleName=trim(strtoupper($data['middleName']));
    $lastName=trim(strtoupper($data['lastName']));
    $fullName="$firstName $middleName $lastName";
    $dob=trim(($data['dob']));
    $emailAddress=trim(($data['emailAddress']));
    $phoneNumber=trim(($data['phoneNumber']));
    $residentialAddress=trim(strtoupper($data['residentialAddress']));
    $genderId=trim(($data['genderId']));
    $schoolsOfInterestSegment=$data['schoolsOfInterestSegment'];
    $paymentMethodId=trim(($data['paymentMethodId'])); /// CC or BT OR WLT

    //////////////////check for empty fields//////////////////////////////////////
    validateEmptyField($examId, 'EXAM ID');
    validateEmptyField($locationId, 'EXAM LOCATION');
    validateEmptyField($centreId, 'EXAM CENTRE');
    validateEmptyField($examDate, 'EXAM DATE');
    validateEmptyField($firstName, 'FIRST NAME');
    validateEmptyField($middleName, 'MIDDLE NAME');
    validateEmptyField($lastName, 'LAST NAME');
    validateEmptyField($dob, 'DATE OF BIRTH');
    validateEmptyField($emailAddress, 'EMAIL ADDRESS');
    validateEmptyField($phoneNumber, 'PHONE NUMBER');
    validateEmptyField($residentialAddress, 'RESIDENTIAL ADDRESS');
    validateEmptyField($genderId, 'GENDER');

    if (count($schoolsOfInterestSegment)==0) {
        $response = [
            'response' => 102,
            'success' => false,
            'message' => 'SCHOOLS OF INTEREST SEGMENT REQUIRED! Check field and try again.'
        ];
        goto end;
    }
    if (!in_array($paymentChoice, ['payNow', 'payLater'])) {
        $response = [
            'response' => 103,
            'success' => false,
            'message' => 'INVALID PAYMENT CHOICE! Please select a valid payment choice and try again.'
        ];
        goto end;
    }
    
    if ($paymentChoice=='payNow' && !in_array($paymentMethodId, ['CC', 'BT', 'WLT'])) {
        $response = [
            'response' => 105,
            'success' => false,
            'message' => 'INVALID PAYMENT METHOD! Please select a valid payment method and try again.'
        ];
        goto end;
    }

    $oldPassportPhotograph='';
    $oldInternationalPassport='';

    if($examRegistrationId!=""){
          ///// get old record for update
        $query=mysqli_query($conn,"SELECT passportPhotograph, internationalPassport FROM STUDENT_EXAMS_REGISTRATION_TAB WHERE examRegistrationId='$examRegistrationId'")or die (mysqli_error($conn));
        $fetchQuery=mysqli_fetch_array($query);
        $oldPassportPhotograph = $fetchQuery['passportPhotograph'];
        $oldInternationalPassport = $fetchQuery['internationalPassport'];
        /// delete existing record for update
        mysqli_query($conn,"DELETE FROM STUDENT_EXAMS_REGISTRATION_TAB WHERE examRegistrationId='$examRegistrationId'")or die (mysqli_error($conn));
        mysqli_query($conn,"DELETE FROM STUDENT_SCHOOL_OF_INTEREST_TAB WHERE examRegistrationId='$examRegistrationId'")or die (mysqli_error($conn));
        mysqli_query($conn,"DELETE FROM TRANSACTION_TAB WHERE referenceId='$examRegistrationId'")or die (mysqli_error($conn));

    }

    ///////////////////////geting sequence//////////////////////////
        $countId='ER';
        $sequence=$callclass->_getSequenceCount($conn, $countId);
        $array = json_decode($sequence, true);
        $no= $array[0]['no'];
        $examRegistrationId=$countId.$no.date("Ymdhis");
        
        mysqli_query($conn,"INSERT INTO `STUDENT_EXAMS_REGISTRATION_TAB`
        (`examRegistrationId`, `countryId`, `studentId`, `examId`, `locationId`, `centreId`, `examDate`, `altExamDate`, `firstName`, `middleName`, `lastName`, `dob`, `emailAddress`, `phoneNumber`, `residentialAddress`, `genderId`, `statusId`, `createdTime`, `paymentChoice`) VALUES
        ('$examRegistrationId', '$countryId', '$studentId', '$examId', '$locationId', '$centreId', '$examDate', '$altExamDate', '$firstName', '$middleName', '$lastName', '$dob', '$emailAddress', '$phoneNumber', '$residentialAddress', '$genderId', 3, NOW(), '$paymentChoice')")or die (mysqli_error($conn));

        foreach ($schoolsOfInterestSegment as $schoolsOfInterest) {
			$nameOfInstitution = strtoupper($schoolsOfInterest['nameOfInstitution']);
			$institutionCode = $schoolsOfInterest['institutionCode'];
			$institutionLocation = strtoupper($schoolsOfInterest['institutionLocation']);
			$programId = $schoolsOfInterest['programId'];
			$courseOfStudy = strtoupper($schoolsOfInterest['courseOfStudy']);
			/// Insert Into payment_breakdown_tab
			mysqli_query($conn,"INSERT INTO `STUDENT_SCHOOL_OF_INTEREST_TAB` 
            (`examRegistrationId`, `nameOfInstitution`, `institutionCode`, `institutionLocation`, `programId`, `courseOfStudy`) VALUES 
            ('$examRegistrationId', '$nameOfInstitution', '$institutionCode', '$institutionLocation', '$programId', '$courseOfStudy')")or die (mysqli_error($conn));
		}
        
        
        ///// get exam fee for payment processing
        $select = "SELECT * FROM BRANCH_EXAM_PRICING_TAB WHERE countryId='$countryId' AND examId='$examId'";
        $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
        $fetchQuery=mysqli_fetch_array($query);
        $amount=$fetchQuery['amount'];
        $currency=$fetchQuery['currency'];
        $examAbbr=$fetchQuery['examAbbr'];

         $countId='TRANS';
        $sequence=$callclass->_getSequenceCount($conn, $countId);
        $array = json_decode($sequence, true);
        $no= $array[0]['no'];
        $transactionId=$countId.$no.date("Ymdhis");
        
        $transactionTypeId='PMT'; /// PAYMENT
        $balanceBefore=$loginUserWalletBalance;
        $balanceAfter=$balanceBefore; /// since payment is pending

        if ($paymentChoice=='payNow') {

            ///get country paymentKey
            $query=mysqli_query($conn,"SELECT paymentKey FROM COUNTRY_TAB WHERE countryId='$countryId'") or die (mysqli_error($conn));
            $fetchQuery=mysqli_fetch_array($query);
            $dbPaymentKey=$fetchQuery['paymentKey'];

            if ($paymentMethodId=='CC') {
                $paymentKey=$dbPaymentKey;
                $statusId=3; /// PENDING

                mysqli_query($conn,"INSERT INTO `TRANSACTION_TAB`
                (`countryId`, `transactionId`, `referenceId`, `userId`, `transactionTypeId`, `reasonForPayment`, `paymentMethodId`, `emailAddress`, `currency`, `balanceBefore`, `amount`, `balanceAfter`, `paymentKey`, `statusId`, `createdTime`) VALUES
                ('$countryId', '$transactionId', '$examRegistrationId', '$studentId', '$transactionTypeId', 'ExamRegistration', '$paymentMethodId', '$emailAddress', '$currency', '$balanceBefore', '$amount', '$balanceAfter', '$paymentKey', '$statusId', NOW())")or die (mysqli_error($conn));
                $alertDetail = "User with ID $studentId and Name $loginUserFullname attempt to register for $examAbbr exam with Registration ID $examRegistrationId. Transaction ID $transactionId generated for payment of $currency $amount.";
            
            }elseif($paymentMethodId=='BT'){

                $paymentKey=$dbPaymentKey;
                $statusId=3; /// PENDING
                mysqli_query($conn,"INSERT INTO `TRANSACTION_TAB`
                (`countryId`, `transactionId`, `referenceId`, `userId`, `transactionTypeId`, `reasonForPayment`, `paymentMethodId`, `emailAddress`, `currency`, `balanceBefore`, `amount`, `balanceAfter`, `paymentKey`, `statusId`, `createdTime`) VALUES
                ('$countryId', '$transactionId', '$examRegistrationId', '$studentId', '$transactionTypeId', 'ExamRegistration', '$paymentMethodId', '$emailAddress', '$currency', '$balanceBefore', '$amount', '$balanceAfter', '$paymentKey', '$statusId', NOW())")or die (mysqli_error($conn));
                $alertDetail = "User with ID $studentId and Name $loginUserFullname attempt to register for $examAbbr exam with Registration ID $examRegistrationId. Transaction ID $transactionId generated for payment of $currency $amount.";
                
            }elseif($paymentMethodId=='WLT'){
                
                if ($loginUserWalletBalance < $amount) {
                    $response = [
                        'response' => 103,
                        'success' => false,
                        'message' => "INSUFFICIENT WALLET BALANCE! You have $currency $loginUserWalletBalance in your wallet. Please fund your wallet and try again.",
                    ];
                    goto end;
                }
                $paymentKey='WALLET';
                $statusId=1; /// APPROVED
                $balanceAfter=$balanceBefore - $amount; /// since payment is from wallet
                mysqli_query($conn,"INSERT INTO `TRANSACTION_TAB`
                (`countryId`, `transactionId`, `referenceId`, `userId`, `transactionTypeId`, `reasonForPayment`, `paymentMethodId`, `emailAddress`, `currency`, `balanceBefore`, `amount`, `balanceAfter`, `paymentKey`, `statusId`, `createdTime`) VALUES
                ('$countryId', '$transactionId', '$examRegistrationId', '$studentId', '$transactionTypeId', 'ExamRegistration', '$paymentMethodId', '$emailAddress', '$currency', '$balanceBefore', '$amount', '$balanceAfter', '$paymentKey', '$statusId', NOW())")or die (mysqli_error($conn));
                /// update user wallet balance
                mysqli_query($conn,"UPDATE USERS_TAB SET walletBalance='$balanceAfter' WHERE userId='$studentId'")or die (mysqli_error($conn));
                //// update exam registration status to approved
                mysqli_query($conn,"UPDATE STUDENT_EXAMS_REGISTRATION_TAB SET statusId='$statusId' WHERE examRegistrationId='$examRegistrationId'")or die (mysqli_error($conn));
                
                $alertDetail = "User with ID $studentId and Name $loginUserFullname successfully paid $currency $amount from wallet for $examAbbr exam with Registration ID $examRegistrationId. Transaction ID $transactionId generated for payment.";
            }
            
            
            $response = [
                'response' => 200,
                'success' => true,
                'message' => "EXAM REGISTRATION LOG SUCCESSFUL.",
                'data' => [
                    'examRegistrationId' => $examRegistrationId,
                    'paymentChoice' => $paymentChoice,
                    'transactionId' => $transactionId,
                    'fullName'      => $firstName." ".$middleName." ".$lastName,
                    'emailAddress'  => $emailAddress,
                    'phoneNumber'   => $phoneNumber,
                    'amount'        => $amount,
                    'currency'      => $currency,
                    'paymentKey'    => $paymentKey,
                    'paymentMethodId' => $paymentMethodId,
                    'files' => [
                        'oldPassportPhotograph' => $oldPassportPhotograph,
                        'oldInternationalPassport' => $oldInternationalPassport
                    ]
                ]
            ];
        }else{

            $paymentKey="PAY_LATER";
            $statusId=3; /// PENDING
            mysqli_query($conn,"INSERT INTO `TRANSACTION_TAB`
            (`countryId`, `transactionId`, `referenceId`, `userId`, `transactionTypeId`, `reasonForPayment`, `paymentMethodId`, `emailAddress`, `currency`, `balanceBefore`, `amount`, `balanceAfter`, `paymentKey`, `statusId`, `createdTime`) VALUES
            ('$countryId', '$transactionId', '$examRegistrationId', '$studentId', '$transactionTypeId', 'ExamRegistration', '$paymentMethodId', '$emailAddress', '$currency', '$balanceBefore', '$amount', '$balanceAfter', '$paymentKey', '$statusId', NOW())")or die (mysqli_error($conn));
                
            $alertDetail = "User with ID $studentId and Name $loginUserFullname attempt to register for $examAbbr exam with Registration ID $examRegistrationId. Payment choice is Pay Later.";
            ///// send email
            $response = [
                'response' => 200,
                'success' => true,
                'message' => "EXAM REGISTRATION LOG SUCCESSFUL.",
                'data' => [
                    'examRegistrationId' => $examRegistrationId,
                    'paymentChoice' => $paymentChoice,
                    'files' => [
                        'oldPassportPhotograph' => $oldPassportPhotograph,
                        'oldInternationalPassport' => $oldInternationalPassport
                    ]
                ]
            ];
        }
        
 $callclass->_alertSequenceAndUpdate($conn,$loginUserCountryId,$loginUserId,$loginUserFullname,$alertDetail,$ipAddress,$systemName);       
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>