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
		
		$tutorial_id=trim($_POST['tutorial_id']);

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
		if(empty($tutorial_id)){ ///start if 2
			$response['response']=101;
			$response['success']=false;
			$response['message']="TUTORIAL ID REQUIRED! Provide tutorialID and try again."; 
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

			$tutorial_array=$callclass->_get_tutorial_details($conn, $tutorial_id);
			$tutorial_array = json_decode($tutorial_array, true);
			$department_id= $tutorial_array[0]['department_id'];
			$class_id= $tutorial_array[0]['class_id'];
			$subject_id= $tutorial_array[0]['subject_id'];
			$term_id= $tutorial_array[0]['term_id'];
			$week_id= $tutorial_array[0]['week_id'];
			$topic= $tutorial_array[0]['topic'];
			$duration= $tutorial_array[0]['duration'];
	
	
	
				/////////////////////geting sequence//////////////////////////
				$sequence=$callclass->_get_sequence_count($conn, 'QUES');
				$array = json_decode($sequence, true);
				$no= $array[0]['no'];
				$datetime=date("Ymdhi");
				$question_id='QUES'.$no.$datetime;
				

				mysqli_query($conn,"INSERT INTO `cbt_question_bank_tab`
				(`question_id`, `department_id`, `class_id`, `subject_id`, `term_id`, `week_id`, `tutorial_id`, `question_text`, `answer`, `created_time`, `updated_time`, `modified_by`) VALUES
				('$question_id',  '$department_id', '$class_id','$subject_id', '$term_id', '$week_id', '$tutorial_id', '$question_text', '$answer', NOW(), NOW(), '$login_staff_id')")or die (mysqli_error($conn));
				

				/////upload question pix
				$allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png","PNG","GIF","webp","WEBP");
				$question_pix_extension = pathinfo($_FILES['question_pix']['name'], PATHINFO_EXTENSION);
				if (in_array($question_pix_extension, $allowedExts)){/// start if 4
					$question_pix = $question_id.'_'.$datetime.'_question.'.$question_pix_extension;
					$cbtQuestionPixPath= $cbtQuestionPixPath . $question_pix;

					move_uploaded_file($_FILES["question_pix"]["tmp_name"], $cbtQuestionPixPath);
					//update question_pix on cbt_question_bank_tab
					mysqli_query($conn,"UPDATE `cbt_question_bank_tab`
					SET `question_pix`='$question_pix' WHERE `question_id`='$question_id'")or die (mysqli_error($conn));
				}


				//// for option A
				mysqli_query($conn,"INSERT INTO `cbt_options_tab`
				(`question_id`, `option_id`, `option_text`) VALUES
				('$question_id',  'A', '$option_a')")or die (mysqli_error($conn));

				/////upload option A pix
				$allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png","PNG","GIF","webp","WEBP");
				$option_a_pix_extension = pathinfo($_FILES['option_a_pix']['name'], PATHINFO_EXTENSION);
				if (in_array($option_a_pix_extension, $allowedExts)){/// start if 4
					$option_a_pix = $question_id.'_'.$datetime.'_optionA.'.$option_a_pix_extension;
					$cbtOptionPixPath_a= $cbtOptionPixPath . $option_a_pix;

					if(move_uploaded_file($_FILES["option_a_pix"]["tmp_name"], $cbtOptionPixPath_a)){
						//update Option pix
						mysqli_query($conn,"UPDATE `cbt_options_tab`
						SET `option_pix`='$option_a_pix' WHERE `question_id`='$question_id' AND `option_id`='A'")or die (mysqli_error($conn));
					}
					
				}


				//// for option B
				mysqli_query($conn,"INSERT INTO `cbt_options_tab`
				(`question_id`, `option_id`, `option_text`) VALUES
				('$question_id',  'B', '$option_b')")or die (mysqli_error($conn));

				/////upload option B pix
				$allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png","PNG","GIF","webp","WEBP");
				$option_b_pix_extension = pathinfo($_FILES['option_b_pix']['name'], PATHINFO_EXTENSION);
				if (in_array($option_b_pix_extension, $allowedExts)){/// start if 4
					$option_b_pix = $question_id.'_'.$datetime.'_optionB.'.$option_b_pix_extension;
					$cbtOptionPixPath_b= $cbtOptionPixPath . $option_b_pix;

					if(move_uploaded_file($_FILES["option_b_pix"]["tmp_name"], $cbtOptionPixPath_b)){
						//update Option pix
						mysqli_query($conn,"UPDATE `cbt_options_tab`
						SET `option_pix`='$option_b_pix' WHERE `question_id`='$question_id' AND `option_id`='B'")or die (mysqli_error($conn));
					}
				}
				
				//// for option C
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


				//// for option D
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


				//// for option E
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

				$response['response']=200;
				$response['success']=true;
				$response['message']="QUIZ QUESTION SUBMITTED!";

		} ///end if 2
		
	}/// end if 1
}/// end if 0
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>