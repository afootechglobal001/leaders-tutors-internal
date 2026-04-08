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
	$transactionId=($_GET['id']);
    validateEmptyField($transactionId, 'TRANSACTION ID');
    /// update transaction
    $query=mysqli_query($conn,"UPDATE TRANSACTION_TAB SET statusId=5 WHERE transactionId='$transactionId'") or die (mysqli_error($conn));
    $response = [
            'response'=> 200,
            'success'=> true,
            'message'=> "You have cancelled the transaction.",
        ];

    /// sent alert
    $alertDetail = "User with ID $loginUserId and Name $loginUserFullname cancelled their wallet load transaction with Transaction ID $transactionId.";
end:
//////////////////////////////////////////////////////////////////////////////////////////////
$callclass->_alertSequenceAndUpdate($conn,$loginUserCountryId,$loginUserId,$loginUserFullname,$alertDetail,$ipAddress,$systemName);
echo json_encode($response);
?>