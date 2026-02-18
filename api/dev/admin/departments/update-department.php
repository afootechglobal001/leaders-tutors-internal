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

		$department_id=trim(strtoupper($_POST['department_id']));
		$department_name=trim(strtoupper($_POST['department_name']));
		$urls=trim($_POST['urls']);
		$seo_keywords=trim((str_replace("'", "\'", $_POST['seo_keywords'])));
		$seo_description =trim((str_replace("'", "\'", $_POST['seo_description'])));
		$thumbnail=$_FILES['thumbnail']['name'];
		$status_id=trim($_POST['status_id']);
			
		if($department_id==''){ ///start if 2
			$response['response']=100; 
			$response['success']=false;
			$response['message']="DEPARTMENT ID REQUIRED! Check and try again."; 
		}elseif($department_name==''){ ///else if 2
			$response['response']=101; 
			$response['success']=false;
			$response['message']="DEPARTMENT NAME  REQUIRED! Check and try again.";
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
			
			$department_check_by_name=mysqli_query($conn,"SELECT * FROM departments_tab WHERE department_name='$department_name' AND department_id!='$department_id'");
			$department_check_by_name=mysqli_num_rows($department_check_by_name);
			if ($department_check_by_name>0){ ///start if 3
				$response['response']=107; 
				$response['success']=false;
				$response['message']="DEPARTMENT EXIST BY NAME! department with name: $department_name already exist";
				$alert_detail="DEPARTMENT UPDATE FAILED: Department with name $department_name can not be updated as its already exist.";
			}else{///else if 3

			
				$department_check_by_urls=mysqli_query($conn,"SELECT * FROM departments_tab WHERE urls='$urls' AND department_id!='$department_id'");
				$department_check_by_urls=mysqli_num_rows($department_check_by_urls);
				if ($department_check_by_urls>0){ ///start if 5
					$response['response']=109; 
					$response['success']=false;
					$response['message']="DEPARTMENT EXIST BY URL! department with URL: $urls already exist";
					$alert_detail="DEPARTMENT UPDATE FAILED: Department with url $urls can not be updated as its already exist.";
				}else{///else if 5
						
					$department_array=$callclass->_get_department_details($conn, $department_id);
					$department_array = json_decode($department_array, true);
					$db_urls= $department_array[0]['urls'];
					$db_thumbnail= $department_array[0]['thumbnail'];
					/// register department
					mysqli_query($conn,"UPDATE `departments_tab`
					SET `department_name`='$department_name',`urls`='$urls',`seo_keywords`='$seo_keywords',`seo_description`='$seo_description',`status_id`='$status_id', `updated_time`=NOW(),`modified_by`='$login_staff_id' 
					WHERE department_id='$department_id'")or die (mysqli_error($conn));



					
					$allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png","PNG","GIF","webp","WEBP");	
					$extension = pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION);
					if (in_array($extension, $allowedExts)){/// start if 6
						$datetime=date("Ymdhi");
						$thumbnail = $department_id.'_'.$datetime.'_'.$thumbnail;
						$uploadPath= $departmentPixPath . $thumbnail;
						if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $uploadPath)){/// start if 7
							unlink($departmentPixPath . $db_thumbnail);
							mysqli_query($conn,"UPDATE `departments_tab` SET thumbnail='$thumbnail' WHERE department_id='$department_id'")or die (mysqli_error($conn));
						}
					}

					$response['response']=200; 
					$response['success']=true;
					$response['message']="DEPARTMENT UPDATED SUCCESSFULLY!";
					$response['department_id']=$department_id;
					$response['department_name']=$department_name;
					$response['urls']=$urls;
					$response['db_urls']=$db_urls;
					$response['seo_keywords']=$seo_keywords;
					$response['seo_description']=$seo_description;
					$response['thumbnail']=$thumbnail;
					$response['db_thumbnail']=$db_thumbnail;
					$alert_detail="DEPARTMENT UPDATED SUCCESSFULLY: A department was successfully Updated. DETAILS: - name: $department_name, ID: $department_id";
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