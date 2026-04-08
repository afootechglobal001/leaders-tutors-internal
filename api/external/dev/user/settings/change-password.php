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
	$oldPassword=($data['oldPassword']);
    $newPassword=($data['newPassword']);
    $cnewPassword=($data['cnewPassword']);
    
	////////////////////////////////////////////////////////////////////////////////
    validateEmptyField($oldPassword, 'OLD PASSWORD');
    validateEmptyField($newPassword, 'NEW PASSWORD');
    validateEmptyField($cnewPassword, 'CONFIRM NEW PASSWORD');

    $oldPassword=md5($data['oldPassword']);
    $newPassword=md5($data['newPassword']);
    $cnewPassword=md5($data['cnewPassword']);

    $query=mysqli_query($conn,"SELECT * FROM USERS_TAB WHERE userId='$loginUserId' AND password='$oldPassword'") or die (mysqli_error($conn));
    $count=mysqli_num_rows($query);
    if ($count==0){ /// start if 4
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "INCORRECT OLD PASSWORD! Check and try again.",
        ];
        goto end;
    }

    if ($newPassword!=$cnewPassword){ /// start if 4
        $response = [
            'response'=> 103,
            'success'=> false,
            'message'=> "NEW PASSWORD NOT MATCH! Check and try again.",
        ];
        goto end;
    }
    
    /// Generate login access key
    $accessKey=trim(md5($loginUserId.date("Ymdhis")));
    mysqli_query($conn,"UPDATE USERS_TAB SET accessKey='$accessKey', password='$newPassword'  WHERE userId='$loginUserId'") or die (mysqli_error($conn));

    $response['response']=200; 
    $response['success']=true;
    $response['message']="PASSWORD CHANGED SUCCESFFULY!"; 
 //////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>