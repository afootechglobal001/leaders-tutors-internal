
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



function _actionAlert(message,status ){
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
 


function _get_form(page) {
	$("#get-more-div").html('<div class="ajax-loader"><img src="'+website_url+'/all-images/images/ajax-loader.gif"/></div>').css({'display': 'flex','justify-content': 'center','align-items': 'center'}).fadeIn(500);
	var action = "get_form";
	var dataString = "action=" + action + "&page=" + page;
	$.ajax({
	  type: "POST",
	  url: agent_login_local_url,
	  data: dataString,
	  cache: false,
	  success: function (html) { 
		$("#get-more-div").html(html);
	  },
	});
  }
  
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


function _confirmLoginEmail() {
	const email = $("#email").val();
	$("#email").removeClass("issue");

	if (!email || $("#email").val().indexOf("@") <= 0) {
		$("#email").addClass("issue");
		_actionAlert('Provide Correct Email Address To Continue', false);
	} else {
	$("#email").removeClass("issue");

	//////////////// get btn text ////////////////
	const btn_text = $("#proceed_btn").html();
	$("#proceed_btn").html('<i class="fa fa-spinner fa-spin"></i> Authenticating');
	document.getElementById("proceed_btn").disabled = true;
	////////////////////////////////////////////////

	const dataString = "&email=" + email;
	$.ajax({
		type: "POST",
		url: endPoint + '/agent/auth/login-otp-verification',
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
}


function _get_otp_form(email) {
	$("#get-more-div").html('<div class="ajax-loader"><img src="' +website_url +'/all-images/images/ajax-loader.gif"/></div>').css({'display': 'flex','justify-content': 'center','align-items': 'center'}).fadeIn(500);
	const action = "otp_form";
	const dataString ="action=" + action +"&email=" + email;
	$.ajax({
	  type: "POST",
	  url: agent_login_local_url,
	  data: dataString,
	  cache: false,
	  success: function (html) {
		$("#get-more-div").html(html);
		$("#useremail").html(email);
	  },
	});
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



function _proceedToLogin(email) {
	const otp = $("#otp").val();
	$("#otp").removeClass("issue");

	if (!otp) {
		$("#otp").addClass("issue");
		_actionAlert('Provide Correct OTP To Continue', false);
	} else {
	$("#otp").removeClass("issue");

	//////////////// get btn text ////////////////
	const btn_text = $("#submit_btn").html();
	$("#submit_btn").html('<i class="fa fa-spinner fa-spin"></i> Authenticating');
	document.getElementById("submit_btn").disabled = true;
	////////////////////////////////////////////////

	const dataString ="&email=" +email +"&otp=" + otp;
	$.ajax({
		type: "POST",
		url: endPoint + '/agent/auth/login',
		data: dataString,
		cache: false,
		dataType: "json",
		cache: false,
		headers: {
		'apiKey': apiKey
	        },
		success: function (data) {
			const success = data.success;
			const message = data.message;

			if (success == true) {			
				sessionStorage.setItem("agentLoginData", JSON.stringify(data));
				_actionAlert(message, true);
				window.parent((location = agent_portal_url));
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

