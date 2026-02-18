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

		$class_id=trim(strtoupper($_POST['class_id']));
		$class_name=trim(strtoupper($_POST['class_name']));
		$urls=trim($_POST['urls']);
		$thumbnail=$_FILES['thumbnail']['name'];
		$status_id=trim($_POST['status_id']);
			
		if($class_id==''){ ///start if 2
			$response['response']=100; 
			$response['success']=false;
			$response['message']="CLASS ID REQUIRED! Check and try again."; 
		}elseif($class_name==''){ ///else if 2
			$response['response']=101; 
			$response['success']=false;
			$response['message']="CLASS NAME  REQUIRED! Check and try again.";
		}elseif($urls==''){ ///else if 2
			$response['response']=102; 
			$response['success']=false;
			$response['message']="URL REQUIRED! Check and try again.";
		}elseif($status_id==''){ ///else if 2
			$response['response']=106; 
			$response['success']=false;
			$response['message']="STATUS REQUIRED! Select the status and try again.";
		}else{ ///else if 2
			
			$class_check_by_name=mysqli_query($conn,"SELECT * FROM classs_tab WHERE class_name='$class_name' AND class_id!='$class_id'");
			$class_check_by_name=mysqli_num_rows($class_check_by_name);
			if ($class_check_by_name>0){ ///start if 3
				$response['response']=107; 
				$response['success']=false;
				$response['message']="CLASS EXIST BY NAME! class with name: $class_name already exist";
				$alert_detail="CLASS UPDATE FAILED: class with name $class_name can not be updated as its already exist.";
			}else{///else if 3

			
				$class_check_by_urls=mysqli_query($conn,"SELECT * FROM classs_tab WHERE urls='$urls' AND class_id!='$class_id'");
				$class_check_by_urls=mysqli_num_rows($class_check_by_urls);
				if ($class_check_by_urls>0){ ///start if 5
					$response['response']=109; 
					$response['success']=false;
					$response['message']="CLASS EXIST BY URL! class with URL: $urls already exist";
					$alert_detail="CLASS UPDATE FAILED: class with url $urls can not be updated as its already exist.";
				}else{///else if 5
						
					$class_array=$callclass->_get_class_details($conn, $class_id);
					$class_array = json_decode($class_array, true);
					$db_urls= $class_array[0]['urls'];
					$db_thumbnail= $class_array[0]['thumbnail'];
					/// register class
					mysqli_query($conn,"UPDATE `classes_tab`
					SET `class_name`='$class_name',`urls`='$urls',`status_id`='$status_id', `updated_time`=NOW(),`modified_by`='$login_staff_id' 
					WHERE class_id='$class_id'")or die (mysqli_error($conn));

					$allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png","PNG","GIF","webp","WEBP");
					$extension = pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION);
					if (in_array($extension, $allowedExts)){/// start if 6

						$datetime=date("Ymdhi");
						$thumbnail = $class_id.'_'.$datetime.'_'.$thumbnail;
						$uploadPath= $classPixPath . $thumbnail;
						if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $uploadPath)){/// start if 7
							unlink($classPixPath . $db_thumbnail);
							mysqli_query($conn,"UPDATE `classes_tab` SET thumbnail='$thumbnail' WHERE class_id='$class_id'")or die (mysqli_error($conn));
						}
					}

					$response['response']=200; 
					$response['success']=true;
					$response['message']="CLASS UPDATED SUCCESSFULLY!";
					$response['class_id']=$class_id;
					$response['urls']=$urls;
					$response['db_urls']=$db_urls;
					$response['thumbnail']=$thumbnail;
					$response['db_thumbnail']=$db_thumbnail;
					$alert_detail="CLASS UPDATED SUCCESSFULLY: A class was successfully Updated. DETAILS: - name: $class_name, ID: $class_id";
				}///end if 5
				
			}	///end if 3
			$callclass->_alert_sequence_and_update($conn,$login_staff_id,$login_staff_fullname,$login_role_id,$alert_detail,$ipAddress,$systemName);	
		} ///end if 2
	}///end if 1
}///end if 0
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>