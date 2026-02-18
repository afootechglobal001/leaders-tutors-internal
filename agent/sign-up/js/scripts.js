
$(window).scroll(function () {
	var scrollheight = $(window).scrollTop();
	if (scrollheight >= 100) {
	  $("#back2Top").fadeIn(1000);
	} else {
	  $("#back2Top").fadeOut(1000);
	 
	}
  });

function _back_to_top(){
		event.preventDefault();
		$("html, body").animate({ scrollTop: 0 }, "slow");
        return false;
}

function _open_menu(){
	   $('.sidenavdiv, .sidenavdiv-in').animate({'margin-left':'0'},200);
	   $('.live-chat-back-div').animate({'margin-left':'-100%'},400);
	   $('.index-menu-back-div').animate({'margin-left':'0'},400);
}
function _open_live_chat(){
	   $('.sidenavdiv, .sidenavdiv-in').animate({'margin-left':'0'},200);
	   $('.index-menu-back-div').animate({'margin-left':'-100%'},400);
	   $('.live-chat-back-div').animate({'margin-left':'0'},400);
}
function _close_side_nav(){
	   $('.sidenavdiv, .sidenavdiv-in').animate({'margin-left':'-100%'},200);
	   $('.index-menu-back-div,.live-chat-back-div').animate({'margin-left':'-100%'},400);
}

function _open_li(ids){
		 $('#'+ids+'-sub-li').toggle('slow');
}

function alert_close(){
		$('#get-more-div').html('').fadeOut(200);
}


function _actionAlert(message,status){
	let text = '';
	$('.all-alert-back-div').html(text).css('display', 'flex');
	if(status==true){
		text +=
		'<div class="success-alert-div animated fadeInDown">' +
			'<div class="icon"><i class="bi-check-all"></i></div>'+
			'<div class="text"><p>'+message+'</p></div>'+
		'</div>';
	}else{
		text +=
		'<div class="failed-alert-div animated fadeInDown">' +
			'<div class="icon"><i class="bi-exclamation-octagon-fill"></i></div>'+
			'<div class="text"><p>'+message+'</p></div>'+
		'</div>';
	}
	$('.all-alert-back-div').html(text).fadeIn(500).delay(3000).fadeOut(100);
}




function isNumber_Check(e) {
    var key = e.keyCode || e.which;

    if (!((key >= 48 && key <= 57))) {
        if (e.preventDefault) {
            e.preventDefault();
        } else {
            e.returnValue = false;
        }
    }
}
 


function _counDownOtp(timer){
	$('#resendOtpBtn').hide();
	$('#resendCountdown').fadeIn(500);
	const countdown = setInterval(() => {
		if (timer > 0) {
		  timer = timer - 1;
		  $('#timer').html(timer);
		} else {
			$('#resendCountdown').hide();
			$('#resendOtpBtn').fadeIn(500);
		  clearInterval(countdown);
		}
	  }, 1000);
	  return () => clearInterval(countdown);
}

 
function _get_form(page){
	$('#get-more-div').html('<div class="ajax-loader"><img src="'+website_url+'/all-images/images/ajax-loader.gif"/></div>').css({'display': 'flex','justify-content': 'center','align-items': 'center'}).fadeIn(500);
		var action='get_form';
		var dataString ='action='+ action+'&page='+ page;
		$.ajax({
		type: "POST",
		url: agent_local_signup_url,
		data: dataString,
		cache: false,
		success: function(html){
			$('#get-more-div').html(html);
			if(page=='compelete_reg_form'){
				let agentData = JSON.parse(sessionStorage.getItem("agentLoginData"));
				$('#agentname').html(agentData.newly_registered_company_name);
			}
		}
	});
}



