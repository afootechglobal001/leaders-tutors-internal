
function _open_menu() {
	$('.sidenavdiv, .sidenavdiv-in').animate({ 'margin-left': '0' }, 200);
	$('.live-chat-back-div').animate({ 'margin-left': '-100%' }, 400);
	$('.index-menu-back-div').animate({ 'margin-left': '0' }, 400);
}

function _open_live_chat() {
	$('.sidenavdiv, .sidenavdiv-in').animate({ 'margin-left': '0' }, 200);
	$('.index-menu-back-div').animate({ 'margin-left': '-100%' }, 400);
	$('.live-chat-back-div').animate({ 'margin-left': '0' }, 400);
}

function _close_side_nav() {
	$('.sidenavdiv, .sidenavdiv-in').animate({ 'margin-left': '-100%' }, 200);
	$('.index-menu-back-div,.live-chat-back-div').animate({ 'margin-left': '-100%' }, 400);
}


$(document).ready(function () {
	function trim(s) {
		return s.replace(/^\s*/, "").replace(/\s*$/, "");
	}
	$("#nextPage3").keydown(function (e) {
		if (e.keyCode == 13) {
			_userSignUp();
		}
	});


});




// ------------- CONSTANT FUNCTIONS ----------------------------- //

function _placeHolder(search_txt, search_content) {
	superplaceholder({
		el: search_txt,
		sentences: search_content,
		options: {
			letterDelay: 80,
			loop: true,
			startOnFocus: false
		}
	});
}


function _isValidMobileNumber(number) {
	// Regular expression to match a typical mobile phone number format
	var regex = /^\d+$/;
	return regex.test(number);
}

function _showPasswordVisibility(ids, toggle_pass) {
	var password = $('#' + ids).val();
	if (password != '') {
		$('#' + toggle_pass).show();
	} else {
		$('#' + toggle_pass).hide();
	}
}


function _isNumberCheck(id, info) {
	$(document).on('keypress', '#' + id, function (event) {
		var key = event.keyCode || event.which;
		if (!((key >= 48 && key <= 57) || key === 43 || key === 45)) {
			event.preventDefault();
			$('#' + info).fadeIn(300);
			$(this).css('border', '#F00 1px solid');
		} else {
			$('#' + info).fadeOut(300);
			$(this).css('border', 'rgba(0, 0, 0, .1) 1px solid');
		}
	});
}


function _capitalizeFirstLetterOfEachWord(inputText) {
	// Split the input text into an array of words
	var words = inputText.toLowerCase().split(' ');
	// Capitalize the first letter of each word
	for (var i = 0; i < words.length; i++) {
		words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1);
	}
	// Join the words back into a sentence
	var result = words.join(' ');
	return result;
}





function _checkPasswordMatch(ids, toggle_pass) {
	var create_password = $("#reg_create_password").val();
	var confirmed_password = $("#reg_confirmed_password").val();
	if ((create_password != confirmed_password) && (confirmed_password != '')) {
		$('#message').show();
		$('#reg_create_password,#reg_confirmed_password').css('border', '#F00 1px solid');
	} else {
		$('#message').hide();
		$('#reg_create_password,#reg_confirmed_password').css('border', 'rgba(0, 0, 0, .1) 1px solid');
	}
	_showPasswordVisibility(ids, toggle_pass);
}




function _sliptResponse(response, splitSign) {
	// Split the response at '!'
	var splitResponse = response.split(splitSign);
	// Trim the whitespace from the first part and append it with a newline character
	var firstPart = splitResponse[0].trim() + '\n';
	// Join the first part with the second part
	var formattedResponse = firstPart + splitResponse[1];
	return formattedResponse;
}




function _togglePasswordVisibility(ids, toggle_pass) {
	const passwordInput = $('#' + ids);
	const togglePasswordIcon = $('#' + toggle_pass);

	if (passwordInput.attr('type') === 'password') {
		passwordInput.attr('type', 'text');
		togglePasswordIcon.html('<i class="bi-eye password-toggle"></i>');
	} else {
		passwordInput.attr('type', 'password');
		togglePasswordIcon.html('<i class="bi-eye-slash password-toggle"></i>');
	}
}




