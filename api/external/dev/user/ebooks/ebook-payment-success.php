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
    $transactionId=($_GET['transactionId']);
	$examId=trim($_GET['examId']);
    $ebookId=trim($_GET['ebookId']);
    ///// get ebook details
    $select = "SELECT ebookTitle, sellingPrice, material FROM EXAM_EBOOK_TAB WHERE examId='$examId' AND ebookId='$ebookId'";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    $fetchQuery=mysqli_fetch_assoc($query);
    $ebookTitle=$fetchQuery['ebookTitle'];
    $amount=$fetchQuery['sellingPrice'];
    $material=$fetchQuery['material'];
    /// update transaction
    $query=mysqli_query($conn,"UPDATE TRANSACTION_TAB SET statusId=4 WHERE transactionId='$transactionId'") or die (mysqli_error($conn));
    if(!$query){
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "Failed to update transaction status. Please contact support.",
        ];
        goto end;
     }
      ///// get transaction details
    $getTransactionDetailsQuery=mysqli_query($conn,"SELECT * FROM TRANSACTION_TAB WHERE transactionId='$transactionId'")or die (mysqli_error($conn));
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

    //// send mail
    require_once '../../mail/user/exam-registration-pay-now-email.php';
     $response = [
            'response'=> 200,
            'success'=> true,
            'message'=> "Payment successful! You can now download the ebook.",
            'data'   => [
                'material' => $material
            ]
        ];
    /// sent alert
    $alertDetail = "User with ID $loginUserId and Name $loginUserFullname successfully paid $loginUserCurrency $amount for ebook with name $ebookTitle. Transaction ID $transactionId updated to successful.";
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>