function _get_otp_form(email) {
	$("#get-more-div").html('<div class="ajax-loader"><img src="' +website_url +'/all-images/images/ajax-loader.gif"/></div>').css({'display': 'flex','justify-content': 'center','align-items': 'center'}).fadeIn(500);
	const action = "otp_form";
	const dataString ="action=" + action +"&email=" + email;
	$.ajax({
	  type: "POST",
	  url: agent_local_signup_url,
	  data: dataString,
	  cache: false,
	  success: function (html) {
		$("#get-more-div").html(html);
		$("#useremail").html(email);
	  },
	});
}
  

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

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


$(function () {
	agent_pix_preview = {
	  UpdatePreview: function (obj) {
		// if IE < 10 doesn't support FileReader
		if (!window.FileReader) {
		  // don't know how to proceed to assign src to image tag
		} else {
		  var reader = new FileReader();
		  var target = null;
  
		  reader.onload = function (e) {
			target = e.target || e.srcElement;
			$("#agent_pix").prop("src", target.result);
		  };
		  reader.readAsDataURL(obj.files[0]);
		}
	  },
	};
  });

function _getSelectRole(select_id,role_id){
	var dataString = "role_id=" + role_id + "&login_role_id=" + 2;
	$.ajax({
		type: "POST",
		url: endPoint + '/setups/role',
		data: dataString,
		dataType: 'json',
		cache: false,
		headers: {
			'apiKey': apiKey,
		},
		success: function(info){
			const success = info.success;
			const message = info.message;
			const fetch = info.data;
  
			if (success == true) {
				for (let i = 0; i < fetch.length; i++) {
					const role_id = fetch[i].role_id;
					const role_name = fetch[i].role_name;
					$('#'+ select_id).append('<option value="'+ role_id +'">'+ role_name +'</option>');
				}
			}else{
				_actionAlert(message, false);
		  	}
		}, 
	});
}


function _userSignUpCheck(next_id) {
	const company_name = $('#company_name').val();
	const company_address = $('#company_address').val();
	const company_phone = $('#company_phone').val();
	const company_email = $('#company_email').val();
	const company_logo_file = $('#company_logo').prop('files')[0];
	const contact_name = $('#contact_name').val();
	const contact_email = $('#contact_email').val();
	const contact_phone = $('#contact_phone').val();
	const contact_role_id = $('#contact_role_id').val();
	$('#company_name,#company_address,#company_phone,#company_email,#company_logo,#contact_name,#contact_email,#contact_phone,#contact_role_id').removeClass('issue');

	if (next_id == 'nextPage2') {
		if (!company_name) {
			$("#company_name").addClass("issue");
			_actionAlert('Provide Company Name To Continue', false);

		} else if (!company_address) {
			$("#company_address").addClass("issue");
			_actionAlert('Provide Company Address To Continue', false);

		} else if (!company_phone) {
			$("#company_phone").addClass("issue");
			_actionAlert('Provide Company Phone Number To Continue', false);

		} else if (!company_email || $("#company_email").val().indexOf("@") <= 0) {
			$("#company_email").addClass("issue");
			_actionAlert('Provide Correct Email Address To Continue', false);

		} else {
			_nextPage(next_id)
		}

	} else if (next_id == 'nextPage3') {
		if (!company_logo_file) {
			$("#company_logo").addClass("issue");
			_actionAlert('Select Company Logo To Continue', false);
		} else {
			_nextPage(next_id)		
		}
		
	} else if (next_id == 'signUp') {
		if (!contact_name) {
			$("#contact_name").addClass("issue");
			_actionAlert('Provide Contact Name To Continue', false);

		} else if (!contact_email || $("#contact_email").val().indexOf("@") <= 0) {
			$("#contact_email").addClass("issue");
			_actionAlert('Provide Contact Address To Continue', false);

		} else if (!contact_phone) {
			$("#contact_phone").addClass("issue");
			_actionAlert('Provide Contact Mobile To Continue', false);

		} else if (!contact_role_id) {
			$("#contact_role_id").addClass("issue");
			_actionAlert('Select Role To Continue', false);

		} else {
			$('#company_name,#company_address,#company_phone,#company_email,#company_logo,#contact_name,#contact_email,#contact_phone,#contact_role_id').removeClass('issue');	
			_agentProceedToOtp(company_email, contact_email);
		}
	}else{
		// do nothing
	}
}




