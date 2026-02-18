function _logOut() {
	sessionStorage.removeItem("loginUserInfoSession");
	window.parent.location.href = website_url + "/account/login/";
}



let timerInterval; // Global timer reference
let isTimerRunning = false; // Track timer state
function _getTimeCountDown() {
    const cbtSummaryDetails = JSON.parse(sessionStorage.getItem("cbtSummaryDetails")) || { quiz_duration: "00:30:00" };
    const quizDuration = cbtSummaryDetails.quiz_duration;

    function parseDuration(duration) {
        const [hours, minutes, seconds] = duration.split(":").map(Number);
        return (hours * 3600) + (minutes * 60) + seconds;
    }

    remainingTimeGlobal = parseDuration(quizDuration);
    const $timeDisplay = $("#detailTime");

    function formatTime(seconds) {
        const hours = String(Math.floor(seconds / 3600)).padStart(2, "0");
        const minutes = String(Math.floor((seconds % 3600) / 60)).padStart(2, "0");
        const secs = String(seconds % 60).padStart(2, "0");
        return `${hours}:${minutes}:${secs}`;
    }

    function updateTimer() {
        if (remainingTimeGlobal > 0) {
            remainingTimeGlobal--;
            $timeDisplay.text(formatTime(remainingTimeGlobal));
            sessionStorage.setItem("getCurrentTime", JSON.stringify(formatTime(remainingTimeGlobal)));
        } else {
            stopTimer();
            _getPageCbt('cbt_statistics', '');
        }
    }

    function stopTimer() {
        clearInterval(timerInterval);
        timerInterval = null; // Ensure it's reset
        isTimerRunning = false; // Mark timer as stopped
        $timeDisplay.text("00:00:00");
        sessionStorage.removeItem("getCurrentTime");
    }

    // Store stopTimer globally to allow stopping externally
    window.stopTimer = stopTimer;

    $timeDisplay.text(formatTime(remainingTimeGlobal));
    timerInterval = setInterval(updateTimer, 1000);
    isTimerRunning = true; // Mark timer as running
}






///// Right Click Disabled Function ////////
function _disabledInspect() {
	// Disable right-click on the entire document
	document.addEventListener('contextmenu', function (e) {
		e.preventDefault();
	});

	// Disable Ctrl+S
	document.addEventListener('keydown', function (e) {
		if ((e.ctrlKey || e.metaKey) && e.key === 's') {
			e.preventDefault();
		}
	});
}

