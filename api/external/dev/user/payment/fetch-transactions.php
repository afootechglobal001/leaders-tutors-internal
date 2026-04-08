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
	$transactionId=trim(($_GET['transactionId']));
    if($transactionId!=""){
        $query=mysqli_query($conn,"SELECT * FROM TRANSACTIONS_VIEW WHERE transactionId='$transactionId'") or die (mysqli_error($conn));
    }else{
        $query=mysqli_query($conn,"SELECT * FROM TRANSACTIONS_VIEW WHERE userId='$loginUserId' ORDER BY updatedTime DESC") or die (mysqli_error($conn));
    }
    //// get user wallet balance
    $walletQuery = mysqli_query($conn, "SELECT walletBalance FROM USERS_TAB WHERE userId='$loginUserId'") or die(mysqli_error($conn));
    $allRecordCount=mysqli_num_rows($query);
    if($allRecordCount==0){
        $response=[
            'response' => 101,
            'success' => false,
            'message' => "NO TRANSACTION FOUND! Please make a transaction and try again.",
        ];
        goto end;
    }
    $walletData = mysqli_fetch_array($walletQuery);
    $response = [
        'response'=> 200,
        'success'=> true,
        'message'=> "Transaction fetched successfully.",
        'userData' => [
            'currency' => $loginUserCurrency,
            'walletBalance' => $walletData['walletBalance'],
        ],
        'data' => [],
    ];
     while($fetchQuery=mysqli_fetch_assoc($query)){
         $response['data'][] = $fetchQuery;
     }

end:
//////////////////////////////////////////////////////////////////////////////////////////////
echo json_encode($response);
?>