function _agentProceedToOtp(company_email, contact_email) {
	//////////////// get btn text ////////////////
	const btn_text = $("#proceed_btn").html();
	$("#proceed_btn").html('<i class="fa fa-spinner fa-spin"></i> PROCESSING');
	document.getElementById("proceed_btn").disabled = true;
	////////////////////////////////////////////////

	const dataString = "&company_email=" + company_email + "&contact_email=" + contact_email;
	$.ajax({
		type: "POST",
		url: endPoint + '/agent/auth/signup-otp-verification',
		data: dataString,
		cache: false,
		dataType: "json",
		cache: false,
		headers: {
		'apiKey': apiKey
	        },
		success: function (info) {
			const success = info.success;
			const message = info.message;
		
			if (success == true) {
				const email = info.email;
				_actionAlert(message, true);
				_get_otp_form(email);
			} else {
				_actionAlert(message, false);				
			}	
			$("#proceed_btn").html(btn_text);
			document.getElementById("proceed_btn").disabled = false;	
		},
		error: function (error) {
			console.log(error);
			_actionAlert('An error occurred. Please try again', false);	
			$("#proceed_btn").html(btn_text);
			document.getElementById("proceed_btn").disabled = false;
		}
	});
}

function _resentOtp() {
	const company_email = $('#company_email').val();
	const contact_email = $('#contact_email').val();
	_agentProceedToOtp(company_email, contact_email);			
}



function _completeRegistration() {
	const company_name = $('#company_name').val();
	const company_address = $('#company_address').val();
	const company_phone = $('#company_phone').val();
	const company_email = $('#company_email').val();
	const company_logo_file = $('#company_logo').prop('files')[0];
	const contact_name = $('#contact_name').val();
	const contact_email = $('#contact_email').val();
	const contact_phone = $('#contact_phone').val();
	const contact_role_id = $('#contact_role_id').val();
	const otp = $("#otp").val();

	$("#otp").removeClass("issue");

	if (!otp) {
		$("#otp").addClass("issue");
		_actionAlert('Provide Correct OTP To Continue', false);
	} else {
	$("#otp").removeClass("issue");

	//////////////// get btn text ////////////////
	const btn_text = $("#submit_btn").html();
	$("#submit_btn").html('<i class="fa fa-spinner fa-spin"></i> PROCESSING');
	document.getElementById("submit_btn").disabled = true;
	////////////////////////////////////////////////

	const form_data = new FormData();
	form_data.append("company_name", company_name);
	form_data.append("company_address", company_address);
	form_data.append("company_phone", company_phone);
	form_data.append("company_email", company_email);
	form_data.append("company_logo", company_logo_file);
	form_data.append("contact_name", contact_name);
	form_data.append("contact_email", contact_email);
	form_data.append("contact_phone", contact_phone);
	form_data.append("contact_role_id", contact_role_id);
	form_data.append("otp", otp);

	$.ajax({
		type: "POST",
        url: endPoint + '/agent/auth/signup',
        data: form_data,
        dataType: "json",
        contentType: false,
        cache: false,
        headers: {
			'apiKey': apiKey
		},
        processData: false,
        success: function (data) {
          const success = data.success;
          const message = data.message;

			if (success == true) {
				sessionStorage.setItem("agentLoginData", JSON.stringify(data));
				_actionAlert(message, true);
				_get_form('compelete_reg_form');
			} else {
				_actionAlert(message, false);				
			}	
			$("#submit_btn").html(btn_text);
			document.getElementById("submit_btn").disabled = false;	
		},
		error: function (error) {
			console.log(error);
			_actionAlert('An error occurred. Please try again', false);	
			$("#submit_btn").html(btn_text);
			document.getElementById("submit_btn").disabled = false;
		}
	});
	}
}


function proceedToPortal() {
	window.parent((location = agent_portal_url));
}