function _numberWithComma(amount) {
	return amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
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
	const passwordInput = document.getElementById(ids);
	const togglePasswordIcon = document.getElementById(toggle_pass);

	if (passwordInput.type === 'password') {
		passwordInput.type = 'text';
		togglePasswordIcon.innerHTML = '<i class="bi-eye password-toggle"></i>';
	} else {
		passwordInput.type = 'password';
		togglePasswordIcon.innerHTML = '<i class="bi-eye-slash password-toggle"></i>';
	}
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


function _toggleProfilePixDiv() {
	$('.toggle-profile-div').toggle('slow');
}

function _toggleCbtQuestionNumbers(cbtNumIcon) {
    const togglePasswordIcon = $('#' + cbtNumIcon);
    $('.mobile-cbt-num-btns-container').toggle('slow');

    // Toggle the icon
    if (togglePasswordIcon.html().includes('bi-three-dots')) {
        togglePasswordIcon.html('<i class="bi bi-x"></i>');
    } else {
        togglePasswordIcon.html('<i class="bi bi-three-dots"></i>');
    }
}


function select_search() {
	$(".srch-select").show();
}

function close_search() {
	$("#srch-select").slideToggle("fast");
	$('#mobile-datepicker-from').val('');
	$('#mobile-datepicker-to').val('');
}
function _openMenu() {
	$('.sidenavdiv, .sidenavdiv-in').animate({ 'margin-left': '0' }, 200);
	$('#menu-list-div').animate({ 'margin-left': '0' }, 300);
	$('#live-chat-div').animate({ 'margin-left': '-100%' }, 400);
}

function _closeSideNav() {
	$('#menu-list-div,#live-chat-div').animate({ 'margin-left': '-100%' }, 300);
	$('.sidenavdiv, .sidenavdiv-in').animate({ 'margin-left': '-100%' }, 200);
}


function _nextPage(next_id, icon, divid) {
	$('#account_settings_id,#account_detail,#channge_password').hide();
	$('#' + next_id).fadeIn(1000);
	$('#panel-title').html($('#' + icon).html() + $('#' + divid).html());
}
function _prevPage(next_id) {
	$('#account_settings_id,#account_detail,#channge_password').hide();
	$('#' + next_id).fadeIn(1000);
	$('#panel-title').html('<i class="bi-gear"></i> </span id="app_text"> APP SETTINGS')
}

function _alertClose() {
	if (isTimerRunning){
		stopTimer();
		sessionStorage.removeItem("cbtSummaryDetails");
		$('#get-more-div').fadeOut(300);
	}else{
		sessionStorage.removeItem("cbtSummaryDetails");
		$('#get-more-div').fadeOut(300);
	}
}

function _alertClose2() {
	$('#video_subscription_detail_page').html('');
	$('#get-more-div').fadeOut(300);
}


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



function _checkedOption(questions, currentQuestionIndex, selectedOption) {
	// Ensure only one option can be selected
	$(".checkfield").change(function () {
		const selectedValue = parseInt($(this).val());
		questions[currentQuestionIndex].selectedOption = selectedValue;
	});
}


function _numberWithComma(amount) {
	return amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}


function _isValidMobileNumber(number) {
	// Regular expression to match a typical mobile phone number format
	var regex = /^\d+$/;
	return regex.test(number);
}


function _pauseVideo() {
	var videoDisplay = document.getElementById('videoDisplay');
	videoDisplay.src = '';  // Set the source to an empty string to stop the video
	videoDisplay.muted = true;  // Mute the audio
}

function _copyText() {
	var textToCopy = $("#user_referral_link").text(); // Get the text to copy
	navigator.clipboard.writeText(textToCopy); // Copy text to clipboard
	// Change icon to check mark for feedback
	$("#copyText").html('<span style="font-size: 11px">copied</span> <i class="bi bi-check"></i>');
	// Revert back to clipboard icon after 4 seconds
	setTimeout(function () {
		$("#copyText").html('<i class="bi bi-clipboard"></i> copy');
	}, 3000);
}


function _getActiveLink(divid) {
	$('#dashboard, #subjects, #terminal_exam,  #external_exam,  #academic_report, #transactions, #subscription_history, #myprofile').removeClass('active-li');
	$('#_dashboard').removeClass('active-li');
	$('#mobile-dashboard, #mobile-subjects, #mobile-terminal-exam, #mobile-external-exam,  #mobile-academic-report, #mobile-transactions-history, #mobile-subscription-history').removeClass('active-li');
	$('#mobile2-dashboard, #mobile2-subjects, #mobile2-myprofile').removeClass('active-li');
	$('#' + divid).addClass('active-li');
	$('#_' + divid).addClass('active-li');
	$('#mobile-' + divid).addClass('active-li');
	$('#mobile2-' + divid).addClass('active-li');
	$('#page-title').html($('#' + divid).html());
}



function _collapse(div_id) {
	var x = document.getElementById(div_id + "num");
	if (x.innerHTML === '&nbsp;<i class="bi-chevron-down"></i>&nbsp;') {
		x.innerHTML = '&nbsp;<i class="bi-chevron-up"></i>&nbsp;';
	} else {
		x.innerHTML = '&nbsp;<i class="bi-chevron-down"></i>&nbsp;';
	}
	$('#' + div_id + 'answer').slideToggle('slow');
}




function _collapseCbt(div_id) {
	// Close other answers and reset icons
	$(".faq-answer-div").not("#" + div_id + "answer").slideUp("slow");
	$(".expand-div").not("#" + div_id + "num").html('&nbsp;<i class="bi-plus"></i>&nbsp;');
	$(".cbt-statistic-container").css("background-color", "var(--white-color)"); // Remove active class from all

	var $icon = $("#" + div_id + "num");
	var $answer = $("#" + div_id + "answer");
	var $container = $("#cbt-statistic-container-" + div_id);

	if ($answer.is(":visible")) {
		$icon.html('&nbsp;<i class="bi-plus"></i>&nbsp;'); // Collapse
		$answer.slideUp("slow");
		$container.css("background-color", "var(--white-color)");
	} else {
		$icon.html('&nbsp;<i class="bi-dash"></i>&nbsp;'); // Expand
		$answer.slideDown("slow");
		$container.css("background-color", "var(--subbg-color)");
	}
}


function _getToggleOpen() {
	// Ensure the first FAQ is open on page load
	$(document).ready(function () {
		var firstFaqId = $(".faq-title-text .expand-div").first().attr("id"); // Get first FAQ ID
		if (firstFaqId) {
			_collapseCbt(firstFaqId.replace("num", "")); // Trigger the collapse function for the first FAQ
		}
	});
}









function _getPage(page, divid) {
	sessionStorage.removeItem("cbtSummaryDetails");
	if (page == '') {
		// do nothing
	} else {
		_getActiveLink(divid);
		$('#page-content').html('<div class="ajax-loader"><img src="' + website_url + '/account/all-images/images/ajax-loader.gif"/></div>').fadeIn('fast');
		var action = 'get_page';
		var dataString = 'action=' + action + '&page=' + page;
		$.ajax({
			type: "POST",
			url: user_local_portal_url,
			data: dataString,
			cache: false,
			success: function (html) {
				$('#page-content').html(html);
				if (page == 'transactions') {
					_getFetchAllTransactionsHistory(page);
				} else if (page == 'subscription_history') {
					_getFetchAllSubscriptionHistory(page);
				} else {
					// do nothing
				}
			},
			error: function (error) {
				console.log(error);
				_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
			}
		});
	}

}


function _getPageWithId(page, ids1, ids2) {
	sessionStorage.removeItem("cbtSummaryDetails");
	if (page == '') {
		// do nothing
	} else {

		$('#page-content').html('<div class="ajax-loader"><img src="' + website_url + '/account/all-images/images/ajax-loader.gif"/></div>').fadeIn('fast');
		var action = 'get_page';
		var dataString = 'action=' + action + '&page=' + page;
		$.ajax({
			type: "POST",
			url: user_local_portal_url,
			data: dataString,
			cache: false,
			success: function (html) {
				$('#page-content').html(html);
				if (page == 'video_page') {
					_getFetchDepartmentClassSubjectWeeks(ids1, ids2);
				} else {
					// do nothing
				}
			},
			error: function (error) {
				console.log(error);
				_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
			}
		});
	}

}




function _getForm(page) {
	sessionStorage.removeItem("cbtSummaryDetails");
	if (page == '') {
		// do nothing
	} else {
		$('#get-more-div').html('<div class="ajax-loader3"><img src="' + website_url + '/account/all-images/images/ajax-loader.gif"/></div>').fadeIn('fast');
		var action = 'get_form';
		var dataString = 'action=' + action + '&page=' + page;
		$.ajax({
			type: "POST",
			url: user_local_portal_url,
			data: dataString,
			cache: false,
			success: function (html) {
				$('#get-more-div').html(html);
				if (page == 'user_subcription') {
					_getSelectDepartment('sub_department_id', '');
					_getSubscriptionAmount();
					_getPaymentMethod();
				}
			},
			error: function (error) {
				console.log(error);
				_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
			}
		});
	}
}


function _getFormWithId(page, ids) {
	sessionStorage.removeItem("cbtSummaryDetails");
	if (page == '') {
		// do nothing
	} else {
		$('#get-more-div').html('<div class="ajax-loader3"><img src="' + website_url + '/account/all-images/images/ajax-loader.gif"/></div>').fadeIn('fast');
		var action = 'get_form_with_id';
		var dataString = 'action=' + action + '&page=' + page + '&ids=' + ids;
		$.ajax({
			type: "POST",
			url: user_local_portal_url,
			data: dataString,
			cache: false,
			success: function (html) {
				$('#get-more-div').html(html);
				if (page == 'transaction_form_details') {
					_getFetchEachTransactionsHistory(page, ids);
				} else if (page == 'subcription_form_details') {
					_getFetchEachSubscriptionHistory(page);
				} else if (page == 'cbt_summary_details') {
					_getCbtSummaryDetails(page, ids);
				} else {
					// do nothing
				}
			},
			error: function (error) {
				console.log(error);
				_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
			}
		});
	}
}







function _getPageCbt(page, ids) {
	if (page == '') {
		// do nothing
	} else {
				$('#cbt-details-id').html('<div class="ajax-loader" style="margin:100px auto 0px auto"><img src="' + website_url + '/all-images/images/ajax-loader.gif"/></div>').fadeIn('fast');
		var action = 'get_form';
		var dataString = 'action=' + action + '&page=' + page;
		$.ajax({
			type: "POST",
			url: user_local_portal_url,
			data: dataString,
			cache: false,
			success: function (html) {
				$('#cbt-details-id').html(html);
				if (page == 'cbt_quiz') {
					_startCbt(ids);
					//_cbtQuestion();
				} else if (page == 'cbt_statistics') {
					_getToggleOpen();
					_finishQuiz();
				} else if (page == 'cbt_correction_quiz') {
					$('#cbt-header-title').html('CBT CORRECTION');
					let loginUserInfoSession = JSON.parse(sessionStorage.getItem("loginUserInfoSession"));
					$('#user_fullname').html(_capitalizeFirstLetterOfEachWord(loginUserInfoSession.user[0].fullname));
					_cbtCorrectionQuiz(ids);
				} else {

				}

			},
			error: function (error) {
				console.log(error);
				_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
			}
		});
	}

}





///// accept number ////
function _isNumberCheck() {
	var e = window.event;
	var key = e.keyCode && e.which;

	//// noit accpet zero(0) as first input ////
	$("#wallet_amount").on("input", function () {
		var val = $(this).val()
		var reg = /^0/gi;
		if (val.match(reg)) {
			$(this).val(val.replace(reg, ''));
			$('#wallet_amount').css('border', '#F00 1px solid');
		}
	});
	//// accept number only
	if (!((key >= 48) && (key <= 57) || (key == 43) || (key == 45))) {
		if (e.preventDefault) {
			e.preventDefault();
			$('#amount_info,#verify_mobile_info').fadeIn(300);
			$('#wallet_amount').css('border', '#F00 1px solid');
			$('#mobile').css('border', '#F00 1px solid');
		} else {
			e.returnValue = false;
		}
	} else {
		//// amount with comma
		$('#wallet_amount').on("input", function (event) {
			// skip for arrow keys
			if (event.which >= 37 && event.which <= 40) return;
			// format number
			$(this).val(function (index, value) {
				return value
					.replace(/\D/g, "")
					.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
			});
		});
		$('#amount_info,#verify_mobile_info').hide();
		$('#wallet_amount').css('border', '#CCC 1px solid');
		$('#mobile').css('border', '#CCC 1px solid');

	}
}







function _successAlert(alertMessage1, alertMessage2) {
	$('#success-div').html('<div><i class="bi-check-all"></i></div> ' + alertMessage1 + '<br /><span>' + alertMessage2 + '</span>').fadeIn(500).delay(4000).fadeOut(100);
}

function _warningAlert(alertId, alertMessage1, alertMessage2) {
	$('#' + alertId).addClass('complain');
	$('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> ' + alertMessage1 + '<br /><span>' + alertMessage2 + '</span>').fadeIn(500).delay(4000).fadeOut(100);
}



function _getFetchUserPix(login_user_documentStoragePath, login_user_profile_pix, login_user_fullname) {
	profile_login_pix =
		'<img id="profile_pix" src="' + login_user_documentStoragePath + '/' + login_user_profile_pix + '" alt="' + login_user_fullname + ' Profile pix"/>' +
		'<img id="header_pix" src="' + login_user_documentStoragePath + '/' + login_user_profile_pix + '" alt="' + login_user_fullname + ' Profile pix" />' +
		'<img id="option_pix" src="' + login_user_documentStoragePath + '/' + login_user_profile_pix + '" alt="' + login_user_fullname + ' Profile pix" />' +
		'<img id="welcome_pix" src="' + login_user_documentStoragePath + '/' + login_user_profile_pix + '" alt="' + login_user_fullname + ' Profile pix" />'
	'<img id="side_user_pix" src="' + login_user_documentStoragePath + '/' + login_user_profile_pix + '" alt="' + login_user_fullname + ' Profile pix" />'

	$('#profile_pix,#header_pix,#option_pix,#welcome_pix,#side_user_pix').html(profile_login_pix);
}






function _hideAndShowWallet() {
	var user_wallet_balance = document.getElementById("user_wallet_balance");
	var user_mobile_wallet_balance = document.getElementById("user_mobile_wallet_balance");

	if ((user_wallet_balance.style.display === 'none') || (user_mobile_wallet_balance.style.display === 'none')) {
		////////////////////////////////////////////?
		$('#user_wallet_balance,#user_mobile_wallet_balance').css("display", "inline");
		$("#text_in,#mobile_text_in").html('');
		$("#hide_show,#mobile_hide_show").html('<i class="bi-eye"></i>');
		// ////////////////////////////////////////////			
	} else {
		$("#text_in,#mobile_text_in").html('****');
		$("#hide_show,#mobile_hide_show").html('<i class="bi-eye-slash"></i>');
		$('#user_wallet_balance,#user_mobile_wallet_balance').css("display", "none");
	}
}





function _getUserLoginDetails(page) {
	let loginUserInfoSession = JSON.parse(sessionStorage.getItem("loginUserInfoSession"));

	//----------- USER LOGIN SESSION DETAILS -------------- //
	var login_user_fullname = loginUserInfoSession.user[0].fullname;
	var login_user_email = loginUserInfoSession.user[0].email;
	var login_user_mobile_no = loginUserInfoSession.user[0].mobile_no;
	var login_user_wallet_balance = loginUserInfoSession.user[0].wallet_balance;

	var login_user_status_name = loginUserInfoSession.user[0].status_name;
	var referral_link = loginUserInfoSession.user[0].referral_link;
	var online_user_referral_link = referral_link + login_user_id;

	//var local_user_referral_link = 'http://localhost/projects/leaderstutors.com/account/sign-up/?ref='+ login_user_id;

	var login_user_profile_pix = loginUserInfoSession.user[0].profile_pix;
	var login_user_documentStoragePath = loginUserInfoSession.user[0].documentStoragePath;
	var login_user_created_time = loginUserInfoSession.user[0].created_time;
	var login_user_updated_time = loginUserInfoSession.user[0].updated_time;
	var user_last_login_time = loginUserInfoSession.user[0].last_login_time;



	if (loginUserInfoSession.subscription.length > 0) {
		//----------- USER LOGIN SUBCRIPTIONS SESSION DETAILS -------------- //
		var department_name = loginUserInfoSession.subscription[0].department_name;
		var class_name = loginUserInfoSession.subscription[0].class_name;

		// get current date and time
		var todays_date = loginUserInfoSession.subscription[0].todays_date;
		var current_date = new Date(todays_date);
		// get subcription start date
		var subscription_start_date = loginUserInfoSession.subscription[0].subscription_start_date;
		// get subcription end date
		var subscription_end_date = loginUserInfoSession.subscription[0].subscription_end_date;
		var endDate = new Date(subscription_end_date);
		//var days = endDate.getTime() - startDate.getTime();
		var days = endDate.getTime() - current_date.getTime();
		var getRemainingDays = Math.ceil(days / (1000 * 60 * 60 * 24));

	}


	if (page == 'dashboard') {
		$('#login_user_fullname,#profile_name,#user_wallet_name,#side_fullname').html(_capitalizeFirstLetterOfEachWord(login_user_fullname));
		$('#user_id,#side_user_id').html(login_user_id);
		$('#user_mobile').html(login_user_mobile_no);
		$('#user_wallet_balance,#user_mobile_wallet_balance').html(_numberWithComma(login_user_wallet_balance));
		_getFetchUserPix(login_user_documentStoragePath, login_user_profile_pix, login_user_fullname);
		$('#login_user_login_time').html(user_last_login_time);
		$('#get_user_remaining_expires_days').html(getRemainingDays);

	} else if (page == 'user_profile') {
		$('#user_department_name').html(department_name);
		$('#user_class_name').html(class_name);
		$('#user_subscription_start_date').html(subscription_start_date);
		$('#user_subscription_end_date').html(subscription_end_date);


		$('#user_referral_link').html(online_user_referral_link);
		$('#user_status_name').html(login_user_status_name);
		$('#user_wallet_ballance,#user_mobile_wallet_balance').html(_numberWithComma(login_user_wallet_balance));
		$('#user_registration_date').html(login_user_created_time);
		$('#user_profile_updated_date').html(login_user_updated_time);
		$('#user_last_login_date').html(user_last_login_time);


		$('#fullname').val(login_user_fullname);
		$('#email').val(login_user_email);
		$('#mobile').val(login_user_mobile_no);
		_getFetchUserPix(login_user_documentStoragePath, login_user_profile_pix, login_user_fullname);
	} else if (page == 'load_user_wallet') {
		$('#user_wallet_name').html(_capitalizeFirstLetterOfEachWord(login_user_fullname));

	} else if (page == 'load_user_wallet_success') {
		$('#user_load_wallet_name').html(_capitalizeFirstLetterOfEachWord(login_user_fullname));
		$('#user_wallet_ballance,#user_mobile_wallet_balance').html(_numberWithComma(login_user_wallet_balance));

	} else if (page == 'user_subcription') {
		$('#user_subscription_name').html(_capitalizeFirstLetterOfEachWord(login_user_fullname));

	} else if (page == 'user_subcription_success') {
		$('#user_wallet_ballance,#user_mobile_wallet_balance').html(_numberWithComma(login_user_wallet_balance));
		$('#user_subscription_name').html(_capitalizeFirstLetterOfEachWord(login_user_fullname));
		$('#user_sub_department_name').html(department_name);
		$('#user_sub_class_name').html(class_name);

	} else {

	}

}




function _getFetchDepartmentClassSubject() {
	$('#fetch_department_class_subject_details').html('<div class="ajax-loader2"><br clear="all"/> Loading... <br clear="all"/><img src="' + website_url + '/account/all-images/images/ajax-loader2.gif"/></div>').fadeIn('fast');
	var action = 'fetch-deparment-class-subjects';
	$.ajax({
		type: "POST",
		url: endPoint + '/user/tutorials/' + action,
		dataType: "json",
		cache: false,
		headers: {
			'apiKey': apiKey,
			'Authorization': 'Bearer ' + login_access_key
		},
		success: function (info) {
			var response = info.response;
			if (response < 100) {
				_logOut();
			} else {
				var getAllData = info.subjects;
				var success = info.success;
				var message = info.message;
				var all_record_count = info.all_record_count;

				var no = 0;
				var text = '';
				if (success == true) {
					for (var i = 0; i < 5 && i < getAllData.length; i++) {
						no++;
						var subject_id = getAllData[i].subject_id;
						var subject_name = getAllData[i].subject_name.toUpperCase();
						var terms = getAllData[i].terms;

						text +=
							'<div class="quest-faq-div animated fadeIn">' +
							'<div class="faq-title-text">' +
							'<h3>' + subject_name + ' </h3>' +
							'<div class="expand-div" id="' + "view" + no + "num" + '" title="Click to View Terms" onclick="_collapse(' + "'" + 'view' + no + "'" + ')">&nbsp;<i class="bi-chevron-down"></i>&nbsp;</div>' +
							'</div>';

						text += '<div class="faq-answer-div" id="' + "view" + no + "answer" + '" style="display:none;">';

						for (var j = 0; j < terms.length; j++) {
							var term_id = terms[j].term_id;
							var term_name = terms[j].term_name;
							var total_number_of_videos = terms[j].total_number_of_videos;
							text += '<button class="btn" title="' + term_name + '" onClick="_getPageWithId(' + "'video_page'" + "," + "'" + term_id + "'" + "," + "'" + subject_id + "'" + ')"><i class="bi-pencil-square"></i> ' + term_name + ' &nbsp; <span>' + total_number_of_videos + '</span>&nbsp;<i class="bi-play-btn-fill"></i></button>';
						}

						text += '</div>' +
							'</div>';
					}
				} else {
					if ((loginUserInfoSession.subscription.length == 0) || (response == 100)) {
						sessionStorage.setItem("expireDate", JSON.stringify('0'));
						let expireDate = JSON.parse(sessionStorage.getItem("expireDate"));
						$('#get_user_remaining_expires_days').html(expireDate);
						text = '<div class="false-notification-div">' +
							"<p> " + message + " </p>" +
							'<button class="btn" onClick="_getForm(' + "'user_subcription'" + ')"> Click here to subscribe <i class="bi bi-send-check-fill"></i></button>'
						'</div>';
					} else {
						text = '<div class="false-notification-div">' +
							"<p> " + message + " </p>" +
							'</div>';
					}
				}
			}
			$('#current_count').html(no);
			$('#total_count').html(all_record_count);
			$('#fetch_department_class_subject_details').html(text);
		},
		error: function (error) {
			console.log(error);
			_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
		}
	});
}





function _getFetchDepartmentClassSubjectWeeks(ids1, ids2) {
	var term_id = ids1;
	var subject_id = ids2;
	if (term_id == '' || subject_id == '') {
		// do nothing
	} else {

		$('#fetch_deparment_class_subject_weeks_details').html('<div class="ajax-loader2"><br clear="all"/> Loading... <br clear="all"/><img src="' + website_url + '/account/all-images/images/ajax-loader2.gif"/></div>').fadeIn('fast');
		var action = 'fetch-deparment-class-subject-weeks';
		var dataString = 'term_id=' + term_id + '&subject_id=' + subject_id;
		$.ajax({
			type: "POST",
			url: endPoint + '/user/tutorials/' + action,
			dataType: "json",
			data: dataString,
			cache: false,
			headers: {
				'apiKey': apiKey,
				'Authorization': 'Bearer ' + login_access_key
			},
			success: function (info) {
				var response = info.response;
				if (response < 100) {
					_logOut();
				} else {
					var getAllData = info.data;
					var success = info.success;
					var message = info.message;
					var subject_name = info.subject_name;
					var term_name = info.term_name;

					var no = 0;
					var text = '';
					if (success == true) {
						for (var i = 0; i < getAllData.length; i++) {
							no++;
							var week_name = getAllData[i].week_name.toUpperCase();
							var week_videos = getAllData[i].week_videos;

							text +=
								'<div class="quest-faq-div animated fadeIn">' +
								'<div class="faq-title-text">' +
								'<h3>' + week_name + '<span title="Click to View Videos" onclick="_collapse(' + "'" + 'view' + no + "'" + ')">View Lesson</span></h3>' +
								'<div class="expand-div" id="' + "view" + no + "num" + '" title="Click to View Videos" onclick="_collapse(' + "'" + 'view' + no + "'" + ')">&nbsp;<i class="bi-chevron-down"></i>&nbsp;</div>' +
								'</div>';

							text += '<div class="faq-answer-div" id="' + "view" + no + "answer" + '" style="display:none;">';

							for (var j = 0; j < week_videos.length; j++) {
								var tutorial_id = week_videos[j].tutorial_id;
								var topic = week_videos[j].topic;
								var summary = week_videos[j].summary.substr(0, 138);
								var documentStoragePath = week_videos[j].documentStoragePath;
								var thumbnail = week_videos[j].thumbnail;
								var quiz_status = week_videos[j].quiz_status;
								var quiz_question_counts = week_videos[j].quiz_question_counts;

								text +=
									'<div class="topics-content-div">' +
									'<div class="image-div"><img src="' + documentStoragePath + '/' + thumbnail + '" alt="' + topic + '"/></div>' +
									'<div class="text">' +
									'<h4>' + topic + '</h4>' +
									'<p>' + summary + '</p>' +
									'<hr></hr>' +
									'<div class="bottom-div">';
								if (quiz_status == 1) {
									text += '<button class="btn edit1" title="PLAY VIDEO" onClick="_getFormWithId(' + "'cbt_summary_details'" + "," + "'" + tutorial_id + "'" + ')"><i class="bi bi-tv"></i> CBT (' + quiz_question_counts + ') </button>';
								}
								text += '<button class="btn edit" title="PLAY VIDEO" onClick="_getFormWithId(' + "'tutorial_video'" + "," + "'" + tutorial_id + "'" + ')"><i class="bi bi-play"></i> PLAY VIDEO </button>' +
									'<button class="btn" title="VIEW NOTE" onClick="_getFormWithId(' + "'tutorial_note'" + "," + "'" + tutorial_id + "'" + ')"><i class="bi bi-pencil-square"></i> VIEW NOTE </button>' +
									'</div>' +
									'</div>' +
									'</div>';
							}
							text += '</div>' + '</div>';
						}


					} else {
						if (loginUserInfoSession.subscription.length == 0) {
							text = '<div class="false-notification-div">' +
								"<p> " + message + " </p>" +
								'<button class="btn"> Subscribe Now <i class="bi bi-send-check-fill"></i></button>'
							'</div>';
						} else {
							text = '<div class="false-notification-div">' +
								"<p> " + message + " </p>" +
								'</div>';
						}
					}

				}
				$('#tutorial_subject_name').html(subject_name);
				$('#tutorial_term_name').html(term_name);
				$('#fetch_deparment_class_subject_weeks_details').html(text);
			},
			error: function (error) {
				console.log(error);
				_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
			}
		});
	}
}








function _getTutorialVideosDetails(page, tutorial_id) {
	if (page == '' || tutorial_id == '') {
		// do nothing
	} else {
		$('#ajax_loader').html('<div class="ajax-loader"><img src="' + website_url + '/account/all-images/images/ajax-loader.gif"/></div>').fadeIn('fast');
		$('#fetch_tutorial_details').hide();
		var action = 'fetch-tutorial';
		var dataString = 'tutorial_id=' + tutorial_id;
		$.ajax({
			type: "POST",
			url: endPoint + '/user/tutorials/' + action,
			dataType: "json",
			data: dataString,
			cache: false,
			headers: {
				'apiKey': apiKey,
				'Authorization': 'Bearer ' + login_access_key
			},
			success: function (info) {
				var response = info.response;
				if (response < 100) {
					_logOut();
				} else {
					$('#ajax_loader').html('');
					$('#fetch_tutorial_details').show();
					var success = info.success;
					var message = info.message;

					if (success == true) {
						if (page == 'tutorial_video') {
							var getAllData = info.data[0];
							var documentStoragePath_video = getAllData.documentStoragePath_video;
							var video = getAllData.video;

							var subject_name = getAllData.subject_name.toUpperCase();
							var term_name = getAllData.term_name.toUpperCase();
							var week_name = getAllData.week_name.toUpperCase();
							var duration = getAllData.duration;

							var topic = getAllData.topic;
							var summary = getAllData.summary;

							_getTutorialVideo(documentStoragePath_video, video);

							$("#tutorial_topic").html(topic);
							$("#tutorial_summary").html(summary);
							$("#tutorial_subject").html(subject_name);
							$("#tutorial_term").html(term_name);
							$("#tutorial_week").html(week_name);
							$("#tutorial_duration").html(duration);

						} else if (page == 'tutorial_note') {
							var getAllData = info.data[0];

							var class_name = getAllData.class_name;
							var subject_name = getAllData.subject_name.toUpperCase();
							var term_name = getAllData.term_name.toUpperCase();
							var week_name = getAllData.week_name.toUpperCase();
							var documentStoragePath_material = getAllData.documentStoragePath_material;
							var material = getAllData.material;

							
							_getTutorialNote(documentStoragePath_material, material);
							 

							$("#tutorial_class").html(class_name);
							$("#tutorial_subject").html(subject_name);
							$("#tutorial_term").html(term_name);
							$("#tutorial_week").html(week_name);

						
							

						} else {

						}



					} else {
						if (loginUserInfoSession.subscription.length == 0) {
							text = '<div class="false-notification-div">' +
								"<p> " + message + " </p>" +
								'<button class="btn"> Subscribe Now <i class="bi bi-send-check-fill"></i></button>'
							'</div>';
						} else {
							text = '<div class="false-notification-div">' +
								"<p> " + message + " </p>" +
								'</div>';
						}
						$("#fetch_tutorial_details").html(text);
					}

				}
			},
			error: function (error) {
				console.log(error);
				_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
			}

		});

	}


}


function _getTutorialVideo(documentStoragePath_video, video) {
	var videoDisplay = $('#videoDisplay');
	// Set the source of the video element
	videoDisplay.attr('src', documentStoragePath_video + "/" + video);
	// Show the video
	videoDisplay.show();
}



// function _getTutorialNote(documentStoragePath_material, material) {
//     var pdfIframe = $('#pdfFile');
//     var pdfUrl = documentStoragePath_material + "/" + material;

//     pdfIframe.attr('src', pdfUrl);
//     pdfIframe.css('display', 'block'); // Show the PDF
// }

function _getTutorialNote(documentStoragePath_material, material) {
    var pdfIframe = $('#pdfFile');
    var pdfUrl = documentStoragePath_material + "/" + material;

    pdfIframe.attr('src', "https://docs.google.com/gview?url=" + encodeURIComponent(pdfUrl) + "&embedded=true");
    pdfIframe.css('display', 'block'); // Show the PDF
}




$(function () {
	user_profile_pix = {
		UpdatePreview: function (obj) {
			if (!window.FileReader) {
				// Handle browsers that don't support FileReader
				console.error("FileReader is not supported.");
			} else {
				_uploadUserProfilePix();
				var reader = new FileReader();

				reader.onload = function (e) {
					$('#profile_pix,#header_pix,#option_pix,#welcome_pix,#side_user_pix').prop("src", e.target.result);
				};

				reader.readAsDataURL(obj.files[0]);
			}
		},
	};
});



function _uploadUserProfilePix() {
	var action = 'update-user-picture';
	var passport_pix_input = $('#passport_pix')[0];
	var passport_pix_file = passport_pix_input.files[0];

	var form_data = new FormData();
	form_data.append('profile_pix', passport_pix_file);
	form_data.append('profile_pix', profile_pix);
	$('#loading-div').html('<i class="fa fa-spinner fa-spin"></i> Uploading...');

	$.ajax({
		url: endPoint + '/user/profile/' + action,
		type: "POST",
		data: form_data,
		contentType: false,
		cache: false,
		headers: {
			'apiKey': apiKey,
			'Authorization': 'Bearer ' + login_access_key
		},
		processData: false,
		success: function (info) {
			var response = info.response;
			if (response < 100) {
				_logOut();
			} else {
				var success = info.success;
				var message = info.message;
				if (success == true) {
					_successAlert(message, '');
					sessionStorage.setItem("loginUserInfoSession", JSON.stringify(info));
				} else {
					_warningAlert(null, message, '');
				}
				$('#loading-div').html('');
			}
		},
		error: function (error) {
			console.log(error);
			_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
		}
	});

}





function _updateUserProfile() {
	var fullname = $('#fullname').val();
	var email = $('#email').val();
	var mobile_no = $('#mobile').val();

	$('#fullname,#email,#mobile').removeClass('complain');
	if ((fullname == '') && (email == '') && (mobile_no == '')) {
		$('#fullname,#email,#mobile').addClass('complain');
		_warningAlert(null, 'ERROR!', 'Fill all fields to continue.');

	} else if (fullname == '') {
		_warningAlert('fullname', 'FULLNAME ERROR!', 'Fill this field to continue.');

	} else if (email == '') {
		_warningAlert('email', 'EMAIL ERROR!', 'Fill this field to continue.');

	} else if ($("#email").val().indexOf("@") <= 0) {
		_warningAlert('email', 'INVALID EMAIL ADDRESS!', 'Fill valid email to continue');

	} else if (mobile_no == '') {
		_warningAlert('mobile', 'PHONE NUMBER ERROR!', 'Fill this field to continue.');

	} else if (!_isValidMobileNumber(mobile_no)) {
		_warningAlert('mobile', 'INVALID PHONE NUMBER!', 'Fill valid phone number to continue');

	} else {
		$('#fullname,#email,#mobile').removeClass('complain');
		//////////////// get btn text ////////////////
		var btn_text = $('#update_btn').html();
		$('#update_btn').html('UPDATING <i class="fa fa-spinner fa-spin"></i>');
		document.getElementById('update_btn').disabled = true;
		////////////////////////////////////////////////	
		var action = 'update-user';

		var dataString = 'fullname=' + fullname + '&email=' + email + '&mobile_no=' + mobile_no;
		$.ajax({
			type: "POST",
			url: endPoint + '/user/profile/' + action,
			dataType: "json",
			data: dataString,
			cache: false,
			headers: {
				'apiKey': apiKey,
				'Authorization': 'Bearer ' + login_access_key
			},
			success: function (info) {
				var response = info.response;
				if (response < 100) {
					_logOut();
				} else {
					var success = info.success;
					var message = info.message;
					if (success == true) {
						var getData = info.user[0];
						$('#login_user_fullname,#profile_name,#side_fullname').html(_capitalizeFirstLetterOfEachWord(getData.fullname));
						_successAlert(message, '');
						sessionStorage.setItem("loginUserInfoSession", JSON.stringify(info));
					} else {
						_warningAlert(null, message, '');
					}
					$('#update_btn').html(btn_text);
					document.getElementById('update_btn').disabled = false;
				}
			},
			error: function (error) {
				console.log(error);
				_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
				$('#update_btn').html(btn_text);
				document.getElementById('update_btn').disabled = false;
			}

		});

	}
}





// --------- USER LOAD WALLET FUNCTION API's ---------------------------------- //


function _loadWallet() {
	var wallet_amount = $('#wallet_amount').val();
	$('#wallet_amount').removeClass('complain');

	if (wallet_amount == '') {
		_warningAlert('wallet_amount', 'AMOUNT ERROR!', 'Fill this field to continue.');

	} else {
		$('#wallet_amount').removeClass('complain');

		/////////////////////////////////////////
		var btn_text = $('#load_wallet_btn').html();
		$('#load_wallet_btn').html('Loading <i class="fa fa-spinner fa-spin"></i>');
		document.getElementById('load_wallet_btn').disabled = true;

		////////////////////////////////////////////////	
		var action = 'load-wallet-pending';
		var amount = wallet_amount.replace(/,/g, '');

		var dataString = 'amount=' + amount;
		$.ajax({
			type: "POST",
			url: endPoint + '/user/transactions/' + action,
			data: dataString,
			cache: false,
			dataType: 'json',
			cache: false,
			headers: {
				'apiKey': apiKey,
				'Authorization': 'Bearer ' + login_access_key
			},
			success: function (info) {
				var response = info.response;
				if (response < 100) {
					_logOut();
				} else {
					var success = info.success;
					var message = info.message;
					if (success == true) {
						var transaction_id = info.transaction_id;
						var fullname = info.fullname;
						var amount = info.amount;
						var email = info.email;
						var login_user_mobile_no = loginUserInfoSession.user[0].mobile_no;
						var paystack_payment_key = info.paystack_payment_key;

						_payWithPaystackLoadWallet(fullname, transaction_id, fullname, email, amount, login_user_mobile_no, paystack_payment_key);
						_successAlert(message, '');
					} else {
						_warningAlert('wallet_amount', message, '');

						$('#load_wallet_btn').html(btn_text);
						document.getElementById('load_wallet_btn').disabled = false;
					}

				}
			},
			error: function (error) {
				console.log(error);
				_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
				$('#load_wallet_btn').html(btn_text);
				document.getElementById('load_wallet_btn').disabled = false;
			}
		});
	}

}



////// CALL LOAD WALLET PAYSTACK ////////////////

function _payWithPaystackLoadWallet(fullname, transaction_id, fullname, email, amount, login_user_mobile_no, paystack_payment_key) {

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
					value: login_user_mobile_no
				}
			]
		},
		callback: function (response) { //success
			var stack_pay_ref = $.trim(response.reference);
			_callLoadWalletPaymentSuccess(transaction_id);
		},
		onClose: function () { //update to cancelled.
			_callLoadWalletPaymentCancelled(transaction_id);
			return false;
		}
	});
	handler.openIframe();
}


