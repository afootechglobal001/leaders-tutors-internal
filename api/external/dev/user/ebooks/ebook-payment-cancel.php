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
    /// update transaction to cancelled
    $query=mysqli_query($conn,"UPDATE TRANSACTION_TAB SET statusId=7 WHERE transactionId='$transactionId'") or die (mysqli_error($conn));
     $response = [
            'response'=> 200,
            'success'=> true,
            'message'=> "Payment cancelled. You cannot download the ebook.",
           
        ];
    /// sent alert
    $alertDetail = "User with ID $loginUserId and Name $loginUserFullname cancelled payment for ebook with name $ebookTitle. Transaction ID $transactionId updated to cancelled.";
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>