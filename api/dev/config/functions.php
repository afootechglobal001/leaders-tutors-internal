<?php
class allClass{
/////////////////////////////////////////
/////////////////////////////////////////
function _get_setup_backend_settings_detail($conn, $backend_setting_id){
	$query=mysqli_query($conn,"SELECT * FROM setup_backend_settings_tab WHERE backend_setting_id='$backend_setting_id'")or die (mysqli_error($conn));
	$fetch=mysqli_fetch_array($query);
		$smtp_host=$fetch['smtp_host'];
		$smtp_username=$fetch['smtp_username'];
		$smtp_password=$fetch['smtp_password'];
		$smtp_port=$fetch['smtp_port'];
		$sender_name=$fetch['sender_name'];
		$support_email=$fetch['support_email'];
		$subcription_amount=$fetch['subcription_amount'];
		$paystack_payment_key=$fetch['paystack_payment_key'];
		$student_bonus_for_referral=$fetch['student_bonus_for_referral'];
		return '[{"smtp_host":"'.$smtp_host.'","smtp_username":"'.$smtp_username.'","smtp_password":"'.$smtp_password.'",
		"smtp_port":"'.$smtp_port.'","sender_name":"'.$sender_name.'","support_email":"'.$support_email.'",
		"subcription_amount":"'.$subcription_amount.'","paystack_payment_key":"'.$paystack_payment_key.'","student_bonus_for_referral":"'.$student_bonus_for_referral.'"}]';
}
/////////////////////////////////////////
function _get_sequence_count($conn, $counter_id){
	$count=mysqli_fetch_array(mysqli_query($conn,"SELECT counter_value FROM setup_counter_tab WHERE counter_id = '$counter_id' FOR UPDATE"));
	 $num=$count[0]+1;
	 mysqli_query($conn,"UPDATE `setup_counter_tab` SET `counter_value` = '$num' WHERE counter_id = '$counter_id'")or die (mysqli_error($conn));
	 if ($num<10){$no='00'.$num;}elseif($num>=10 && $num<100){$no='0'.$num;}else{$no=$num;}
	 return '[{"no":"'.$no.'"}]';
}
/////////////////////////////////////////
function _alert_sequence_and_update($conn,$user_id,$user_name,$role_id,$alert_detail,$ipAddress,$systemName){
	$sequence=$this->_get_sequence_count($conn, 'ALT');
	$array = json_decode($sequence, true);
	$no= $array[0]['no'];
	//$num= $array[0]['num'];
	$alert_id='ALT'.$no.date("Ymdhis");
	
	mysqli_query($conn,"INSERT INTO `0_alert_tab`
	(`alert_id`, `user_id`, `user_name`, `role_id`, `alert_detail`, `seen_status`, `ip_address`, `system_name`) VALUES
	('$alert_id', '$user_id', '$user_name', $role_id, '$alert_detail', 0, '$ipAddress', '$systemName')")or die (mysqli_error($conn));
}
function _get_alert_details($conn,$alert_id){
	$query=mysqli_query($conn,"SELECT * FROM 0_alert_tab WHERE alert_id='$alert_id'")or die (mysqli_error($conn));
	$fetch_query=mysqli_fetch_array($query);
		$seen_status=$fetch_query['seen_status'];
		return '[{"seen_status":"'.$seen_status.'"}]';
}

/////////////////////////////////////////
function _admin_accesskey_validation($conn,$access_key){
	$query=mysqli_query($conn,"SELECT * FROM staff_tab WHERE access_key='$access_key' AND  status_id=1 AND access_key!=''")or die (mysqli_error($conn));
	$count = mysqli_num_rows($query);
		if ($count>0){
			$fetch_query=mysqli_fetch_array($query);
			$staff_id=$fetch_query['staff_id'];
			$fullname=$fetch_query['fullname'];
			$role_id=$fetch_query['role_id'];
			$check=1; 
		}else{
			$check=0;
		}
		return '[{"check":"'.$check.'","staff_id":"'.$staff_id.'","fullname":"'.$fullname.'","role_id":"'.$role_id.'"}]';
}

function _get_staff_details($conn,$staff_id){
	$query=mysqli_query($conn,"SELECT * FROM staff_tab WHERE staff_id='$staff_id'")or die (mysqli_error($conn));
	$fetch_query=mysqli_fetch_array($query);
		$staff_id=$fetch_query['staff_id'];
		$profile_pix=$fetch_query['profile_pix'];
		$role_id=$fetch_query['role_id'];
		return '[{"staff_id":"'.$staff_id.'","profile_pix":"'.$profile_pix.'","role_id":"'.$role_id.'"}]';
}

/////////////////////////////////////////
function _user_accesskey_validation($conn,$access_key){
	$query=mysqli_query($conn,"SELECT * FROM users_tab WHERE access_key='$access_key' AND  status_id IN (1,3) AND access_key!=''")or die (mysqli_error($conn));
	$count = mysqli_num_rows($query);
		if ($count>0){
			$fetch_query=mysqli_fetch_array($query);
			$user_id=$fetch_query['user_id'];
			$fullname=$fetch_query['fullname'];
			$email=$fetch_query['email'];
			$mobile_no=$fetch_query['mobile_no'];
			$check=1; 
		}else{
			$check=0;
		}
		return '[{"check":"'.$check.'","user_id":"'.$user_id.'","fullname":"'.$fullname.'","email":"'.$email.'"}]';
}

function _get_user_details($conn,$user_id){
	$query=mysqli_query($conn,"SELECT * FROM users_tab WHERE user_id='$user_id'")or die (mysqli_error($conn));
	$fetch_query=mysqli_fetch_array($query);
		$user_id=$fetch_query['user_id'];
		$referral_id=$fetch_query['referral_id'];
		$fullname=$fetch_query['fullname'];
		$email=$fetch_query['email'];
		$mobile_no=$fetch_query['mobile_no'];
		$profile_pix=$fetch_query['profile_pix'];
		$wallet_balance=$fetch_query['wallet_balance'];
		return '[{"referral_id":"'.$referral_id.'","fullname":"'.$fullname.'","email":"'.$email.'","mobile_no":"'.$mobile_no.'","profile_pix":"'.$profile_pix.'","wallet_balance":"'.$wallet_balance.'"}]';
}

/////////////////////////////////////////
function _user_subscription_validation($conn,$user_id){
	$query=mysqli_query($conn,"SELECT * FROM subscriptions_tab WHERE user_id='$user_id' AND  status_id =1  AND subscription_end_date>NOW()")or die (mysqli_error($conn));
	$count = mysqli_num_rows($query);
	if ($count>0){
		$fetch_query=mysqli_fetch_array($query);
		$department_id=$fetch_query['department_id'];
		$class_id=$fetch_query['class_id'];
		$check=1;
	}else {
		///// subscription expired
		mysqli_query($conn, "UPDATE `subscriptions_tab` SET status_id = 6 WHERE user_id = '$user_id' AND status_id=1") or die(mysqli_error($conn));
		mysqli_query($conn, "UPDATE `subscriptions_tab` SET status_id = 4 WHERE user_id = '$user_id' AND status_id=3") or die(mysqli_error($conn));
		$check=0;
	}
	return '[{"check":"'.$check.'","user_id":"'.$user_id.'","department_id":"'.$department_id.'","class_id":"'.$class_id.'"}]';
}

function _get_term_details($conn,$term_id){
	$query=mysqli_query($conn,"SELECT * FROM setup_term_tab WHERE term_id='$term_id'")or die (mysqli_error($conn));
	$fetch_query=mysqli_fetch_array($query);
		$term_name=$fetch_query['term_name'];
		return '[{"term_name":"'.$term_name.'"}]';
}

function _get_department_details($conn,$department_id){
	$query=mysqli_query($conn,"SELECT * FROM departments_tab WHERE department_id='$department_id'")or die (mysqli_error($conn));
	$fetch_query=mysqli_fetch_array($query);
		$department_name=$fetch_query['department_name'];
		$urls=$fetch_query['urls'];
		$thumbnail=$fetch_query['thumbnail'];
		return '[{"department_name":"'.$department_name.'","urls":"'.$urls.'","thumbnail":"'.$thumbnail.'"}]';
}

function _get_class_details($conn,$class_id){
	$query=mysqli_query($conn,"SELECT * FROM classes_tab WHERE class_id='$class_id'")or die (mysqli_error($conn));
	$fetch_query=mysqli_fetch_array($query);
		$class_name=$fetch_query['class_name'];
		$urls=$fetch_query['urls'];
		$thumbnail=$fetch_query['thumbnail'];
		return '[{"class_name":"'.$class_name.'","urls":"'.$urls.'","thumbnail":"'.$thumbnail.'"}]';
}

function _get_subject_details($conn,$subject_id){
	$query=mysqli_query($conn,"SELECT * FROM subjects_tab WHERE subject_id='$subject_id'")or die (mysqli_error($conn));
	$fetch_query=mysqli_fetch_array($query);
		$subject_name=$fetch_query['subject_name'];
		$urls=$fetch_query['urls'];
		$thumbnail=$fetch_query['thumbnail'];
		return '[{"subject_name":"'.$subject_name.'","urls":"'.$urls.'","thumbnail":"'.$thumbnail.'"}]';
}

function _get_week_details($conn,$week_id){
	$query=mysqli_query($conn,"SELECT * FROM setup_week_tab WHERE week_id='$week_id'")or die (mysqli_error($conn));
	$fetch_query=mysqli_fetch_array($query);
		$week_name=$fetch_query['week_name'];
		return '[{"week_name":"'.$week_name.'"}]';
}

function _get_series_details($conn,$series_id){
	$query=mysqli_query($conn,"SELECT * FROM setup_video_series_tab WHERE series_id='$series_id'")or die (mysqli_error($conn));
	$fetch_query=mysqli_fetch_array($query);
		$series_name=$fetch_query['series_name'];
		return '[{"series_name":"'.$series_name.'"}]';
}
function _get_status_details($conn,$status_id){
	$query=mysqli_query($conn,"SELECT * FROM setup_status_tab WHERE status_id='$status_id'")or die (mysqli_error($conn));
	$fetch_query=mysqli_fetch_array($query);
		$status_name=$fetch_query['status_name'];
		return '[{"status_name":"'.$status_name.'"}]';
}

function _get_role_details($conn,$role_id){
	$query=mysqli_query($conn,"SELECT * FROM setup_role_tab WHERE role_id='$role_id'")or die (mysqli_error($conn));
	$fetch_query=mysqli_fetch_array($query);
		$role_name=$fetch_query['role_name'];
		return '[{"role_name":"'.$role_name.'"}]';
}

function _get_tutorial_details($conn,$tutorial_id){
	$query=mysqli_query($conn,"SELECT * FROM tutorial_tab WHERE tutorial_id='$tutorial_id'")or die (mysqli_error($conn));
	$fetch_query=mysqli_fetch_array($query);
		$department_id=$fetch_query['department_id'];
		$class_id=$fetch_query['class_id'];
		$subject_id=$fetch_query['subject_id'];
		$term_id=$fetch_query['term_id'];
		$week_id=$fetch_query['week_id'];
		$topic=$fetch_query['topic'];
		$urls=$fetch_query['urls'];
		$seo_keywords=$fetch_query['seo_keywords'];
		$seo_description=$fetch_query['seo_description'];
		//$summary=$fetch_query['summary'];
		$thumbnail=$fetch_query['thumbnail'];
		$video=$fetch_query['video'];
		$duration=$fetch_query['duration'];
		$material=$fetch_query['material'];
		$status_id=$fetch_query['status_id'];
		$quiz_status=$fetch_query['quiz_status'];
		$quiz_duration=$fetch_query['quiz_duration'];
		$quiz_question_counts=$fetch_query['quiz_question_counts'];
		return '[{"department_id":"'.$department_id.'","class_id":"'.$class_id.'","subject_id":"'.$subject_id.'","term_id":"'.$term_id.'","week_id":"'.$week_id.'","topic":"'.$topic.'",
		"urls":"'.$urls.'","seo_keywords":"'.$seo_keywords.'","seo_description":"'.$seo_description.'","thumbnail":"'.$thumbnail.'","video":"'.$video.'",
		"duration":"'.$duration.'","material":"'.$material.'","status_id":"'.$status_id.'","quiz_status":"'.$quiz_status.'","quiz_duration":"'.$quiz_duration.'","quiz_question_counts":"'.$quiz_question_counts.'"}]';
}
function _get_question_details($conn,$question_id){
	$query=mysqli_query($conn,"SELECT * FROM cbt_question_bank_tab WHERE question_id='$question_id'")or die (mysqli_error($conn));
	$fetch_query=mysqli_fetch_array($query);
		$tutorial_id=$fetch_query['tutorial_id'];
		$question_pix=$fetch_query['question_pix'];
		return '[{"tutorial_id":"'.$tutorial_id.'","question_pix":"'.$question_pix.'"}]';
}
function _get_option_details($conn, $question_id, $option_id){
	$query=mysqli_query($conn,"SELECT * FROM cbt_options_tab WHERE question_id='$question_id' AND option_id='$option_id'")or die (mysqli_error($conn));
	$fetch_query=mysqli_fetch_array($query);
		$option_pix=$fetch_query['option_pix'];
		return '[{"option_pix":"'.$option_pix.'"}]';
}
function _get_transaction_details($conn,$transaction_id){
	$query=mysqli_query($conn,"SELECT * FROM payment_transactions_tab WHERE transaction_id='$transaction_id'")or die (mysqli_error($conn));
	$fetch_query=mysqli_fetch_array($query);
		$amount=$fetch_query['amount'];
		return '[{"amount":"'.$amount.'"}]';
}