function _callLoadWalletPaymentSuccess(transaction_id) {
	var action = 'load-wallet-success';
	var dataString = 'transaction_id=' + transaction_id;
	$.ajax({
		type: "POST",
		url: endPoint + '/user/transactions/' + action,
		data: dataString,
		cache: false,
		dataType: 'json',
		cache: false,
		headers: {
			'apiKey': apiKey,
			'Authorization': 'Bearer ' + login_access_key
		},
		success: function (info) {
			var success = info.success;
			var message = info.message;

			if (success == true) {
				var getData = info.user[0];
				$('#user_wallet_balance,#user_wallet_balance').html(_numberWithComma(getData.wallet_balance));
				sessionStorage.setItem("loginUserInfoSession", JSON.stringify(info));
				_getForm('load_user_wallet_success');

			} else {
				_warningAlert(null, message, '');
			}

		},
		error: function (error) {
			console.log(error);
			_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
		}
	});
}




function _callLoadWalletPaymentCancelled(transaction_id) {
	var action = 'load-wallet-cancelled';
	var dataString = 'transaction_id=' + transaction_id;
	$.ajax({
		type: "POST",
		url: endPoint + '/user/transactions/' + action,
		cache: false,
		data: dataString,
		dataType: 'json',
		cache: false,
		headers: {
			'apiKey': apiKey,
			'Authorization': 'Bearer ' + login_access_key
		},
		success: function (info) {
			var success = info.success;
			var message = info.message;
			if (success == true) {
				_successAlert(message, '');
				$('#load_wallet_btn').html('<i class="bi-credit-card"></i> LOAD WALLET');
				document.getElementById('load_wallet_btn').disabled = false;
			} else {
				_warningAlert(null, message, '');
			}

		},
		error: function (error) {
			console.log(error);
			_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
		}
	});
}