function _obfuscateEmail(email, visibleChars) {
	// Split the email into username and domain
	const [username, domain] = email.split('@');
	// Calculate the number of asterisks to replace in the username
	const numAsterisks = Math.max(0, username.length - visibleChars);
	// Obfuscate the username by replacing characters with asterisks
	const obfuscatedUsername = username.substring(0, visibleChars) + '*'.repeat(numAsterisks);
	// Combine the obfuscated username and the domain to form the obfuscated email
	const obfuscatedEmail = `${obfuscatedUsername}@${domain}`;

	$("#reg_email_info,#reg_email_info1").html(obfuscatedEmail);
}







function _alertClose() {
	$('#get-more-div').fadeOut(300);
}



function _successAlert(alertMessage1, alertMessage2) {
	$('#success-div').html('<div><i class="bi-check-all"></i></div> ' + alertMessage1 + '<br /><span>' + alertMessage2 + '</span>').fadeIn(500).delay(3000).fadeOut(100);
}

function _warningAlert(alertId, alertMessage1, alertMessage2) {
	$('#' + alertId).addClass('complain');
	$('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> ' + alertMessage1 + '<br /><span>' + alertMessage2 + '</span>').fadeIn(500).delay(3000).fadeOut(100);
}





function _nextPage(next_id) {
	if (next_id != '') {
		$('#nextPage1,#nextPage2,#nextPage3').hide();
		$('#' + next_id).fadeIn(1000);
	} else {
		// do nothing
	}
}

function _prevPage(next_id) {
	if (next_id != '') {
		$('#nextPage1,#nextPage2,#nextPage3').hide();
		$('#' + next_id).fadeIn(1000);
	} else {
		// do nothing
	}
}







// --------------- API'S FUNCTIONS -------------------------- //


function _getSelectDepartment(select_id, department_id) {
	var text = '<option value="" selected="selected">FETCHING DEPARTMENT... </option>';
	$('#' + select_id).html(text);
	var action = 'fetch-department';
	var dataString = 'department_id=' + department_id;
	$.ajax({
		type: "POST",
		url: endPoint + '/site/departments/' + action,
		data: dataString,
		dataType: 'json',
		cache: false,
		headers: {
			'apiKey': apiKey
		},
		success: function (info) {
			var success = info.success;
			var message = info.message;
			var getAllData = info.data;
			var text = '';
			var text = '<option value="">SELECT DEPARTMENT </option>';
			if (success == true) {
				for (var i = 0; i < getAllData.length; i++) {
					var department_id = getAllData[i].department_id;
					var department_name = getAllData[i].department_name;
					text += '<option value="' + department_id + '">' + department_name.toUpperCase() + '</option>';
				}
			} else {
				text = '<option>' + message + '</option>';
			}
			$('#' + select_id).html(text);
		}
	});
}





function _getSelectDepartmentClass(select_id, class_input) {
	var department_id = $('#' + select_id).val();

	var text = '<option value="">FETCHING CLASS...</option>';
	$('#' + class_input).html(text);

	var action = 'fetch-class-by-department';
	var dataString = 'department_id=' + department_id;
	$.ajax({
		type: "POST",
		url: endPoint + '/site/department-class-subject/' + action,
		data: dataString,
		dataType: 'json',
		cache: false,
		headers: {
			'apiKey': apiKey
		},
		success: function (info) {
			var success = info.success;
			var message = info.message;
			var getAllData = info.data;

			var text = '';
			var text = '<option selected value="" selected="selected">SELECT CLASS</option>';
			if (success == true) {
				for (var i = 0; i < getAllData.length; i++) {
					var class_id = getAllData[i].class_id;
					var class_name = getAllData[i].class_name;
					text += '<option value="' + class_id + '">' + class_name.toUpperCase() + '</option>';
				}
			} else {
				text = '<option>' + message + '</option>';
			}
			$('#' + class_input).html(text);
		}
	});
}






function _getSubscriptionAmount() {
	var action = 'fetch-settings';
	$.ajax({
		type: "POST",
		url: endPoint + '/site/settings/' + action,
		dataType: 'json',
		cache: false,
		headers: {
			'apiKey': apiKey
		},
		success: function (info) {
			var success = info.success;
			if (success == true) {
				var getAllData = info.data[0];
				$('#subcription_amount').html(getAllData.subcription_amount);
			} else {
				$('#subcription_amount').html('0.00');
			}
		}
	});
}



function _getUserReferralLink() {
	const currentUrl = window.location.href;
	const url = new URL(currentUrl);
	const referralCode = url.searchParams.get('ref');
	sessionStorage.setItem("userReferralIdSession", JSON.stringify(referralCode));
}


