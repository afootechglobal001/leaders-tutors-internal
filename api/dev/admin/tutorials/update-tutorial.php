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
		$response['success']=false;
		$response['message']="SESSION EXPIRED! Please LogIn Again.";
	}else{/// else if 1
		$tutorial_id=trim($_POST['tutorial_id']);
		$term_id=trim($_POST['term_id']);
		$department_id=trim($_POST['department_id']);
		$class_id=trim($_POST['class_id']);
		$subject_id=trim($_POST['subject_id']);
		$week_id=trim($_POST['week_id']);
		$series_id=trim($_POST['series_id']);
		$topic=trim(strtoupper($_POST['topic']));
		$urls=trim($_POST['urls']);
		$seo_keywords=trim((str_replace("'", "\'", $_POST['seo_keywords'])));
		$seo_description =trim((str_replace("'", "\'", $_POST['seo_description'])));
		$summary=trim((str_replace("'", "\'", $_POST['summary'])));
		$thumbnail=$_FILES['thumbnail']['name'];
		$video=$_FILES['video']['name'];
		$duration=trim($_POST['duration']);
		$material=$_FILES['material']['name'];
		$status_id=trim($_POST['status_id']);
			
		if($subject_id==''){ ///start if 2
			$response['response']=101;
			$response['success']=false;
			$response['message']="SUBJECT REQUIRED! Select subject and try again.";
		}elseif($term_id==''){ ///else if 2
			$response['response']=102;
			$response['success']=false;
			$response['message']="TERM REQUIRED! Select term and try again.";
		}elseif($department_id==''){ ///else if 2
			$response['response']=103;
			$response['success']=false;
			$response['message']="DEPARTMENT REQUIRED! Select department and try again.";
		}elseif($class_id==''){ ///else if 2
			$response['response']=104;
			$response['success']=false;
			$response['message']="CLASS REQUIRED! Select class and try again.";
		}elseif($week_id==''){ ///else if 2
			$response['response']=105;
			$response['success']=false;
			$response['message']="WEEK REQUIRED! Select week and try again.";
		}elseif($series_id==''){ ///else if 2
			$response['response']=105;
			$response['success']=false;
			$response['message']="SERIES REQUIRED! Select series and try again.";
		}elseif($topic==''){ ///else if 2
			$response['response']=106;
			$response['success']=false;
			$response['message']="TOPIC REQUIRED! Check and try again.";
		}elseif($urls==''){ ///else if 2
			$response['response']=107;
			$response['success']=false;
			$response['message']="URL REQUIRED! Check and try again.";
		}elseif($seo_keywords==''){ ///else if 2
			$response['response']=108;
			$response['success']=false;
			$response['message']="SEO KEYWORDS REQUIRED! Check and try again.";
		}elseif($seo_description==''){ ///else if 2
			$response['response']=109;
			$response['success']=false;
			$response['message']="SEO DESCRIPTION REQUIRED! Check and try again.";
		}elseif($summary==''){ ///else if 2
			$response['response']=110;
			$response['success']=false;
			$response['message']="SUMMARY REQUIRED! Check and try again.";
		}elseif($duration==''){ ///else if 2
			$response['response']=111;
			$response['success']=false;
			$response['message']="VIDEO DURATION REQUIRED! Check and try again.";
		}elseif($status_id==''){ ///else if 2
			$response['response']=112;
			$response['success']=false;
			$response['message']="STATUS REQUIRED! Select the status and try again.";
		}else{ ///else if 2

				$term_array=$callclass->_get_term_details($conn, $term_id);
				$term_array = json_decode($term_array, true);
				$term_name= $term_array[0]['term_name'];

				$department_array=$callclass->_get_department_details($conn, $department_id);
				$department_array = json_decode($department_array, true);
				$department_name= $department_array[0]['department_name'];
				$department_urls= $department_array[0]['urls'];
				
				$class_array=$callclass->_get_class_details($conn, $class_id);
				$class_array = json_decode($class_array, true);
				$class_name= $class_arratutorial_arrayy[0]['class_name'];
				$class_urls= $class_array[0]['urls'];

				$subject_array=$callclass->_get_subject_details($conn, $subject_id);
				$subject_array = json_decode($subject_array, true);
				$subject_name= $subject_array[0]['subject_name'];
				$subject_urls= $subject_array[0]['urls'];

				$week_array=$callclass->_get_week_details($conn, $week_id);
				$week_array = json_decode($week_array, true);
				$week_name= $week_array[0]['week_name'];

				$series_array=$callclass->_get_series_details($conn, $series_id);
				$series_array = json_decode($series_array, true);
				$series_name= $series_array[0]['series_name'];

				$tutorial_array=$callclass->_get_tutorial_details($conn, $tutorial_id);
				$tutorial_array = json_decode($tutorial_array, true);
				$db_urls= $tutorial_array[0]['urls'];
				$db_thumbnail= $tutorial_array[0]['thumbnail'];
				$db_video= $tutorial_array[0]['video'];
				$db_material= $tutorial_array[0]['material'];

				$tutorial_check_by_urls=mysqli_query($conn,"SELECT * FROM tutorial_tab WHERE subject_id='$subject_id' AND department_id='$department_id' AND class_id='$class_id' AND urls='$urls' AND tutorial_id!='$tutorial_id'");
				$tutorial_check_by_urls=mysqli_num_rows($tutorial_check_by_urls);
				if ($tutorial_check_by_urls>0){ ///start if 3
					$response['response']=113;
					$response['success']=false;
					$response['message']="TUTORIAL EXIST BY URL! Topic with URL: $urls already exist";
					$alert_detail="TUTORIAL REGISTRATION FAILED: Topic with url $urls can not be registered as its already exist. DETAIL: department/$department_urls/$class_urls/$urls";
				}else{///else if 3
					// $series_check_by_urls=mysqli_query($conn,"SELECT * FROM tutorial_tab WHERE subject_id='$subject_id' AND department_id='$department_id' AND class_id='$class_id' AND term_id='$term_id' AND week_id='$week_id' AND series_id='$series_id' AND tutorial_id!='$tutorial_id'");
					// $series_check_by_urls=mysqli_num_rows($series_check_by_urls);
					// if ($series_check_by_urls>0){ ///start if 3
					// 	$response['response']=113;
					// 	$response['success']=false;
					// 	$response['message']="TUTORIAL EXIST BY SERIES! Topic with $series_name already exist";
					// 	$alert_detail="TUTORIAL REGISTRATION FAILED: Topic with $series_name can not be registered as its already exist. DETAIL: department/$department_name/$class_name/$term_name/$week_name/$subject_name";
					// }else{///else if 3

						/// update tutorial
						$actionQuery= mysqli_query($conn,"UPDATE `tutorial_tab`
						SET `subject_id`='$subject_id',`term_id`='$term_id',`department_id`='$department_id',`class_id`='$class_id',`week_id`='$week_id',`series_id`='$series_id',`topic`='$topic',`urls`='$urls',`seo_keywords`='$seo_keywords',`seo_description`='$seo_description',`summary`='$summary',`duration`='$duration',`status_id`='$status_id',`updated_time`=NOW(), `modified_by`='$login_staff_id'
						WHERE `tutorial_id`='$tutorial_id'")or die (mysqli_error($conn));

						if($actionQuery){
							$allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png","PNG","GIF","webp","WEBP");
							$extension = pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION);
							if (in_array($extension, $allowedExts)){/// start if 4
								unlink($tutorialPixPath . $db_thumbnail);
								$thumbnail = $tutorial_id.'_'.$datetime.'_'.$thumbnail;
								$tutorialPixPath= $tutorialPixPath . $thumbnail;
								move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $tutorialPixPath);
								/// update tutorial
								mysqli_query($conn,"UPDATE `tutorial_tab`
								SET `thumbnail`='$thumbnail' WHERE `tutorial_id`='$tutorial_id'")or die (mysqli_error($conn));
							}/// end if 4
	
							$allowedExts = array("MP4", "mp4", "MOV", "mov", "AVI", "avi","WMV","wmv","AVCHD","avchd","WebM","FLV","flv");
							$extension = pathinfo($_FILES['video']['name'], PATHINFO_EXTENSION);
							if (in_array($extension, $allowedExts)){/// start if 5
								unlink($tutorialVideoPath . $db_video);
								$video = $tutorial_id.'_'.$datetime.'_'.$video;
								$tutorialVideoPath= $tutorialVideoPath . $video;
								move_uploaded_file($_FILES["video"]["tmp_name"], $tutorialVideoPath);
								/// update tutorial
								mysqli_query($conn,"UPDATE `tutorial_tab`
								SET `video`='$video' WHERE `tutorial_id`='$tutorial_id'")or die (mysqli_error($conn));
							}/// end if 5
	
							$allowedExts = array("PDF", "pdf");
							$extension = pathinfo($_FILES['material']['name'], PATHINFO_EXTENSION);
							if (in_array($extension, $allowedExts)){/// start if 6
								unlink($tutorialMaterialPath . $db_material);
								$material = $tutorial_id.'_'.$datetime.'_'.$material;
								$tutorialMaterialPath= $tutorialMaterialPath . $material;
								move_uploaded_file($_FILES["material"]["tmp_name"], $tutorialMaterialPath);
								/// update tutorial
								mysqli_query($conn,"UPDATE `tutorial_tab`
								SET `material`='$material' WHERE `tutorial_id`='$tutorial_id'")or die (mysqli_error($conn));
							}/// end if 6
	
	
							$response['response']=200;
							$response['success']=true;
							$response['message']="TUTORIAL UPDATED SUCCESSFULLY!";
							$response['tutorial_id']=$tutorial_id;
							$response['urls']=$urls;
							$response['db_urls']=$db_urls;
							$response['thumbnail']=$thumbnail;
							$response['db_thumbnail']=$db_thumbnail;
							$response['department_urls']=$department_urls;
							$response['class_urls']=$class_urls;
							$response['subject_urls']=$subject_urls;
	
							$alert_detail="TUTORIAL UPDATED SUCCESSFUL: A tutorial was successfully updated. DETAILS: DETAIL: $term_name - $department_name - $class_name - $subject_name - $week_name - $topic";
							
						}else{
							$response['response']=000;
							$response['success']=false;
							$response['message']="QUERY ERROR! Contact your Engineer For Help";
							$alert_detail="TUTORIAL UPDATE FAILED: Tutorial with topic name $topic can not be updated due to query error. DETAIL: $term_name - $department_name - $class_name - $subject_name - $week_name";
						}
					//}
				}///end if 3
			
		$callclass->_alert_sequence_and_update($conn,$login_staff_id,$login_staff_fullname,$login_role_id,$alert_detail,$ipAddress,$systemName);
		} ///end if 2
	}///end if 1
}///end if 0
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>
