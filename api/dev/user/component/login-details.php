<?php
	$response['user'] = array();
	$response['subscription'] = array();  
	//// for user details
	$select="SELECT a.user_id, a.access_key, a.fullname, a.email, a.mobile_no, a.profile_pix, a.status_id, a.created_time, a.updated_time, a.last_login_time, a.wallet_balance, b.status_name
	FROM users_tab a, setup_status_tab b 
	WHERE a.user_id ='$user_id' AND a.status_id=b.status_id";

	$query=mysqli_query($conn,$select)or die (mysqli_error($conn));
	while ($fetch_query = mysqli_fetch_assoc($query)) {
		$fetch_query['documentStoragePath'] = "$documentStoragePath/user-pix";
		$fetch_query['referral_link'] = $referralLink;
		$response['user'][] = $fetch_query;
	}
	//// for subscription details
	$select="SELECT a.department_id, b.department_name, a.class_id, c.class_name, a.subscription_start_date, a.subscription_end_date, NOW() AS todays_date, a.status_id, d.status_name
	FROM subscriptions_tab a, departments_tab b, classes_tab c, setup_status_tab d 
	WHERE a.user_id ='$user_id' AND a.department_id=b.department_id AND a.class_id=c.class_id AND a.status_id=d.status_id AND a.status_id=1;";

	$query=mysqli_query($conn,$select)or die (mysqli_error($conn));
	while ($fetch_query = mysqli_fetch_assoc($query)) {
		$response['subscription'][] = $fetch_query;
	}


?>