function _hiddenField() {
	var userReferralIdSession = JSON.parse(sessionStorage.getItem("userReferralIdSession"));
	if (userReferralIdSession) {
		$("#hidden-referral-code").html('');
	} else {
		$("#hidden-referral-code").show();
	}
}


function _inputSession(){
	if (userSignUpSession) {
		$('#reg_fullname').val(userSignUpSession.fullname);
		$('#reg_email').val(userSignUpSession.email);
		$('#reg_mobile_no').val(userSignUpSession.mobile_no);
	}
}


function _userSignUp(next_id) {
	var fullname = $("#reg_fullname").val();
	var email = $("#reg_email").val();
	var mobile_no = $("#reg_mobile_no").val();
	var department_id = $("#reg_department_id").val();
	var class_id = $("#reg_class_id").val();
	var create_password = $("#reg_create_password").val();
	var confirm_password = $("#reg_confirmed_password").val();
	var agent_referral_code = $("#agent_referral_code").val(); /// optional field

	$('#reg_fullname,#reg_email,#reg_mobile_no,#reg_department_id,#reg_class_id,#reg_create_password,#reg_confirmed_password').removeClass('complain');
	if (next_id == 'nextPage2') {
		if (fullname == '') {
			_warningAlert('reg_fullname', 'FULLNAME ERROR!', 'Fill this fields to continue.');

		} else if (email == '') {
			_warningAlert('reg_email', 'EMAIL ERROR!', 'Fill this fields to continue.');

		} else if ($("#reg_email").val().indexOf("@") <= 0) {
			_warningAlert('reg_email', 'INVALID EMAIL ADDRESS!', 'Check your email to continue.');

		} else if (mobile_no == '') {
			_warningAlert('reg_mobile_no', 'MOBILE NUMBER ERROR!', 'Fill this fields to continue.');

		} else if (!_isValidMobileNumber(mobile_no)) {
			_warningAlert('reg_mobile_no', 'INVALID PHONE NUMBER!', 'Fill valid phone number to continue');

		} else {
			const userSignUpSession = {
				fullname: fullname,
				email: email,
				mobile_no: mobile_no,
			};
			sessionStorage.setItem("userSignUpSession", JSON.stringify(userSignUpSession));
			$("#reg_fullname_info,#reg_fullname_info1").html(_capitalizeFirstLetterOfEachWord(fullname));
			$("#reg_email_info,#reg_email_info1").html(_obfuscateEmail(email, 10));
			_nextPage(next_id);
		}

	} else if (next_id == 'nextPage3') {
		if (department_id == '') {
			_warningAlert('reg_department_id', 'DEPARTMENT ERROR!', 'Select department to continue');

		} else if (class_id == '') {
			_warningAlert('reg_class_id', 'CLASS ERROR!', 'Select class to continue');

		} else {
			_nextPage(next_id);
		}

	} else if (next_id == 'signUp') {


		if (create_password == '') {
			_warningAlert('reg_create_password', 'PASSWORD ERROR!', 'Fill this field to continue');

		} else if (create_password != confirm_password) {
			$('#reg_create_password,#reg_confirmed_password').addClass('complain');
			_warningAlert(null, 'PASSWORD NOT MATCH!', 'Check your passwords to continue');

		} else {
			$('#reg_fullname,#reg_email,#reg_mobile_no,#reg_department_id,#reg_class_id,#reg_create_password,#reg_confirmed_password').removeClass('complain');
			_userProceedToPayment(fullname, email, mobile_no, department_id, class_id, create_password, confirm_password, agent_referral_code);
		}
	} else {
		/// do nothing
	}
}






