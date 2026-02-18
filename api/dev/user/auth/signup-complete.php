<?php require_once '../../config/connection.php'; ?>
<?php require_once '../../config/user-session-check.php'; ?>
<?php
	///// check for API security
	if ($apiKey != $expected_api_key) {/// start if 0
		$response['response'] = 98;
		$response['success'] = false;
		$response['message'] = "SECURITY ACCESS DENIED! You are not allowed to execute this command due to security bridge.";
		goto end;
	}

	if ($check == 0) { /// start if 1
		$response['response'] = 99;
		$response['success'] = False;
		$response['message'] = "SESSION EXPIRED! Please LogIn Again.";
		goto end;
	}
	//////////////////declaration of variables//////////////////////////////////////
	$user_id = trim(($_POST['user_id']));
	$email = trim(($_POST['email']));
	$transaction_id = trim(($_POST['transaction_id']));
	$subscription_id = trim(($_POST['subscription_id']));
	$amount = trim(($_POST['amount']));
	$paystack_payment_key = trim(($_POST['paystack_payment_key']));
	$referral_type = trim(($_POST['referral_type'])); /// code or link
	$referral_id = trim(($_POST['referral_id']));

	if (empty($user_id)) { ///start if 2
		$response['response'] = 100;
		$response['success'] = false;
		$response['message'] = "USER ID REQUIRED! Check the field and try again.";
		goto end;
	}
	if (empty($email)) { ///else if 2
		$response['response'] = 101;
		$response['success'] = false;
		$response['message'] = "EMAIL REQUIRED!  Check the field and try again.";
		goto end;
	}
	if (empty($transaction_id)) { ///else if 2
		$response['response'] = 102;
		$response['success'] = false;
		$response['message'] = "TRANSACTION ID REQUIRED!  Check the field and try again.";
		goto end;
	}
	if (empty($subscription_id)) { ///else if 2
		$response['response'] = 103;
		$response['success'] = false;
		$response['message'] = "SUBSCRIPTION ID REQUIRED!  Check the field and try again.";
		goto end;
	}
	if (empty($amount)) { ///else if 2
		$response['response'] = 104;
		$response['success'] = false;
		$response['message'] = "AMOUNT REQUIRED!  Check the field and try again.";
		goto end;
	}
	if (empty($paystack_payment_key)) { ///else if 2
		$response['response'] = 105;
		$response['success'] = false;
		$response['message'] = "PAYMENT KEY REQUIRED!  Select your current class and try again.";
		goto end;
	}

	$query = mysqli_query($conn, "SELECT * FROM users_tab WHERE user_id='$user_id' AND status_id!=3") or die(mysqli_error($conn));
	$count_user = mysqli_num_rows($query);
	if ($count_user > 0) {
		$response['response'] = 106;
		$response['success'] = false;
		$response['message'] = "USER ERROR 106! Contact the admin for help or login.";
		goto end;
	}

	$user_array = $callclass->_get_user_details($conn, $user_id);
	$user_fetch = json_decode($user_array, true);
	$user_fullname = $user_fetch[0]['fullname'];

	$settings_array = $callclass->_get_setup_backend_settings_detail($conn, 'BK_ID001');
	$settings_fetch = json_decode($settings_array, true);
	$subcription_amount = $settings_fetch[0]['subcription_amount'];
	$db_paystack_payment_key = $settings_fetch[0]['paystack_payment_key'];

	if ($paystack_payment_key != $db_paystack_payment_key) {///start if 3
		$response['response'] = 107;
		$response['success'] = false;
		$response['message'] = "FRAUD ALERT! You cannot complete this transaction with wrong key.";

		$alert_detail = "FRAUD ALERT: A prospective user whose name is $user_fullname with ID: $user_id attempt to pay $amount with a wrong payment key $paystack_payment_key";
		$callclass->_alert_sequence_and_update($conn, $user_id, $user_fullname, 0, $alert_detail, $ipAddress, $systemName);
		goto end;
	}

	if ($amount != $subcription_amount) {///start if 4
		$response['response'] = 108;
		$response['success'] = false;
		$response['message'] = "FRAUD ALERT! You cannot complete this transaction with wrong amount.";

		$alert_detail = "FRAUD ALERT: A prospective user whose name is $user_fullname with ID: $user_id attempt to pay $amount instead of $subcription_amount";
		$callclass->_alert_sequence_and_update($conn, $user_id, $user_fullname, 0, $alert_detail, $ipAddress, $systemName);
		goto end;
	}


	if (($referral_type != 'code') && ($referral_type != 'link')) { //// for agents
		$response['response'] = 109;
		$response['success'] = false;
		$response['message'] = "USER ERROR 109! Contact the admin for help or login.";
		goto end;
	}

	if ($referral_type == 'code') { //// for agents
		if (!empty($referral_id)) {
			$referral_id_query = mysqli_query($conn, "SELECT * FROM company_tab WHERE referral_code='$referral_id' AND status_id=1");
			$count_referral_id = mysqli_num_rows($referral_id_query);
			// get company_id
			$fetch_query=mysqli_fetch_array($referral_id_query);
			$company_id=$fetch_query['company_id'];

			if ($count_referral_id == 0) {
				$response['response'] = 110;
				$response['success'] = false;
				$response['message'] = "USER ERROR 110! Contact the admin for help or login.";
				goto end;
			}
		}
	}

	if ($referral_type == 'link') {
		$referral_id_query = mysqli_query($conn, "SELECT * FROM users_tab WHERE user_id='$referral_id' AND status_id=1");
		$count_referral_id = mysqli_num_rows($referral_id_query);

		if ($count_referral_id == 0) {
			$response['response'] = 111;
			$response['success'] = false;
			$response['message'] = "USER ERROR 111! Contact the admin for help or login.";
			goto end;
		}
	}


	mysqli_query($conn, "UPDATE `users_tab` SET status_id=1 WHERE user_id='$user_id'") or die(mysqli_error($conn));
	mysqli_query($conn, "UPDATE `payment_transactions_tab` SET status_id=5 WHERE user_id='$user_id' AND transaction_id='$transaction_id'") or die(mysqli_error($conn));
	mysqli_query($conn, "UPDATE `subscriptions_tab` SET status_id = 1, subscription_end_date = DATE_ADD(NOW(), INTERVAL 30 DAY) WHERE user_id = '$user_id' AND subscription_id = '$subscription_id'") or die(mysqli_error($conn));


	if ($referral_type == 'link') {
		$settings_array = $callclass->_get_setup_backend_settings_detail($conn, 'BK_ID001');
		$settings_fetch = json_decode($settings_array, true);
		$student_bonus_for_referral = $settings_fetch[0]['student_bonus_for_referral'];

		for ($i = 1; $i <= 5; $i++) {
			$ref_array = $callclass->_get_user_details($conn, $referral_id);
			$ref_fetch = json_decode($ref_array, true);
			$ref_email = $ref_fetch[0]['email'];
			$ref_wallet_balance = $ref_fetch[0]['wallet_balance'];
			$who_refer = $ref_fetch[0]['referral_id'];
			///////////////////////geting sequence//////////////////////////
			$sequence = $callclass->_get_sequence_count($conn, 'TRANS');
			$array = json_decode($sequence, true);
			$no = $array[0]['no'];
			//$num= $array[0]['num'];
			$transaction_id = 'TRANS' . $no . date("Ymdhis");

			$student_bonus_for_referral = floatval($student_bonus_for_referral / 2);

			$balance_after =floatval( $ref_wallet_balance + $student_bonus_for_referral);
			mysqli_query($conn, "INSERT INTO `payment_transactions_tab`
			(`user_id`,  `email`, `transaction_id`, `balance_before`, `amount`, `balance_after`, `transaction_type_id`, `payment_method_id`, `from_who`, `status_id`, `created_time`) VALUES
			('$referral_id', '$ref_email', '$transaction_id', '$ref_wallet_balance','$student_bonus_for_referral','$balance_after', 'BON', 'SYS', '$user_id', 5, NOW())") or die(mysqli_error($conn));
			mysqli_query($conn,"UPDATE `users_tab` SET wallet_balance=$balance_after WHERE user_id='$referral_id'")or die (mysqli_error($conn));
			//// get new referral ID
			if ((!$who_refer) || empty($who_refer)) {
				break;
			}
			$referral_id_query = mysqli_query($conn, "SELECT * FROM company_tab WHERE referral_code='$who_refer'");
			$count_referral_id = mysqli_num_rows($referral_id_query);
			if ($count_referral_id>0) {
				break;
			}
			$referral_id = $who_refer;
		}
	}


	if ($referral_type == 'code') {
		if (!empty($referral_id)) {

			$fetch=$callclass->_get_company_details($conn,$company_id);
			$array = json_decode($fetch, true);
			$company_email=$array[0]['email'];
			$company_commission=$array[0]['company_commission'];
			$company_wallet_balance = $array[0]['wallet_balance'];

			///////////////////////geting sequence//////////////////////////
			$sequence = $callclass->_get_sequence_count($conn, 'TRANS');
			$array = json_decode($sequence, true);
			$no = $array[0]['no'];
			//$num= $array[0]['num'];
			$transaction_id = 'TRANS' . $no . date("Ymdhis");

			$bonus_for_referral = (floatval($company_commission) / 100) * $amount;

			$balance_after = $company_wallet_balance + $bonus_for_referral;

			mysqli_query($conn, "INSERT INTO `payment_transactions_tab`
			(`user_id`,  `email`, `transaction_id`, `balance_before`, `amount`, `balance_after`, `transaction_type_id`, `payment_method_id`, `from_who`, `status_id`, `created_time`) VALUES
			('$company_id', '$company_email', '$transaction_id', '$company_wallet_balance','$bonus_for_referral','$balance_after', 'BON', 'SYS', '$user_id', 5, NOW())") or die(mysqli_error($conn));
			
			mysqli_query($conn,"UPDATE `company_tab` SET wallet_balance=$balance_after WHERE company_id='$company_id'")or die (mysqli_error($conn));
		}	
	}

	$response['response'] = 200;
	$response['success'] = true;
	$response['message'] = "REGISTRATION COMPLETED! Proceed to dashboard.";
	require_once '../component/login-details.php';

	$alert_detail = "REGISTRATION SUCCESS ALERT: A user whose name is $user_fullname with ID: $user_id has successfully signup on leaders tutors application";
	$callclass->_alert_sequence_and_update($conn, $user_id, $user_fullname, 0, $alert_detail, $ipAddress, $systemName);

	end:
	//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>