////////////////////// END LOAD WALLET PAYSTACK /////////////////////////////








function _getFetchAllTransactionsHistory(page) {
	$('#fetch_all_transaction_history').html('<div class="ajax-loader2">Loading... <br clear="all"/><img src=" ' + website_url + '/account/all-images/images/ajax-loader2.gif"/></div>').fadeIn(500);
	if (page == '') {
		// do nothing
	} else {
		var action = 'transaction-history';
		$.ajax({
			type: "POST",
			url: endPoint + '/user/transactions/' + action,
			dataType: "json",
			cache: false,
			headers: {
				'apiKey': apiKey,
				'Authorization': 'Bearer ' + login_access_key
			},
			success: function (info) {
				var response = info.response;
				if (response < 100) {
					_logOut();
				} else {
					var success = info.success;
					var message = info.message;
					var all_record_count = info.all_record_count;
					var getAllData = info.data;
					var no = 0;
					var text = '';


					if (success == true) {


						text =
							'<tr class="tb-col">' +
							'<td>SN</td>' +
							'<td>TRANSACTION ID</td>' +
							'<td>AMOUNT</td>' +
							'<td>PURPOSE</td>' +
							'<td>TRANSACTION METHOD</td>' +
							'<td>STATUS</td>' +
							'<td>DATE</td>' +
							'<td>ACTION</td>' +
							'</tr>';
						for (var i = 0; i < getAllData.length; i++) {
							no++;
							var transaction_id = getAllData[i].transaction_id;
							var amount = getAllData[i].amount;
							var transaction_type_name = getAllData[i].transaction_type_name.toUpperCase();
							var payment_method_name = getAllData[i].payment_method_name.toUpperCase();
							var status_name = getAllData[i].status_name.toUpperCase();
							var created_time = getAllData[i].created_time;
							text +=
								'<tr>' +
								'<td>' + no + '</td>' +
								'<td>' + transaction_id + '</td>' +
								'<td>₦' + _numberWithComma(amount) + '</td>' +
								'<td>' + transaction_type_name + '</td>' +
								'<td>' + payment_method_name + '</td>' +
								'<td>' +
								'<div class="status-div ' + status_name + '">' + status_name + '</div>' +
								'</td>' +
								'<td>' + created_time + '</td>' +
								'<td><button class="btn" onclick="_getFormWithId(' + "'transaction_form_details'" + "," + "'" + transaction_id + "'" + ')"><i class="bi bi-eye"></i> VIEW DETAILS</button></td>' +
								'</tr>';
						}

						$('#current_trans_count').html(no);
						$('#trans_total_count').html(all_record_count);

					} else {
						text = '<div class="false-notification-div">' +
							'<p> ' + message + ' </p>' +
							// '<button class="btn" onClick="_getFormWithId(' + "'create_department_form'" + "," + "'" + school_id + "'" + ')"> <i class="bi bi-plus-square"></i> CREATE NEW DEPARTMENT</button>'
							'</div>';
					}
				}
				$('#fetch_all_transaction_history').html(text);
			},
			error: function (error) {
				console.log(error);
				_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
			}
		});
	}

}




