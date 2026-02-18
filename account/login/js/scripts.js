
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
	$("#view_login").keydown(function (e) {
		if (e.keyCode == 13) {
			_logIn();
		}
	});

	$("#procced_reset_password_info").keydown(function (e) {
		if (e.keyCode == 13) {
			_proceedResetPassword();
		}
	});
});



function _alertClose2(next_id, divid) {
	$('#get-more-div').fadeOut(300);
	_nextPage(next_id, divid);
}





// --------------- START CONSTANT FUNCTIONS --------------------------- //

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



function _showPasswordVisibility(ids, toggle_pass) {
	var password = $('#' + ids).val();
	if (password != '') {
		$('#' + toggle_pass).show();
	} else {
		$('#' + toggle_pass).hide();
	}
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



function _successAlert(alertMessage1, alertMessage2) {
	$('#success-div').html('<div><i class="bi-check-all"></i></div> ' + alertMessage1 + '<br /><span>' + alertMessage2 + '</span>').fadeIn(500).delay(4000).fadeOut(100);
}

function _warningAlert(alertId, alertMessage1, alertMessage2) {
	$('#' + alertId).addClass('complain');
	$('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> ' + alertMessage1 + '<br /><span>' + alertMessage2 + '</span>').fadeIn(500).delay(4000).fadeOut(100);
}


function _sliptResponse(response, splitSign) {
	// Split the response at '!'
	var splitResponse = response.split(splitSign);
	// Trim the whitespace from the first part and append it with a newline character
	var firstPart = splitResponse[0].trim() + '\n';
	// Join the first part with the second part
	var formattedResponse = firstPart + splitResponse[1];
	return formattedResponse
}

function _isValidMobileNumber(number) {
	// Regular expression to match a typical mobile phone number format
	var regex = /^\d+$/;
	return regex.test(number);
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


function _obfuscateEmail(email, visibleChars) {
	// Split the email into username and domain
	const [username, domain] = email.split('@');
	// Calculate the number of asterisks to replace in the username
	const numAsterisks = Math.max(0, username.length - visibleChars);
	// Obfuscate the username by replacing characters with asterisks
	const obfuscatedUsername = username.substring(0, visibleChars) + '*'.repeat(numAsterisks);
	// Combine the obfuscated username and the domain to form the obfuscated email
	const obfuscatedEmail = `${obfuscatedUsername}@${domain}`;
	$('#useremail').html(obfuscatedEmail);
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



function _checkPasswordMatch(ids, toggle_pass) {
	var create_password = $("#create_reset_password").val();
	var confirmed_password = $("#confirmed_reset_password").val();
	if ((create_password != confirmed_password) && (confirmed_password != '')) {
		$('#message').show();
		$('#create_reset_password,#confirmed_reset_password').css('border', '#F00 1px solid');
	} else {
		$('#message').hide();
		$('#create_reset_password,#confirmed_reset_password').css('border', 'rgba(0, 0, 0, .1) 1px solid');

	}
	_showPasswordVisibility(ids, toggle_pass);
}

function _checkResetPasswordMatch(ids, toggle_pass) {
	var create_password = $("#reset_create_password").val();
	var confirmed_password = $("#reset_confirmed_password").val();
	if ((create_password != confirmed_password) && (confirmed_password != '')) {
		$('#message').show();
	} else {
		$('#message').hide();
	}
	_showPasswordVisibility(ids, toggle_pass);
}


function _nextPage(next_id, divid) {
	$('#view_login,#procced_reset_password_info').hide();
	$('#' + next_id).fadeIn(1000);
	$('#page-title').html($('#' + divid).html());
}


function _alertClose() {
	$('#get-more-div').fadeOut(300);
}


function _alert_close2(next_id, divid) {
	$('#get-more-div').fadeOut(300);
	_nextPage(next_id, divid);
}


function _getPage(page) {
	if (page == '') {
		// do nothing
	} else {
		$('#get-more-div').html('<div class="ajax-loader"><img src="' + website_url + '/account/login/all-images/images/ajax-loader.gif"/></div>').fadeIn('fast');
		var action = 'get_page';
		var dataString = 'action=' + action + '&page=' + page;
		$.ajax({
			type: "POST",
			url: user_login_local_url,
			data: dataString,
			cache: false,
			success: function (html) {
				$('#get-more-div').html(html);
			},
			error: function (error) {
				console.log(error);
				_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
			}
		});
	}
}


function _getPageWithId(page, verify_user_fullname, verify_user_email) {
	if (page == '') {
		// do nothing
	} else {
		var action = 'get_page_with_id';
		var dataString = 'action=' + action + '&page=' + page;
		$.ajax({
			type: "POST",
			url: user_login_local_url,
			data: dataString,
			cache: false,
			success: function (html) {
				$('#get_page_id').html(html);
				$('#verify_user_fullname').html(verify_user_fullname);
				$('#verify_user_email').html(verify_user_email);
			},
			error: function (error) {
				console.log(error);
				_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
			}
		});
	}
}


function _getForm(page) {
	if (page == '') {
		// do nothing
	} else {
		$('#get-more-div').html('<div class="ajax-loader"><img src="' + website_url + '/account/login/all-images/images/ajax-loader.gif"/></div>').fadeIn('fast');
		var action = 'get-form';
		var dataString = 'action=' + action + '&page=' + page;
		$.ajax({
			type: "POST",
			url: user_login_local_url,
			data: dataString,
			cache: false,
			success: function (html) {
				$('#get-more-div').html(html);
			},
			error: function (error) {
				console.log(error);
				_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
			}
		});
	}
}




// --------------- END CONSTANT FUNCTIONS --------------------------- //











// --------------- API'S FUNCTIONS --------------------------- //




//////////// LOGIN ////////////
function _logIn() {
	var username = $('#email').val();
	var password = $('#password').val();
	$('#email,#password').removeClass('complain');

	if ((username != '') && (password != '')) {
		if (username.indexOf("@") <= 0) {
			_warningAlert('email', 'INVALID EMAIL ADDRESS', 'Kindly, check your email and try again');
		} else {
			_getUserLoginData(username, password);
		}
	} else {
		$('#email,#password').addClass('complain');
		_warningAlert(null, 'ERROR!', 'Fill all fields to continue');
	}
};



///////////////////// user login /////////////////////
function _getUserLoginData(username, password) {
	/////////////// get btn text ////////////////
	var btn_text = $('#login_btn').html();
	$('#login_btn').html('<i class="fa fa-spinner fa-spin"></i> Authenticating...');
	document.getElementById('login_btn').disabled = true;
	////////////////////////////////////////////////	
	var action = 'login';
	var dataString = 'username=' + username + '&password=' + password;

	$.ajax({
		type: "POST",
		url: endPoint + '/user/auth/' + action,
		dataType: 'json',
		data: dataString,
		cache: false,
		headers: {
			'apiKey': apiKey
		},
		success: function (info) {
			var success = info.success;
			var message = info.message;
			if (success == true) {
				sessionStorage.setItem("loginUserInfoSession", JSON.stringify(info));
				_successAlert(_sliptResponse(message, '!'), '');
				window.parent((location = user_portal_url));
			} else {
				_warningAlert(null, _sliptResponse(message, '!'), '');
				$('#login_btn').html(btn_text);
				document.getElementById('login_btn').disabled = false;
			}
		},
		error: function (error) {
			console.log(error);
			_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
			$('#login_btn').html(btn_text);
			document.getElementById('login_btn').disabled = false;
		}
	});
}








function _proceedResetPassword() {
	var email = $('#reset_pass_email').val();

	$('#reset_pass_email').removeClass('complain');
	if (email == '') {
		_warningAlert('reset_pass_email', 'EMAIL ERROR!', 'Fill this fields to continue');

	} else if ($("#reset_pass_email").val().indexOf("@") <= 0) {
		_warningAlert('reset_pass_email', 'INVALID EMAIL ADDRESS!', 'Kindly, check your email and try again');

	} else {
		if (userResetPasswordSession) {
			$('#reset_pass_email').val(email);
		}
		//////////////// get btn text ////////////////
		var btn_text = $('#reset_password_btn').html();
		$('#reset_password_btn').html('<i class="fa fa-spinner fa-spin"></i> Processing...');
		document.getElementById('reset_password_btn').disabled = true;
		////////////////////////////////////////////////	
		var action = 'reset-password';
		var dataString = 'email=' + email;
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
			success: function (info) {
				var success = info.success;
				var message = info.message;
				if (success == true) {
					sessionStorage.setItem("userResetPasswordSession", JSON.stringify(info));
					_successAlert(_sliptResponse(message, '!'), '');
					_resetPassword();
				} else {
					_warningAlert('reset_pass_email', _sliptResponse(message, '!'), '');
					$('#reset_password_btn').html(btn_text);
					document.getElementById('reset_password_btn').disabled = false;
				}
			},
			error: function (error) {
				console.log(error);
				_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
				$('#reset_password_btn').html(btn_text);
				document.getElementById('reset_password_btn').disabled = false;
			}
		});
	}
}



function _resetPassword() {
	let getUserDataDetails = JSON.parse(sessionStorage.getItem("userResetPasswordSession"));
	if (getUserDataDetails) {
		$('#get-more-div').html('<div class="ajax-loader"><img src="' + website_url + '/account/login/all-images/images/ajax-loader.gif"/></div>').fadeIn('fast');
		var action = 'reset_password';
		var dataString = 'action=' + action;
		$.ajax({
			type: "POST",
			url: user_login_local_url,
			data: dataString,
			cache: false,
			success: function (html) {
				$('#get-more-div').html(html);
				$('#username').html(_capitalizeFirstLetterOfEachWord(getUserDataDetails.fullname));
				$('#useremail').html(_obfuscateEmail(getUserDataDetails.email, 10));
				$('#reset_password_btn').html('Proceed <i class="bi-arrow-right"></i>');
				document.getElementById('reset_password_btn').disabled = false;
			}
		});
	} else {
		// do nothing
	}
}











function _resendOtp(ids) {
	let getUserDataDetails = JSON.parse(sessionStorage.getItem("userResetPasswordSession"));
	var user_id = getUserDataDetails.user_id;

	var btn_text = $('#' + ids).html();
	$('#' + ids).html('SENDING <i class="fa fa-spinner fa-spin"></i>');

	var action = 'resend-otp';
	var dataString = 'user_id=' + user_id;
	$.ajax({
		type: "POST",
		url: endPoint + '/user/auth/' + action,
		data: dataString,
		cache: false,
		headers: {
			'apiKey': apiKey
		},
		success: function (data) {
			var success = data.success;
			var message = data.message;
			if (success == true) {
				_successAlert(_sliptResponse(message, '!'), '');
			} else {
				_warningAlert(null, _sliptResponse(message, '!'), '');
			}
			$('#' + ids).html(btn_text);
		},
		error: function (error) {
			console.log(error);
			_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
			$('#' + ids).html(btn_text);
			document.getElementById('reset_password_btn').disabled = false;
		}
	});
}







function _completeResetPassword() {
	let getUserDataDetails = JSON.parse(sessionStorage.getItem("userResetPasswordSession"));
	var user_id = getUserDataDetails.user_id;

	var otp = $('#reset_password_otp').val();
	var password = $('#create_reset_password').val();
	var confirm_password = $('#confirmed_reset_password').val();

	$("#reset_password_otp,#create_reset_password,#confirmed_reset_password").removeClass("complain");
	if (otp == "") {
		_warningAlert('reset_password_otp', 'OTP ERROR!', 'Fill this fields to continue');

	} else if (!_isValidMobileNumber(otp)) {
		_warningAlert('reset_password_otp', 'INVALID OTP', 'Fill valid otp sent to your mail');

	} else if (password == "") {
		_warningAlert('create_reset_password', 'CREATE PASSWORD ERROR!', 'Fill this fields to continue');

	} else if (confirm_password == "") {
		_warningAlert('confirmed_reset_password', 'CONFIRMED PASSWORD ERROR!', 'Fill this fields to continue');

	} else if (password != confirm_password) {
		$("#create_reset_password,#confirmed_reset_password").addClass("complain");
		_warningAlert(null, 'PASSWORD ERROR!', 'Password not match. Try again');

	} else {

		$('#reset_password_otp,#create_reset_password,#confirmed_reset_password').removeClass('complain');
		//////////////// get btn text ////////////////
		var btn_text = $('#comfirmed_reset_btn').html();
		$('#comfirmed_reset_btn').html('Resetting <i class="fa fa-spinner fa-spin"></i>');
		document.getElementById('comfirmed_reset_btn').disabled = true;
		////////////////////////////////////////////////	
		var action = 'create-new-password';
		var dataString = 'user_id=' + user_id + '&otp=' + otp + '&password=' + password + '&confirm_password=' + confirm_password;
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
					_getPage('password_reset_successful');
					sessionStorage.removeItem("userResetPasswordSession");
					$('#reset_pass_email').val('');
				} else {
					_warningAlert('reset_password_otp', _sliptResponse(message, '!'), '');
					$('#comfirmed_reset_btn').html(btn_text);
					document.getElementById('comfirmed_reset_btn').disabled = false;
				}
			},
			error: function (error) {
				console.log(error);
				_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
				$('#comfirmed_reset_btn').html(btn_text);
				document.getElementById('comfirmed_reset_btn').disabled = false;
			}
		});
	}
}





// --------------- END API'S FUNCTIONS --------------------------- //


