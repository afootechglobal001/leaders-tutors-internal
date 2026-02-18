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
		$quiz_question_template=$_FILES['quiz_question_template']['name'];
		///////////////////////////////////////////////////////////////////////////////
		if(empty($tutorial_id)){ ///start if 2
			$response['response']=101;
			$response['success']=false;
			$response['message']="TUTORIAL ID REQUIRED! Provide tutorialID and try again."; 
		}elseif(empty($quiz_question_template)){ ///else if 2
			$response['response']=102;
			$response['success']=false;
			$response['message']="QUESTION TEMPLATE REQUIRED! Upload question template and try again.";
		}else{ ///else if 2

			$datetime=date("Ymdhi");

			$query=mysqli_query($conn,"SELECT * FROM tutorial_tab WHERE tutorial_id='$tutorial_id'")or die (mysqli_error($conn));
            $fetch_query=mysqli_fetch_array($query);
            
        	$department_id=$fetch_query['department_id'];
        	$class_id=$fetch_query['class_id'];
        	$term_id=$fetch_query['term_id'];
        	$subject_id=$fetch_query['subject_id'];
        	$week_id=$fetch_query['week_id'];
        	$topic=$fetch_query['topic'];
        	$duration=$fetch_query['duration'];


			$allowedExts = array("csv","CSV","dat","DAT");
			$extension = pathinfo($_FILES['quiz_question_template']['name'], PATHINFO_EXTENSION);
			
			if (in_array($extension, $allowedExts)){
					/// open the file
				$file = fopen($_FILES["quiz_question_template"]["tmp_name"], "r");
				///upload the file
				$quiz_question_template = $tutorial_id.'_'.$datetime.'_question.'.$extension;
				$cbtQuestionTemplatePath= $cbtQuestionTemplatePath . $quiz_question_template;
				move_uploaded_file($_FILES["quiz_question_template"]["tmp_name"], $cbtQuestionTemplatePath);

			$no = 0;

mysqli_set_charset($conn, "utf8mb4");

$stmtQuestion = $conn->prepare("
INSERT INTO cbt_question_bank_tab
(question_id, department_id, class_id, subject_id, term_id, week_id, tutorial_id, question_text, answer, created_time, updated_time, modified_by)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW(), ?)");

$stmtOption = $conn->prepare("
INSERT INTO cbt_options_tab
(question_id, option_id, option_text)
VALUES (?, ?, ?)");

while (($emapData = fgetcsv($file, 10000000, ",")) !== FALSE) {

    foreach ($emapData as $key => $value) {
        $encoding = mb_detect_encoding($value, ['UTF-8', 'Windows-1252', 'ISO-8859-1'], true);
        $emapData[$key] = mb_convert_encoding($value, 'UTF-8', $encoding);
    }

    $no++;

    if ($no > 1) {

        $sequence = $callclass->_get_sequence_count($conn, 'QUES');
        $array = json_decode($sequence, true);
        $seqNo = $array[0]['no'];

        if (!$seqNo) {
            die("Sequence failed");
        }

        $question_id = 'QUES' . $seqNo . $datetime;

        $question_text = trim($emapData[0]);
        $option_a = trim($emapData[1]);
        $option_b = trim($emapData[2]);
        $option_c = trim($emapData[3]);
        $option_d = trim($emapData[4]);
        $option_e = trim($emapData[5]);
        $answer = trim($emapData[6]);

        // Insert Question
        $stmtQuestion->bind_param(
            "ssssssssss",
            $question_id,
            $department_id,
            $class_id,
            $subject_id,
            $term_id,
            $week_id,
            $tutorial_id,
            $question_text,
            $answer,
            $login_staff_id
        );

        $stmtQuestion->execute();

        // Insert Options
        $options = [
            'A' => $option_a,
            'B' => $option_b,
            'C' => $option_c,
            'D' => $option_d,
            'E' => $option_e,
        ];

        foreach ($options as $label => $text) {
            if (!empty($text)) {
                $stmtOption->bind_param("sss", $question_id, $label, $text);
                $stmtOption->execute();
            }
        }

					}
				
				}
				fclose($file);

				$response['response']=200;
				$response['success']=true;
				$response['message']="QUIZ QUESTION UPLOADED!";
			}else{
				$response['response']=103;
				$response['success']=false;
				$response['message']="INVALID QUESTION TEMPLATE FORMAT!";
			}
		} ///end if 2
		
	}/// end if 1
}/// end if 0
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>