function _getFetchEachTransactionsHistory(page, transaction_id) {
	//$('#fetch_all_transaction_history').html('<div class="ajax-loader2">Loading... <br clear="all"/><img src=" ' + website_url + '/account/all-images/images/ajax-loader2.gif"/></div>').fadeIn(500);
	if ((page == '') || (transaction_id == '')) {
		// do nothing
	} else {

		var action = 'transaction-history';
		var dataString = 'transaction_id=' + transaction_id;
		$.ajax({
			type: "POST",
			url: endPoint + '/user/transactions/' + action,
			data: dataString,
			dataType: "json",
			cache: false,
			headers: {
				'apiKey': apiKey,
				'Authorization': 'Bearer ' + login_access_key
			},
			success: function (info) {
				var response = info.response;
				if (response < 100) {
					_logOut();
				} else {
					var success = info.success;
					var message = info.message;
					var getAllData = info.data[0];
					if (success == true) {
						var transaction_id = getAllData.transaction_id;
						var email = getAllData.email;
						var transaction_type_name = getAllData.transaction_type_name.toUpperCase();
						var payment_method_name = getAllData.payment_method_name.toUpperCase();
						var balance_before = getAllData.balance_before;
						var amount = getAllData.amount;
						var balance_after = getAllData.balance_after;
						var status_name = getAllData.status_name.toUpperCase();
						var created_time = getAllData.created_time;

						$('#transaction_id').html(transaction_id);
						$('#trans_email').html(email);
						$('#transaction_purpose').html(transaction_type_name);
						$('#payment_method').html(payment_method_name);
						$('#wallet_balance_before').html('₦' + _numberWithComma(balance_before));
						$('#transaction_amount').html('₦' + _numberWithComma(amount));
						$('#wallet_balance_after').html('₦' + _numberWithComma(balance_after));
						$('#transaction_status').html(status_name);
						$('#date').html(created_time);

					} else {

					}
				}
				//$('#fetch_all_transaction_history').html(text);
			},
			error: function (error) {
				console.log(error);
				_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
			}
		});
	}

}








function _getFetchAllSubscriptionHistory(page) {
	$('#fetch_all_subscription_history').html('<div class="ajax-loader2">Loading... <br clear="all"/><img src=" ' + website_url + '/account/all-images/images/ajax-loader2.gif"/></div>').fadeIn(500);
	if (page == '') {
		// do nothing
	} else {
		var action = 'subscription-history';
		$.ajax({
			type: "POST",
			url: endPoint + '/user/subscription/' + action,
			dataType: "json",
			cache: false,
			headers: {
				'apiKey': apiKey,
				'Authorization': 'Bearer ' + login_access_key
			},
			success: function (info) {
				var response = info.response;
				if (response < 100) {
					_logOut();
				} else {
					var success = info.success;
					var message = info.message;
					var all_record_count = info.all_record_count;
					var getAllData = info.data;
					var no = 0;
					var text = '';

					if (success == true) {
						text =
							'<tr class="tb-col">' +
							'<td>SN</td>' +
							'<td>SUBCRIPTION ID</td>' +
							'<td>DEPARTMENT</td>' +
							'<td>CLASS</td>' +
							'<td>SUBCRIPTION DATE</td>' +
							'<td>DUE DATE</td>' +
							'<td>STATUS</td>' +
							'<td>ACTION</td>' +
							'</tr>';
						for (var i = 0; i < getAllData.length; i++) {
							no++;
							var subscription_id = getAllData[i].subscription_id;
							var department_name = getAllData[i].department_name.toUpperCase();
							var class_name = getAllData[i].class_name.toUpperCase();
							var subscription_start_date = getAllData[i].subscription_start_date;
							var subscription_end_date = getAllData[i].subscription_end_date;
							var status_name = getAllData[i].status_name.toUpperCase();
							text +=
								'<tr>' +
								'<td>' + no + '</td>' +
								'<td>' + subscription_id + '</td>' +
								'<td>' + department_name + '</td>' +
								'<td>' + class_name + '</td>' +
								'<td>' + subscription_start_date + '</td>' +
								'<td>' + subscription_end_date + '</td>' +
								'<td>' +
								'<div class="status-div ' + status_name + '">' + status_name + '</div>' +
								'</td>' +
								'<td><button class="btn" onclick="_getFormWithId(' + "'subcription_form_details'" + "," + "'" + subscription_id + "'" + ')"><i class="bi bi-eye"></i> VIEW DETAILS</button></td>' +
								'</tr>';
						}

						$('#current_sub_count').html(no);
						$('#sub_total_count').html(all_record_count);

					} else {
						text = '<div class="false-notification-div">' +
							'<p> ' + message + ' </p>' +
							// '<button class="btn" onClick="_getFormWithId(' + "'create_department_form'" + "," + "'" + school_id + "'" + ')"> <i class="bi bi-plus-square"></i> CREATE NEW DEPARTMENT</button>'
							'</div>';
					}
				}
				$('#fetch_all_subscription_history').html(text);
			},
			error: function (error) {
				console.log(error);
				_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
			}
		});
	}

}




function _getFetchEachSubscriptionHistory(page, subcription_id) {
	//$('#fetch_all_transaction_history').html('<div class="ajax-loader2">Loading... <br clear="all"/><img src=" ' + website_url + '/account/all-images/images/ajax-loader2.gif"/></div>').fadeIn(500);
	if ((page == '') || (subcription_id == '')) {
		// do nothing
	} else {

		var action = 'subscription-history';
		var dataString = 'subcription_id=' + subcription_id;
		$.ajax({
			type: "POST",
			url: endPoint + '/user/subscription/' + action,
			data: dataString,
			dataType: "json",
			cache: false,
			headers: {
				'apiKey': apiKey,
				'Authorization': 'Bearer ' + login_access_key
			},
			success: function (info) {
				var response = info.response;
				if (response < 100) {
					_logOut();
				} else {
					var success = info.success;
					var message = info.message;
					var getAllData = info.data[0];
					if (success == true) {
						var subscription_id = getAllData.subscription_id;
						var email = getAllData.email;
						var department_name = getAllData.department_name.toUpperCase();
						var class_name = getAllData.class_name.toUpperCase();
						var subscription_start_date = getAllData.subscription_start_date;
						var subscription_end_date = getAllData.subscription_end_date;
						var status_name = getAllData.status_name.toUpperCase();

						$('#subscription_id').html(subscription_id);
						$('#sub_email').html(email);
						$('#department').html(department_name);
						$('#class').html(class_name);
						$('#subcription_date').html(subscription_start_date);
						$('#due_date').html(subscription_end_date);
						$('#subcription_status').html(status_name);

					} else {

					}
				}
				//$('#fetch_all_transaction_history').html(text);
			},
			error: function (error) {
				console.log(error);
				_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
			}
		});
	}

}








// ------------- USER SUBSCRIPTION FUNCTION API's --------------------------------- //




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
		},
		error: function (error) {
			console.log(error);
			_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
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
		},
		error: function (error) {
			console.log(error);
			_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
		}
	});
}




function _getPaymentMethod() {
	var payment_id = $('#sub_payment_method_id').val();

	var text = '<option value="">FETCHING PAYMENT...</option>';
	$('#sub_payment_method_id').html(text);

	var action = 'payment-method';
	var dataString = 'payment_id=' + payment_id;
	$.ajax({
		type: "POST",
		url: endPoint + '/setups/' + action,
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
			var text = '<option selected value="" selected="selected">SELECT PAYMENT METHOD</option>';
			if (success == true) {
				for (var i = 0; i < getAllData.length; i++) {
					var payment_method_id = getAllData[i].payment_method_id;
					var payment_method_name = getAllData[i].payment_method_name;
					text += '<option value="' + payment_method_id + '">' + payment_method_name.toUpperCase() + '</option>';
				}
			} else {
				text = '<option>' + message + '</option>';
			}
			$('#sub_payment_method_id').html(text);
		},
		error: function (error) {
			console.log(error);
			_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
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
				$('#subscription_amount').html(_numberWithComma(getAllData.subcription_amount));
			} else {
				$('#subscription_amount').html('0.00');
			}
		}
	});
}







