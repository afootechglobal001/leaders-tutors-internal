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

		$class_name=trim(strtoupper($_POST['class_name']));
		$urls=trim($_POST['urls']);
		$thumbnail=$_FILES['thumbnail']['name'];
		$status_id=trim($_POST['status_id']);
			
		if($class_name==''){ ///start if 2
			$response['response']=101; 
			$response['success']=false;
			$response['message']="CLASS NAME REQUIRED! Check and try again."; 
		}elseif($urls==''){ ///else if 2
			$response['response']=102; 
			$response['success']=false;
			$response['message']="URL REQUIRED! Check and try again.";
		}elseif($status_id==''){ ///else if 2
			$response['response']=106; 
			$response['success']=false;
			$response['message']="STATUS REQUIRED! Select the status and try again.";
		}else{ ///else if 2
			
			
			$class_check_by_name=mysqli_query($conn,"SELECT * FROM classes_tab WHERE class_name='$class_name'");
			$class_check_by_name=mysqli_num_rows($class_check_by_name);
			if ($class_check_by_name>0){ ///start if 4
				$response['response']=108; 
				$response['success']=false;
				$response['message']="CLASS EXIST BY NAME! class with name: $class_name already exist";
				$alert_detail="CLASS REGISTRATION FAILED: class with name $class_name can not be registered as its already exist.";
			}else{///else if 4

				$class_check_by_urls=mysqli_query($conn,"SELECT * FROM classes_tab WHERE urls='$urls'");
				$class_check_by_urls=mysqli_num_rows($class_check_by_urls);
				if ($class_check_by_urls>0){ ///start if 5
					$response['response']=109; 
					$response['success']=false;
					$response['message']="CLASS EXIST BY URL! class with URL: $urls already exist";
					$alert_detail="CLASS REGISTRATION FAILED: class with url $urls can not be registered as its already exist.";
				}else{///else if 5
						
					$allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png","PNG","GIF","webp","WEBP");
					$extension = pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION);
					if (in_array($extension, $allowedExts)){/// start if 6
						///////////////////////geting sequence//////////////////////////
						$sequence=$callclass->_get_sequence_count($conn, 'CLS');
						$array = json_decode($sequence, true);
						$no= $array[0]['no'];
						$class_id='CLS'.$no;
						
						$datetime=date("Ymdhi");
						$thumbnail = $class_id.'_'.$datetime.'_'.$thumbnail;
						$uploadPath= $classPixPath . $thumbnail;
						if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $uploadPath)){/// start if 7

							/// register class
							mysqli_query($conn,"INSERT INTO `classes_tab`
							(`class_id`, `class_name`, `urls`,  `thumbnail`,  `status_id`, `created_time`, `modified_by`) VALUES
							('$class_id',  '$class_name', '$urls','$thumbnail', '$status_id', NOW(), '$login_staff_id')")or die (mysqli_error($conn));

							$response['response']=200; 
							$response['success']=true;
							$response['message']="CLASS REGISTERED SUCCESSFULLY!";
							$response['class_id']=$class_id;
							$response['urls']=$urls;
							$response['thumbnail']=$thumbnail;
							$alert_detail="CLASS REGISTRATION SUCCESSFUL: A class was successfully registered. DETAILS: - name: $class_name, ID: $class_id";
						}else {/// else if 7
							$response['response']=110; 
							$response['success']=False;
							$response['message']="PICTURE UPLOAD ERROR! Contact your Engineer For Help";
							$alert_detail="CLASS REGISTRATION FAILED: class with name $class_name can not be registered due to picture upload error.";
						}/// end if 7
					}else{/// else if 6
						$response['response']=111; 
						$response['success']=False;
						$response['message']="INVALID PICTURE FORMAT! Check the picture format and try again.";
						$alert_detail="CLASS REGISTRATION FAILED: class with name $class_name can not be registered due to invalid picture format.";
					}/// end if 6
				}///end if 5
			}///end if 4
			
		$callclass->_alert_sequence_and_update($conn,$login_staff_id,$login_staff_fullname,$login_role_id,$alert_detail,$ipAddress,$systemName);
		} ///end if 2
	}///end if 1
}///end if 0
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>