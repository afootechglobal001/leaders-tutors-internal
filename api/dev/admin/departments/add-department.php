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

		$department_name=trim(strtoupper($_POST['department_name']));
		$urls=trim($_POST['urls']);
		$seo_keywords=trim((str_replace("'", "\'", $_POST['seo_keywords'])));
		$seo_description =trim((str_replace("'", "\'", $_POST['seo_description'])));
		$thumbnail=$_FILES['thumbnail']['name'];
		$status_id=trim($_POST['status_id']);
			
		if($department_name==''){ ///start if 2
			$response['response']=101; 
			$response['success']=false;
			$response['message']="DEPARTMENT NAME REQUIRED! Check and try again."; 
		}elseif($urls==''){ ///else if 2
			$response['response']=102; 
			$response['success']=false;
			$response['message']="URL REQUIRED! Check and try again.";
		}elseif($seo_keywords==''){ ///else if 2
			$response['response']=103; 
			$response['success']=false;
			$response['message']="SEO KEYWORDS REQUIRED! Check and try again.";
		}elseif($seo_description==''){ ///else if 2
			$response['response']=104; 
			$response['success']=false;
			$response['message']="SEO DESCRIPTION REQUIRED! Check and try again."; 
		}elseif($status_id==''){ ///else if 2
			$response['response']=106; 
			$response['success']=false;
			$response['message']="STATUS REQUIRED! Select the status and try again.";
		}else{ ///else if 2
			
			
			$department_check_by_name=mysqli_query($conn,"SELECT * FROM departments_tab WHERE department_name='$department_name'");
			$department_check_by_name=mysqli_num_rows($department_check_by_name);
			if ($department_check_by_name>0){ ///start if 4
				$response['response']=108; 
				$response['success']=false;
				$response['message']="DEPARTMENT EXIST BY NAME! Department with name: $department_name already exist";
				$alert_detail="DEPARTMENT REGISTRATION FAILED: Department with name $department_name can not be registered as its already exist.";
			}else{///else if 4

				$department_check_by_urls=mysqli_query($conn,"SELECT * FROM departments_tab WHERE urls='$urls'");
				$department_check_by_urls=mysqli_num_rows($department_check_by_urls);
				if ($department_check_by_urls>0){ ///start if 5
					$response['response']=109; 
					$response['success']=false;
					$response['message']="department EXIST BY URL! department with URL: $urls already exist";
					$alert_detail="DEPARTMENT REGISTRATION FAILED: Department with url $urls can not be registered as its already exist.";
				}else{///else if 5
						
					$allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png","PNG","GIF","webp","WEBP");
					$extension = pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION);
					if (in_array($extension, $allowedExts)){/// start if 6
						///////////////////////geting sequence//////////////////////////
						$sequence=$callclass->_get_sequence_count($conn, 'DPT');
						$array = json_decode($sequence, true);
						$no= $array[0]['no'];
						$department_id='DPT'.$no;
						
						$datetime=date("Ymdhi");
						$thumbnail = $department_id.'_'.$datetime.'_'.$thumbnail;
						$uploadPath= $departmentPixPath . $thumbnail;
						if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $uploadPath)){/// start if 7

							/// register department
							mysqli_query($conn,"INSERT INTO `departments_tab`
							(`department_id`, `department_name`, `urls`, `seo_keywords`, `seo_description`, `thumbnail`,  `status_id`, `created_time`, `modified_by`) VALUES
							('$department_id',  '$department_name', '$urls', '$seo_keywords', '$seo_description','$thumbnail', '$status_id', NOW(), '$login_staff_id')")or die (mysqli_error($conn));

							$response['response']=200; 
							$response['success']=true;
							$response['message']="DEPARTMENT REGISTERED SUCCESSFULLY!";
							$response['department_id']=$department_id;
							$response['department_name']=$department_name;
							$response['urls']=$urls;
							$response['seo_keywords']=$seo_keywords;
							$response['seo_description']=$seo_description;
							$response['thumbnail']=$thumbnail;
							$alert_detail="DEPARTMENT REGISTRATION SUCCESSFUL: A department was successfully registered. DETAILS: - name: $department_name, ID: $department_id";
						}else {/// else if 7
							$response['response']=110; 
							$response['success']=False;
							$response['message']="PICTURE UPLOAD ERROR! Contact your Engineer For Help";
							$alert_detail="DEPARTMENT REGISTRATION FAILED: Department with name $department_name can not be registered due to picture upload error.";
						}/// end if 7
					}else{/// else if 6
						$response['response']=111; 
						$response['success']=False;
						$response['message']="INVALID PICTURE FORMAT! Check the picture format and try again.";
						$alert_detail="DEPARTMENT REGISTRATION FAILED: Department with name $department_name can not be registered due to invalid picture format.";
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