function _userSubscriptionPayment() {
	var department_id = $('#sub_department_id').val();
	var class_id = $('#sub_class_id').val();
	var payment_method_id = $('#sub_payment_method_id').val();

	$('#sub_department_id, #sub_class_id, #sub_payment_method_id').removeClass('complain');

	if (department_id == '') {
		_warningAlert('sub_department_id', 'DEPARTMENT ERROR!', 'Select this field to continue.');
	} else if (class_id == '') {
		_warningAlert('sub_class_id', 'CLASS ERROR!', 'Select this field to continue.');
	} else if (payment_method_id == '') {
		_warningAlert('sub_payment_method_id', 'PAYMENT METHOD ERROR!', 'Select this field to continue.');
	} else {
		$('#sub_department_id, #sub_class_id, #sub_payment_method_id').removeClass('complain');

		//////////////// get btn text ////////////////
		var btn_text = $('#submit_btn').html();
		$('#submit_btn').html('<i class="fa fa-spinner fa-spin"></i> PROCCESSING...');
		document.getElementById('submit_btn').disabled = true;
		////////////////////////////////////////////////	
		var action = 'renew-subscription';
		var dataString = 'department_id=' + department_id + '&class_id=' + class_id + '&payment_method_id=' + payment_method_id;

		$.ajax({
			type: "POST",
			url: endPoint + '/user/subscription/' + action,
			data: dataString,
			cache: false,
			dataType: 'json',
			cache: false,
			headers: {
				'apiKey': apiKey,
				'Authorization': 'Bearer ' + login_access_key
			},
			success: function (info) {
				var success = info.success;
				var message = info.message;
				if (success == true) {
					if (payment_method_id == 'DO') {
						var subscription_id = info.subscription_id;
						var transaction_id = info.transaction_id;
						var amount = info.amount;
						var email = info.email;
						var login_user_fullname = loginUserInfoSession.user[0].fullname;
						var login_user_mobile_no = loginUserInfoSession.user[0].mobile_no;
						var payment_key = info.paystack_payment_key;

						_successAlert(message, '');
						_payWithPaystackSubcription(login_user_fullname, login_user_mobile_no, subscription_id, transaction_id, email, amount, payment_key);
					} else if (payment_method_id == 'WAL') {
						sessionStorage.setItem("loginUserInfoSession", JSON.stringify(info));
						_getForm('user_subcription_success');
						_getPage('dashboard', 'dashboard');
						_getUserLoginDetails('dashboard');
					} else {
						//do nothing
						_warningAlert(null, message, '');
						$('#submit_btn').html(btn_text);
						document.getElementById('submit_btn').disabled = false;
					}

				} else {
					_warningAlert(null, message, '');
					$('#submit_btn').html(btn_text);
					document.getElementById('submit_btn').disabled = false;
				}
			},
			error: function (error) {
				console.log(error);
				_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
			}
		});
	}

}




////// CALL SUBSCRIPTION PAYSTACK ////////////////

function _payWithPaystackSubcription(login_user_fullname, login_user_mobile_no, subscription_id, transaction_id, email, amount, payment_key) {

	var handler = PaystackPop.setup({
		key: payment_key,
		email: email,
		amount: amount * 100, //amt in kobo
		ref: transaction_id,
		currency: 'NGN', // Use GHS for Ghana Cedis or USD for US Dollars
		metadata: {
			custom_fields: [
				{
					display_name: login_user_fullname,
					variable_name: "mobile_number",
					value: login_user_mobile_no
				}
			]
		},
		callback: function (response) { //success
			var stack_pay_ref = $.trim(response.reference);
			_callSubscriptionPaymentSuccess(transaction_id, subscription_id, amount, payment_key);
		},
		onClose: function () { //update to cancelled.
			_callSubscriptionPaymentCancelled(transaction_id, subscription_id);
			return false;
		}
	});
	handler.openIframe();
}



function _callSubscriptionPaymentSuccess(transaction_id, subscription_id, amount, payment_key) {
	if ((transaction_id == '') || (subscription_id == '') || (amount == '') || (payment_key == '')) {
		// do nothing
	} else {
		var action = 'subscription-success';
		var dataString = 'transaction_id=' + transaction_id + '&subscription_id=' + subscription_id + '&amount=' + amount + '&payment_key=' + payment_key;
		$.ajax({
			type: "POST",
			url: endPoint + '/user/subscription/' + action,
			data: dataString,
			cache: false,
			dataType: 'json',
			cache: false,
			headers: {
				'apiKey': apiKey,
				'Authorization': 'Bearer ' + login_access_key
			},
			success: function (info) {
				var success = info.success;
				var message = info.message;
				if (success == true) {
					sessionStorage.setItem("loginUserInfoSession", JSON.stringify(info));
					_getForm('user_subcription_success');
					_getPage('dashboard', 'dashboard');
					_getUserLoginDetails('dashboard');
				} else {
					_warningAlert(null, message, '');
					$('#submit_btn').html('<i class="bi-credit-card"></i> MAKE PAYMENT');
					document.getElementById('submit_btn').disabled = false;
				}

			}
		});
	}
}




function _callSubscriptionPaymentCancelled(transaction_id, subscription_id) {
	if ((transaction_id == '') || (transaction_id == '')) {
		// do nothing
	} else {
		var action = 'subscription-cancelled';
		var dataString = 'transaction_id=' + transaction_id + '&subscription_id=' + subscription_id;

		$.ajax({
			type: "POST",
			url: endPoint + '/user/subscription/' + action,
			data: dataString,
			cache: false,
			dataType: 'json',
			cache: false,
			headers: {
				'apiKey': apiKey,
				'Authorization': 'Bearer ' + login_access_key
			},
			success: function (info) {
				var success = info.success;
				var message = info.message;
				if (success == true) {
					_successAlert(message, '');
					$('#submit_btn').html('<i class="bi-credit-card"></i> MAKE PAYMENT');
					document.getElementById('submit_btn').disabled = false;
				} else {
					_warningAlert(null, message, '');
				}

			},
			error: function (error) {
				console.log(error);
				_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
			}
		});
	}

}

////////////////////// END SUBSCRIPTION PAYSTACK /////////////////////////////















function _updatePassword() {
	var old_password = $('#old_password').val();
	var new_password = $('#new_password').val();
	var comfirmed_password = $('#comfirmed_password').val();
	$('#old_password, #new_password, #comfirmed_password').removeClass('complain');

	if (old_password == '') {
		$('#old_password').addClass('complain');
		$('#warning-div').html('<div><i class="bi-exclamation-circle"></i></div> OLD PASSWORD ERROR! <br />  <span>Fill this field to continue.</span>').fadeIn(500).delay(3000).fadeOut(100);

	} else if (new_password == '') {
		$('#new_password').addClass('complain');
		$('#warning-div').html('<div><i class="bi-exclamation-circle"></i></div> NEW PASSWORD ERROR! <br />  <span>Fill this field to continue.</span>').fadeIn(500).delay(3000).fadeOut(100);

	} else if (comfirmed_password == '') {
		$('#comfirmed_password').addClass('complain');
		$('#warning-div').html('<div><i class="bi-exclamation-circle"></i></div> CONFIRM PASSWORD ERROR! <br />  <span>Fill this field to continue.</span>').fadeIn(500).delay(3000).fadeOut(100);

	} else if (new_password != comfirmed_password) {
		$('#new_password, #comfirmed_password').addClass('complain');
		$('#warning-div').html('<div><i class="bi-exclamation-circle"></i></div> PASSWORD ERROR! <br />  <span>Check password not match.</span>').fadeIn(500).delay(3000).fadeOut(100);

	} else {

		var btn_text = $('#update_btn').html();
		$('#update_btn').html('UPDATING <i class="fa fa-spinner fa-spin"></i>');
		document.getElementById('update_btn').disabled = true;

		var action = 'change_password_api'
		var dataString = 'action=' + action + '&old_password=' + old_password + '&new_password=' + new_password;
		$.ajax({
			type: "POST",
			url: user_api,
			data: dataString,
			dataType: 'json',
			cache: false,
			success: function (info) {
				var login_check = info.check;
				if (login_check > 0) {
					var result = info.result;
					var message1 = info.message1;
					var message2 = info.message2;
					if (result == true) {
						$('#success-div').html('<div><i class="bi-check-all"></div>' + message1 + '<br /> <span>' + message2 + '</span>').fadeIn(500).delay(3000).fadeOut(100);
						_alert_close();
						$('#login_user_fullname,#profile_name,#user_wallet_name').html('Xxxxx');
						_getForm('access_key_validation_info');
					} else {
						$('#warning-div').html('<div><i class="bi-exclamation-circle"></i></div>' + message1 + '<br /> <span>' + message2 + '</span>').fadeIn(500).delay(3000).fadeOut(100);
						$('#old_password').addClass('complain');

						$('#update_btn').html(btn_text);
						document.getElementById('update_btn').disabled = false;
					}

				} else {
					_getForm('access_key_validation_info');
				}
			},
			error: function (error) {
				console.log(error);
				_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
			}
		});
	}
}




function _checkPasswordMatch(ids, toggle_pass) {
	var password = $("#new_password").val();
	var confirmed_reset_password = $("#comfirmed_password").val();
	if ((password != confirmed_reset_password) && (confirmed_reset_password != '')) {
		$('#message').show();
	} else {
		$('#message').hide();
	}
	_showPasswordVisibility(ids, toggle_pass);
}






//// STATRT CBT FUNCTIIONS //////////////






function _getCbtSummaryDetails(page, tutorial_id) {
	if (page == '' || tutorial_id == '') {
		// do nothing
	} else {
		//$('#ajax_loader').html('<div class="ajax-loader"><img src="' + website_url + '/account/all-images/images/ajax-loader.gif"/></div>').fadeIn('fast');
		$("#quizbtn").html('<i class="fa fa-spinner fa-spin"></i> Loading...');
		$("#quizbtn").disabled = true;

		var action = 'fetch-cbt-summary';
		var dataString = 'tutorial_id=' + tutorial_id;
		$.ajax({
			type: "POST",
			url: endPoint + '/user/cbt/' + action,
			dataType: "json",
			data: dataString,
			cache: false,
			headers: {
				'apiKey': apiKey,
				'Authorization': 'Bearer ' + login_access_key
			},
			success: function (data) {
				var response = data.response;
				if (response < 100) {
					_logOut();
				} else {
					var success = data.success;

					if (success == true) {
						sessionStorage.setItem("cbtSummaryDetails", JSON.stringify(data));

						var db_tutorial_id = data.tutorial_id;
						$("#cbt_user_name").html(_capitalizeFirstLetterOfEachWord(data.user_fullname));
						$("#cbt_topic").html(data.topic);
						$("#cbt_tutorial_class").html(data.class_name);
						$("#cbt_tutorial_subject").html(data.subject_name);
						$("#cbt_tutorial_term").html(data.term_name);
						$("#cbt_tutorial_week").html(data.week_name);
						$("#cbt_tutorial_no_of_question").html(data.quiz_question_counts);
						$("#cbt_tutorial_available_time").html(data.quiz_duration);
						var quiz_started = data.quiz_started;
						if (quiz_started == false) {
							var btnText = 'START QUIZ';
						} else {
							var btnText = 'RESUME QUIZ';
						}
						$("#quizbtn").html('<i class="bi-skip-start-btn-fill"> </i> ' + btnText).off("click")
							.click(function () {
								_getPageCbt('cbt_quiz', db_tutorial_id);
							});
					} else {
						_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
					}
				}
			},
			error: function (error) {
				console.log(error);
				_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
			}
		});
	}
}


