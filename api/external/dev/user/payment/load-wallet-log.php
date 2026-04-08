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
	$amount=trim(($data['amount']));
    //////////////////check for empty fields//////////////////////////////////////
    validateEmptyField($amount, 'AMOUNT');
    if (!is_numeric($amount)) {
        $response = [
            'response'=> 103,
            'success'=> false,
            'message'=> "INVALID AMOUNT! Enter a valid amount and try again",
            'amount'=> $amount
        ];
        goto end;
    }

    ///////////////////////geting sequence//////////////////////////
        $countId='TRANS';
        $sequence=$callclass->_getSequenceCount($conn, $countId);
        $array = json_decode($sequence, true);
        $no= $array[0]['no'];
        $transactionId=$countId.$no.date("Ymdhis");

        $userId=$loginUserId;
        $fullName=$loginUserFullname;
        $emailAddress=$loginUserEmail;
        $phoneNumber=$loginUserPhoneNumber;
        $balanceBefore=$loginUserWalletBalance;
        $transactionTypeId='CRD'; /// CREDIT
        $paymentMethodId='CC'; // CREDIT CARD
        $currency=$loginUserCurrency;
        $balanceAfter=$balanceBefore;
        $statusId=3; /// PENDING
        $countryId=$loginUserCountryId;
        
        ///get country paymentKey
        $query=mysqli_query($conn,"SELECT paymentKey FROM COUNTRY_TAB WHERE countryId='$countryId'") or die (mysqli_error($conn));
        $fetchQuery=mysqli_fetch_array($query);
        $paymentKey=$fetchQuery['paymentKey'];

        
        mysqli_query($conn,"INSERT INTO `TRANSACTION_TAB`
        (`countryId`, `transactionId`, `userId`, `transactionTypeId`, `reasonForPayment`, `paymentMethodId`, `emailAddress`, `currency`, `balanceBefore`, `amount`, `balanceAfter`, `paymentKey`, `statusId`, `createdTime`) VALUES 
        ('$countryId', '$transactionId', '$userId', '$transactionTypeId', 'Wallet', '$paymentMethodId', '$emailAddress', '$currency', '$balanceBefore', '$amount', '$balanceAfter', '$paymentKey', '$statusId', NOW())")or die (mysqli_error($conn));

        $response = [
            'response' => 200,
            'success' => true,
            'message' => "PAYMENT LOGGED SUCCESSFULLY!",
            'data' => [
                'transactionId' => $transactionId,
                'fullName'      => $fullName,
                'emailAddress'  => $emailAddress,
                'phoneNumber'   => $phoneNumber,
                'amount'        => $amount,
                'currency'      => $currency,
                'paymentKey'    => $paymentKey
            ]
        ];
        $alertDetail = "User with ID $userId and Name $fullName initiated a wallet load transaction of $currency $amount with Transaction ID $transactionId.";
end:
//////////////////////////////////////////////////////////////////////////////////////////////
$callclass->_alertSequenceAndUpdate($conn,$loginUserCountryId,$loginUserId,$loginUserFullname,$alertDetail,$ipAddress,$systemName);
echo json_encode($response);
?>