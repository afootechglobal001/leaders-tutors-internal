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

		$subject_id=trim(strtoupper($_POST['subject_id']));
		$subject_name=trim(strtoupper($_POST['subject_name']));
		$urls=trim($_POST['urls']);
		$thumbnail=$_FILES['thumbnail']['name'];
		$status_id=trim($_POST['status_id']);
			
		if($subject_id==''){ ///start if 2
			$response['response']=100; 
			$response['success']=false;
			$response['message']="SUBJECT ID REQUIRED! Check and try again."; 
		}elseif($subject_name==''){ ///else if 2
			$response['response']=101; 
			$response['success']=false;
			$response['message']="SUBJECT NAME  REQUIRED! Check and try again.";
		}elseif($urls==''){ ///else if 2
			$response['response']=102; 
			$response['success']=false;
			$response['message']="URL REQUIRED! Check and try again.";
		}elseif($status_id==''){ ///else if 2
			$response['response']=106; 
			$response['success']=false;
			$response['message']="STATUS REQUIRED! Select the status and try again.";
		}else{ ///else if 2
			
			$subject_check_by_name=mysqli_query($conn,"SELECT * FROM subjects_tab WHERE subject_name='$subject_name' AND subject_id!='$subject_id'");
			$subject_check_by_name=mysqli_num_rows($subject_check_by_name);
			if ($subject_check_by_name>0){ ///start if 3
				$response['response']=107; 
				$response['success']=false;
				$response['message']="SUBJECT EXIST BY NAME! subject with name: $subject_name already exist";
				$alert_detail="SUBJECT UPDATE FAILED: subject with name $subject_name can not be updated as its already exist.";
			}else{///else if 3

			
				$subject_check_by_urls=mysqli_query($conn,"SELECT * FROM subjects_tab WHERE urls='$urls' AND subject_id!='$subject_id'");
				$subject_check_by_urls=mysqli_num_rows($subject_check_by_urls);
				if ($subject_check_by_urls>0){ ///start if 5
					$response['response']=109; 
					$response['success']=false;
					$response['message']="SUBJECT EXIST BY URL! subject with URL: $urls already exist";
					$alert_detail="SUBJECT UPDATE FAILED: subject with url $urls can not be updated as its already exist.";
				}else{///else if 5
						
					$subject_array=$callclass->_get_subject_details($conn, $subject_id);
					$subject_array = json_decode($subject_array, true);
					$db_urls= $subject_array[0]['urls'];
					$db_thumbnail= $subject_array[0]['thumbnail'];
					/// register subject
					mysqli_query($conn,"UPDATE `subjects_tab`
					SET `subject_name`='$subject_name',`urls`='$urls',`status_id`='$status_id', `updated_time`=NOW(),`modified_by`='$login_staff_id' 
					WHERE subject_id='$subject_id'")or die (mysqli_error($conn));



					$allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png","PNG","GIF","webp","WEBP");
					$extension = pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION);
					if (in_array($extension, $allowedExts)){/// start if 6
						$datetime=date("Ymdhi");
						$thumbnail = $subject_id.'_'.$datetime.'_'.$thumbnail;
						$uploadPath= $subjectPixPath . $thumbnail;
						if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $uploadPath)){/// start if 7
							unlink($subjectPixPath . $db_thumbnail);
							mysqli_query($conn,"UPDATE `subjects_tab` SET thumbnail='$thumbnail' WHERE subject_id='$subject_id'")or die (mysqli_error($conn));
						}
					}

					$response['response']=200; 
					$response['success']=true;
					$response['message']="SUBJECT UPDATED SUCCESSFULLY!";
					$response['subject_id']=$subject_id;
					$response['urls']=$urls;
					$response['db_urls']=$db_urls;
					$response['thumbnail']=$thumbnail;
					$response['db_thumbnail']=$db_thumbnail;
					$alert_detail="SUBJECT UPDATED SUCCESSFULLY: A subject was successfully Updated. DETAILS: - name: $subject_name, ID: $subject_id";
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