function _userProceedToPayment(fullname, email, mobile_no, department_id, class_id, create_password, confirm_password, agent_referral_code) {
	var userReferralIdSession = JSON.parse(sessionStorage.getItem("userReferralIdSession"));
	if (userReferralIdSession){
		var referral_type = 'link';
		var referral_id = userReferralIdSession;
	}else{
		var referral_type = 'code';
		var referral_id = agent_referral_code;
	}
	//////////////// get btn text ////////////////
	var btn_text = $('#submit_btn').html();
	$('#submit_btn').html('<i class="fa fa-spinner fa-spin"></i>');
	document.getElementById('submit_btn').disabled = true;
	////////////////////////////////////////////////	
	var action = 'signup';
	var dataString = 'fullname=' + fullname + '&email=' + email + '&mobile_no=' + mobile_no + '&department_id=' + department_id + '&class_id=' + class_id + '&create_password=' + create_password + '&confirm_password=' + confirm_password + '&referral_type=' + referral_type + '&referral_id=' + referral_id;

	$.ajax({
		type: "POST",
		url: endPoint + '/user/auth/' + action,
		data: dataString,
		cache: false,
		dataType: 'json',
		cache: false,
		headers: {
			'apiKey': apiKey
		},
		success: function (data) {
			var success = data.success;
			var message = data.message;
			if (success == true) {
				var user_id = data.user_id;
				var access_key = data.access_key;
				var subscription_id = data.subscription_id;
				var transaction_id = data.transaction_id;
				var amount = data.amount;
				var email = data.email;
				var paystack_payment_key = data.paystack_payment_key;
				var referral_type = data.referral_type;
				var referral_id = data.referral_id;

				_payWithPaystack(user_id, fullname, mobile_no, access_key, subscription_id, transaction_id, email, amount, paystack_payment_key,referral_type, referral_id);
				_successAlert(_sliptResponse(message, '!'), null);

			} else {
				_warningAlert('reg_email', _sliptResponse(message, '!'), '');
				$('#submit_btn').html(btn_text);
				document.getElementById('submit_btn').disabled = false;
			}
		},
		error: function (error) {
			console.log(error);
			_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
			$('#submit_btn').html(btn_text);
			document.getElementById('submit_btn').disabled = false;
		}
	});
}


// --------------- END API'S FUNCTION -------------------------- //










////// CALL PAYSTACK ////////////////

function _payWithPaystack(user_id, fullname, mobile_no, access_key, subscription_id, transaction_id, email, amount, paystack_payment_key, referral_type, referral_id) {

	var handler = PaystackPop.setup({
		key: paystack_payment_key,
		email: email,
		amount: amount * 100, //amt in kobo
		ref: transaction_id,
		currency: 'NGN', // Use GHS for Ghana Cedis or USD for US Dollars
		metadata: {
			custom_fields: [
				{
					display_name: fullname,
					variable_name: "mobile_number",
					value: mobile_no
				}
			]
		},
		callback: function (response) { //success
			var stack_pay_ref = $.trim(response.reference);
			_callPaymentSuccess(access_key, user_id, email, transaction_id, subscription_id, amount, paystack_payment_key, referral_type, referral_id);
		},
		onClose: function () { //update to cancelled.
			_callPaymentCancelled(access_key);
			return false;
		}
	});
	handler.openIframe();
}



function _callPaymentSuccess(access_key, user_id, email, transaction_id, subscription_id, amount, paystack_payment_key, referral_type, referral_id) {
	var action = 'signup-complete';
	var dataString = 'user_id=' + user_id + '&email=' + email + '&transaction_id=' + transaction_id + '&subscription_id=' + subscription_id + '&amount=' + amount + '&paystack_payment_key=' + paystack_payment_key + '&referral_type=' + referral_type + '&referral_id=' + referral_id;
	$.ajax({
		type: "POST",
		url: endPoint + '/user/auth/' + action,
		data: dataString,
		cache: false,
		dataType: 'json',
		cache: false,
		headers: {
			'apiKey': apiKey,
			'Authorization': 'Bearer ' + access_key
		},
		success: function (info) {
			var success = info.success;
			var message = info.message;

			if (success == true) {
				sessionStorage.setItem("userSignUpSession", JSON.stringify(''));
				sessionStorage.setItem("loginUserInfoSession", JSON.stringify(info));

				_successAlert(_sliptResponse(message, '!'), null);
				window.parent((location = user_portal_url));
			} else {
				_warningAlert(null, _sliptResponse(message, '!'), '');
			}

		}
	});
}




function _callPaymentCancelled(access_key) {
	var action = 'signup-cancelled';
	$.ajax({
		type: "POST",
		url: endPoint + '/user/auth/' + action,
		cache: false,
		dataType: 'json',
		cache: false,
		headers: {
			'apiKey': apiKey,
			'Authorization': 'Bearer ' + access_key
		},
		success: function (data) {
			var success = data.success;
			var message = data.message;
			if (success == true) {
				_successAlert(message, '');
				$('#submit_btn').html('<i class="bi bi-credit-card"></i> PROCEED');
				document.getElementById('submit_btn').disabled = false;
			} else {
				_warningAlert(null, _sliptResponse(message, '!'), '');
			}

		}
	});
}

////////////////////// END PAYSTACK /////////////////////////////