function _getCbtHeaderSummaryDetails() {
	var cbtSummaryDetails = JSON.parse(sessionStorage.getItem("cbtSummaryDetails"));
	$("#cbt_tutorial_class").html(cbtSummaryDetails.class_name);
	$("#cbt_tutorial_subject").html(cbtSummaryDetails.subject_name);
	$("#cbt_tutorial_term").html(cbtSummaryDetails.term_name);
	$("#cbt_tutorial_week").html(cbtSummaryDetails.week_name);
	$("#cbt_topic").html(cbtSummaryDetails.topic);
}




function _startCbt(tutorial_id) {
	_getCbtHeaderSummaryDetails();
	if (tutorial_id == '') {
		// do nothing
		_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
	} else {
		$("#numButtonContainerId").html(`<div class="loader-btn" id="loader-btn">loading.. <br> <img src="${website_url}/account/all-images/images/ajax-loader2.gif" alt="Loading Number Button"></div>`);
		var action = 'start-resume-quiz';
		var dataString = 'tutorial_id=' + tutorial_id;
		$.ajax({
			type: "POST",
			url: endPoint + '/user/cbt/' + action,
			dataType: "json",
			data: dataString,
			cache: false,
			headers: {
				'apiKey': apiKey,
				'Authorization': 'Bearer ' + login_access_key
			},
			success: function (data) {
				$("#numButtonContainerId").html('');
				_getTimeCountDown();
				var response = data.response;
				if (response < 100) {
					_logOut();
				} else {
					let currentQuestionIndex = 0;
					var success = data.success;

					if (success == true) {
						var display_question_no = data.display_question_no;
						var display_question_id = data.display_question_id;
						var display_btn = data.buttons;
						sessionStorage.setItem("getTotalBtnCount", JSON.stringify(data.buttons));
						var btn_count = JSON.parse(sessionStorage.getItem("getTotalBtnCount"));

						function generateNumButtons() {
							display_btn.forEach((btnData, index) => {
								const btnContent = `
								<button class="num-btn attempted${btnData.attempted}" id="numBtnId_${index}" 
									data-index="${index}" 
									onclick="_updateCbtQuestion('${index}', '${btn_count}', '${btnData.tutorial_id}', '${btnData.question_id}', '${btnData.display_question_no}')">
									${btnData.display_question_no}
								</button>
							    `;
								$("#numButtonContainerId,#mobileNumButtonContainerId").append(btnContent);
								
							});
							// Add click event listeners to number buttons
							$("#numBtnId").click(function () {
								currentQuestionIndex = $(this).data("index");
								_updateCbtQuestion(currentQuestionIndex, btn_count, tutorial_id, display_question_id, display_question_no);
							});
						}

						generateNumButtons();

						_updateCbtQuestion(currentQuestionIndex, btn_count, tutorial_id, display_question_id, display_question_no);

					} else {
						_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
					}
				}
			},
			error: function (error) {
				console.log(error);
				_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
			}
		});

	}
}






function _updateCbtQuestion(currentQuestionIndex, btn_count, tutorial_id, display_question_id, display_question_no) {
	var new_btn_count = JSON.parse(sessionStorage.getItem("getTotalBtnCount")) || btn_count;
	var available_time = JSON.parse(sessionStorage.getItem("getCurrentTime"));

	var cbtSummaryDetails = JSON.parse(sessionStorage.getItem("cbtSummaryDetails"));
	var quizDuration = cbtSummaryDetails.quiz_duration;

	var available_time = (available_time === null || available_time === undefined) ? quizDuration : available_time;

	if ((tutorial_id == '') || (display_question_id == '')) {
		// do nothing
		_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
	} else {
		// $('#question-container-div').hide();
		// $('#question-loader').html('<div class="ajax-loader"><img src="' + website_url + '/all-images/images/ajax-loader.gif"/></div>').fadeIn('fast');
		var action = 'fetch-quiz-question';
		var dataString = 'tutorial_id=' + tutorial_id + '&question_id=' + display_question_id + '&available_time=' + available_time;
		$.ajax({
			type: "POST",
			url: endPoint + '/user/cbt/' + action,
			dataType: "json",
			data: dataString,
			cache: false,
			headers: {
				'apiKey': apiKey,
				'Authorization': 'Bearer ' + login_access_key
			},
			success: function (data) {
				// $('#question-loader').html('');
				// $('#question-container-div').show();
				var response = data.response;
				if (response < 100) {
					_logOut();
				} else {
					var success = data.success;

					if (success == true) {
						var questions = data.questions[0];
						_getRenderQuestions(currentQuestionIndex, new_btn_count, tutorial_id, display_question_no, questions);
					} else {
						_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
					}
				}
			},
			error: function (error) {
				console.log(error);
				_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
			}
		});
	}
}



function _getRenderQuestions(currentQuestionIndex, new_btn_count, tutorial_id, display_question_no, questions) {
	var new_btn_count = JSON.parse(sessionStorage.getItem("getTotalBtnCount"));

	if (questions && questions.question_text) {
		$('#questionID').text(`Question ${display_question_no}`);
		// Remove the <p> tag that contains the exact question text
		$("p").filter(function () {
			return $(this).html().trim() === questions.question_text.trim();
		}).remove();
		$('#questionTextId').html(questions.question_text);

		if (questions.question_pix == 'avatar.jpg') {
			$("#imageContainerId").hide();
			$(".question").css("display", "block");
		} else {
			$("#imageContainerId").html(`<img src="${questions.questionsStoragePath}/${questions.question_pix}" alt="Question ${display_question_no} Image" />`);
			$("#imageContainerId").show();
			$(".question").css("display", "flex");
			$(".text-with-img").css("width", "100%");
		}
		// Clear existing options
		$('#optionsContainerId').find("label").remove();
		// fetch options
		questions.options.forEach((option, index) => {
			const isChecked = questions.selected_option == option.option_id ? "checked" : "";
			const optionDetail = `
		<label>
			<div class="question-option-div">
				<div class="option-container-div" onclick="_pickQuizOption('${option.question_id}', '${option.option_id}')">
					<input type="radio" class="checkfield" name="option" value="${index}" ${isChecked} />
					<div class="option-div">${option.option_id}</div>
					${option.option_pix == 'avatar.jpg'
					? option.option_text
					: `<div class="option-image-div">
							<img src="${option.optionsStoragePath}/${option.option_pix}" alt="Option Image" class="option-image" />
						</div>`
				}
				</div>
			</div>
		</label>`;
			$('#optionsContainerId').append(optionDetail);
		});

		$(".checkfield").change(function () {
			const selectedValue = parseInt($(this).val());
			questions.selected_option = selectedValue;
			$(`.num-btn[data-index="${currentQuestionIndex}"]`).addClass("answered");
		});
		// active number button
		$(`#numButtonContainerId .num-btn[data-index="${currentQuestionIndex}"], #mobileNumButtonContainerId .num-btn[data-index="${currentQuestionIndex}"]`).click(function () {
			updateActiveButton();
		});
		function updateActiveButton() {
			$(".num-btn").removeClass("active");
			//$(`#numBtnId_${currentQuestionIndex}`).addClass('active');

			// Highlight the corresponding number button as answered
			$(`#numButtonContainerId .num-btn[data-index="${currentQuestionIndex}"], 
				#mobileNumButtonContainerId .num-btn[data-index="${currentQuestionIndex}"]`).addClass("active");
	 
		}
		if (display_question_no == 1) {
			updateActiveButton();
		} else {
			updateActiveButton();
		}
		// Handle Previous button
		$("#prevButton").off("click").click(function () {
			if (currentQuestionIndex > 0) {
				currentQuestionIndex--;
				const previousQuestion = new_btn_count[currentQuestionIndex];
				_updateCbtQuestion(
					currentQuestionIndex,
					new_btn_count,
					tutorial_id,
					previousQuestion.question_id,
					previousQuestion.display_question_no
				);
				if (questions) {
					updateActiveButton();
				}
			}
		});
		// Handle Next button
		function nextQuestion() {
			if (currentQuestionIndex < new_btn_count.length - 1) {
				currentQuestionIndex++;
				const nextQuestions = new_btn_count[currentQuestionIndex];
				_updateCbtQuestion(
					currentQuestionIndex,
					new_btn_count,
					tutorial_id,
					nextQuestions.question_id,
					nextQuestions.display_question_no
				);
				if (questions) {
					updateActiveButton();
				}
			}
		}
		// Handle Finish button
		function finishQuiz() {
			_getPageCbt('cbt_statistics', '');
		}
		// Update Next button text
		if (currentQuestionIndex == new_btn_count.length - 1) {
			$('#nextBtn').html('<i class="bi bi-check"></i> Finish').off("click").click(finishQuiz);
		} else {
			$('#nextBtn').html('Next <i class="bi bi-arrow-right"></i>').off("click").click(nextQuestion);
		}
		if (display_question_no == new_btn_count.length) {
			$('#nextBtn').html('<i class="bi bi-check"></i> Finish').off("click").click(finishQuiz);
			nextQuestion();
		}
		if (display_question_no == new_btn_count.length - 1){
			$(`#numButtonContainerId .num-btn[data-index="${currentQuestionIndex}"], 
				#mobileNumButtonContainerId .num-btn[data-index="${currentQuestionIndex}"]`).addClass("active");
	 
		}
	} else {
		console.error("Question data is missing or invalid.");
	}
}





function _pickQuizOption(question_id, selected_option) {
	var cbtSummaryDetails = JSON.parse(sessionStorage.getItem("cbtSummaryDetails"));
	var tutorial_id = cbtSummaryDetails.tutorial_id;
	var available_time = JSON.parse(sessionStorage.getItem("getCurrentTime"));

	if ((tutorial_id == '') || (question_id == '') || (selected_option == '')) {
		// do nothing
		_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
	} else {
		var action = 'pick-quiz-option';
		var dataString = 'tutorial_id=' + tutorial_id + '&question_id=' + question_id + '&selected_option=' + selected_option + '&available_time=' + available_time;
		$.ajax({
			type: "POST",
			url: endPoint + '/user/cbt/' + action,
			dataType: "json",
			data: dataString,
			cache: false,
			headers: {
				'apiKey': apiKey,
				'Authorization': 'Bearer ' + login_access_key
			},
			success: function (data) {
				var response = data.response;
				if (response < 100) {
					_logOut();
				}
			},
			error: function (error) {
				console.log(error);
				_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
			}
		});
	}
}





