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
    $countryId=trim($loginUserCountryId);
    $studentId=trim($loginUserId);
    $emailAddress=$loginUserEmail;
    $phoneNumber=$loginUserPhoneNumber;
    $currency=$loginUserCurrency;
    //////////////////declaration of variables//////////////////////////////////////
	$examId=trim($_GET['examId']);
    $ebookId=trim($_GET['ebookId']);
    $paymentMethodId=$data['paymentMethodId'];
    //////////////////check for empty fields//////////////////////////////////////
    validateEmptyField($examId, 'EXAM ID');
    validateEmptyField($ebookId, 'EBOOK ID');
    if (!in_array($paymentMethodId, ['CC', 'BT', 'WLT'])) {
            $response = [
                'response' => 103,
                'success' => false,
                'message' => 'INVALID PAYMENT METHOD! Please select a valid payment method and try again.',
                'paymentMethodId' => $paymentMethodId
            ];
            goto end;
    }
    /////// generate transactionId
    $countId='TRANS';
    $sequence=$callclass->_getSequenceCount($conn, $countId);
    $array = json_decode($sequence, true);
    $no= $array[0]['no'];
    $transactionId=$countId.$no.date("Ymdhis");


    $transactionTypeId='PMT'; /// PAYMENT
    $balanceBefore=$loginUserWalletBalance;
    $balanceAfter=$balanceBefore; /// since payment is pending

    ///get country paymentKey
    $query=mysqli_query($conn,"SELECT paymentKey FROM COUNTRY_TAB WHERE countryId='$countryId'") or die (mysqli_error($conn));
    $fetchQuery=mysqli_fetch_array($query);
    $paymentKey=$fetchQuery['paymentKey'];
    $statusId=3; /// PENDING

    ///// get ebook details
    $select = "SELECT ebookTitle, sellingPrice, material FROM EXAM_EBOOK_TAB WHERE examId='$examId' AND ebookId='$ebookId'";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    $fetchQuery=mysqli_fetch_assoc($query);
    $ebookTitle=$fetchQuery['ebookTitle'];
    $amount=$fetchQuery['sellingPrice'];
    $material=$fetchQuery['material'];
    
    if (($paymentMethodId=='CC') || ($paymentMethodId=='BT')) {
        mysqli_query($conn,"INSERT INTO `TRANSACTION_TAB`
        (`countryId`, `transactionId`, `userId`, `transactionTypeId`, `reasonForPayment`, `paymentMethodId`, `emailAddress`, `currency`, `balanceBefore`, `amount`, `balanceAfter`, `paymentKey`, `statusId`, `createdTime`) VALUES
        ('$countryId', '$transactionId', '$studentId', '$transactionTypeId', 'Ebook', '$paymentMethodId', '$emailAddress', '$currency', '$balanceBefore', '$amount', '$balanceAfter', '$paymentKey', '$statusId', NOW())")or die (mysqli_error($conn));
        
        $alertDetail = "User with ID $studentId and Name $loginUserFullname initiated payment of $currency $amount for the download of $ebookTitle using payment method $paymentMethodId. Transaction ID $transactionId generated for payment. Ebook ID $ebookId";
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
        ('$countryId', '$transactionId', '$ebookId', '$studentId', '$transactionTypeId', 'Ebook', '$paymentMethodId', '$emailAddress', '$currency', '$balanceBefore', '$amount', '$balanceAfter', '$paymentKey', '$statusId', NOW())")or die (mysqli_error($conn));
        /// update user wallet balance
        mysqli_query($conn,"UPDATE USERS_TAB SET walletBalance='$balanceAfter' WHERE userId='$studentId'")or die (mysqli_error($conn));
              
        $alertDetail = "User with ID $studentId and Name $loginUserFullname successfully paid $currency $amount from wallet for the download of $ebookTitle. Transaction ID $transactionId generated for payment. Ebook ID $ebookId";
    }
    
    $isWallet = $paymentMethodId === 'WLT';
    $response = [
        'response' => 200,
        'success'  => true,
        'message'  => $isWallet
            ? "Payment successful! You can now download the ebook."
            : "Payment initiated! Please proceed to complete your payment to download the ebook.",
        'data'     => $isWallet
            ? [
                'material' => $material
            ]
            : [
                'transactionId'      => $transactionId,
                'fullName'           => $loginUserFullname,
                'emailAddress'       => $emailAddress,
                'phoneNumber'        => $phoneNumber,
                'amount'             => $amount,
                'currency'           => $currency,
                'paymentKey'         => $paymentKey,
                'paymentMethodId'    => $paymentMethodId,
                'examId'             => $examId,
                'ebookId'            => $ebookId
            ]
    ];

    $callclass->_alertSequenceAndUpdate($conn,$loginUserCountryId,$loginUserId,$loginUserFullname,$alertDetail,$ipAddress,$systemName);

//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>