function _get_company_details($conn,$company_id){
	$query=mysqli_query($conn,"SELECT * FROM company_tab WHERE company_id='$company_id'")or die (mysqli_error($conn));
	$fetch_query=mysqli_fetch_array($query);
		$name=$fetch_query['name'];
		$email=$fetch_query['email'];
		$phone=$fetch_query['phone'];
		$address=$fetch_query['address'];
		$logo=$fetch_query['logo'];
		$wallet_balance=$fetch_query['wallet_balance'];

		$query=mysqli_query($conn,"SELECT * FROM company_commission_tab WHERE company_id='$company_id'")or die (mysqli_error($conn));
		$fetch_query=mysqli_fetch_array($query);
		$company_commission=$fetch_query['company'];

		return '[{"name":"'.$name.'", "email":"'.$email.'", "phone":"'.$phone.'", "address":"'.$address.'", "logo":"'.$logo.'", "company_commission":"'.$company_commission.'", "wallet_balance":"'.$wallet_balance.'"}]';
}

function _agent_accesskey_validation($conn,$access_key){
	$query=mysqli_query($conn,"SELECT * FROM company_contacts_login_verification_tab WHERE access_key='$access_key' AND access_key!=''")or die (mysqli_error($conn));
	$count = mysqli_num_rows($query);
		if ($count>0){
			$fetch_query=mysqli_fetch_array($query);
			$email=$fetch_query['email'];
			$check=1;
		}else{
			$check=0;
		}
		return '[{"check":"'.$check.'","email":"'.$email.'"}]';
}


function _get_agent_details($conn,$company_id,$email){
	$query=mysqli_query($conn,"SELECT * FROM company_contacts_tab WHERE company_id='$company_id' AND email='$email'")or die (mysqli_error($conn));
	$fetch_query=mysqli_fetch_array($query);
		$staff_id=$fetch_query['staff_id'];
		$name=$fetch_query['name'];
		$email=$fetch_query['email'];
		$phone=$fetch_query['phone'];
		$role_id=$fetch_query['role_id'];
		$status_id=$fetch_query['status_id'];
		$isApproved=$fetch_query['isApproved'];
		return '[{"staff_id":"'.$staff_id.'", "name":"'.$name.'", "email":"'.$email.'", "phone":"'.$phone.'", "role_id":"'.$role_id.'", "status_id":"'.$status_id.'", "isApproved":"'.$isApproved.'"}]';
}
}//end of class
$callclass=new allClass();
?>