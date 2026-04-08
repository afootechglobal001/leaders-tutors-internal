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
    $query=mysqli_query($conn,"UPDATE TRANSACTION_TAB SET balanceAfter=balanceBefore+amount, statusId=4 WHERE transactionId='$transactionId'") or die (mysqli_error($conn));
    /// get balanceAfter
    $query=mysqli_query($conn,"SELECT amount, balanceAfter FROM TRANSACTION_TAB WHERE transactionId='$transactionId'") or die (mysqli_error($conn));
    $fetchQuery=mysqli_fetch_array($query);
    $amount=$fetchQuery['amount'];
    $balanceAfter=$fetchQuery['balanceAfter'];
    ///update user walletBalace
    $query=mysqli_query($conn,"UPDATE USERS_TAB SET walletBalance='$balanceAfter' WHERE userId='$loginUserId'") or die (mysqli_error($conn));
    $response = [
            'response'=> 200,
            'success'=> true,
            'message'=> "You have successfully loaded your wallet.",
        ];
    /// sent alert
    $alertDetail = "User with ID $loginUserId and Name $loginUserFullname loaded their wallet with $loginUserCurrency $amount.";
end:
//////////////////////////////////////////////////////////////////////////////////////////////
$callclass->_alertSequenceAndUpdate($conn,$loginUserCountryId,$loginUserId,$loginUserFullname,$alertDetail,$ipAddress,$systemName);
echo json_encode($response);
?>