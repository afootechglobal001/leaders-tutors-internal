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
/// $loginUserId
    //////////////////declaration of variables//////////////////////////////////////
    // $select = "SELECT DISTINCT examId, ebookId, examAbbr, ebookTitle, sellingPrice, regpix, ebookSize, ebookPages FROM EXAM_EBOOK_TAB ORDER BY examAbbr ASC";
    
    $select = "SELECT DISTINCT (examId) AS examId FROM EXAM_EBOOK_TAB ORDER BY examAbbr ASC";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    $allRecordCount=mysqli_num_rows($query);
    if($allRecordCount==0){///start if 1
        $response['response']=200;
        $response['success']=false;
        $response['message']="No Record found";
        goto end;
    }

    $response=[
        'response' => 200,
        'success' => true,
        'message' => "E-BOOK FETCH SUCCESSFULLY!",
        'data' => array() // Initialize the data array
    ];

    while ($fetchQuery = mysqli_fetch_assoc($query)) {
        $examId=$fetchQuery['examId'];
        ///// for $examId
        $getExamQuery=mysqli_query($conn,"SELECT publishId AS examId, examLogo, regTitle AS examName, examAbbr FROM PUBLISH_TAB WHERE publishId='$examId'")or die (mysqli_error($conn));
        $getExamFetch=mysqli_fetch_assoc($getExamQuery);
        $fetchQuery['examData']=$getExamFetch;
       
        /////////////////// Fetch ebook per exam /////////
        $ebookData=array();
        $getEbookQuery = mysqli_query($conn, "SELECT
        ebookId, ebookTitle, sellingPrice, regpix, ebookSize, ebookPages
        FROM EXAM_EBOOK_TAB WHERE examId='$examId' AND statusId=1 AND sellingPrice > 0") or die(mysqli_error($conn));
        
        while ($getEbookFetch = mysqli_fetch_assoc($getEbookQuery)) {
            $ebookData[] = $getEbookFetch;
        }
        $fetchQuery['ebookData']= $ebookData;
        
         ////confirm if this user has registered for this exam
        $checkRegistrationQuery=mysqli_query($conn,"SELECT * FROM STUDENT_EXAMS_REGISTRATION_TAB WHERE studentId='$loginUserId' AND examId='$examId' AND statusId=1 LIMIT 1")or die (mysqli_error($conn));
        $checkRegistrationCount=mysqli_num_rows($checkRegistrationQuery);
        $fetchQuery['isDownloadable']=$checkRegistrationCount > 0 ? true : false; // Add registration status to the response

        $response['data'][] = $fetchQuery;
    }
end:
echo json_encode($response);
?>