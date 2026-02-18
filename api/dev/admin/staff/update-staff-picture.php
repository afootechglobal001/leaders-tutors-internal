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

		$staff_id=trim(strtoupper($_POST['staff_id']));
		$profile_pix=$_FILES['profile_pix']['name'];

		if($staff_id != $login_staff_id){/// login_staff_id is coming from admin-session-check.php /// start if 2
			$response['response']=100; 
			$response['success']=False;
			$response['message']="USER ERROR! This action was rejected."; 
		}else{/// else if 2

			$allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png","PNG","GIF","webp","WEBP");
			$extension = pathinfo($_FILES['profile_pix']['name'], PATHINFO_EXTENSION);
			
			if (in_array($extension, $allowedExts)){/// start if 3
				
				$datetime=date("Ymdhi");
				$profile_pix = $staff_id.'_'.$datetime.'_'.$profile_pix;
				$uploadPath= $staffProfilePixPath . $profile_pix;
				if (move_uploaded_file($_FILES["profile_pix"]["tmp_name"], $uploadPath)){/// start if 4

					$user_array=$callclass->_get_staff_details($conn, $staff_id);
					$user_array = json_decode($user_array, true);
					$db_passport= $user_array[0]['profile_pix'];
		
					if($db_passport!='avatar.jpg'){
						unlink($staffProfilePixPath . $db_passport);
					}
					mysqli_query($conn,"UPDATE `staff_tab` SET profile_pix='$profile_pix' WHERE staff_id='$staff_id'")or die (mysqli_error($conn));

					$response['response']=200; 
					$response['success']=true;
					$response['message']="SUCCESS! Staff picture updated successfully!";

				}else {/// else if 4
					$response['response']=101; 
					$response['success']=False;
					$response['message']="PICTURE UPLOAD ERROR! Contact your Engineer For Help"; 
				}/// end if 34
			}else{/// else if 3
				$response['response']=102; 
				$response['success']=False;
				$response['message']="INVALID PICTURE FORMAT! Check the picture format and try again."; 
			}/// end if 3
		}/// end if 2
	}/// end if 1
}/// end if 0
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>