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
	$examId=trim($_GET['examId']);
    $ebookId=trim($_GET['ebookId']);
    //////////////////check for empty fields//////////////////////////////////////
    validateEmptyField($examId, 'EXAM ID');
    validateEmptyField($ebookId, 'EBOOK ID');

    ////// get ebook details for this $examId and $ebookId
    $select = "SELECT material, sellingPrice FROM EXAM_EBOOK_TAB WHERE examId='$examId' AND ebookId='$ebookId'";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    $fetchQuery=mysqli_fetch_assoc($query);
    $material=$fetchQuery['material'];
    $sellingPrice=$fetchQuery['sellingPrice'];


    $checkRegistrationQuery=mysqli_query($conn,"SELECT * FROM STUDENT_EXAMS_REGISTRATION_TAB WHERE studentId='$loginUserId' AND examId='$examId' AND statusId=1 LIMIT 1")or die (mysqli_error($conn));
    $checkRegistrationCount=mysqli_num_rows($checkRegistrationQuery);
    $isDownloadable=$checkRegistrationCount > 0 ? true : false; // Add registration status to the response

    
    if($isDownloadable){///start if 1
       $response = [
            'response' => 200,
            'success' => true,
            'isDownloadable'=>$isDownloadable,
            'message' => "Proceed to download this ebook.",
            'material' => $material
        ];
    }else{
        //// get ebook details
        $select = "SELECT ebookTitle, sellingPrice FROM EXAM_EBOOK_TAB WHERE examId='$examId' AND ebookId='$ebookId'";
        $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
        $fetchQuery=mysqli_fetch_assoc($query);
        
        $response = [
            'response' => 200,
            'success' => true,
            'isDownloadable'=>$isDownloadable,
            'message' => "Proceed to payment to download this ebook.",
            'data' => [
                'examId' => $examId,
                'ebookId' => $ebookId,
                'ebookData' => $fetchQuery,
                'userFullName' => $loginUserFullname
            ]
        ];
    }
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>