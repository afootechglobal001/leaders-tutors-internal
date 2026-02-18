<?php require_once '../../config/connection.php';?>
<?php require_once '../../config/admin-session-check.php';?>
<?php
////////////////////////////////////////////////////////
///// check for API security
if ($apiKey!=$expected_api_key){/// start if 0
	$response['response']=98; 
	$response['success']=false;
	$response['message']="SECURITY ACCESS DENIED! You are not allowed to execute this command due to security bridge."; 
}else{/// else if 0

	if($check==0){ /// start if 1
		$response['response']=99; 
		$response['success']=False;
		$response['message']="SESSION EXPIRED! Please LogIn Again."; 
	}else{/// else if 1

		$fullname=trim(strtoupper($_POST['fullname']));
		$mobile=trim($_POST['mobile']);
		$email=trim($_POST['email']);
		$address =trim(strtoupper(str_replace("'", "\'", $_POST['address'])));
		$role_id=trim($_POST['role_id']);
		$status_id=trim($_POST['status_id']);
			
		if($fullname==''){ ///start if 2
			$response['response']=100; 
			$response['success']=false;
			$response['message']="FULL NAME REQUIRED! Check the full name and try again."; 
		}elseif($mobile==''){ ///else if 2
			$response['response']=101; 
			$response['success']=false;
			$response['message']="PHONE NUMBER REQUIRED! Check phone number and try again."; 
		}elseif($email==''){ ///else if 2
			$response['response']=102; 
			$response['success']=false;
			$response['message']="EMAIL REQUIRED! Check email address and try again.";
		}elseif($address==''){ ///else if 2
			$response['response']=103; 
			$response['success']=false;
			$response['message']="EMAIL REQUIRED! Check address and try again."; 
		}elseif($role_id==''){ ///else if 2
			$response['response']=104; 
			$response['success']=false;
			$response['message']="ROLE REQUIRED! Select a role and try again.";  
		}elseif($status_id==''){ ///else if 2
			$response['response']=105; 
			$response['success']=false;
			$response['message']="STATUS REQUIRED! Select the status and try again.";
		}else{ ///else if 2
			if(filter_var($email, FILTER_VALIDATE_EMAIL)){ ///start if 3
				$usercheck=mysqli_query($conn,"SELECT * FROM staff_tab WHERE email='$email'");
				$useremail=mysqli_num_rows($usercheck);
				if ($useremail>0){ ///start if 4
					$response['response']=106; 
					$response['success']=false;
					$response['message']="EMAIL NOT ACCETABLE! $email already exist"; 
				}else{///else if 4
							///////////////////////geting sequence//////////////////////////
							$sequence=$callclass->_get_sequence_count($conn, 'STF');
							$array = json_decode($sequence, true);
							$no= $array[0]['no'];

							/// generate staff_id and password
							//// LTS means Leaders Tutors Staff
							$staff_id='LTS'.$no.date("Ymdhis");
							$access_key=md5($staff_id.date("Ymdhis"));
							$password=md5($staff_id);	
							/// register staff
							mysqli_query($conn,"INSERT INTO `staff_tab`
							(`staff_id`, `fullname`, `mobile`, `email`, `address`, `profile_pix`, `role_id`, `status_id`, `password`, `created_time`) VALUES
							('$staff_id',  '$fullname', '$mobile', '$email','$address', 'avatar.jpg', '$role_id', '$status_id', '$password', NOW())")or die (mysqli_error($conn));

							$response['response']=200; 
							$response['success']=true;
							$response['message']="SUCCESS! Staff Registration Successful!";
							$response['staff_id']=$staff_id;
				}///end if 4
			}else{ ///else if 3
				$response['response']=107; 
				$response['success']=false;
				$response['message']="ERROR: $email is NOT a valid email address"; 
			} ///end if 3
		} ///end if 2
	}///end if 1
}///end if 0
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>