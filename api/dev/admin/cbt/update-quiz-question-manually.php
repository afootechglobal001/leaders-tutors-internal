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

		//////////////////declaration of variables//////////////////////////////////////
		$question_id=trim($_POST['question_id']);

		$question_text=str_replace("'", "\'", $_POST['question_text']);
		$option_a=str_replace("'", "\'", $_POST['option_a']);
		$option_b=str_replace("'", "\'", $_POST['option_b']);
		$option_c=str_replace("'", "\'", $_POST['option_c']);
		$option_d=str_replace("'", "\'", $_POST['option_d']);
		$option_e=str_replace("'", "\'", $_POST['option_e']);
		$answer=trim($_POST['answer']);

		$question_pix=$_FILES['question_pix']['name'];
		$option_a_pix=$_FILES['option_a_pix']['name'];
		$option_b_pix=$_FILES['option_b_pix']['name'];
		$option_c_pix=$_FILES['option_c_pix']['name'];
		$option_d_pix=$_FILES['option_d_pix']['name'];
		$option_e_pix=$_FILES['option_e_pix']['name'];

		///////////////////////////////////////////////////////////////////////////////
		if(empty($question_id)){ ///start if 2
			$response['response']=101;
			$response['success']=false;
			$response['message']="QUESTION ID REQUIRED! Provide questionID and try again.";
		}elseif(empty($question_text) && empty($question_pix)){ ///else if 2
			$response['response']=102;
			$response['success']=false;
			$response['message']="QUESTION REQUIRED! Provide question and try again.";
		}elseif(empty($option_a) && empty($option_a_pix)){ ///else if 2
			$response['response']=102;
			$response['success']=false;
			$response['message']="OPTION A REQUIRED! Provide option a and try again.";
		}elseif(empty($option_b) && empty($option_b_pix)){ ///else if 2
			$response['response']=102;
			$response['success']=false;
			$response['message']="OPTION B REQUIRED! Provide option b and try again.";
		}elseif(empty($answer)){ ///else if 2
			$response['response']=102;
			$response['success']=false;
			$response['message']="QUESTION ANSWER REQUIRED! Provide answer and try again.";
		}else{ ///else if 2

			$question_array=$callclass->_get_question_details($conn, $question_id);
			$question_array = json_decode($question_array, true);
			$tutorial_id= $question_array[0]['tutorial_id'];
			$db_question_pix= $question_array[0]['question_pix'];

			$tutorial_array=$callclass->_get_tutorial_details($conn, $tutorial_id);
			$tutorial_array = json_decode($tutorial_array, true);
			$department_id= $tutorial_array[0]['department_id'];
			$class_id= $tutorial_array[0]['class_id'];
			$subject_id= $tutorial_array[0]['subject_id'];
			$term_id= $tutorial_array[0]['term_id'];
			$week_id= $tutorial_array[0]['week_id'];
			$topic= $tutorial_array[0]['topic'];
			$duration= $tutorial_array[0]['duration'];
			
			
				$department_array=$callclass->_get_department_details($conn, $department_id);
				$department_array = json_decode($department_array, true);
				$department_name= $department_array[0]['department_name'];
				
				$class_array=$callclass->_get_class_details($conn, $class_id);
				$class_array = json_decode($class_array, true);
				$class_name= $class_array[0]['class_name'];
	
				$subject_array=$callclass->_get_subject_details($conn, $subject_id);
				$subject_array = json_decode($subject_array, true);
				$subject_name= $subject_array[0]['subject_name'];
	
				$term_array=$callclass->_get_term_details($conn, $term_id);
				$term_array = json_decode($term_array, true);
				$term_name= $term_array[0]['term_name'];
	
				$week_array=$callclass->_get_week_details($conn, $week_id);
				$week_array = json_decode($week_array, true);
				$week_name= $week_array[0]['week_name'];
	
	
				$datetime=date("Ymdhi");

				mysqli_query($conn,"UPDATE `cbt_question_bank_tab` SET
				`department_id`='$department_id', `class_id`='$class_id', `subject_id`='$subject_id', `term_id`='$term_id', `week_id`='$week_id',
				`tutorial_id`='$tutorial_id', `question_text`='$question_text', `answer`='$answer',`updated_time`=NOW(), `modified_by`='$login_staff_id'
				 WHERE `question_id`='$question_id'")or die (mysqli_error($conn));
				

				/////upload question pix
				$allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png","PNG","GIF","webp","WEBP");
				$question_pix_extension = pathinfo($_FILES['question_pix']['name'], PATHINFO_EXTENSION);
				if (in_array($question_pix_extension, $allowedExts)){/// start if 4
					if($db_question_pix!='avatar.jpg'){
						unlink($cbtQuestionPixPath . $db_question_pix);
					}

					$question_pix = $question_id.'_'.$datetime.'_question.'.$question_pix_extension;
					$cbtQuestionPixPath= $cbtQuestionPixPath . $question_pix;

					move_uploaded_file($_FILES["question_pix"]["tmp_name"], $cbtQuestionPixPath);
					//update question_pix on cbt_question_bank_tab
					mysqli_query($conn,"UPDATE `cbt_question_bank_tab`
					SET `question_pix`='$question_pix' WHERE `question_id`='$question_id'")or die (mysqli_error($conn));
				}


				//// for option A
				mysqli_query($conn,"UPDATE `cbt_options_tab` SET
				`option_text`='$option_a'
				WHERE `question_id`='$question_id' AND `option_id`='A'")or die (mysqli_error($conn));

				/////upload option A pix
				$allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png","PNG","GIF","webp","WEBP");
				$option_a_pix_extension = pathinfo($_FILES['option_a_pix']['name'], PATHINFO_EXTENSION);
				if (in_array($option_a_pix_extension, $allowedExts)){/// start if 4

					$option_array=$callclass->_get_option_details($conn, $question_id, 'A');
					$option_array = json_decode($option_array, true);
					$db_option_pix_a= $option_array[0]['option_pix'];
		
					if($db_option_pix_a!='avatar.jpg'){
						unlink($cbtOptionPixPath . $db_option_pix_a);
					}

					$option_a_pix = $question_id.'_'.$datetime.'_optionA.'.$option_a_pix_extension;
					$cbtOptionPixPath_a= $cbtOptionPixPath . $option_a_pix;

					if(move_uploaded_file($_FILES["option_a_pix"]["tmp_name"], $cbtOptionPixPath_a)){
						//update Option pix
						mysqli_query($conn,"UPDATE `cbt_options_tab`
						SET `option_pix`='$option_a_pix' WHERE `question_id`='$question_id' AND `option_id`='A'")or die (mysqli_error($conn));
					}
				}


				//// for option B
				mysqli_query($conn,"UPDATE `cbt_options_tab` SET
				`option_text`='$option_b'
				WHERE `question_id`='$question_id' AND `option_id`='B'")or die (mysqli_error($conn));

				/////upload option B pix
				$allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png","PNG","GIF","webp","WEBP");
				$option_b_pix_extension = pathinfo($_FILES['option_b_pix']['name'], PATHINFO_EXTENSION);
				if (in_array($option_b_pix_extension, $allowedExts)){/// start if 4

					$option_array=$callclass->_get_option_details($conn, $question_id, 'B');
					$option_array = json_decode($option_array, true);
					$db_option_pix_b= $option_array[0]['option_pix'];
		
					if($db_option_pix_b!='avatar.jpg'){
						unlink($cbtOptionPixPath . $db_option_pix_b);
					}

					$option_b_pix = $question_id.'_'.$datetime.'_optionB.'.$option_b_pix_extension;
					$cbtOptionPixPath_b= $cbtOptionPixPath . $option_b_pix;

					if(move_uploaded_file($_FILES["option_b_pix"]["tmp_name"], $cbtOptionPixPath_b)){
						//update Option pix
						mysqli_query($conn,"UPDATE `cbt_options_tab`
						SET `option_pix`='$option_b_pix' WHERE `question_id`='$question_id' AND `option_id`='B'")or die (mysqli_error($conn));
					}
				}
				


				//// for option C
				$query=mysqli_query($conn,"SELECT * FROM cbt_options_tab WHERE question_id='$question_id' AND option_id='C'") or die (mysqli_error($conn));
				$count_option=mysqli_num_rows($query);
				if($count_option>0){
					if(!empty($option_c) || !empty($option_c_pix)){ ///else if 2
						mysqli_query($conn,"UPDATE `cbt_options_tab` SET
						`option_text`='$option_c'
						WHERE `question_id`='$question_id' AND `option_id`='C'")or die (mysqli_error($conn));

						/////upload option C pix
						$allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png","PNG","GIF","webp","WEBP");
						$option_c_pix_extension = pathinfo($_FILES['option_c_pix']['name'], PATHINFO_EXTENSION);
						if (in_array($option_c_pix_extension, $allowedExts)){/// start if 4

							$option_array=$callclass->_get_option_details($conn, $question_id, 'C');
							$option_array = json_decode($option_array, true);
							$db_option_pix_c= $option_array[0]['option_pix'];

							if($db_option_pix_c!='avatar.jpg'){
								unlink($cbtOptionPixPath . $db_option_pix_c);
							}

							$option_c_pix = $question_id.'_'.$datetime.'_optionC.'.$option_c_pix_extension;
							$cbtOptionPixPath_c= $cbtOptionPixPath . $option_c_pix;

							move_uploaded_file($_FILES["option_c_pix"]["tmp_name"], $cbtOptionPixPath_c);
							//update Option pix
							mysqli_query($conn,"UPDATE `cbt_options_tab`
							SET `option_pix`='$option_c_pix' WHERE `question_id`='$question_id' AND `option_id`='C'")or die (mysqli_error($conn));
						}


					}else{
						$option_array=$callclass->_get_option_details($conn, $question_id, 'C');
						$option_array = json_decode($option_array, true);
						$db_option_pix_c= $option_array[0]['option_pix'];
			
						if($db_option_pix_c!='avatar.jpg'){
							unlink($cbtOptionPixPath . $db_option_pix_c);
						}
						mysqli_query($conn,"DELETE FROM `cbt_options_tab`
						WHERE `question_id`='$question_id' AND `option_id`='C'")or die (mysqli_error($conn));
					}
				}else{
					if(!empty($option_c) || !empty($option_c_pix)){ ///else if 2
						mysqli_query($conn,"INSERT INTO `cbt_options_tab`
						(`question_id`, `option_id`, `option_text`) VALUES
						('$question_id',  'C', '$option_c')")or die (mysqli_error($conn));

						/////upload option C pix
						$allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png","PNG","GIF","webp","WEBP");
						$option_c_pix_extension = pathinfo($_FILES['option_c_pix']['name'], PATHINFO_EXTENSION);
						if (in_array($option_c_pix_extension, $allowedExts)){/// start if 4
							$option_c_pix = $question_id.'_'.$datetime.'_optionC.'.$option_c_pix_extension;
							$cbtOptionPixPath_c= $cbtOptionPixPath . $option_c_pix;

							move_uploaded_file($_FILES["option_c_pix"]["tmp_name"], $cbtOptionPixPath_c);
							//update Option pix
							mysqli_query($conn,"UPDATE `cbt_options_tab`
							SET `option_pix`='$option_c_pix' WHERE `question_id`='$question_id' AND `option_id`='C'")or die (mysqli_error($conn));
						}
					}
				}

				
					

				//// for option D
				$query=mysqli_query($conn,"SELECT * FROM cbt_options_tab WHERE question_id='$question_id' AND option_id='D'") or die (mysqli_error($conn));
				$count_option=mysqli_num_rows($query);
				if($count_option>0){
					if(!empty($option_d) || !empty($option_d_pix)){ ///else if 2
						mysqli_query($conn,"UPDATE `cbt_options_tab` SET
						`option_text`='$option_d'
						WHERE `question_id`='$question_id' AND `option_id`='D'")or die (mysqli_error($conn));

						/////upload option C pix
						$allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png","PNG","GIF","webp","WEBP");
						$option_d_pix_extension = pathinfo($_FILES['option_d_pix']['name'], PATHINFO_EXTENSION);
						if (in_array($option_d_pix_extension, $allowedExts)){/// start if 4

							$option_array=$callclass->_get_option_details($conn, $question_id, 'D');
							$option_array = json_decode($option_array, true);
							$db_option_pix_d= $option_array[0]['option_pix'];

							if($db_option_pix_d!='avatar.jpg'){
								unlink($cbtOptionPixPath . $db_option_pix_d);
							}

							$option_d_pix = $question_id.'_'.$datetime.'_optionD.'.$option_d_pix_extension;
							$cbtOptionPixPath_d= $cbtOptionPixPath . $option_d_pix;

							move_uploaded_file($_FILES["option_d_pix"]["tmp_name"], $cbtOptionPixPath_d);
							//update Option pix
							mysqli_query($conn,"UPDATE `cbt_options_tab`
							SET `option_pix`='$option_d_pix' WHERE `question_id`='$question_id' AND `option_id`='D'")or die (mysqli_error($conn));
						}


					}else{
						$option_array=$callclass->_get_option_details($conn, $question_id, 'D');
						$option_array = json_decode($option_array, true);
						$db_option_pix_d= $option_array[0]['option_pix'];
			
						if($db_option_pix_d!='avatar.jpg'){
							unlink($cbtOptionPixPath . $db_option_pix_d);
						}
						mysqli_query($conn,"DELETE FROM `cbt_options_tab`
						WHERE `question_id`='$question_id' AND `option_id`='D'")or die (mysqli_error($conn));
					}
				}else{
					if(!empty($option_d) || !empty($option_d_pix)){ ///else if 2
						mysqli_query($conn,"INSERT INTO `cbt_options_tab`
						(`question_id`, `option_id`, `option_text`) VALUES
						('$question_id',  'D', '$option_d')")or die (mysqli_error($conn));
						
						/////upload option D pix
						$allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png","PNG","GIF","webp","WEBP");
						$option_d_pix_extension = pathinfo($_FILES['option_d_pix']['name'], PATHINFO_EXTENSION);
						if (in_array($option_d_pix_extension, $allowedExts)){/// start if 4
							$option_d_pix = $question_id.'_'.$datetime.'_optionD.'.$option_d_pix_extension;
							$cbtOptionPixPath_d= $cbtOptionPixPath . $option_d_pix;

							move_uploaded_file($_FILES["option_d_pix"]["tmp_name"], $cbtOptionPixPath_d);
							//update Option pix
							mysqli_query($conn,"UPDATE `cbt_options_tab`
							SET `option_pix`='$option_d_pix' WHERE `question_id`='$question_id' AND `option_id`='D'")or die (mysqli_error($conn));
						}
					}
				}





				//// for option E
				$query=mysqli_query($conn,"SELECT * FROM cbt_options_tab WHERE question_id='$question_id' AND option_id='E'") or die (mysqli_error($conn));
				$count_option=mysqli_num_rows($query);
				if($count_option>0){
					if(!empty($option_e) || !empty($option_e_pix)){ ///else if 2
						mysqli_query($conn,"UPDATE `cbt_options_tab` SET
						`option_text`='$option_e'
						WHERE `question_id`='$question_id' AND `option_id`='E'")or die (mysqli_error($conn));

						/////upload option C pix
						$allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png","PNG","GIF","webp","WEBP");
						$option_e_pix_extension = pathinfo($_FILES['option_e_pix']['name'], PATHINFO_EXTENSION);
						if (in_array($option_e_pix_extension, $allowedExts)){/// start if 4

							$option_array=$callclass->_get_option_details($conn, $question_id, 'E');
							$option_array = json_decode($option_array, true);
							$db_option_pix_e= $option_array[0]['option_pix'];

							if($db_option_pix_e!='avatar.jpg'){
								unlink($cbtOptionPixPath . $db_option_pix_e);
							}

							$option_e_pix = $question_id.'_'.$datetime.'_optionE.'.$option_e_pix_extension;
							$cbtOptionPixPath_e= $cbtOptionPixPath . $option_e_pix;

							move_uploaded_file($_FILES["option_e_pix"]["tmp_name"], $cbtOptionPixPath_e);
							//update Option pix
							mysqli_query($conn,"UPDATE `cbt_options_tab`
							SET `option_pix`='$option_e_pix' WHERE `question_id`='$question_id' AND `option_id`='E'")or die (mysqli_error($conn));
						}


					}else{
						$option_array=$callclass->_get_option_details($conn, $question_id, 'E');
						$option_array = json_decode($option_array, true);
						$db_option_pix_e= $option_array[0]['option_pix'];
			
						if($db_option_pix_e!='avatar.jpg'){
							unlink($cbtOptionPixPath . $db_option_pix_e);
						}
						mysqli_query($conn,"DELETE FROM `cbt_options_tab`
						WHERE `question_id`='$question_id' AND `option_id`='E'")or die (mysqli_error($conn));
					}
				}else{
					if(!empty($option_e) || !empty($option_e_pix)){ ///else if 2
						mysqli_query($conn,"INSERT INTO `cbt_options_tab`
						(`question_id`, `option_id`, `option_text`) VALUES
						('$question_id',  'E', '$option_e')")or die (mysqli_error($conn));
						
						/////upload option D pix
						$allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png","PNG","GIF","webp","WEBP");
						$option_e_pix_extension = pathinfo($_FILES['option_e_pix']['name'], PATHINFO_EXTENSION);
						if (in_array($option_e_pix_extension, $allowedExts)){/// start if 4
							$option_e_pix = $question_id.'_'.$datetime.'_optionE.'.$option_e_pix_extension;
							$cbtOptionPixPath_e= $cbtOptionPixPath . $option_e_pix;

							move_uploaded_file($_FILES["option_e_pix"]["tmp_name"], $cbtOptionPixPath_e);
							//update Option pix
							mysqli_query($conn,"UPDATE `cbt_options_tab`
							SET `option_pix`='$option_e_pix' WHERE `question_id`='$question_id' AND `option_id`='E'")or die (mysqli_error($conn));
						}
					}
				}


				

				$response['response']=200;
				$response['success']=true;
				$response['message']="QUESTION UPDATED SUCCESSFULLY!";
				$alert_detail="QUESTION UPDATED SUCCESSFUL: A question was successfully updated. DETAILS: DETAIL: $term_name - $department_name - $class_name - $subject_name - $week_name - $topic";
				$callclass->_alert_sequence_and_update($conn,$login_staff_id,$login_staff_fullname,$login_role_id,$alert_detail,$ipAddress,$systemName);
		} ///end if 2
		
	}/// end if 1
}/// end if 0
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>