function _finishQuiz() {
	var cbtSummaryDetails = JSON.parse(sessionStorage.getItem("cbtSummaryDetails"));
	var tutorial_id = cbtSummaryDetails.tutorial_id;

	var available_time = JSON.parse(sessionStorage.getItem("getCurrentTime"));
	var cbtSummaryDetails = JSON.parse(sessionStorage.getItem("cbtSummaryDetails"));
	var quizDuration = cbtSummaryDetails.quiz_duration;
	var available_time = (available_time === null || available_time === undefined) ? quizDuration : available_time;

	if ((tutorial_id == '') || (available_time == '')) {
		// do nothing
		_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
	} else {
		$('#fetch-all-cbt-statistics-details').html('<div class="ajax-loader"><img src="' + website_url + '/all-images/images/ajax-loader.gif"/></div>').fadeIn('fast');
		var action = 'finish-quiz';
		var dataString = 'tutorial_id=' + tutorial_id + '&available_time=' + available_time;
		$.ajax({
			type: "POST",
			url: endPoint + '/user/cbt/' + action,
			dataType: "json",
			data: dataString,
			cache: false,
			headers: {
				'apiKey': apiKey,
				'Authorization': 'Bearer ' + login_access_key
			},
			success: function (data) {
				stopTimer();
				var response = data.response;
				if (response < 100) {
					_logOut();
				} else {
					var success = data.success;
					var message = data.message;
					if (success == true) {
						sessionStorage.setItem("finishQuizDetails", JSON.stringify(data));
						_successAlert(message, '');
						_fetchAllQuizResult(tutorial_id);
					} else {
						_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
					}
				}
			},
			error: function (error) {
				console.log(error);
				_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
			}
		});
	}
}



function _fetchAllQuizResult(tutorial_id) {
	if (tutorial_id == '') {
		// do nothing
		_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
	} else {
		sessionStorage.setItem("getCurrentTime", JSON.stringify('00:00:00'));
		sessionStorage.removeItem("getCurrentTime");
		$('#fetch-all-cbt-statistics-details').html('<div class="ajax-loader"><img src="' + website_url + '/all-images/images/ajax-loader.gif"/></div>').fadeIn('fast');

		var action = 'fetch-all-quiz-result-summary';
		var dataString = 'tutorial_id=' + tutorial_id;
		$.ajax({
			type: "POST",
			url: endPoint + '/user/cbt/' + action,
			dataType: "json",
			data: dataString,
			cache: false,
			headers: {
				'apiKey': apiKey,
				'Authorization': 'Bearer ' + login_access_key
			},
			success: function (info) {
				$('#fetch-all-cbt-statistics-details').html('');
				var response = info.response;
				if (response < 100) {
					_logOut();
				} else {
					var success = info.success;
					var getAllData = info.data;

					if (success == true) {
						getAllData.forEach((data, index) => {
							var getCount = index + 1;
							var displayStyle = getCount == 1 ? 'block' : 'none';
							var activeBackround = getCount == 1 ? 'var(--subbg-color)' : 'var(--white-color)';

							const cbtStatisticsDetails = `
							   <div class="quest-faq-div cbt-statistic-container" id="cbt-statistic-container-faq${getCount}"  style="background-color: ${activeBackround}">
									<div class="faq-title-text">
										<h3 class="item-no">ITEM ${getCount} <button class="btn" type="button" id="" onclick="_getPageCbt('cbt_correction_quiz', '${data.quiz_summary_id}')"><i class="bi-eye"></i> View Correction</button></h3>
										<div class="expand-div" id="faq${getCount}num" onclick="_collapseCbt('faq${getCount}')" title="Click to View Terms">&nbsp;<i class="bi-plus"></i>&nbsp;</div>
									</div>
										<div class="faq-answer-div cbt-statistic-div-in" id="faq${getCount}answer" style="display: ${displayStyle};">
										<div class="statistics-count-div">
											<div class="text-div">Total Number of Questions</div>
											<div class="count-div" id="total_number_of_question">${getAllData[index].total_number_of_question}</div>
										</div>
										<div class="statistics-count-div">
											<div class="text-div">Questions Attempted</div>
											<div class="count-div" id="questions_attempted">${getAllData[index].questions_attempted}</div>
										</div>
										<div class="statistics-count-div">
											<div class="text-div">Questions Not Attempted</div>
											<div class="count-div" id="questions_not_attempted">${getAllData[index].questions_not_attempted}</div>
										</div>
										<div class="statistics-count-div">
											<div class="text-div">Question Passed</div>
											<div class="count-div" id="questions_passed">${getAllData[index].questions_passed}</div>
										</div>
										<div class="statistics-count-div">
											<div class="text-div">Question Failed</div>
											<div class="count-div" id="questions_failed">${getAllData[index].questions_failed}</div>
										</div>
										<div class="statistics-count-div">
											<div class="text-div">Time Allowed</div>
											<div class="count-div" id="time_allowed">${getAllData[index].time_allowed}</div>
										</div>
										<div class="statistics-count-div">
											<div class="text-div">Time Taken</div>
											<div class="count-div" id="time_taken">${getAllData[index].time_taken}</div>
										</div>
										<div class="statistics-count-div">
											<div class="text-div">Percentage</div>
											<div class="count-div"><span id="percentage">${getAllData[index].percentage}</span>%</div>
										</div>
									</div>
								</div>
							`;
							$("#fetch-all-cbt-statistics-details").append(cbtStatisticsDetails);
						});
					} else {
						_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
					}
					//_getTimeCountDown();

				}
			},
			error: function (error) {
				console.log(error);
				_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
			}
		});
	}
}




function _cbtCorrectionQuiz(quiz_summary_id) {
	_getCbtHeaderSummaryDetails();
	var cbtSummaryDetails = JSON.parse(sessionStorage.getItem("cbtSummaryDetails"));
	var tutorial_id = cbtSummaryDetails.tutorial_id;

	if ((tutorial_id == '') || (quiz_summary_id == '')) {
		// do nothing
		alert("yes")
		_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
	} else {
		$('#fetch-all-cbt-correction-details').html('<div class="ajax-loader"><img src="' + website_url + '/all-images/images/ajax-loader.gif"/></div>').fadeIn('fast');

		var action = 'fetch-corrections';
		var dataString = 'tutorial_id=' + tutorial_id + '&quiz_summary_id=' + quiz_summary_id;
		$.ajax({
			type: "POST",
			url: endPoint + '/user/cbt/' + action,
			dataType: "json",
			data: dataString,
			cache: false,
			headers: {
				'apiKey': apiKey,
				'Authorization': 'Bearer ' + login_access_key
			},
			success: function (data) {
				$('#fetch-all-cbt-correction-details').html('');
				var response = data.response;
				if (response < 100) {
					_logOut();
				} else {
					var success = data.success;
					if (success == true) {
						var allQuestions = data.questions;
						_renderAllCbtCorrectionQuiz(allQuestions);
					} else {
						_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
					}
				}
			},
			error: function (error) {
				console.log(error);
				_warningAlert(null, 'ERROR!', 'An error occurred. Please try again');
			}
		});
	}
}


function _renderAllCbtCorrectionQuiz(allQuestions) {
	$(document).ready(function () {
		let currentQuestionIndex = 0;
		const $questionDiv = $("#questionID");
		const $questionTextId = $("#questionTextId");
		const $optionsContainerId = $("#optionsContainerId");
		const $numButtonContainerId = $("#numButtonContainerId, #mobileNumButtonContainerId");
		const $imageContainerId = $("#imageContainerId");
		const $nextButton = $("#nextBtn");
		const $prevButton = $("#prevButton");
		// Generate number buttons dynamically
		function generateNumButtons() {
			$numButtonContainerId.empty(); // Clear existing buttons
			allQuestions.forEach((_, index) => {
				const currentQuestion = allQuestions[index];
				const isAttempted = currentQuestion.selected_option === null ? "attemptedno" : "attemptedyes";  // Is this the correct answer?

				const numButton = `
					<button class="num-btn ${isAttempted}" id="numBtnId" data-index="${index}">${index + 1}</button>
					`;
				$numButtonContainerId.append(numButton);
			});
			// Add click event listeners to number buttons
			$(".num-btn").click(function () {
				currentQuestionIndex = $(this).data("index");
				updateQuestion();
			});
		}
		// Update question and options
		function updateQuestion() {
			const currentQuestion = allQuestions[currentQuestionIndex];
			$questionDiv.text(`Question ${currentQuestionIndex + 1}`);
			// Remove the <p> tag that contains the exact question text
			$("p").filter(function () {
				return $(this).html().trim() === currentQuestion.question_text.trim();
			}).remove();
			$questionTextId.html(currentQuestion.question_text);
			// Handle image
			if (currentQuestion.question_pix !== 'avatar.jpg') {
				$imageContainerId.html(`<img src="${currentQuestion.questionsStoragePath}/${currentQuestion.question_pix}" alt="Question ${currentQuestionIndex + 1} Image" />`);
				$imageContainerId.show();
				$(".question").css("display", "flex");
				$(".text-with-img").css("width", "100%");
			} else {
				$imageContainerId.hide(); // Hide the image container
				$(".question").css("display", "block");
			}
			// Clear existing options
			$optionsContainerId.find("label").remove();

			currentQuestion.options.forEach((option, index) => {
				const isCorrect = currentQuestion.answer === option.option_id;  // Is this the correct answer?
				const isSelected = currentQuestion.selected_option === option.option_id; // Is this the user's selected option?
				const isWrong = isSelected && !isCorrect;  // User selected this, but it's wrong

				let optionClass = isCorrect ? "correctOption" : (isWrong ? "wrongOption" : ""); // Assign classes accordingly

				const optionDetail = `
					<label>
						<div class="question-option-div ${optionClass}" data-option-id="${option.option_id}">
							<div class="option-container-div">
								<div class="option-div">${option.option_id}</div>
								${option.option_pix !== 'avatar.jpg'
						? `<div class="option-image-div">
											<img src="${option.optionsStoragePath}/${option.option_pix}" alt="Option Image" class="option-image" />
										</div>`
						: option.option_text}
							</div>
						</div>
					</label>`;

				$optionsContainerId.append(optionDetail);
			});

			// Handle option selection
			$(".question-option-div").on("click", function () {
				const selectedOptionId = $(this).data("option-id");
				//$(".question-option-div").removeClass("correctOption wrongOption");
				// Check if selected option is correct
				if (selectedOptionId === currentQuestion.answer) {
					$(this).addClass("correctOption");
				} else {
					$(this).addClass("wrongOption");
				}
			});

			// Highlight the active number button
			$(".num-btn").removeClass("active");
			$(`.num-btn[data-index="${currentQuestionIndex}"]`).addClass("active");
			// Update Next button text
			if (currentQuestionIndex === allQuestions.length - 1) {
				$nextButton.disabled = true;
				$nextButton.hide();
			} else {
				$nextButton.disabled = false;
				$nextButton.show();
				$nextButton.text("Next").off("click").click(nextQuestion);
			}
		}
		// Handle Previous button
		$prevButton.click(function () {
			if (currentQuestionIndex > 0) {
				currentQuestionIndex--;
				updateQuestion();
			}
		});
		// Handle Next button
		function nextQuestion() {
			if (currentQuestionIndex < allQuestions.length - 1) {
				currentQuestionIndex++;
				updateQuestion();
			}
		}
		// Initialize the quiz
		generateNumButtons();
		updateQuestion();
	});
}


























