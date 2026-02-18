<?php require_once '../../config/connection.php';?>
<?php if (!$checkBasicSecurity) {goto end;}?>

<?php

	//////////////////declaration of variables//////////////////////////////////////
	$username=trim($_POST['username']);
	$p_password=$_POST['password'];
	$password=md5($p_password);
	////////////////////////////////////////////////////////////////////////////////

	if ($username==""){/// start if 2
		$response['response']=100; 
		$response['success']=false;
		$response['message']="USERNAME REQUIRED! Check username fields and try again"; 
	}elseif($p_password==""){
		$response['response']=101; 
		$response['success']=false;
		$response['message']="PASSWORD REQUIRED! Check password fields and try again"; 
	}else{/// else if 2

		if(filter_var($username, FILTER_VALIDATE_EMAIL)){ /// start if 3
			$query=mysqli_query($conn,"SELECT * FROM users_tab WHERE email='$username' AND `password`='$password'") or die (mysqli_error($conn));
			$count_user=mysqli_num_rows($query);

				if ($count_user>0){ /// start if 4
					$fetch_query=mysqli_fetch_array($query);
					$user_id=$fetch_query['user_id']; 
					$status_id=$fetch_query['status_id']; 

					$user_array=$callclass->_get_user_details($conn, $user_id);
					$user_fetch = json_decode($user_array, true);
					$user_fullname=$user_fetch[0]['fullname'];

						if($status_id==1){ /// start if 5 (check if the user is active)
							/// Generate login access key
							$access_key=trim(md5($user_id.date("Ymdhis")));

							/// update user on users_tab
							mysqli_query($conn,"UPDATE users_tab SET access_key='$access_key', last_login_time=NOW() WHERE user_id='$user_id'")or die ("cannot update access key - staff_tab");

							$response['response']=200; 
							$response['success']=true;
							$response['message']="LOGIN SUCCESSFUL! Proceed to dashboard."; 
							require_once '../component/login-details.php';

							$alert_detail="LOGIN ALERT: A user whose name is $user_fullname with ID: $user_id has successfully logged in to leaders tutors application";
							$callclass->_alert_sequence_and_update($conn,$user_id,$user_fullname,0,$alert_detail,$ipAddress,$systemName);
						}else if($status_id==2){/// else if 5
							$response['response']=102; 
							$response['success']=false;
							$response['message']="ACCOUNT SUSPENDED! Contact the administrator for more info.";

							$alert_detail="ACCESS DENIED: A user whose name is $user_fullname with ID: $user_id was denied from loging in for account suspension";
							$callclass->_alert_sequence_and_update($conn,$user_id,$user_fullname,0,$alert_detail,$ipAddress,$systemName);
						}else{ /// else if 5
							$response['response']=103; 
							$response['success']=false;
							$response['message']="ACCOUNT UNDER REVIEW! kindly complete your registration.";
							$alert_detail="ACCESS DENIED: A user whose name is $user_fullname with ID: $user_id was denied from loging in for account under review";
							$callclass->_alert_sequence_and_update($conn,$user_id,$user_fullname,0,$alert_detail,$ipAddress,$systemName);
						} /// end if 5
			
				}else{/// else if 4
					$response['response']=104; 
					$response['success']=false;
					$response['message']="INVALID USERNAME OR PASSWORD! Kindly check the login parameters and try again."; 
				}/// end if 4
		}else{ /// else if 3
			$response['response']=105; 
			$response['success']=false;
			$response['message']="INVALID EMAIL ADDRESS! Enter a valid email address and try again"; 
		}/// end if 3
	}/// end if 2
}/// end if 1
	//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);

?>