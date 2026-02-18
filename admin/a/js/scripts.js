function _logout(){
  sessionStorage.setItem("login_staff_session", JSON.stringify(''));
  window.parent.location.href = "../";
}

$(document).ready(function() {
  window.setInterval(function(){
    get_notification_number();
  }, 180000);
});


function capitalizeFirstLetterOfEachWord(inputText) {
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

 
function handleAdminClick() {
  if (login_role_id > 1) {     
    let adminText =               
    '<div class="statistics-div bg1" id="admin" onClick="_get_page(' + "'view_staff'" + "," + "'admin'" + ')">'+
      '<div class="inner-div">'+                    
          'Administrator <br>'+
          '<span class="number" id="total_active_staff_count">0</span>'+
      '</div>'+
    '</div>';
    $('#adminstrator_link').html(adminText);

    let agentsText =                
    '<div class="statistics-div bg5" "id="agents" onClick="_get_page(' + "'active_agents'" + "," + "'agents'" + ')">'+
      '<div class="inner-div">'+
          'Active Agents  <br>'+
          '<span class="number" id="">0</span>'+
      '</div>'+
    '</div>';
    $('#agents_link').html(agentsText);

    let usersText =        
    '<div class="statistics-div bg2" id="user" onClick="_get_page(' + "'active_users'" + "," + "'user'" + ')">'+
      '<div class="inner-div">'+
          'Active Users <br>'+
          '<span class="number" id="">0</span>'+
      '</div>'+
    '</div>';
    $('#users_link').html(usersText);
  }
}


function _side_admin_check(containerId) {
  if (login_role_id > 1) {
    if (containerId === 'admin') {
      document.write(`
      <div class="nav-div" onClick="_get_page('view_staff', 'admin')" id="admin">
          <div class="icon"><i class="bi-people-fill"></i></div> Staff
          <div class="hidden" id="_admin"><i class="bi-people-fill"></i> Staff / Administrator</div>
      </div>
    `);
    } else if (containerId === 'agents') {
      document.write(`
      <div class="nav-div" title="Agents" onClick="_get_page('active_agents', 'agents')" id="agents">
          <div class="icon"><i class="bi-person-check-fill"></i></div> Agents
          <div class="hidden" id="_agents"><i class="bi-person-check-fill"></i> Active Agents</div>
      </div>
    `);
    } else if (containerId === 'user') {
      document.write(`
      <div class="nav-div" title="Users" onClick="_get_page('active_users', 'user')" id="user">
          <div class="icon"><i class="bi-people-fill"></i></div> Users
          <div class="hidden" id="_user"><i class="bi-people-fill"></i> Active Users</div>
      </div> 
    `);
    }
  }
}



function _toggle_profile_pix_div() {
  $(".toggle-profile-div").toggle("slow");
}

function select_search() {
  $(".srch-select").toggle("fast");
}


function srch_custom(text){
  $('#srch-text').html(text);
  $('.custom-srch-div').fadeIn(500);
};

function _next_page(next_id, icon, divid) {
  $("#account_settings_id,#account_detail,#channge_password").hide();
  $("#" + next_id).fadeIn(1000);
  $("#panel-title").html($("#" + icon).html() + $("#" + divid).html());
}

function _prev_page(next_id) {
  $("#account_settings_id,#account_detail,#channge_password").hide();
  $("#" + next_id).fadeIn(1000);
  $("#panel-title").html(
    '<i class="bi-gear"></i> </span id="app_text"> APP SETTINGS'
  );
}

function _alert_close() {
  $("#get-more-div").fadeOut(300);
}

function _alert_secondary_close() {
  $("#get-more-div-secondary").fadeOut(300);
}

function _alert_close2() {
  $("#get-more-div").fadeOut(300);
  closeVideo(); // 
}

function closeVideo() {
  var videoDisplay = document.getElementById('videoDisplay');
  videoDisplay.src = '';  
  videoDisplay.muted = true; 
}

function _copyText() {
	var textToCopy = $("#referral_code_detail").text(); // Get the text to copy
	navigator.clipboard.writeText(textToCopy); // Copy text to clipboard
	// Change icon to check mark for feedback
	$("#copyText").html('<span style="font-size: 10px">copied</span> <i class="bi bi-check"></i>');
	// Revert back to clipboard icon after 4 seconds
	setTimeout(function () {
		$("#copyText").html('<i class="bi bi-clipboard"></i>');
	}, 3000);
}

function _collapse(div_id) {
  var x = document.getElementById(div_id + "num");
  if (x.innerHTML === '&nbsp;<i class="bi-chevron-down"></i>&nbsp;') {
    x.innerHTML = '&nbsp;<i class="bi-chevron-up"></i>&nbsp;';
  } else {
    x.innerHTML = '&nbsp;<i class="bi-chevron-down"></i>&nbsp;';
  }
	$('#'+div_id+'answer').slideToggle('slow');
}


///// accept number ////
function isNumber_Check() {
  var e = window.event;
  var key = e.keyCode && e.which;

  if (!((key >= 48 && key <= 57) || key == 43 || key == 45)) {
    if (e.preventDefault) {
      e.preventDefault();
      $("#mobile_info").fadeIn(300);
      document.getElementById("reg_mobile", "updt_mobile").style.border =
        "#F00 1px solid";
    } else {
      e.returnValue = false;
    }
  } else {
    $("#mobile_info").fadeOut(300);
    document.getElementById("reg_mobile", "updt_mobile").style.border =
      "rgba(0, 0, 0, .1) 1px solid";
  }
}

function _get_active_link(divid) {
  $("#dashboard, #admin, #department, #user, #tutor, #subject, #class, #blogs, #faqs, #agents").removeClass("active-li");
  $("#" + divid).addClass("active-li");
  $("#page-title").html($("#_" + divid).html());
}

function _get_active_detail(text){
	$('#next-all, #next-trans, #next-wallet').removeClass('active-btn');
	$('#next-'+text).addClass('active-btn');
}


function _get_page(page, divid) {
  _get_active_link(divid);
  $("#page-content").html('<div class="ajax-loader"><img src="' +website_url +'/all-images/images/ajax-loader.gif"/></div>').fadeIn("fast");
  var action = "get_page";
  var dataString = "action=" + action + "&page=" + page;
  $.ajax({
    type: "POST",
    url: admin_local_portal_url,
    data: dataString,
    cache: false,
    success: function (html) {
      $("#page-content").html(html);
      if (page == 'dashboard'){
          handleAdminClick();
      }
    },
  });
}


function _get_page_with_id(page, ids) {
  $("#page-content").html('<div class="ajax-loader"><img src="' +website_url + '/all-images/images/ajax-loader.gif"/></div>').fadeIn("fast");
  var action = "get_page_with_id";
  var dataString = "action=" + action + "&page=" + page + "&ids=" + ids;
  $.ajax({
    type: "POST",
    url: admin_local_portal_url,
    data: dataString,
    cache: false,
    success: function (html) {
      $("#page-content").html(html);
    },
  });
}


function _get_class_page_with_id(page, department_id, class_id) {
  $("#page-content").html('<div class="ajax-loader"><img src="' +website_url + '/all-images/images/ajax-loader.gif"/></div>').fadeIn("fast");
  var action = "get_class_page_with_id";
  var dataString = "action=" + action + "&page=" + page + "&department_id=" + department_id + "&class_id=" + class_id;
  $.ajax({
    type: "POST",
    url: admin_local_portal_url,
    data: dataString,
    cache: false,
    success: function (html) {
      $("#page-content").html(html);
    },
  });
}


function _get_video_page_with_id(page, department_id, class_id, subject_id, term_id) {
  $("#page-content").html('<div class="ajax-loader"><img src="' +website_url + '/all-images/images/ajax-loader.gif"/></div>').fadeIn("fast");
  var action = "get_video_page_with_id";
  var dataString = "action=" + action + "&page=" + page + "&department_id=" + department_id + "&class_id=" + class_id + "&subject_id=" + subject_id + "&term_id=" + term_id;
  $.ajax({
    type: "POST",
    url: admin_local_portal_url,
    data: dataString,
    cache: false,
    success: function (html) {
      $("#page-content").html(html);
    },
  });
}



function _get_form(page) {
  $("#get-more-div").html('<div class="ajax-loader"><img src="'+website_url+'/all-images/images/ajax-loader.gif"/></div>').css({'display': 'flex','justify-content': 'center','align-items': 'center'}).fadeIn(500);
  var action = "get_form";
  var dataString = "action=" + action + "&page=" + page;
  $.ajax({
    type: "POST",
    url: admin_local_portal_url,
    data: dataString,
    cache: false,
    success: function (html) { 
      $("#get-more-div").html(html);
    },
  });
}


function _get_form_with_id(page, ids) {
  $("#get-more-div").html('<div class="ajax-loader"><img src="'+website_url+'/all-images/images/ajax-loader.gif"/></div>').css({'display': 'flex','justify-content': 'center','align-items': 'center'}).fadeIn(500);
  var action = "get_form_with_id";
  var dataString = "action=" + action + "&page=" + page + "&ids=" + ids;
  $.ajax({
    type: "POST",
    url: admin_local_portal_url,
    data: dataString,
    cache: false,
    success: function (html) {
      $("#get-more-div").html(html);
    },
  });
}

function _get_subject_form_with_id(page, department_id, class_id) {
  $("#get-more-div").html('<div class="ajax-loader"><img src="'+website_url+'/all-images/images/ajax-loader.gif"/></div>').css({'display': 'flex','justify-content': 'center','align-items': 'center'}).fadeIn(500);
  var action = "get_subject_form_with_id";
  var dataString = "action=" + action + "&page=" + page + "&department_id=" + department_id + "&class_id=" + class_id;
  $.ajax({
    type: "POST",
    url: admin_local_portal_url,
    data: dataString,
    cache: false,
    success: function (html) {
      $("#get-more-div").html(html);
    },
  });
}

function _get_video_form_with_id(page, department_id, class_id, subject_id, tutorial_id) {
  $("#get-more-div").html('<div class="ajax-loader"><img src="'+website_url+'/all-images/images/ajax-loader.gif"/></div>').css({'display': 'flex','justify-content': 'center','align-items': 'center'}).fadeIn(500);
  var action = "get_video_form_with_id";
  var dataString = "action=" + action + "&page=" + page + "&department_id=" + department_id + "&class_id=" + class_id + "&subject_id=" + subject_id + "&tutorial_id=" + tutorial_id;
  $.ajax({
    type: "POST",
    url: admin_local_portal_url,
    data: dataString,
    cache: false,
    success: function (html) {
      $("#get-more-div").html(html);
    },
  });
}

function _get_secondary_form_with_id(page, ids) {
  $("#get-more-div-secondary").html('<div class="ajax-loader"><img src="'+website_url+'/all-images/images/ajax-loader.gif"/></div>').css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);
  var action = "get_secondary_form_with_id";
  var dataString = "action=" + action + "&page=" + page + "&ids=" + ids;
  $.ajax({
    type: "POST",
    url: admin_local_portal_url,
    data: dataString,
    cache: false,
    success: function (html) {
      $("#get-more-div-secondary").html(html);
    },
  });
}

function _get_detail(page,ids,text){
	_get_active_detail(text);
	var action='get_detail';
	$('#get_detail').html('<div class="ajax-loader"><img src="' +website_url +'/all-images/images/ajax-loader.gif"/></div>').fadeIn("fast");
	var dataString ='action='+ action+'&page='+ page+'&ids='+ ids;
	$.ajax({
	type: "POST",
	url: admin_local_portal_url,
	data: dataString,
	cache: false,
	success: function(html){
		$('#get_detail').html(html);
	}
	});
}

function _get_active_modal_link(page){
  $('#question_bank_details, #quiz_question, #load_questions_manually, #load_questions_automatically').removeClass('active-li');
  $('#' + page).addClass('active-li');
}

function _get_page_contents(page, ids) {
  _get_active_modal_link(page);
  $('#get_page_details').html('<div class="ajax-loader cbt-ajax-loader"><img src="all-images/images/ajax-loader2.gif"/></div>').fadeIn(500);
  var action = 'get_page_details';
  var dataString = 'action=' + action + '&page=' + page + '&ids=' + ids;
  $.ajax({
    type: "POST",
    url: admin_local_portal_url,
    data: dataString,
    cache: false,
    success: function (html) {
      $('#get_page_details').html(html);
    }
  });
}


function _get_active_agent_modal_link(page){
  $('#dashboard_details, #contact_person_details, #referees_details').removeClass('active');
  $('#' + page).addClass('active');
}

function _get_agent_page_contents(page, ids) {
  _get_active_agent_modal_link(page);
  $('.company-back-details').html('<div class="ajax-loader agent-ajax-loader"><img src="all-images/images/ajax-loader2.gif"/></div>').fadeIn(500);
  var action = 'get_page_details';
  var dataString = 'action=' + action + '&page=' + page + '&ids=' + ids;
  $.ajax({
    type: "POST",
    url: admin_local_portal_url,
    data: dataString,
    cache: false,
    success: function (html) {
      $('.company-back-details').html(html);
    }
  });
}

$(function () {
  subj_pix = {
    UpdatePreview: function (obj) {
      // if IE < 10 doesn't support FileReader
      if (!window.FileReader) {
        // don't know how to proceed to assign src to image tag
      } else {
        var reader = new FileReader();
        var target = null;

        reader.onload = function (e) {
          target = e.target || e.srcElement;
          $("#subject-pix").prop("src", target.result);
        };
        reader.readAsDataURL(obj.files[0]);
      }
    },
  };
});


$(function () {
  blog_pix = {
    UpdatePreview: function (obj) {
      // if IE < 10 doesn't support FileReader
      if (!window.FileReader) {
        // don't know how to proceed to assign src to image tag
      } else {
        var reader = new FileReader();
        var target = null;

        reader.onload = function (e) {
          target = e.target || e.srcElement;
          $("#blog-pix").prop("src", target.result);
        };
        reader.readAsDataURL(obj.files[0]);
      }
    },
  };
});


$(function () {
  quiz_question_pix_preview = {
    UpdatePreview: function (obj) {
      // if IE < 10 doesn't support FileReader
      if (!window.FileReader) {
        // don't know how to proceed to assign src to image tag
      } else {
        var reader = new FileReader();
        var target = null;

        reader.onload = function (e) {
          target = e.target || e.srcElement;
          $("#quiz_question_pix").prop("src", target.result);
        };
        reader.readAsDataURL(obj.files[0]);
      }
    },
  };
});


$(function () {
  quiz_option_a_pix_preview = {
    UpdatePreview: function (obj) {
      // if IE < 10 doesn't support FileReader
      if (!window.FileReader) {
        // don't know how to proceed to assign src to image tag
      } else {
        var reader = new FileReader();
        var target = null;

        reader.onload = function (e) {
          target = e.target || e.srcElement;
          $("#quiz_option_a_pix").prop("src", target.result);
        };
        reader.readAsDataURL(obj.files[0]);
      }
    },
  };
});


$(function () {
  quiz_option_b_pix_preview = {
    UpdatePreview: function (obj) {
      // if IE < 10 doesn't support FileReader
      if (!window.FileReader) {
        // don't know how to proceed to assign src to image tag
      } else {
        var reader = new FileReader();
        var target = null;

        reader.onload = function (e) {
          target = e.target || e.srcElement;
          $("#quiz_option_b_pix").prop("src", target.result);
        };
        reader.readAsDataURL(obj.files[0]);
      }
    },
  };
});


$(function () {
  quiz_option_c_pix_preview = {
    UpdatePreview: function (obj) {
      // if IE < 10 doesn't support FileReader
      if (!window.FileReader) {
        // don't know how to proceed to assign src to image tag
      } else {
        var reader = new FileReader();
        var target = null;

        reader.onload = function (e) {
          target = e.target || e.srcElement;
          $("#quiz_option_c_pix").prop("src", target.result);
        };
        reader.readAsDataURL(obj.files[0]);
      }
    },
  };
});



$(function () {
  quiz_option_d_pix_preview = {
    UpdatePreview: function (obj) {
      // if IE < 10 doesn't support FileReader
      if (!window.FileReader) {
        // don't know how to proceed to assign src to image tag
      } else {
        var reader = new FileReader();
        var target = null;

        reader.onload = function (e) {
          target = e.target || e.srcElement;
          $("#quiz_option_d_pix").prop("src", target.result);
        };
        reader.readAsDataURL(obj.files[0]);
      }
    },
  };
});


$(function () {
  quiz_option_e_pix_preview = {
    UpdatePreview: function (obj) {
      // if IE < 10 doesn't support FileReader
      if (!window.FileReader) {
        // don't know how to proceed to assign src to image tag
      } else {
        var reader = new FileReader();
        var target = null;

        reader.onload = function (e) {
          target = e.target || e.srcElement;
          $("#quiz_option_e_pix").prop("src", target.result);
        };
        reader.readAsDataURL(obj.files[0]);
      }
    },
  };
});



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


function _get_dashboard_count() {
  var dataString = '';
  $.ajax({
    type: "POST",
    url: endPoint + '/admin/dashboard/statistics',
    data: dataString,
    dataType: "json",
    cache: false,
    headers: {
      'apiKey': apiKey,  
      'Authorization': 'Bearer '+ login_access_key
        },
    success: function (info) {
      var success = info.success;
      var message = info.message;
      
      if(success==true){
        var fetch = info.data[0];
        var total_active_staff_count = fetch.total_active_staff_count;
        var total_active_subjects_count = fetch.total_active_subjects_count;
        var total_active_classes_count = fetch.total_active_classes_count;
        var total_active_departments_count = fetch.total_active_departments_count;

        $("#total_active_staff_count").html(total_active_staff_count);
        $("#total_active_subjects_count").html(total_active_subjects_count);
        $("#total_active_classes_count").html(total_active_classes_count);
        $("#total_active_departments_count").html(total_active_departments_count);

      }else{
        var response = info.response;
        if(response<100){
          _logout();
        }else{
          $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> <span>'+ message +'</span>').fadeIn(500).delay(5000).fadeOut(100);
        }  
      }
  },
  });
}



function _get_staff_login() {
  $("#login_user_fullname,#login_user_login_time").html("XXXXX");
  var dataString = "staff_id=" + login_staff_id;
  $.ajax({
    type: "POST",
    url: endPoint + '/admin/staff/fetch-staff',
    data: dataString,
    dataType: "json",
    cache: false,
    headers: {
      'apiKey': apiKey,  
      'Authorization': 'Bearer '+ login_access_key
        },
    success: function (info) {
       var success = info.success;
       var message = info.message;

      if(success==true){
        var fetch = info.data[0];
        var staff_id = fetch.staff_id;
        var fullname = capitalizeFirstLetterOfEachWord(fetch.fullname);
        var mobile = fetch.mobile;
        var role_name = fetch.role_name;
        var updated_time = fetch.updated_time;
        var profile_pix = fetch.profile_pix;
        var documentStoragePath = fetch.documentStoragePath;

        $("#login_user_fullname,#profile_name,#header_profile_name").html(fullname);
        $("#user_id").html(staff_id);
        $("#header_role_name").html(role_name);
        $("#user_mobile").html(mobile);
        $("#login_user_login_time").html(updated_time);
        _get_header_pix(documentStoragePath,profile_pix);
       }else{
        var response = info.response;
        if(response<100){
          _logout();
        }else{
          $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> <span>'+ message +'</span>').fadeIn(500).delay(5000).fadeOut(100);
        }     
      }
      
    },
  });
}



function _get_header_pix(documentStoragePath, profile_pix) {
  header_pix ='<img id="passportimg2" src="'+ documentStoragePath +"/" + profile_pix +'" />';
  $("#header_pix,#toggle_header_pix").html(header_pix);
}



function _fetchTimeCountOption(select_id, maxValue) {
  for (let minValue = 0; minValue <= maxValue; minValue++) {
    let paddedValue = String(minValue).padStart(2, '0');
    $('#' + select_id).append('<option value="' + paddedValue + '">' + paddedValue + '</option>');
  }
}



function _get_select_status(select_id,status_id){
  var dataString = "status_id=" + status_id;
  $.ajax({
      type: "POST",
      url: endPoint + '/setups/status',
      data: dataString,
      dataType: 'json',
      cache: false,
      headers: {
          'apiKey': apiKey,
          'Authorization': 'Bearer ' + login_access_key
      },
      success: function(info){
        var success = info.success;
        var message = info.message;
        var fetch = info.data;

        if (success == true) {
          for (var i = 0; i < fetch.length; i++) {
            var status_id = fetch[i].status_id;
            var status_name = fetch[i].status_name;
            $('#'+ select_id).append('<option value="'+ status_id +'">'+ status_name +'</option>');
          }
        }else{
          var response = info.response;
          if(response<100){
            _logout();
        }else{
          $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> <span>'+ message +'</span>').fadeIn(500).delay(5000).fadeOut(100);
        }
      }
      }, 
  });
}



function _get_select_role(select_id,role_id) {
  var dataString = "role_id=" + role_id + "&login_role_id=" + login_role_id;
  $.ajax({
      type: "POST",
      url: endPoint + '/setups/role',
      data: dataString,
      dataType: 'json',
      cache: false,
      headers: {
          'apiKey': apiKey,
          'Authorization': 'Bearer ' + login_access_key
      },
      success: function(info){
          var success = info.success;
          var message = info.message;
          var fetch = info.data;

          if (success == true) {
            for (var i = 0; i < fetch.length; i++) {
              var role_id = fetch[i].role_id;
              var role_name = fetch[i].role_name;
              $('#'+ select_id).append('<option value="'+ role_id +'">'+ role_name +'</option>');
            }
          }else{
            var response = info.response;
            if(response<100){
              _logout();
          }else{
            $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> <span>'+ message +'</span>').fadeIn(500).delay(5000).fadeOut(100);
          }
        }
      }, 
  });
}





function _get_select_week(select_id){
  var dataString = '';
  $.ajax({
      type: "POST",
      url: endPoint + '/setups/weeks',
      data: dataString,
      dataType: 'json',
      cache: false,
      headers: {
        'apiKey': apiKey,
        'Authorization': 'Bearer ' + login_access_key
      },
      success: function(info){
        var success = info.success;
        var message = info.message;
        var fetch = info.data;

        if (success == true) {
            for (var i = 0; i < fetch.length; i++) {
              var week_id = fetch[i].week_id;
              var week_name = fetch[i].week_name;
              $('#'+ select_id).append('<option value="'+ week_id +'">'+ week_name +'</option>');
            }
          } else {
            var response = info.response;
            if(response<100){
              _logout();
            }else{
              $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> <span>'+ message +'</span>').fadeIn(500).delay(5000).fadeOut(100);
            }
          }
      }, 
    });
}





function _get_select_term(select_id) {
  var dataString = '';
  $.ajax({
    type: "POST",
    url: endPoint + '/setups/terms',
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
      var fetch = info.data;

      if (success == true) {
        for (var i = 0; i < fetch.length; i++) {
          var term_id = fetch[i].term_id;
          var term_name = fetch[i].term_name;
          $('#'+ select_id).append('<option value="'+ term_id +'">'+ term_name +'</option>');
        }
      } else {
        var response = info.response;
        if(response<100){
          _logout();
        }else{
          $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> <span>'+ message +'</span>').fadeIn(500).delay(5000).fadeOut(100);
        }
      }
    }
	});
}






function _get_select_department(select_id) {
  const dataString = '';
  $.ajax({
    type: "POST",
    url: endPoint + '/admin/departments/fetch-department',
    data: dataString,
    dataType: 'json',
    cache: false,
    headers: {
      'apiKey': apiKey,
      'Authorization': 'Bearer ' + login_access_key
    },
		success: function (info) {
      const success = info.success;
      const message = info.message;
      const fetch = info.data;

				if (success == true) {
					for (let i = 0; i < fetch.length; i++) {
						const department_id = fetch[i].department_id;
						const department_name = fetch[i].department_name;
            $('#'+ select_id).append('<option value="'+ department_id +'">'+ department_name +'</option>');
					}
        } else {
          const response = info.response;
          if(response<100){
            _logout();
          }else{
            $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> <span>'+ message +'</span>').fadeIn(500).delay(5000).fadeOut(100);
          }
        }
		  }
	});
}


function _get_class(dept_input, class_input){
	var department_id = $('#' + dept_input).val();
	$('#' + class_input).html('<option value="">LOADING PLEASE WAIT...</option>');
	const dataString = 'department_id=' + department_id;
	$.ajax({
		type: "POST",
		url: endPoint + '/admin/department-class-subject/fetch-class-by-department',
		data: dataString,
		dataType: 'json',
		cache: false,
		headers: {
			'apiKey': apiKey,
			'Authorization': 'Bearer ' + login_access_key
		},
		success: function(info){
			const success = info.success;
			const message = info.message;

      if (success== true) {
        const data = info.data;
        if (data && data.length > 0) {
          $('#' + class_input).html('<option selected value="">SELECT CLASS</option>');
          for (let i = 0; i < data.length; i++) {
            const class_id = data[i].class_id;
            const class_name = data[i].class_name;
            $('#' + class_input).append('<option value="' + class_id + '">' + class_name + '</option>');
          }
        } else {
          $('#' + class_input).html('<option value="">' + message + '</option>');
        }
      } else {
        $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> <span>' + message + '</span>').fadeIn(500).delay(5000).fadeOut(100);
      }
		}
	});
}



function _fetch_select_subject(select_id) {
  var dataString = '';
  $.ajax({
    type: "POST",
    url: endPoint + '/admin/subjects/fetch-subject',
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
        var fetch = info.data;

				var text = '';
				if (success == true) {
					for (var i = 0; i < fetch.length; i++) {
						var subject_id = fetch[i].subject_id;
						var subject_name = fetch[i].subject_name;
						text += '<option value="' + subject_id + '">' + subject_name.toUpperCase() + '</option>';
					}
        } else {
          text = '<option>' + message + '</option>';
        }
        $('#' + select_id).html(text);
		  }
	  });
}




function _get_login_staff_profile() {
    var dataString = "staff_id=" + login_staff_id;
    $.ajax({
    type: "POST",
    url: endPoint + '/admin/staff/fetch-staff',
    data: dataString,
    dataType: "json",
    cache: false,
    headers: {
      'apiKey': apiKey,  
      'Authorization': 'Bearer '+ login_access_key
        },
    success: function (info) {
      var success = info.success;
      var message = info.message;

      if (success == true) {
        var data = info.data[0];
        var staff_id = data.staff_id;
        var fullname = data.fullname;
        var mobile = data.mobile;
        var email = data.email;
        var address = data.address;
        var profile_pix = data.profile_pix;
        var role_id = data.role_id;  
        var role_name = data.role_name;  
        var status_id = data.status_id;
        var status_name = data.status_name;
        var created_time = data.created_time;
        var last_login_time = data.last_login_time;
        var documentStoragePath = data.documentStoragePath;

        $('#staff_login_fullname').html(fullname);
        $('#last_login_time').html(last_login_time);
        $('#staff_status_name').html(status_name);
        $('#current_user_passport2').html('<img id="passportimg1" src="'+ documentStoragePath +"/" + profile_pix +'"/>');
        $('#updt_fullname').val(fullname);
        $('#updt_mobile').val(mobile);
        $('#updt_email').val(email);
        $('#updt_address').val(address);
        $('#updt_status_id').append('<option value="' + status_id +'" selected="selected">' + status_name +"</option>");
        $('#updt_role_id').append('<option value="' + role_id + '" selected="selected">' + role_name +"</option>");
        $('#staff_id').val(staff_id);
        $('#created_time').val(created_time);
        $('#last_login').val(last_login_time);
      }else{
        var response = info.response;
        if(response<100){
          _logout();
        }else{
          $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> <span>'+ message +'</span>').fadeIn(500).delay(5000).fadeOut(100);
        }
      }
    },
  });
}


function _get_staff_profile(staff_id) {
  var dataString = "staff_id=" + staff_id;
  $.ajax({
    type: "POST",
    url: endPoint + '/admin/staff/fetch-staff',
    data: dataString,
    dataType: "json",
    cache: false,
    headers: {
      'apiKey': apiKey,  
      'Authorization': 'Bearer '+ login_access_key
        },
    success: function (info) {
      var success = info.success;
    
      if (success == true) {
        var data = info.data[0];
        var staff_id = data.staff_id;
        var fullname = data.fullname;
        var mobile = data.mobile;
        var email = data.email;
        var address = data.address;
        var profile_pix = data.profile_pix;
        var role_id = data.role_id;
        var role_name = data.role_name;
        var status_id = data.status_id;
        var status_name = data.status_name;
        var created_time = data.created_time;
        var last_login_time = data.last_login_time;
        var documentStoragePath = data.documentStoragePath;

        $('#staff_login_fullname').html(fullname);
        $('#last_login_time').html(last_login_time);
        $('#staff_status_name').html(status_name);
        $('#current_user_passport1').html('<img id="passportimg4" src="'+ documentStoragePath +"/" + profile_pix +'"/>');

        $('#updt_fullname').val(fullname);
        $('#updt_mobile').val(mobile);
        $('#updt_email').val(email);
        $('#updt_address').val(address);
        $('#updt_status_id').append('<option value="' + status_id +'" selected="selected">' + status_name +"</option>");
        $('#updt_role_id').append('<option value="' + role_id + '" selected="selected">' + role_name +"</option>");
        $('#s_staff_id').val(staff_id);
        $('#s_created_time').val(created_time);
        $('#s_last_login').val(last_login_time);
      }else{
        var response = info.response;
        if(response<100){
          _logout();
        }else{
          $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> <span>'+ message +'</span>').fadeIn(500).delay(5000).fadeOut(100);
        }
      } 
    },
  });
}




function _upload_pix_() {
  $(function () {
    Test = {
      UpdatePreview: function (obj) {
        if (!window.FileReader) {
          // Handle browsers that don't support FileReader
          console.error("FileReader is not supported.");
        } else {
          _upload_profile_pix(login_staff_id);
          var reader = new FileReader();

          reader.onload = function (e) {
            $('#passportimg1,#passportimg2').prop("src", e.target.result);
          };

          reader.readAsDataURL(obj.files[0]);
        }
      },
    };
  });
}



function _upload_profile_pix() {
  var passport_pix_input = $('#profile_pix')[0];
  var passport_pix_file = passport_pix_input.files[0];
  
  var form_data = new FormData();
  form_data.append('staff_id', login_staff_id);
  form_data.append('profile_pix', passport_pix_file);
  form_data.append('profile_pix', profile_pix); 
  
	$.ajax({
    url: endPoint + '/admin/staff/update-staff-picture',
		type: "POST",
		data: form_data,
		contentType: false,
		cache: false,
    headers: {
      'apiKey': apiKey,  
      'Authorization': 'Bearer '+ login_access_key
        },
		processData: false,
		success: function (info) {
			var success = info.success;
			var message = info.message;

      if(success == true){
        $('#success-div').html('<div><i class="bi-check"></i></div>' + message +"").fadeIn(500).delay(5000).fadeOut(100);
      }else{
        $('#warning-div').html('<div><i class="bi-check"></i></div> ' + message +" ").fadeIn(500).delay(3000).fadeOut(100);
      }
		}
	});

}


function _update_staff_profile(staff_id) {
  var fullname = $('#updt_fullname').val();
  var email = $('#updt_email').val();
  var mobile = $('#updt_mobile').val();
  var address = $('#updt_address').val();
  var role_id = $('#updt_role_id').val();
  var status_id = $('#updt_status_id').val();

  $('#updt_fullname, #updt_email, #updt_mobile, #country_id, #updt_address, #updt_role_id, #updt_status_id').removeClass("complain");
  if (fullname == '') {
    $('#updt_fullname').addClass('complain');
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> FULLNAME ERROR!<br /><span>Fill Fields To Continue</span>').fadeIn(500).delay(3000).fadeOut(100);
  
  } else if (email == '' || $('#updt_email').val().indexOf("@") <= 0) {
    $('#updt_email').addClass('complain');
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> EMAIL ERROR!<br /><span>Fill Fields To Continue</span>') .fadeIn(500).delay(3000).fadeOut(100);
 
  } else if (mobile == '') {
    $('#updt_mobile').addClass('complain');
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> MOBILE ERROR!<br /><span>Fill Fields To Continue</span>') .fadeIn(500) .delay(3000).fadeOut(100);
  
  } else if (address == '') {
    $('#updt_address').addClass('complain');
    $("#warning-div") .html('<div><i class="bi-exclamation-octagon-fill"></i></div> ADDRESS ERROR!<br /><span>Fill Fields To Continue</span>'  ).fadeIn(500) .delay(3000).fadeOut(100);
 
  } else if (role_id == '') {
    $('#updt_role_id').addClass('complain');
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> ROLE ERROR!<br /><span>Fill Fields To Continue</span>' ).fadeIn(500).delay(3000) .fadeOut(100);
  
  } else if (status_id == '') {
    $('#updt_status_id').addClass('complain');
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> STATUS ERROR!<br /><span>Fill Fields To Continue</span>' ).fadeIn(500).delay(3000) .fadeOut(100);
 
  } else {
    $('#updt_fullname, #updt_email, #updt_mobile, #country_id, #updt_address, #updt_role_id, #updt_status_id').removeClass("complain");

    if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
      var btn_text = $("#update_btn").html();
      $('#update_btn').html('<i class="fa fa-spinner fa-spin"></i> UPDATING');
      document.getElementById("update_btn").disabled = true;

      var form_data = new FormData();
      form_data.append('staff_id', staff_id);
      form_data.append('fullname', fullname);
      form_data.append('email', email);
      form_data.append('mobile', mobile);
      form_data.append('address', address);
      form_data.append('role_id', role_id);
      form_data.append('status_id', status_id);

        $.ajax({
        type: "POST",
        url: endPoint + '/admin/staff/update-staff',
        data: form_data,
        dataType: "json",
        contentType: false,
        cache: false,
        headers: {
          'apiKey': apiKey,  
          'Authorization': 'Bearer '+ login_access_key
            },
        processData: false,
        success: function (info) {
          var success = info.success;
          var message = info.message;

          if (success == true) {
            $('#success-div').html('<div><i class="bi-check"></i></div>' + message +"").fadeIn(500).delay(5000).fadeOut(100);
            _get_page('view_staff', 'admin');
          } else {
            $('#updt_email').addClass('complain');
            $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> ERROR!<br /><span>'+ message +'</span>') .fadeIn(500).delay(3000).fadeOut(100);
          }
            $('#update_btn').html(btn_text);
            document.getElementById('update_btn').disabled = false;        
        },
        error: function (error) {
          console.log(error);
          $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> An error occurred. Please try again').fadeIn(500).delay(5000).fadeOut(100);
          $("#update_btn").html(btn_text);
          document.getElementById("update_btn").disabled = false;
        }
      });
    }
  }
}


function _update_login_staff_profile() {
  var fullname = $('#updt_fullname').val();
  var email = $('#updt_email').val();
  var mobile = $('#updt_mobile').val();
  var address = $('#updt_address').val();
  var role_id = $('#updt_role_id').val();
  var status_id = $('#updt_status_id').val();

  $('#updt_fullname, #updt_email, #updt_mobile, #country_id, #updt_address, #updt_role_id, #updt_status_id').removeClass("complain");

  if (fullname == '') {
    $('#updt_fullname').addClass('complain');
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> FULLNAME ERROR!<br /><span>Fill Fields To Continue</span>' ).fadeIn(500).delay(3000).fadeOut(100);
  
  } else if (email == '' || $('#updt_email').val().indexOf("@") <= 0) {
    $('#updt_email').addClass('complain');
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> EMAIL ERROR!<br /><span>Fill Fields To Continue</span>').fadeIn(500).delay(3000).fadeOut(100);
 
  } else if (mobile == '') {
    $('#updt_mobile').addClass('complain');
    $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> MOBILE ERROR!<br /><span>Fill Fields To Continue</span>').fadeIn(500).delay(3000).fadeOut(100);

  } else if (address == '') {
    $('#updt_address').addClass('complain');
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> ADDRESS ERROR!<br /><span>Fill Fields To Continue</span>').fadeIn(500).delay(3000).fadeOut(100);
  
  } else if (role_id == '') {
    $('#updt_role_id').addClass('complain');
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> ROLE ERROR!<br /><span>Fill Fields To Continue</span>').fadeIn(500).delay(3000).fadeOut(100);
 
  } else if (status_id == '') {
    $('#updt_status_id').addClass('complain');
    $('#warning-div').html( '<div><i class="bi-exclamation-octagon-fill"></i></div> STATUS ERROR!<br /><span>Fill Fields To Continue</span>').fadeIn(500).delay(3000) .fadeOut(100);
  
  } else {
    $('#updt_fullname, #updt_email, #updt_mobile, #country_id, #updt_address, #updt_role_id, #updt_status_id').removeClass("complain");

    if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
      var btn_text = $("#update_btn").html();
      $('#update_btn').html('<i class="fa fa-spinner fa-spin"></i> UPDATING');
      document.getElementById('update_btn').disabled = true;

      var form_data = new FormData();
      form_data.append('staff_id', login_staff_id);
      form_data.append('fullname', fullname);
      form_data.append('email', email);
      form_data.append('mobile', mobile);
      form_data.append('address', address);
      form_data.append('role_id', role_id);
      form_data.append('status_id', status_id);

      $.ajax({
        type: "POST",
        url: endPoint + '/admin/staff/update-staff',
        data: form_data,
        dataType: "json",
        contentType: false,
        cache: false,
        headers: {
          'apiKey': apiKey,  
          'Authorization': 'Bearer '+ login_access_key
            },
        processData: false,
        success: function (info) {
          var success = info.success;
          var message = info.message;

          if (success == true) {
            $('#success-div').html('<div><i class="bi-check"></i></div>' + message +"").fadeIn(500).delay(5000).fadeOut(100);
            _get_form('my_profile');
          } else {
            $('#updt_email').addClass('complain');
            $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div>  ERROR!<br /><span>'+ message +'</span>').fadeIn(500).delay(3000).fadeOut(100);
          }
          $('#update_btn').html(btn_text);
          document.getElementById('update_btn').disabled = false;        
        },
        error: function (error) {
          console.log(error);
          $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> An error occurred. Please try again').fadeIn(500).delay(5000).fadeOut(100);
          $("#update_btn").html(btn_text);
          document.getElementById("update_btn").disabled = false;
        }
      });
    }
  }
}




function _get_fetch_all_staff() {
  var search_keywords = $('#search_keywords').val();
  var status_id = $('#status_id').val();
  $('#fetch').html('<div class="ajax-loader"><img src="' + website_url + '/all-images/images/ajax-loader.gif"/></div>').fadeIn("fast");
  
  if (search_keywords.length > 2 || search_keywords == '') {
    var dataString = 'status_id=' + status_id + '&search_keywords=' + search_keywords;
    $.ajax({
      type: "POST",
      url: endPoint + '/admin/staff/fetch-staff',
      data: dataString,
      dataType: "json",
      cache: false,
      headers: {
        'apiKey': apiKey,  
        'Authorization': 'Bearer ' + login_access_key
      },
      success: function(info) {
        var fetch = info.data;
        var success = info.success;
        var message = info.message;
        
        var text = '';
        if (success) {
          if (!fetch || (Array.isArray(fetch) && fetch.length === 0)) {
            text +=
              '<div class="false-notification-div">' +
              "<p> " + message + " </p>" +
              '<button class="btn" onclick="_get_form(' + "'staff_reg'" + ')"><i class="bi-person-plus"></i>ADD NEW ADMIN/STAFF</button>' + "</div>";
          } else {
            for (var i = 0; i < fetch.length; i++) {
              var staff_id = fetch[i].staff_id;
              var fullname = fetch[i].fullname;
              var mobile = fetch[i].mobile;
              var status_name = fetch[i].status_name;
              var role_name = fetch[i].role_name;
              var profile_pix = fetch[i].profile_pix;
              var documentStoragePath = fetch[i].documentStoragePath;

              text +=
              '<div class="user-div animated fadeIn" title="Click to view Staff Profile" onclick="_get_form_with_id(\'staff_profile\', \'' + staff_id + '\')">' +
              '<div class="pix-div"><img src="' + documentStoragePath + "/" + profile_pix + '"/></div>' +
              '<div class="detail">' +
              '<div class="name-div"><div class="name"> ' + fullname + '</div><hr /><br/></div>' +
              '<div class="text">ID: <span>' + staff_id + '</span></div>' +
              '<div class="text"><span>' + mobile + '</span></div>' +
              '<div class="text"><span>' + role_name + '</span></div>' +
              '<div class="status-div ' + status_name + '">' + status_name + '</div>' +
              '</div>' +
              '<br clear="all" />' +
              '</div>';
            }
          }
          $('#fetch').html(text);
        } else {
          var response = info.response;
          if (response < 100) {
            _logout();
          }
          text +=
            '<div class="false-notification-div">' +
            "<p> " + message + " </p>" +
            '<button class="btn" onclick="_get_form(' + "'staff_reg'" + ')"><i class="bi-person-plus"></i>ADD NEW ADMIN/STAFF</button>' + "</div>";
          $('#fetch').html(text);
        }
      },
    });
  } else {
    ///
  }
}



function _add_staff() {
  var fullname = $('#reg_fullname').val();
  var email = $('#reg_email').val();
  var mobile = $('#reg_mobile').val();
  var address = $('#reg_address').val();
  var role_id = $('#reg_role_id').val();
  var status_id = $('#reg_status_id').val();
  $('#reg_fullname, #reg_email, #reg_mobile, #country_id, #reg_address, #reg_role_id, #reg_status_id').removeClass('complain');

  if (fullname == '') {
    $('#reg_fullname').addClass('complain');
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> FULLNAME ERROR!<br /><span>Fill Fields To Continue</span>').fadeIn(500).delay(3000).fadeOut(100);

  } else if (email == '' || $('#reg_email').val().indexOf("@") <= 0) {
    $('#reg_email').addClass('complain');
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> EMAIL ERROR!<br /><span>Fill Correct Email To Continue</span>').fadeIn(500).delay(3000).fadeOut(100);

  } else if (mobile == '') {
    $('#reg_mobile').addClass('complain');
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> MOBILE ERROR!<br /><span>Fill Fields To Continue</span>').fadeIn(500).delay(3000).fadeOut(100);

  } else if (address == '') {
    $('#reg_address').addClass('complain');
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> ADDRESS ERROR!<br /><span>Fill Fields To Continue</span>').fadeIn(500).delay(3000).fadeOut(100);

  } else if (role_id == '') {
    $('#reg_role_id').addClass('complain');
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> ROLE NAME ERROR!<br /><span>Fill Fields To Continue</span>').fadeIn(500).delay(3000).fadeOut(100);

  } else if (status_id == '') {
    $('#reg_status_id').addClass('complain');
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> STATUS NAME ERROR!<br /><span>Fill Fields To Continue</span>').fadeIn(500).delay(3000).fadeOut(100);

  } else {
    $('#reg_fullname, #reg_email, #reg_mobile, #country_id, #reg_address, #reg_role_id, #reg_status_id').removeClass("complain");

    var btn_text = $('#add_staff_btn').html();
    $("#add_staff_btn").html('<i class="fa fa-spinner fa-spin"></i> PROCESSING');
    document.getElementById("add_staff_btn").disabled = true;

    var dataString = 'fullname=' + fullname + '&email=' + email + '&mobile=' + mobile + ' &address=' + address + '&role_id=' + role_id + ' &status_id=' + status_id;

    $.ajax({
      type: "POST",
      url: endPoint + '/admin/staff/add-staff',
      dataType: "json",
      data: dataString,
      cache: false,
      headers: {
        'apiKey': apiKey,
        'Authorization': 'Bearer ' + login_access_key
      },
      success: function (info) {
        var success = info.success;
        var message = info.message;

        if (success == true) {
          $('#success-div').html('<div><i class="bi-check"></i></div>' + message + "").fadeIn(500).delay(5000).fadeOut(100);
          _alert_close();
          _get_page('view_staff', 'admin');
        } else {
          $('#reg_email').addClass('complain');
          $('#warning-div').html('<div><i class="bi-check"></i></div>' + message + "").fadeIn(500).delay(3000).fadeOut(100);
          $('#add_staff_btn').html(btn_text);
          document.getElementById('add_staff_btn').disabled = false;
        }
      },
      error: function (error) {
        console.log(error);
        $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> An error occurred. Please try again').fadeIn(500).delay(5000).fadeOut(100);
        $("#add_staff_btn").html(btn_text);
        document.getElementById("add_staff_btn").disabled = false;
      }
    });
  }
}






function _add_subject() {
  var subject_name = $('#subject_name').val();
  var urls = $('#urls').val();
  var status_id = $('#reg_status_id').val();
  var subject_pix_file = $('#thumbnail').prop('files')[0];

  $('#subject_name, #urls ,#status_id').removeClass('complain');

  if (subject_name == '') {
    $('#subject_name').addClass('complain');
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> SUBJECT NAME ERROR!<br /><span>Check Subject Name And Try Again</span>').fadeIn(500).delay(3000).fadeOut(100);
  } else if (urls == '') {
    $('#urls').addClass('complain');
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> SUBJECT URL ERROR!<br /><span>Check Url And Try Again</span>').fadeIn(500).delay(3000).fadeOut(100);
  } else if (status_id == '') {
    $('#reg_status_id').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> STATUS ERROR!<br /><span>Check Status And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);
  } else {
    $('#subject_name, #urls, #status_id').removeClass('complain');

    if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
      var btn_text = $("#submit_btn").html();
      $("#submit_btn").html('<i class="fa fa-spinner fa-spin"></i> PROCESSING');
      document.getElementById("submit_btn").disabled = true;

      var form_data = new FormData();
      form_data.append("subject_name", subject_name);
      form_data.append("urls", urls);
      form_data.append("status_id", status_id);
      form_data.append("thumbnail", subject_pix_file);
  
      $.ajax({
        type: "POST",
        url: endPoint + '/admin/subjects/add-subject',
        data: form_data,
        dataType: "json",
        contentType: false,
        cache: false,
        headers: {
          'apiKey': apiKey,  
          'Authorization': 'Bearer '+ login_access_key
            },
        processData: false,
        success: function (info) {
          var success = info.success;
          var message = info.message;

          if (success == true) {
            $("#success-div").html('<div><i class="bi-check"></i></div> ' + message +"" ).fadeIn(500).delay(5000).fadeOut(100);
            _alert_close();
            _get_page('all_subject', 'subject');
          } else {
            $("#warning-div")
            .html('<div><i class="bi-exclamation-octagon-fill"></i></div> ' + message +"").fadeIn(500) .delay(5000).fadeOut(100);
            $("#submit_btn").html(btn_text);
            document.getElementById("submit_btn").disabled = false;
          }
        },
        error: function (error) {
          console.log(error);
          $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> An error occurred. Please try again').fadeIn(500).delay(5000).fadeOut(100);
          $("#submit_btn").html(btn_text);
          document.getElementById("submit_btn").disabled = false;
        }
      });
    }
  }
}


function _get_fetch_all_subject(div_id2) {
  var search_keywords = $("#search_keywords").val();
  var status_id = $("#status_id").val();

  $('#fetch_all_subjects').html('<div class="ajax-loader"><img src="' + website_url + '/all-images/images/ajax-loader.gif"/></div>').fadeIn("fast");

  if (search_keywords.length > 2 || search_keywords == '') {
      var dataString = 'status_id=' + status_id + '&search_keywords=' + search_keywords;
    $.ajax({
      type: "POST",
      url: endPoint + '/admin/subjects/fetch-subject',
      data: dataString,
      dataType: "json",
      cache: false,
      headers: {
          'apiKey': apiKey,
          'Authorization': 'Bearer ' + login_access_key
      },
      success: function(info) {
        var fetch = info.data;
        var success = info.success;
        var message = info.message;

        var text = '';
        if (success == true) {
            if (!fetch || (Array.isArray(fetch) && fetch.length === 0)) {                     
              text +=
              '<div class="false-notification-div">' +
              "<p>" + message + "</p>" +
              '<button class="btn" onclick="_get_form(' + "'add_and_update_subject'" + ')"><i class="bi-person-plus"></i>ADD NEW SUBJECT</button>' + "</div>";
            } else {
              for (var i = 0; i < fetch.length; i++) {
                  var subject_id = fetch[i].subject_id;
                  var subject_name = fetch[i].subject_name.toUpperCase();
                  var status_name = fetch[i].status_name;
                  var thumbnail = fetch[i].thumbnail;
                  var documentStoragePath = fetch[i].documentStoragePath;
                  
                  if (div_id2 == 'fetch_all_subjects') {
                    text +=
                    '<div class="grid-div animated fadeIn">' +
                    '<div class="div-in">' +
                    '<div class="image-div"><img src="' + documentStoragePath + "/" + thumbnail + '" alt="' + subject_name + '""/></div>' +
                    '<div class="ACTIVE ' + status_name + '">' + status_name + '</div>' +
                    '<div class="info-div">' + '<h2>' + subject_name + '</h2>' + '<hr></hr>' +
                    '<button class="btn" title="EDIT" onclick="_get_form_with_id(' + "'update_subject'" + "," + "'" + subject_id + "'" + ')"><i class="bi-pencil-square"></i> EDIT</button>' +
                    '</div>' +
                    '</div>' +
                    '</div>';
                  } else if (div_id2 == 'fetch_subject_checkbox') {
                    text +=
                    "<label>" +
                    '<div class="radio-in-div">' +
                    '<div class="radio"><input type="checkbox" class="child" id="' + subject_id + '" name="all_subject_id[]" data-value="' + subject_id + '"><div class="border"></div></div>' +
                    '<span>' + subject_name + '</span>' +
                    '</div>' +
                    "</label>";
                  }
              }
            }    
          } else {
            var response = info.response;
            if (response < 100) {
              _logout();
            }             
            text +=
            '<div class="false-notification-div">' +
            "<p>" + message + "</p>" +
            '<button class="btn" onclick="_get_form(' + "'add_and_update_subject'" + ')"><i class="bi-person-plus"></i>ADD NEW SUBJECT</button>' + "</div>";
          }
          $('#' + div_id2).html(text);
        },
      });
  } else {
      $('#' + div_id2).html('<div class="false-notification-div"><p>' + message + '</p></div>');
  }
}


function _fetch_each_subject(subject_id) {
  var dataString = "subject_id=" + subject_id;
  $.ajax({
    type: "POST",
    url: endPoint + '/admin/subjects/fetch-subject',
    data: dataString,
    dataType: "json",
    cache: false,
    headers: {
      'apiKey': apiKey,  
      'Authorization': 'Bearer '+ login_access_key
        },
    success: function (info) {
      var success = info.success;
    
      if (success == true) {
        var data = info.data[0];
        var subject_name = data.subject_name;
        var urls = data.urls;
        var status_id = data.status_id;
        var status_name = data.status_name;
        var thumbnail = data.thumbnail;
        var documentStoragePath = data.documentStoragePath;
     
        $("#updt_subject_name").val(subject_name);
        $("#updt_urls").val(urls);
        $("#updt_status_id").append('<option value="' + status_id +'" selected="selected">' + status_name +"</option>");
        $('#view_pix').html('<img src="'+ documentStoragePath +"/" + thumbnail +'" id="subject-pix" alt="'+ subject_name +'"/>');
    
      } else {
        var response = info.response;
        if(response<100){
          _logout();
        }else{
          $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> <span>'+ message +'</span>').fadeIn(500).delay(5000).fadeOut(100);
        }
      }
    },
  });
}



function _update_subject(subject_id) {
  var subject_name = $('#updt_subject_name').val();
  var urls = $('#updt_urls').val();
  var status_id = $('#updt_status_id').val();
  var updt_subject_pix_file = $('#thumbnail').prop('files')[0];

  $('#updt_subject_name, #updt_urls, #updt_status_id').removeClass('complain');

  if (subject_name == '') {
    $('#updt_subject_name').addClass('complain');
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> SUBJECT NAME ERROR!<br /><span>Check Subject Name And Try Again</span>').fadeIn(500).delay(3000).fadeOut(100);
  } else if (urls == '') {
    $('#updt_urls').addClass('complain');
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> SUBJECT URL ERROR!<br /><span>Check Url And Try Again</span>').fadeIn(500).delay(3000).fadeOut(100);
  } else if (status_id == '') {
    $('#updt_status_id').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> STATUS ERROR!<br /><span>Check Status And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);
  } else {
    $('#updt_subject_name, #updt_urls, #updt_status_id').removeClass('complain');

    if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
      var btn_text = $("#submit_btn").html();
      $("#submit_btn").html('<i class="fa fa-spinner fa-spin"></i> PROCESSING');
      document.getElementById("submit_btn").disabled = true;

      var form_data = new FormData();
      form_data.append("subject_id", subject_id);
      form_data.append("subject_name", subject_name);
      form_data.append("urls", urls);
      form_data.append("status_id", status_id);
      form_data.append("thumbnail", updt_subject_pix_file);
  
      $.ajax({
        type: "POST",
        url: endPoint + '/admin/subjects/update-subject',
        data: form_data,
        dataType: "json",
        contentType: false,
        cache: false,
        headers: {
          'apiKey': apiKey,  
          'Authorization': 'Bearer '+ login_access_key
            },
        processData: false,
        success: function (info) {
          var success = info.success;
          var message = info.message;

          if (success == true) {
            $("#success-div").html('<div><i class="bi-check"></i></div> ' + message +"" ).fadeIn(500).delay(5000).fadeOut(100);
            _alert_close();
            _get_page('all_subject', 'subject');
          } else {
            $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> ' + message +"").fadeIn(500) .delay(5000).fadeOut(100);
            $("#submit_btn").html(btn_text);
            document.getElementById("submit_btn").disabled = false;
          }
        },
        error: function (error) {
          console.log(error);
          $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> An error occurred. Please try again').fadeIn(500).delay(5000).fadeOut(100);
          $("#submit_btn").html(btn_text);
          document.getElementById("submit_btn").disabled = false;
        }
      });
    }
  }
}



function _get_fetch_all_classes(div_id) {
  var search_keywords = $('#search_keywords').val();
  var status_id = $('#status_id').val();

    $('#fetch_classes').html('<div class="ajax-loader"><img src="' + website_url + '/all-images/images/ajax-loader.gif"/></div>').fadeIn("fast");

  if (search_keywords.length > 2 || search_keywords == '') {
  
  var dataString = 'status_id=' + status_id +'&search_keywords=' + search_keywords;
    $.ajax({
      type: "POST",
      url: endPoint + '/admin/classes/fetch-class',
      data: dataString,
      dataType: "json",
      cache: false,
      headers: {
        'apiKey': apiKey,  
        'Authorization': 'Bearer '+ login_access_key
          },
      success: function (info) {
        var fetch = info.data;
        var success = info.success;
        var message = info.message;

        var text = '';
        if (success == true) {
          if (!fetch || (Array.isArray(fetch) && fetch.length === 0)) {
            text +=
            '<div class="false-notification-div">' +
            "<p> " + message +" </p>" +
            '<button class="btn" onclick="_get_form(' + "'add_classes'" +')"><i class="bi-person-plus"></i>ADD NEW CLASS</button>' +"</div>";
              
          } else {
              for (var i = 0; i < fetch.length; i++) {
              var class_id = fetch[i].class_id;
              var class_name = fetch[i].class_name.toUpperCase();
              var status_name = fetch[i].status_name;
              var thumbnail = fetch[i].thumbnail;
              var documentStoragePath = fetch[i].documentStoragePath;
            
            if (div_id == "fetch_classes"){
              text +=
                '<div class="grid-div animated fadeIn">' +
                  '<div class="div-in">' +
                    '<div class="image-div"><img src="'+ documentStoragePath +"/" + thumbnail +'" alt="'+ class_name +'""/></div>'+
                    '<div class="ACTIVE '+status_name +'">' +status_name +'</div>'+
                    '<div class="info-div">' +'<h2>' + class_name +'</h2>' +'<hr></hr>'+
                    '<div class="count-div"></div>' +
                      '<button class="btn" title="EDIT" onclick="_get_form_with_id(' +"'update_classes'" +"," +"'" + class_id +"'" +')"><i class="bi-pencil-square"></i> EDIT</button>' +
                    '</div>'+
                  '</div>'+
                '</div>';
              } else if (div_id == "fetch_classes_checkbox"){
                text +=
                "<label>" +
                '<div class="radio-in-div">'+
                  '<div class="radio"><input type="checkbox" class="child" id="' + class_id +'" name="all_class_id[]" data-value="' + class_id +'"><div class="border"></div></div>'+
                  '<span>'+ class_name +'</span>'+
                '</div>'+
                "</label>";  
              }
            }
            $('#' + div_id).html(text);
          }        
        } else {
          var response = info.response;
          if (response < 100) {
            _logout();
          }                       
          text +=
          '<div class="false-notification-div">' +
            "<p>" + message + "</p>" +
          '<button class="btn" onclick="_get_form(' + "'add_classes'" +')"><i class="bi-person-plus"></i>ADD NEW CLASS</button>' +"</div>";
        }
        $('#' + div_id).html(text);
      },
    });
  }else{
    $('#' + div_id).html('<div class="false-notification-div"><p>' + message + '</p></div>');
  }
  
}


function _fetch_each_class(class_id) {
  var dataString = "class_id=" + class_id;
  $.ajax({
    type: "POST",
    url: endPoint + '/admin/classes/fetch-class',
    data: dataString,
    dataType: "json",
    cache: false,
    headers: {
      'apiKey': apiKey,  
      'Authorization': 'Bearer '+ login_access_key
        },
    success: function (info) {
      var success = info.success;
    
      if (success == true) {
        var data = info.data[0];
        var class_name = data.class_name;
        var urls = data.urls;
        var status_id = data.status_id;
        var status_name = data.status_name;
        var thumbnail = data.thumbnail;
        var documentStoragePath = data.documentStoragePath;
     
        $("#updt_class_name").val(class_name);
        $("#updt_urls").val(urls);
        $("#updt_status_id").append('<option value="' + status_id +'" selected="selected">' + status_name +"</option>");
        $('#view_pix').html('<img src="'+ documentStoragePath +"/" + thumbnail +'" id="subject-pix" alt="'+ class_name +'"/>');
      } else {
        var response = info.response;
        if(response<100){
          _logout();
        }else{
          $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> <span>'+ message +'</span>').fadeIn(500).delay(5000).fadeOut(100);
        }
      }
    },
  });
}



function _update_classes(class_id) {
  var class_name = $('#updt_class_name').val();
  var urls = $('#updt_urls').val();
  var status_id = $('#updt_status_id').val();
  var updt_class_pix_file = $('#thumbnail').prop('files')[0];

  $('#updt_class_name, #updt_urls, #updt_status_id').removeClass('complain');

  if (class_name == '') {
    $('#updt_subject_name').addClass('complain');
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> CLASS NAME ERROR!<br /><span>Check Class Name And Try Again</span>').fadeIn(500).delay(3000).fadeOut(100);
  } else if (urls == '') {
    $('#updt_urls').addClass('complain');
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> CLASS URL ERROR!<br /><span>Check Url And Try Again</span>').fadeIn(500).delay(3000).fadeOut(100);
  } else if (status_id == '') {
    $('#updt_status_id').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> STATUS ERROR!<br /><span>Check Status And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);
  } else {
    $('#updt_class_name, #updt_urls, #updt_status_id').removeClass('complain');

    if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
      var btn_text = $("#submit_btn").html();
      $("#submit_btn").html('<i class="fa fa-spinner fa-spin"></i> PROCESSING');
      document.getElementById("submit_btn").disabled = true;

      var form_data = new FormData();
      form_data.append("class_id", class_id);
      form_data.append("class_name", class_name);
      form_data.append("urls", urls);
      form_data.append("status_id", status_id);
      form_data.append("thumbnail", updt_class_pix_file);
  
      $.ajax({
        type: "POST",
        url: endPoint + '/admin/classes/update-class',
        data: form_data,
        dataType: "json",
        contentType: false,
        cache: false,
        headers: {
          'apiKey': apiKey,  
          'Authorization': 'Bearer '+ login_access_key
            },
        processData: false,
        success: function (info) {
          var success = info.success;
          var message = info.message;
          
          if (success == true) {
            $("#success-div").html('<div><i class="bi-check"></i></div> ' + message +"" ).fadeIn(500).delay(5000).fadeOut(100);
            _alert_close();
            _get_page('all_class', 'class');
          } else {
            $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> ' + message +"").fadeIn(500) .delay(5000).fadeOut(100);
            $("#submit_btn").html(btn_text);
            document.getElementById("submit_btn").disabled = false;
          }
        },
      });
    }
  }
}


function _add_classes() {
  var class_name = $('#class_name').val();
  var urls = $('#urls').val();
  var status_id = $('#reg_status_id').val();
  var class_pix_file = $('#thumbnail').prop('files')[0];

  $('#class_name, #urls ,#status_id').removeClass('complain');

  if (class_name == '') {
    $('#class_name').addClass('complain');
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> CLASS NAME ERROR!<br /><span>Check Subject Name And Try Again</span>').fadeIn(500).delay(3000).fadeOut(100);
  } else if (urls == '') {
    $('#urls').addClass('complain');
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> CLASS URL ERROR!<br /><span>Check Url And Try Again</span>').fadeIn(500).delay(3000).fadeOut(100);
  } else if (status_id == '') {
    $('#reg_status_id').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> STATUS ERROR!<br /><span>Check Status And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);
  } else {
    $('#class_name, #urls, #status_id').removeClass('complain');

    if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
      var btn_text = $("#submit_btn").html();
      $("#submit_btn").html('<i class="fa fa-spinner fa-spin"></i> PROCESSING');
      document.getElementById("submit_btn").disabled = true;

      var form_data = new FormData();
      form_data.append("class_name", class_name);
      form_data.append("urls", urls);
      form_data.append("status_id", status_id);
      form_data.append("thumbnail", class_pix_file);

      $.ajax({
        type: "POST",
        url: endPoint + '/admin/classes/add-class',
        data: form_data,
        dataType: "json",
        contentType: false,
        cache: false,
        headers: {
          'apiKey': apiKey,  
          'Authorization': 'Bearer '+ login_access_key
            },
        processData: false,
        success: function (info) {
          var success = info.success;
          var message = info.message;

          if (success == true) {
            $("#success-div").html('<div><i class="bi-check"></i></div> ' + message +"" ).fadeIn(500).delay(5000).fadeOut(100);
            _alert_close();
            _get_page('all_class', 'class');
          } else {
            $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> ' + message +"").fadeIn(500) .delay(5000).fadeOut(100);
            $("#submit_btn").html(btn_text);
            document.getElementById("submit_btn").disabled = false;
          }
        },
        error: function (error) {
          console.log(error);
          $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> An error occurred. Please try again').fadeIn(500).delay(5000).fadeOut(100);
          $("#submit_btn").html(btn_text);
          document.getElementById("submit_btn").disabled = false;
        }
      });
    }
  }
}



function _add_department() {
  var department_name = $('#department_name').val();
  var urls = $('#urls').val();
  var seo_keywords = $("#seo_keywords").val();
  var seo_description = $("#seo_description").val();
  var status_id = $('#reg_status_id').val();
  var department_pix = $('#thumbnail').prop('files')[0];

  $('#department_name, #urls, #seo_keywords, #seo_description, #status_id').removeClass('complain');

  if (department_name == '') {
    $('#department_name').addClass('complain');
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> DEPARTMENT NAME ERROR!<br /><span>Check Subject Name And Try Again</span>').fadeIn(500).delay(3000).fadeOut(100);
 
  } else if (urls == '') {
    $('#urls').addClass('complain');
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> DEPARTMENT URL ERROR!<br /><span>Check Url And Try Again</span>').fadeIn(500).delay(3000).fadeOut(100);
 
  } else if (seo_keywords == '') {
    $('#seo_keywords').addClass('complain');
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> SEO KEYWORDS ERROR!<br /><span>Check Url And Try Again</span>').fadeIn(500).delay(3000).fadeOut(100);

  } else if (seo_description == '') {
    $('#seo_description').addClass('complain');
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> SEO DESCRIPTION ERROR!<br /><span>Check Url And Try Again</span>').fadeIn(500).delay(3000).fadeOut(100);
    
  } else if (status_id == '') {
    $('#reg_status_id').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> STATUS ERROR!<br /><span>Check Status And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);
 
  } else {
    $('#department_name, #urls, #seo_keywords, #seo_description, #status_id').removeClass('complain');

    if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
      var btn_text = $("#submit_btn").html();
      $("#submit_btn").html('<i class="fa fa-spinner fa-spin"></i> PROCESSING');
      document.getElementById("submit_btn").disabled = true;

      var form_data = new FormData();
      form_data.append("department_name", department_name);
      form_data.append("urls", urls);
      form_data.append("seo_keywords", seo_keywords);
      form_data.append("seo_description", seo_description);
      form_data.append("status_id", status_id);
      form_data.append("thumbnail", department_pix);

      $.ajax({
        type: "POST",
        url: endPoint + '/admin/departments/add-department',
        data: form_data,
        dataType: "json",
        contentType: false,
        cache: false,
        headers: {
          'apiKey': apiKey,  
          'Authorization': 'Bearer '+ login_access_key
            },
        processData: false,
        success: function (info) {
          var success = info.success;
          var message = info.message;

          if (success == true) {
            var department_id = info.department_id;
            var department_name = info.department_name;
            var urls = info.urls;
            var seo_keywords = info.seo_keywords;
            var seo_description = info.seo_description;
            var thumbnail = info.thumbnail;

            _create_department_folder(department_id, department_name, urls, seo_keywords, seo_description, thumbnail, message);
          } else {
            $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> ' + message +"").fadeIn(500) .delay(5000).fadeOut(100);
            $("#submit_btn").html(btn_text);
            document.getElementById("submit_btn").disabled = false;
          }
        },
        error: function (error) {
          console.log(error);
          $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> An error occurred. Please try again').fadeIn(500).delay(5000).fadeOut(100);
          $("#submit_btn").html(btn_text);
          document.getElementById("submit_btn").disabled = false;
        }
      });
    }
  }
}



function  _create_department_folder(department_id, department_name, urls, seo_keywords, seo_description, thumbnail, message) {
  var action = "create_department_folder";

  var form_data = new FormData();
  form_data.append("action", action);
  form_data.append("department_id", department_id);
  form_data.append("department_name", department_name);
  form_data.append("urls", urls);
  form_data.append("seo_keywords", seo_keywords);
  form_data.append("seo_description", seo_description);
  form_data.append("thumbnail", thumbnail);

  $.ajax({
    url: admin_local_portal_url,
    type: "POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    success: function (html) {
      $("#success-div").html('<div><i class="bi-check"></i></div> ' + message +"" ).fadeIn(500).delay(5000).fadeOut(100);
      _alert_close();
      _get_page('all_department', 'department');
    },
  });
}



function _get_fetch_all_department() {
  var search_keywords = $("#search_keywords").val();
  var status_id = $("#status_id").val();

  $('#fetch_all_department').html('<div class="ajax-loader"><img src="' +website_url +'/all-images/images/ajax-loader.gif"/></div>').fadeIn("fast");
  
  if (search_keywords.length > 2 || search_keywords == '') {
  var dataString = 'status_id=' + status_id +'&search_keywords=' + search_keywords;
    $.ajax({
      type: "POST",
      url: endPoint + '/admin/departments/fetch-department',
      data: dataString,
      dataType: "json",
      cache: false,
      headers: {
        'apiKey': apiKey,  
        'Authorization': 'Bearer '+ login_access_key
          },
      success: function (info) {
        var fetch = info.data;
        var success = info.success;
        var message = info.message;
        
        var text = '';
        if (success == true) {
          if (!fetch || (Array.isArray(fetch) && fetch.length === 0)) {
            text +=
            '<div class="false-notification-div">' +
              "<p> " + message +" </p>" +
            '<button class="btn" onclick="_get_form(' + "'dept_reg'" +')"><i class="bi-person-plus"></i>ADD NEW DEPARTMENT</button>' +"</div>";
              
          } else {
              for (var i = 0; i < fetch.length; i++) {
              var department_id = fetch[i].department_id;
              var department_name = fetch[i].department_name.toUpperCase();
              var seo_description = fetch[i].seo_description;
              var status_name = fetch[i].status_name;
              var thumbnail = fetch[i].thumbnail;
              var no_of_classes =fetch[i].no_of_classes;
              var documentStoragePath =fetch[i].documentStoragePath;

              text +=
              '<div class="record-content-div animated fadeIn">'+
                '<div class="div-in">'+
                    '<div class="image-div">'+
                        '<img src="'+ documentStoragePath +"/" + thumbnail +'" alt="'+ department_name +'""/>'+
                    '</div>'+

                    '<div class="text-div">'+
                        '<h2>'+ department_name +'</h2>'+
                        '<p>'+ seo_description +'</p>'+
                        '<div class="count-div">'+
                            '<div class="count-in"> STATUS: <span class="ACTIVE '+ status_name +'">' + status_name +'</span></div>'+
                            '<button class="btn" title="EDIT" onClick="_get_form_with_id(' +"'update_dept'" +"," +"'" + department_id +"'" +');"><i class="bi-pencil-square"></i> EDIT</button>' +
                            '<button class="btn btn2" title="Click to View Classes" onClick="_get_page_with_id(' +"'all_class_dept'" +"," +"'" + department_id +"'" +')"><i class="bi-journals"></i> Number of classes <span>'+ no_of_classes +'</span></button>'+
                        '</div>'+
                    '</div>'+
                '</div> '+
              '</div>';
          }
        }
          $('#fetch_all_department').html(text);
        } else {
          var response = info.response;
          if (response < 100) {
            _logout();
          }
          text +=
          '<div class="false-notification-div">' +
            "<p> " + message +" </p>" +
            '<button class="btn" onclick="_get_form(' + "'add_and_update_subject'" +')"><i class="bi-person-plus"></i>ADD NEW SUBJECT</button>' +"</div>";
          $('#fetch_all_department').html(text);
        }
      },
    });
  } else {
   ///
  }
}


function _fetch_each_department(department_id) {
  var dataString = "department_id=" + department_id;
  $.ajax({
    type: "POST",
    url: endPoint + '/admin/departments/fetch-department',
    data: dataString,
    dataType: "json",
    cache: false,
    headers: {
      'apiKey': apiKey,  
      'Authorization': 'Bearer '+ login_access_key
        },
    success: function (info) {
      var success = info.success;
    
      if (success == true) {
        var data = info.data[0];
        var department_name = data.department_name;
        var urls = data.urls;
        var seo_keywords = data.seo_keywords;
        var seo_description = data.seo_description;
        var status_id = data.status_id;
        var status_name = data.status_name;
        var thumbnail = data.thumbnail;
        var documentStoragePath =data.documentStoragePath;
    
        $("#updt_department_name").val(department_name);
        $("#updt_seo_keywords").val(seo_keywords);
        $("#updt_seo_description").val(seo_description);
        $("#updt_urls").val(urls);
        $("#updt_status_id").append('<option value="' + status_id +'" selected="selected">' + status_name +"</option>");
        $('#view_pix').html('<img src="'+ documentStoragePath +"/" + thumbnail +'" id="subject-pix" alt="'+ department_name +'"/>');
      } else {
        var response = info.response;
        if(response<100){
          _logout();
        }else{
          $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> <span>'+ message +'</span>').fadeIn(500).delay(5000).fadeOut(100);
        }
      }
    },
  });
}


function _update_department(department_id) {
  var department_name = $('#updt_department_name').val();
  var urls = $('#updt_urls').val();
  var seo_keywords = $('#updt_seo_keywords').val();
  var seo_description = $('#updt_seo_description').val();
  var status_id = $('#updt_status_id').val();
  var updt_department_pix = $('#thumbnail').prop('files')[0];

  $('#updt_class_name, #updt_urls, #updt_status_id').removeClass('complain');

  if (department_name == '') {
    $('#updt_department_name').addClass('complain');
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> DEPARTMENT NAME ERROR!<br /><span>Check Department Name And Try Again</span>').fadeIn(500).delay(3000).fadeOut(100);
 
  } else if (urls == '') {
    $('#updt_urls').addClass('complain');
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> DEPARTMENT URL ERROR!<br /><span>Check Url And Try Again</span>').fadeIn(500).delay(3000).fadeOut(100);
 
  } else if (seo_keywords == '') {
    $('#updt_seo_keywords').addClass('complain');
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> SEO KEYWORDS ERROR!<br /><span>Check Seo Keywords And Try Again</span>').fadeIn(500).delay(3000).fadeOut(100);

  } else if (seo_description == '') {
    $('#updt_seo_description').addClass('complain');
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> SEO DESCRIPTION ERROR!<br /><span>Check Seo Description And Try Again</span>').fadeIn(500).delay(3000).fadeOut(100);

  } else if (status_id == '') {
    $('#updt_status_id').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> STATUS ERROR!<br /><span>Check Status And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);
 
  } else {
    $('#updt_class_name, #updt_urls, #updt_status_id').removeClass('complain');

    if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
      var btn_text = $("#submit_btn").html();
      $("#submit_btn").html('<i class="fa fa-spinner fa-spin"></i> PROCESSING');
      document.getElementById("submit_btn").disabled = true;

      var form_data = new FormData();
      form_data.append("department_id", department_id);
      form_data.append("department_name", department_name);
      form_data.append("urls", urls);
      form_data.append("seo_keywords", seo_keywords);
      form_data.append("seo_description", seo_description);
      form_data.append("status_id", status_id);
      form_data.append("thumbnail", updt_department_pix);
  
      $.ajax({
        type: "POST",
        url: endPoint + '/admin/departments/update-department',
        data: form_data,
        dataType: "json",
        contentType: false,
        cache: false,
        headers: {
          'apiKey': apiKey,  
          'Authorization': 'Bearer '+ login_access_key
            },
        processData: false,
        success: function (info) {
          var success = info.success;
          var message = info.message;

          if (success == true) {
            var department_id = info.department_id;
            var department_name = info.department_name;
            var urls = info.urls;
            var db_urls =info.db_urls;
            var seo_keywords = info.seo_keywords;
            var seo_description = info.seo_description;
            var thumbnail = info.thumbnail;
            var db_thumbnail =info.db_thumbnail;

              _update_department_folder(department_id, department_name, urls, db_urls, seo_keywords, seo_description, thumbnail, db_thumbnail, message);             
          } else {
            $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> ' + message +"").fadeIn(500) .delay(5000).fadeOut(100);
            $("#submit_btn").html(btn_text);
            document.getElementById("submit_btn").disabled = false;
          }
        },
        error: function (error) {
          console.log(error);
          $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> An error occurred. Please try again').fadeIn(500).delay(5000).fadeOut(100);
          $("#submit_btn").html(btn_text);
          document.getElementById("submit_btn").disabled = false;
        }
      });
    }
  }
}


function  _update_department_folder(department_id, department_name, urls, db_urls, seo_keywords, seo_description, thumbnail, db_thumbnail, message) {
    var action = "update_department_folder";
    if(thumbnail==null){
      thumbnail='';
    }
    var form_data = new FormData();
    form_data.append("action", action);
    form_data.append("department_id", department_id);
    form_data.append("department_name", department_name);
    form_data.append("urls", urls);
    form_data.append("db_urls", db_urls);
    form_data.append("seo_keywords", seo_keywords);
    form_data.append("seo_description", seo_description);
    form_data.append("thumbnail", thumbnail);
    form_data.append("db_thumbnail", db_thumbnail);

    $.ajax({
      url: admin_local_portal_url,
      type: "POST",
      data: form_data,
      contentType: false,
      cache: false,
      processData: false,
      success: function (html) {
        $("#success-div").html('<div><i class="bi-check"></i></div> ' + message +"" ).fadeIn(500).delay(5000).fadeOut(100);
        _alert_close();
        _get_page('all_department', 'department');
      },
    });

}


function _get_fetch_all_class_dept(department_id) {
  $('#fetch_all_class_dept').html('<div class="ajax-loader"><img src="' +website_url +'/all-images/images/ajax-loader.gif"/></div>').fadeIn("fast");
  var dataString = 'department_id=' + department_id;
    $.ajax({
      type: "POST",
      url: endPoint + '/admin/department-class-subject/fetch-class-by-department',
      data: dataString,
      dataType: "json",
      cache: false,
      headers: {
        'apiKey': apiKey,  
        'Authorization': 'Bearer '+ login_access_key
          },
      success: function (info) {
        var fetch = info.data;
        var success = info.success;
        var message = info.message;
        var department_id = info.department_id;
        var department_name = info.department_name;

        $('#dpt1_name').html(department_name);
        
        var text = '';
        if (success == true) {
          if (!fetch || (Array.isArray(fetch) && fetch.length === 0)) {
            text +=
            '<div class="false-notification-div">' +
              "<p> " + message +" </p>" +
            '<button class="btn" onclick="_get_form_with_id(' + "'add_class_dept'" + "," +"'" + department_id +"'" +')"><i class="bi-plus-square"></i>ADD A NEW CLASS</button>' +"</div>";
            
          } else {
            for (var i = 0; i < fetch.length; i++) {
            var class_id = fetch[i].class_id;
            var class_name = fetch[i].class_name.toUpperCase();
            var seo_description = fetch[i].seo_description;
            var thumbnail = fetch[i].thumbnail;
            var no_of_subjects = fetch[i].no_of_subjects;
            var documentStoragePath = fetch[i].documentStoragePath;

          text +=
          '<div class="record-content-div animated fadeIn">'+
            '<div class="div-in">'+
                '<div class="image-div">'+
                    '<img src="'+ documentStoragePath +"/" + thumbnail +'" alt="'+ class_name +'""/>'+
                '</div>'+

                '<div class="text-div">'+
                    '<h2>'+ class_name +'</h2>'+
                    '<p>'+ seo_description +'</p>'+
                    '<div class="count-div">'+
                        '<div class="count-in"></div>'+
                        '<button class="btn btn2" title="Click to View Subjects" onClick="_get_class_page_with_id(' + "'all_subj_class'" + "," +"'" + department_id +"'"  + "," +"'" + class_id +"'" +')"><i class="bi-journals"></i> Number of subjects <span>' + no_of_subjects + '</span></button>'+
                    '</div>'+
                '</div>'+
            '</div> '+
          '</div>';
          }
        }
          $('#fetch_all_class_dept').html(text);
        } else {
          var response = info.response;
          if (response < 100) {
            _logout();
          }
          text +=
            '<div class="false-notification-div">' +
              "<p> " + message +" </p>" +
            "</div>";
          $('#fetch_all_class_dept').html(text);
        }
      },
    });
}



function _get_fetch_form_class_dept(department_id) {
  var dataString = 'department_id=' + department_id;
    $.ajax({
      type: "POST",
      url: endPoint + '/admin/department-class-subject/fetch-class-by-department',
      data: dataString,
      dataType: "json",
      cache: false,
      headers: {
        'apiKey': apiKey,  
        'Authorization': 'Bearer '+ login_access_key
          },
      success: function (info) {
        var department_name = info.department_name; 
       
        $('#department1_name').html(department_name);  
      },
    });
}


function _add_class_dept(department_id) {
	var all_class_id = []; 
	$(".child:checked").each(function () {
		all_class_id.push($(this).data("value"));
	});
	
  var checked = $('input[name="all_class_id[]"]:checked').length;
  $("#all_class_id").removeClass("complain");

  if (checked < 1) {
  $("#all_class_id").addClass("complain");
  $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> CLASS ERROR!<br /><span>Pick at least 1 CLass And Try Again</span>').fadeIn(500) .delay(3000).fadeOut(100);
  } else {
    $("#all_class_id").removeClass("complain");

    if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
      var btn_text = $("#submit_btn").html();
      $("#submit_btn").html('<i class="fa fa-spinner fa-spin"></i> PROCESSING');
      document.getElementById("submit_btn").disabled = true;
    
      var action = "create_department_class_folder";
      var form_data = new FormData();
      form_data.append("action", action);
      form_data.append("department_id", department_id);
      form_data.append("all_class_id", all_class_id);

		$.ajax({
			type: "POST",
			url: endPoint + '/admin/department-class-subject/add-class-to-department',
      data: form_data,
      dataType: "json",
      contentType: false,
      cache: false,
      headers: {
        'apiKey': apiKey,  
        'Authorization': 'Bearer '+ login_access_key
          },
      processData: false,
			success: function (info) {
				var success = info.success;
				var message = info.message;
        

				if (success == true) {	
          $.ajax({
            url: admin_local_portal_url,
            type: 'POST',
            dataType: 'json',
            data: {response: JSON.stringify(info),action: action}, // Send the entire response as JSON string
            success: function(result) {
              ///// do nothing ///
            }
          });
          $("#success-div").html('<div><i class="bi-check"></i></div> ' + message +"" ).fadeIn(500).delay(5000).fadeOut(100);
          _alert_close();
          _get_page_with_id('all_class_dept', department_id);
        }else {
					$('#warning-div').html('<div><i class="bi-exclamation-circle"></i></div>' + message + '').fadeIn(500).delay(3000).fadeOut(100);
				}
				$('#submit_btn').html(btn_text);
				document.getElementById('submit_btn').disabled = false;
			},
      error: function (error) {
        console.log(error);
        $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> An error occurred. Please try again').fadeIn(500).delay(5000).fadeOut(100);
        $("#submit_btn").html(btn_text);
        document.getElementById("submit_btn").disabled = false;
      }
		});
	}
}
}




function _get_fetch_all_class_subject(department_id, class_id) {
  $('#fetch_all_class_subject').html('<div class="ajax-loader"><img src="' + website_url +'/all-images/images/ajax-loader.gif"/></div>').fadeIn("fast");
  var dataString = 'department_id=' + department_id + '&class_id=' + class_id;
 
    $.ajax({
      type: "POST",
      url: endPoint + '/admin/department-class-subject/fetch-subject-by-class',
      data: dataString,
      dataType: "json",
      cache: false,
      headers: {
        'apiKey': apiKey,  
        'Authorization': 'Bearer '+ login_access_key
          },
      success: function (info) {
        var fetch = info.data;
        var success = info.success;
        var message = info.message;
        var department_name = info.department_name;
        var class_name = info.class_name;
        
        var text = '';
        if (success == true) {
          if (!fetch || (Array.isArray(fetch) && fetch.length === 0)) {
            text +=
            '<div class="false-notification-div">' +
            "<p> " + message +" </p>" +
            '<button class="btn" onclick="_get_subject_form_with_id(' + "'add_subject_class'" + "," +"'" + department_id +"'," +"'" + class_id +"'" +')"><i class="bi-plus-square"></i>ADD A NEW SUBJECT</button>' +"</div>";
            
          } else {
            for (var i = 0; i < fetch.length; i++) {
            var subject_name = fetch[i].subject_name.toUpperCase();
            var seo_description = fetch[i].seo_description;
            var thumbnail = fetch[i].thumbnail;
            var documentStoragePath = fetch[i].documentStoragePath;

          text +=
              '<div class="record-content-div animated fadeIn">'+
                '<div class="div-in">'+
                    '<div class="image-div">'+
                        '<img src="'+ documentStoragePath +"/" + thumbnail +'" alt="'+ subject_name +'""/>'+
                    '</div>'+

                    '<div class="text-div">'+
                        '<h2>'+ subject_name +'</h2>'+
                        '<p>'+ seo_description +'</p>'+
                        '<div class="count-div">'+
                        '</div>'+
                    '</div>'+
                '</div> '+
              '</div>';
          }
        }
          $('#sub_department_name').html(department_name);
          $('#sub_class_name').html(class_name);
          $('#fetch_all_class_subject').html(text);
        } else {
          var response = info.response;
          if (response < 100) {
            _logout();
          }
          text +=
            '<div class="false-notification-div">' +
              "<p> " + message +" </p>" +
            "</div>";
          $('#fetch_all_class_subject').html(text);
        }
      },
    });
}


function _get_fetch_form_subject_class(department_id, class_id) {
  var dataString = 'department_id=' + department_id + '&class_id=' + class_id;
    $.ajax({
      type: "POST",
      url: endPoint + '/admin/department-class-subject/fetch-subject-by-class',
      data: dataString,
      dataType: "json",
      cache: false,
      headers: {
        'apiKey': apiKey,  
        'Authorization': 'Bearer '+ login_access_key
          },
      success: function (info) {
        var class_name = info.class_name; 
       
        $('#class1_name').html(class_name);  
      },
    });
}




function _add_subject_class(department_id, class_id) {
    var all_subject_id = []; 
    $(".child:checked").each(function () {
      all_subject_id.push($(this).data("value"));
    });

    var checked = $('input[name="all_subject_id[]"]:checked').length;
    $("#all_subject_id").removeClass("complain");
  
    if (checked < 1) {
    $("#all_subject_id").addClass("complain");
    $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> SUBJECT ERROR!<br /><span>Pick at least 1 subject And Try Again</span>').fadeIn(500) .delay(3000).fadeOut(100);
    } else {
      $("#all_subject_id").removeClass("complain");
  
      if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
        var btn_text = $("#submit_btn").html();
        $("#submit_btn").html('<i class="fa fa-spinner fa-spin"></i> PROCESSING');
        document.getElementById("submit_btn").disabled = true;
		///////////////////////////////////////////////
    
    var action = "create_subject_class_folder";
    var form_data = new FormData();
    form_data.append("action", action);
    form_data.append("department_id", department_id);
    form_data.append("class_id", class_id);
    form_data.append("all_subject_id", all_subject_id);

		$.ajax({
			type: "POST",
			url: endPoint + '/admin/department-class-subject/add-subject-to-class',
      data: form_data,
      dataType: "json",
      contentType: false,
      cache: false,
      headers: {
        'apiKey': apiKey,  
        'Authorization': 'Bearer '+ login_access_key
          },
      processData: false,
			success: function (info) {
				var success = info.success;
				var message = info.message;
        

				if (success == true) {	
          $.ajax({
            url: admin_local_portal_url,
            type: 'POST',
            dataType: 'json',
            data: {response: JSON.stringify(info),action: action}, // Send the entire response as JSON string
            success: function(result) {           
              ///// do nothing ///
            }
            
          });
          $("#success-div").html('<div><i class="bi-check"></i></div> ' + message +"" ).fadeIn(500).delay(5000).fadeOut(100);
          _alert_close();
          _get_class_page_with_id('all_subj_class', department_id, class_id);
        }else {
					$('#warning-div').html('<div><i class="bi-exclamation-circle"></i></div>' + message + '').fadeIn(500).delay(3000).fadeOut(100);
				}
				$('#submit_btn').html(btn_text);
				document.getElementById('submit_btn').disabled = false;
			},
      error: function (error) {
        console.log(error);
        $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> An error occurred. Please try again').fadeIn(500).delay(5000).fadeOut(100);
        $("#submit_btn").html(btn_text);
        document.getElementById("submit_btn").disabled = false;
      }
		});
  }
  }
}



function _fetch_department_class_subject() {
	var department_id = $('#department_id').val();
  var class_id = $('#class_id').val();
	$('#department_id, #class_id').removeClass('complain');
	
	if (department_id == '') {
	  $('#department_id').addClass('complain');
	  $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> DEPARTMENT REQUIRED!<br /><span>Check And Try Again</span>').fadeIn(500).delay(3000).fadeOut(100);
 
  } else if (class_id == '') {
    $('#class_id').addClass('complain');
    $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> CLASS REQUIRED!<br /><span>Check And Try Again</span>').fadeIn(500).delay(3000).fadeOut(100);

	} else {
    $('#department_id, #class_id').removeClass('complain');

		var btn_text = $("#submit_btn").html();
		$("#submit_btn").html('<i class="fa fa-spinner fa-spin"></i> Loading...');
		document.getElementById("submit_btn").disabled = true;
  
		var form_data = new FormData();
		form_data.append('department_id', department_id);
    form_data.append('class_id', class_id);
	 
		$.ajax({
      type: "POST",
			url: endPoint + '/admin/tutorials/fetch-deparment-class-subjects',
      data: form_data,
      dataType: "json",
      contentType: false,
      cache: false,
      headers: {
        'apiKey': apiKey,  
        'Authorization': 'Bearer '+ login_access_key
          },
      processData: false,
			success: function (info) {
			  var success = info.success;
			  var message = info.message;

			  if (success == true) {
					_alert_close();
					_get_class_page_with_id('tutorial', department_id, class_id);
        } else {
          $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> ' + message +" <br /><span>").fadeIn(500).delay(5000).fadeOut(100);
          $("#submit_btn").html(btn_text);
          document.getElementById("submit_btn").disabled = false;
        }
			},
		});
	}
}




function _get_fetch_department_class_subject(department_id, class_id) {
  $('#fetch_department_class_subject').html('<div class="ajax-loader"><img src="' + website_url +'/all-images/images/ajax-loader.gif"/></div>').fadeIn("fast");
  var dataString = 'department_id=' + department_id + '&class_id=' + class_id;
 
    $.ajax({
      type: "POST",
      url: endPoint + '/admin/tutorials/fetch-deparment-class-subjects',
      data: dataString,
      dataType: "json",
      cache: false,
      headers: {
        'apiKey': apiKey,  
        'Authorization': 'Bearer '+ login_access_key
          },
      success: function (info) {
        var fetch = info.data;
        var success = info.success;
        var message = info.message;
        var department_name = info.department_name;
        var class_name = info.class_name;

        var no=0;
        var text = '';
        if (success == true) {
          if (!fetch || (Array.isArray(fetch) && fetch.length === 0)) {
            text +=
            '<div class="false-notification-div">' +
              "<p> " + message +" </p>" +
            "</div>";
            
          } else {
            for (var i = 0; i < fetch.length; i++) {
              no++;
              var subject_id = fetch[i].subject_id;
              var subject_name = fetch[i].subject_name.toUpperCase();
              var terms = fetch[i].terms;
          
              text +=
                '<div class="quest-faq-div animated fadeIn">' +
                '<div class="faq-title-text">' +
                '<h3>' + subject_name + '<button class="btn-2" title="Add New Video" onClick="_get_video_form_with_id(' + "'video_reg'" + "," + "'" + department_id + "'" + "," + "'" + class_id + "'" + "," + "'" + subject_id + "'" + ');"><i class="bi-plus-square"></i> ADD NEW VIDEO</button> </h3>' +
                '<div class="expand-div" id="' + "view" + no + "num" + '" title="Click to View Terms" onclick="_collapse(' + "'" + 'view' + no + "'" + ')">&nbsp;<i class="bi-chevron-down"></i>&nbsp;</div>' +
                '</div>';
          
              text += '<div class="faq-answer-div" id="' + "view" + no + "answer" + '" style="display:none;">';
          
              for (var j = 0; j < terms.length; j++) {
                  var term_id = terms[j].term_id;
                  var term_name = terms[j].term_name;
                  var total_number_of_videos = terms[j].total_number_of_videos;
                  text += '<button class="btn" title="'+ term_name +'" onClick="_get_video_page_with_id(' + "'video_page'" + "," +"'" + department_id +"'" +"," +"'" + class_id +"'" +"," +"'" + subject_id +"'" +"," +"'" + term_id + "'" +')"><i class="bi-pencil-square"></i> '+ term_name +' &nbsp; <span>'+ total_number_of_videos +'</span>&nbsp;<i class="bi-play-btn-fill"></i></button>';                                   
              }
          
              text += '</div>' + '</div>';
          }
          

        }
          $('#tut_department_name').html(department_name);
          $('#tut_class_name').html(class_name);
          $('#fetch_department_class_subject').html(text);
        } else {
          var response = info.response;
          if (response < 100) {
            _logout();
          }
          text +=
            '<div class="false-notification-div">' +
              "<p> " + message +" </p>" +
            "</div>";
          $('#fetch_department_class_subject').html(text);
        }
      },
    });
}


function _get_fetch_department_class_subject_form(department_id,class_id) {
  var dataString = 'department_id=' + department_id + '&class_id=' + class_id;
 
    $.ajax({
      type: "POST",
      url: endPoint + '/admin/tutorials/fetch-deparment-class-subjects',
      data: dataString,
      dataType: "json",
      cache: false,
      headers: {
        'apiKey': apiKey,  
        'Authorization': 'Bearer '+ login_access_key
          },
      success: function (info) {
        var department_name = info.department_name;
        var class_name = info.class_name;

          $('#tut_department_name').html(department_name);
          $('#tut_class_name').html(class_name);
      },
    });
}


function _get_fetch_subject_form(subject_id) {
  var dataString = 'subject_id=' + subject_id;
    $.ajax({
      type: "POST",
      url: endPoint + '/admin/subjects/fetch-subject',
      data: dataString,
      dataType: "json",
      cache: false,
      headers: {
        'apiKey': apiKey,  
        'Authorization': 'Bearer '+ login_access_key
          },
      success: function (info) {
        var success = info.success;
    
        if (success == true) {
          var data = info.data[0];
          var subject_name = data.subject_name;
        }

        $('#tut_subject_name').html(subject_name);
        $('#update_subject_name').html(subject_name);
      },
    });
}


function _add_tutorial_video(department_id, class_id, subject_id) {
  tinyMCE.triggerSave();
  var term_id = $('#term_id').val();
  var week_id = $('#week_id').val();
  var series_id = 1;
  var topic = $('#topic').val();
  var urls = $('#urls').val();
  var seo_keywords = $('#seo_keywords').val();
  var seo_description = $('#seo_description').val();
  var summary = $('#summary').val();
  var video_pix_file = $('#thumbnail').prop('files')[0];
  var new_video = $('#video').prop('files')[0];
  var duration = $('#duration').val();
  var new_material = $('#material').prop('files')[0];
  var status_id = $('#reg_status_id').val();

  $('#term_id, #week_id, #topic, #urls, #seo_keywords, #seo_description, #summary, #thumbnail, #video, #duration, #material, #status_id').removeClass('complain');

  if (term_id == '') {
      $('#term_id').addClass('complain');
      $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> TERM ERROR!<br /><span>Check Term And Try Again</span>').fadeIn(500).delay(3000).fadeOut(100);

    } else if (week_id == '') {
      $('#week_id').addClass("complain");
      $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> WEEK ERROR!<br /><span>Check Week And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);

  } else if (topic == '') {
      $('#topic').addClass("complain");
      $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> TOPIC ERROR!<br /><span>Check Topic And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);

  } else if (urls == '') {
      $('#urls').addClass("complain");
      $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> URL ERROR!<br /><span>Check Url And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);

  } else if (seo_keywords == '') {
      $('#seo_keywords').addClass("complain");
      $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> SEO KEYWORDS ERROR!<br /><span>Check Seo Keywords And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);

  } else if (seo_description == '') {
      $('#seo_description').addClass("complain");
      $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> SEO DESCRIPTION ERROR!<br /><span>Check Description And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);

  } else if (summary == '') {
      $('#summary').addClass("complain");
      $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> SUMMARY ERROR!<br /><span>Check Summary And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);

  } else if (video_pix_file == '') {
      $('#thumbnail').addClass("complain");
      $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> VIDEO IMAGE ERROR!<br /><span>Check Video Image And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);

  } else if (new_video == '') {
      $('#video').addClass("complain");
      $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> VIDEO ERROR!<br /><span>Check Video And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);

  } else if (duration == '') {
      $('#duration').addClass("complain");
      $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> DURATION ERROR!<br /><span>Check Duration And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);

  } else if (new_material == '') {
      $('#material').addClass("complain");
      $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> MATERIAL ERROR!<br /><span>Check Material And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);

  } else if (status_id == '') {
      $('#reg_status_id').addClass("complain");
      $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> STATUS ERROR!<br /><span>Check Status And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);

  } else {
    $('#term_id, #week_id, #topic, #urls, #seo_keywords, #seo_description, #summary, #thumbnail, #video, #duration, #material, #status_id').removeClass('complain');

      if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
          $("#submit_btn").hide();
          $("#progress-alert").fadeIn(3000);

          var form_data = new FormData();
          form_data.append("department_id", department_id);
          form_data.append("class_id", class_id);
          form_data.append("subject_id", subject_id);
          form_data.append("term_id", term_id);
          form_data.append("week_id", week_id);
          form_data.append("series_id", series_id);
          form_data.append("topic", topic);
          form_data.append("urls", urls);
          form_data.append("seo_keywords", seo_keywords);
          form_data.append("seo_description", seo_description);
          form_data.append("summary", summary);
          form_data.append("thumbnail", video_pix_file);
          form_data.append("video", new_video);
          form_data.append("duration", duration);
          form_data.append("material", new_material);
          form_data.append("status_id", status_id);

          $.ajax({
            //////////// loading progress bar............
            xhr: function() {
                  var xhr = new window.XMLHttpRequest();
                  xhr.upload.addEventListener("progress", function(evt) {
                      if (evt.lengthComputable) {
                          var percentComplete = ((evt.loaded / evt.total) * 100).toFixed();
                          $(".ajax-progress").width(percentComplete + '%');
                          $(".ajax-progress").html(percentComplete+'%');
                      }
                  }, false);
                  return xhr;
                },
             ////////////////////////////////////////////////
              type: "POST",
              url: endPoint + '/admin/tutorials/add-tutorial',
              data: form_data,
              dataType: "json",
              contentType: false,
              cache: false,
              headers: {
                  'apiKey': apiKey,
                  'Authorization': 'Bearer ' + login_access_key
              },
              processData: false,
              success: function(info) {
                  var success = info.success;
                  var message = info.message;

                  if (success == true) {
                      var tutorial_id = info.tutorial_id;
                      var urls = info.urls;
                      var department_urls = info.department_urls;
                      var class_urls = info.class_urls;
                      var subject_urls = info.subject_urls;
                      var thumbnail = info.thumbnail;

                      _create_tutorial_folder(department_id, class_id, tutorial_id, urls, department_urls, class_urls, subject_urls, thumbnail, message);
                  } else {
                      $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> ' + message + "").fadeIn(500).delay(5000).fadeOut(100);
                      $("#submit_btn").fadeIn(3000);
                      $("#progress-alert").hide();
                  }
              },
              error: function (error) {
                console.log(error);
                $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> An error occurred. Please try again later').fadeIn(500).delay(5000).fadeOut(100);
                $("#submit_btn").fadeIn(3000);
                $("#progress-alert").hide();
              }
          });
      }
  }
}


function _create_tutorial_folder(department_id, class_id, tutorial_id, urls, department_urls, class_urls, subject_urls, thumbnail, message) {
    var action = "create_tutorial_folder";
    var form_data = new FormData();
    form_data.append("action", action);
    form_data.append("tutorial_id", tutorial_id);
    form_data.append("urls", urls);
    form_data.append("department_urls", department_urls);
    form_data.append("class_urls", class_urls);
    form_data.append("subject_urls", subject_urls);
    form_data.append("thumbnail", thumbnail);

    $.ajax({
    url: admin_local_portal_url,
    type: "POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    success: function (html) {
      $("#success-div").html('<div><i class="bi-check"></i></div> ' + message +"" ).fadeIn(500).delay(5000).fadeOut(100);
      _alert_close();
      _get_class_page_with_id('tutorial', department_id, class_id);
      },
    });
}











function _fetch_tutorial_video_page(department_id, class_id, subject_id, term_id) {
  var dataString = 'department_id=' + department_id + '&class_id=' + class_id + '&subject_id=' + subject_id + '&term_id=' + term_id;
  $('#fetch_tutorial_video_page').html('<div class="ajax-loader"><img src="' +website_url +'/all-images/images/ajax-loader.gif"/></div>').fadeIn("fast");

    $.ajax({
      type: "POST",
      url: endPoint + '/admin/tutorials/fetch-deparment-class-subject-weeks',
      dataType: "json",
      data: dataString,
      cache: false,
      headers: {
        'apiKey': apiKey,  
        'Authorization': 'Bearer '+ login_access_key
          },
      success: function (info) {
        var fetch = info.data;
        var success = info.success;
        var message = info.message;
        var department_name = info.department_name;
        var class_name = info.class_name;
        var subject_name = info.subject_name;
        var term_name = info.term_name;


        var no=0;
        var text = '';
        if (success == true) {
          if (!fetch || (Array.isArray(fetch) && fetch.length === 0)) {
              text +=
              '<div class="false-notification-div">' +
                "<p> " + message +" </p>" +
              "</div>";
              
          } else {
              for (var i = 0; i < fetch.length; i++) {
                no++;
                var week_name = fetch[i].week_name.toUpperCase();
                var total_number_of_videos = fetch[i].total_number_of_videos;
                var week_videos = fetch[i].week_videos;

              text +=
                '<div class="quest-faq-div animated fadeIn">'+
                  '<div class="faq-title-text">'+ 
                  '<h3>'+ week_name + '<span>Videos '+ total_number_of_videos +'</span></h3>'+
                    '<div class="expand-div" id="'+"view"+no+"num"+'" title="Click to View Terms" onclick="_collapse('+"'"+'view'+no+"'"+')">&nbsp;<i class="bi-chevron-down"></i>&nbsp;</div>'+ 
                  '</div>';             
                 
                  text +='<div class="faq-answer-div" id="'+"view"+no+"answer"+'" style="display: none;">';
                      
                for (var j = 0; j < week_videos.length; j++) {
                    var tutorial_id = week_videos[j].tutorial_id;
                    var topic = week_videos[j].topic;
                    var summary = week_videos[j].summary.substr(0, 138);
                    var thumbnail = week_videos[j].thumbnail;
                    var status_name = week_videos[j].status_name;
                    var duration = week_videos[j].duration;
                    var quiz_question_counts = week_videos[j].quiz_question_counts;
                    var documentStoragePath = week_videos[j].documentStoragePath;

                    text +=
                     '<div class="topics-content-div">'+
                        '<div class="image-div"><img src="'+ documentStoragePath +'/'+ thumbnail +'" alt="'+ topic +'"/>'+
                        '</div>'+

                        '<div class="text">'+
                            '<h4>'+ topic +'</h4>'+
                            '<p>'+ summary +'</p>'+
                            '<hr></hr>'+
                            '<div class="bottom-div">'+
                                '<button class="btn edit" title="EDIT VIDEO" onClick="_get_video_form_with_id(' +"'update_video'" +"," +"'" + department_id +"'" +"," +"'" + class_id +"'" +"," +"'" + subject_id +"'" +"," +"'" + tutorial_id + "'" +');"><i class="bi-pencil-square"></i> EDIT</button>'+
                                '<button class="btn" title="VIEW CBT" onClick="_get_form_with_id(' +"'cbt_page_details'" +"," +"'" + tutorial_id +"'" +');"> <span class="count">'+ quiz_question_counts +'</span> CBT </button>'+
                                '<span>Status: &nbsp;<span class="status-div '+ status_name +'">'+ status_name +'</span></span>&nbsp; &nbsp; &nbsp;'+
                                '<span>Duration: &nbsp;<span class="duration">'+ duration +'</span></span>&nbsp; &nbsp;'+
                            '</div>'+
                        '</div>'+                    
                      '</div>';                       
                }           
                text += '</div>' + '</div>';
          }
        }
          $('#tutorial_department_name').html(department_name);
          $('#tutorial_class_name').html(class_name);
          $('#tutorial_subject_name').html(subject_name);
          $('#tutorial_term_name').html(term_name);
          $('#fetch_tutorial_video_page').html(text);
        } else {
          var response = info.response;
          if (response < 100) {
            _logout();
          }
          text +=
            '<div class="false-notification-div">' +
              "<p> " + message +" </p>" +
            "</div>";
          $('#fetch_tutorial_video_page').html(text);
        }
      },
    });
}



function _get_fetch_each_video_tutorial(tutorial_id) {
  var dataString = "tutorial_id=" + tutorial_id;
  $.ajax({
    type: "POST",
    url: endPoint + '/admin/tutorials/fetch-tutorial',
    data: dataString,
    dataType: "json",
    cache: false,
    headers: {
      'apiKey': apiKey,  
      'Authorization': 'Bearer '+ login_access_key
    },
    success: function (info) {
      var success = info.success;
      var message = info.message
    
      if (success == true) {
        var data = info.data[0];
        var subject_id = data.subject_id;
        var subject_name = data.subject_name;
        var term_id = data.term_id;
        var term_name = data.term_name;
        var week_id = data.week_id;
        var week_name = data.week_name;
        var series_name = data.series_name;
        var topic = data.topic;
        var urls = data.urls;
        var seo_keywords = data.seo_keywords;
        var seo_description = data.seo_description;
        var summary = data.summary;
        var thumbnail = data.thumbnail;
        var video = data.video;
        var duration = data.duration;
        var material = data.material;
        var status_id = data.status_id;
        var status_name = data.status_name;
        var documentStoragePath_pix = data.documentStoragePath_pix;
        var documentStoragePath_material = data.documentStoragePath_material;
        var documentStoragePath_video = data.documentStoragePath_video;
     
        $('#subject_id').append('<option value="' + subject_id +'" selected="selected">' + subject_name +"</option>");
        $('#term_id').append('<option value="' + term_id +'" selected="selected">' + term_name +"</option>");
        $('#week_id').append('<option value="' + week_id +'" selected="selected">' + week_name +"</option>");     
        $('#topic').val(topic);
        $('#urls').val(urls);
        $('#seo_keywords').val(seo_keywords);
        $('#seo_description').val(seo_description);
        $('#duration').val(duration);
        setTimeout(function() {
          tinymce.get('summary').setContent(summary);
        }, 2000);
        $('#updt_status_id').append('<option value="' + status_id +'" selected="selected">' + status_name +"</option>");
        $('#view_tutorial_pix').html('<img src="'+ documentStoragePath_pix +"/" + thumbnail +'" id="subject-pix" alt="'+ topic +'"/>');
        _get_tutorial_pdf(documentStoragePath_material, material);
        _get_tutorial_video(documentStoragePath_video, video);
      } else {
        var response = info.response;
        if (response < 100) {
          _logout();
        }
        $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> <span>'+ message +'</span>').fadeIn(500).delay(5000).fadeOut(100);
      }
    },
  });
}




function _get_fetch_quiz_details(tutorial_id) {
  var dataString = "tutorial_id=" + tutorial_id;
  $.ajax({
    type: "POST",
    url: endPoint + '/admin/tutorials/fetch-tutorial',
    data: dataString,
    dataType: "json",
    cache: false,
    headers: {
      'apiKey': apiKey,  
      'Authorization': 'Bearer '+ login_access_key
    },
    success: function (info) {
      var success = info.success;
      var message = info.message;

      if (success == true) {
        var data = info.data[0];  
        var department_name = data.department_name;
        var class_name = data.class_name;
        var subject_name = data.subject_name;
        var term_name = data.term_name;
        var week_name = data.week_name;
        var topic = data.topic;
        var duration = data.duration;
        var video = data.video;
        var documentStoragePath_video = data.documentStoragePath_video;
        
        $('#department_name').html(department_name);
        $('#class_name').html(class_name);
        $('#subject_name').html(subject_name);
        $('#term_name').html(term_name);
        $('#week_name').html(week_name);
        $('#topic').html(topic);
        $('#duration').html(duration);
        $('#view_cbt_video').html('<video src="'+ documentStoragePath_video +"/" + video +'" id="videoDisplay" name="sub_video" controls="controls" loop="" class="video-slide"></video>');
      }else{
        var response = info.response;
        if(response<100){
          _logout();
        }else{
          $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> <span>'+ message +'</span>').fadeIn(500).delay(5000).fadeOut(100);
        }
      }
    },
  });
}




function _get_tutorial_video(documentStoragePath_video, video) {
  var videoDisplay = document.getElementById('videoDisplay');
  // Set the source of the video element
  videoDisplay.src = documentStoragePath_video + "/" + video;
  // Hide the default background image
  var videoBackground = document.getElementById('video-background');
  videoBackground.style.display = 'none';
  // Show the video
  videoDisplay.style.display = 'block';
}

function _get_tutorial_pdf(documentStoragePath_material, material) {
  var pdfIframe = document.getElementById('pdfFile');
  // Set the source of the iframe element
  pdfIframe.src = documentStoragePath_material + "/" + material;
  // Hide the default background image
  var pdfBackground = document.getElementById('pdf-background');
  pdfBackground.style.display = 'none';
  // Show the PDF
  pdfIframe.style.display = 'block'; // Display the PDF iframe
}



function _update_tutorial_video(department_id,class_id,tutorial_id) {
  tinyMCE.triggerSave();
  var subject_id = $('#subject_id').val();
  var term_id = $('#term_id').val();
  var week_id = $('#week_id').val();
  var series_id = 1;
  var topic = $('#topic').val();
  var urls = $('#urls').val();
  var seo_keywords = $('#seo_keywords').val();
  var seo_description = $('#seo_description').val();
  var summary = $('#summary').val();
  var video_pix_file = $('#thumbnail').prop('files')[0];
  var new_video = $('#video').prop('files')[0];
  var duration = $('#duration').val();
  var new_material = $('#material').prop('files')[0];
  var status_id = $('#updt_status_id').val();

  $('#term_id, #week_id, #topic, #urls, #seo_keywords, #seo_description, #summary, #thumbnail, #video, #duration, #material, #updt_status_id').removeClass('complain');

  if (subject_id == '') {
    $('#subject_id').addClass('complain');
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> SUBJECT ERROR!<br /><span>Check Subject And Try Again</span>').fadeIn(500).delay(3000).fadeOut(100);

  }else if (term_id == '') {
      $('#term_id').addClass('complain');
      $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> TERM ERROR!<br /><span>Check Term And Try Again</span>').fadeIn(500).delay(3000).fadeOut(100);

  } else if (week_id == '') {
      $('#week_id').addClass("complain");
      $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> WEEK ERROR!<br /><span>Check Week And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);

  } else if (topic == '') {
      $('#topic').addClass("complain");
      $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> TOPIC ERROR!<br /><span>Check Topic And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);

  } else if (urls == '') {
      $('#urls').addClass("complain");
      $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> URL ERROR!<br /><span>Check Url And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);

  } else if (seo_keywords == '') {
      $('#seo_keywords').addClass("complain");
      $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> SEO KEYWORDS ERROR!<br /><span>Check Seo Keywords And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);

  } else if (seo_description == '') {
      $('#seo_description').addClass("complain");
      $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> SEO DESCRIPTION ERROR!<br /><span>Check Description And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);

  } else if (summary == '') {
      $('#summary').addClass("complain");
      $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> SUMMARY ERROR!<br /><span>Check Summary And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);

  } else if (video_pix_file == '') {
      $('#thumbnail').addClass("complain");
      $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> VIDEO IMAGE ERROR!<br /><span>Check Video Image And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);

  } else if (new_video == '') {
      $('#video').addClass("complain");
      $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> VIDEO ERROR!<br /><span>Check Video And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);

  } else if (duration == '') {
      $('#duration').addClass("complain");
      $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> DURATION ERROR!<br /><span>Check Duration And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);

  } else if (new_material == '') {
      $('#material').addClass("complain");
      $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> MATERIAL ERROR!<br /><span>Check Material And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);

  } else if (status_id == '') {
      $('#updt_status_id').addClass("complain");
      $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> STATUS ERROR!<br /><span>Check Status And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);

  } else {
    $('#term_id, #week_id, #topic, #urls, #seo_keywords, #seo_description, #summary, #thumbnail, #video, #duration, #material, #updt_status_id').removeClass('complain');

      if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
        $("#submit_btn").hide();
        $("#progress-alert").fadeIn(3000);

        var form_data = new FormData();
        form_data.append("tutorial_id", tutorial_id);
        form_data.append("department_id", department_id);
        form_data.append("class_id", class_id);
        form_data.append("subject_id", subject_id);
        form_data.append("term_id", term_id);
        form_data.append("week_id", week_id);
        form_data.append("series_id", series_id);
        form_data.append("topic", topic);
        form_data.append("urls", urls);
        form_data.append("seo_keywords", seo_keywords);
        form_data.append("seo_description", seo_description);
        form_data.append("summary", summary);
        form_data.append("thumbnail", video_pix_file);
        form_data.append("video", new_video);
        form_data.append("duration", duration);
        form_data.append("material", new_material);
        form_data.append("status_id", status_id);

        $.ajax({
        //////////// loading progress bar............
        xhr: function() {
              var xhr = new window.XMLHttpRequest();
              xhr.upload.addEventListener("progress", function(evt) {
                  if (evt.lengthComputable) {
                      var percentComplete = ((evt.loaded / evt.total) * 100).toFixed();
                      $(".ajax-progress").width(percentComplete + '%');
                      $(".ajax-progress").html(percentComplete+'%');
                  }
              }, false);
              return xhr;
            },
        ///////////////////////////////////////////////
        type: "POST",
        url: endPoint + '/admin/tutorials/update-tutorial',
        data: form_data,
        dataType: "json",
        contentType: false,
        cache: false,
        headers: {
          'apiKey': apiKey,  
          'Authorization': 'Bearer '+ login_access_key
            },
        processData: false,
        success: function (info) {
          var success = info.success;
          var message = info.message;

          if (success == true) {
            var tutorial_id = info.tutorial_id;
            var urls = info.urls;
            var db_urls =info.db_urls;
            var department_urls = info.department_urls;
            var class_urls = info.class_urls;
            var subject_urls = info.subject_urls;
            var thumbnail = info.thumbnail;
            var db_thumbnail =info.db_thumbnail;

             _update_tutorial_video_folder(department_id, class_id, subject_id, term_id, tutorial_id, urls, db_urls, department_urls, class_urls, subject_urls, thumbnail, db_thumbnail, message);                    
          } else {
            $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> ' + message + "").fadeIn(500).delay(5000).fadeOut(100);
            $("#submit_btn").fadeIn(3000);
            $("#progress-alert").hide();
          }
        },
        error: function (error) {
          console.log(error);
          $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> An error occurred. Please try again later').fadeIn(500).delay(5000).fadeOut(100);
          $("#submit_btn").fadeIn(3000);
          $("#progress-alert").hide();
        }
      });
    }
  }
}





function _update_tutorial_video_folder(department_id, class_id, subject_id, term_id, tutorial_id, urls, db_urls, department_urls, class_urls, subject_urls, thumbnail, db_thumbnail, message) {
    var action = "update_tutorial_video_folder";
    if(thumbnail==null){
      thumbnail='';
    }
    var form_data = new FormData();
    form_data.append("action", action);
    form_data.append("tutorial_id", tutorial_id);
    form_data.append("urls", urls);
    form_data.append("db_urls", db_urls);
    form_data.append("department_urls", department_urls);
    form_data.append("class_urls", class_urls);
    form_data.append("subject_urls", subject_urls);
    form_data.append("thumbnail", thumbnail);
    form_data.append("db_thumbnail", db_thumbnail);

    $.ajax({
      url: admin_local_portal_url,
      type: "POST",
      data: form_data,
      contentType: false,
      cache: false,
      processData: false,
      success: function (html) {
        $("#success-div").html('<div><i class="bi-check"></i></div> ' + message +"" ).fadeIn(500).delay(5000).fadeOut(100);
        _get_video_page_with_id('video_page', department_id, class_id, subject_id, term_id);
        _alert_close();
      },
    });

}













function _fetch_dashboard_alert() {
  $('#fetch_dashboard_alert').html('<div class="ajax-loader dash-alert-loader"><img src="' +website_url +'/all-images/images/ajax-loader.gif"/></div>').fadeIn("fast");
    
  $.ajax({
    type: "POST",
    url: endPoint + '/admin/settings/fetch-dashboard-alert',
    dataType: "json",
    cache: false,
    headers: {
      'apiKey': apiKey,  
      'Authorization': 'Bearer '+ login_access_key
        },
    success: function (info) {
      var fetch = info.data;
      var success = info.success;
      var message = info.message;
      
      var text = '';
      if (success == true) {
        if (!fetch || (Array.isArray(fetch) && fetch.length === 0)) {
          text +=
            '<div class="false-notification-div">' +
            "<p> " + message + " </p>" +
            "</div>";
        } else {
          for (var i = 0; i < fetch.length; i++) {
            var alert_id = fetch[i].alert_id;
            var user_name = fetch[i].user_name;
            var alert_detail = fetch[i].alert_detail.substr(0, 55);
            var created_time = fetch[i].created_time;
            
            text +=
            '<div class="system-alert dashboard-system-alert" id="'+ alert_id +'" onclick="_get_form_with_id(' + "'alert-read'" + "," + "'" + alert_id + "'" + ')">' +
              '<div class="alert-name"><i class="bi-person"></i> ' + user_name + '<span id="'+ alert_id +'viewed"><i class="bi-check"></i></span></div>' +
              '<div class="alert-text">Success Alert: ' + alert_detail + '...</div>' +
              '<div class="alert-time"><i class="bi-clock"></i> <span>' + created_time + '</span></div>' +
            '</div>';   
          }
        }
        $('#fetch_dashboard_alert').html(text);     
      } else {
        var response = info.response;
        if (response < 100) {
          _logout();
        }
        text +=
          '<div class="false-notification-div">' +
            "<p> " + message +" </p>" +
          "</div>";
        $('#fetch_dashboard_alert').html(text);
      }
    },
  });
}




function get_notification_number() {
  $.ajax({
  type: "POST",
  url: endPoint + '/admin/settings/fetch-dashboard-alert',
  dataType: "json",
  cache: false,
  headers: {
    'apiKey': apiKey,
    'Authorization': 'Bearer ' + login_access_key
  },
  success: function(info) {
    var success = info.success;
    var unread_alert = info.unread_alert;

    if (success == true) {
      if (unread_alert === undefined || unread_alert === null) {
        unread_alert = 0;
      }
      if (unread_alert >= 100) {
        $('.bell_notification').html('<i class="bi-bell"></i><div>99+</div>');
      } else {
        $('.bell_notification').html('<i class="bi-bell"></i><div>' + unread_alert + '</div>');
      }
    } else {
      var response = info.response;
      if (response < 100) {
        _logout();
      }
    }
  }
  });
}





function _read_alert(alert_id){	
  $('#'+alert_id+'viewed').html('<i class="bi-check2-all"></i>');
  $('#'+alert_id).addClass('system-alert alert-seen');
}






function _fetch_read_alert(alert_id) {
  var dataString = "alert_id=" + alert_id;
  $.ajax({
    type: "POST",
    url: endPoint + '/admin/settings/fetch-system-alert',
    data: dataString,
    dataType: "json",
    cache: false,
    headers: {
      'apiKey': apiKey,  
      'Authorization': 'Bearer '+ login_access_key
    },
    success: function (info) {
      var success = info.success;
      var message = info.message;

      if (success == true) {
        var data = info.data[0];
        var alert_id = data.alert_id;
        var user_id = data.user_id;
        var user_name = data.user_name;
        var ip_address = data.ip_address;
        var system_name = data.system_name;
        var created_time = data.created_time;
        var alert_detail = data.alert_detail;
      
        $('#alert_id').html(alert_id);
        $('#read_user_id').html(user_id);
        $('#user_name').html(user_name);
        $('#ip_address').html(ip_address);
        $('#system_name').html(system_name);
        $('#created_time').html(created_time);
        $('#alert_detail').html(alert_detail);
        _read_alert(alert_id);
        get_notification_number();
      } else {
        var response = info.response;
        if (response < 100) {
          _logout();
        }
        $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> <span>'+ message +'</span>').fadeIn(500).delay(5000).fadeOut(100);
      }
    },
  });
}





function _fetch_system_alert(dataString) {
  $('#fetch_system_alert').html('<div class="ajax-loader system-alert-loader"><img src="' + website_url + '/all-images/images/ajax-loader.gif"/></div>').fadeIn("fast");
    $.ajax({
      type: "POST",
      url: endPoint + '/admin/settings/fetch-system-alert',
      data: dataString,
      dataType: "json",
      cache: false,
      headers: {
        'apiKey': apiKey,
        'Authorization': 'Bearer ' + login_access_key
      },
      success: function(info) {
        var fetch = info.data;
        var success = info.success;
        var message = info.message;
        var date_from = info.date_from;
        var date_to = info.date_to;
        var view_from = info.view_from;
        var view_to = info.view_to;
        var all_record_count = info.all_record_count;

        var text = '';
        if (success == true) {
          if (!fetch || (Array.isArray(fetch) && fetch.length === 0)) {
            view_from = 0;
            view_to = 0;
            all_record_count = 0;

            text +=
              '<div class="false-notification-div">' +
              "<p> " + message + " </p>" +
              "</div>";

          } else {
            for (var i = 0; i < fetch.length; i++) {
              var alert_id = fetch[i].alert_id;
              var user_name = fetch[i].user_name;
              var alert_detail = fetch[i].alert_detail.substr(0, 55);
              var created_time = fetch[i].created_time;
              var seen_status = fetch[i].seen_status;
              
              if (seen_status==0){
                  text +=
                  '<div class="system-alert" id="'+ alert_id +'" onclick="_get_form_with_id(' + "'alert-read'" + "," + "'" + alert_id + "'" + ')">' +
                    '<div class="alert-name"><i class="bi-person"></i> ' + user_name + '<span id="'+ alert_id +'viewed"><i class="bi-check2"></i></span></div>' +
                    '<div class="alert-text">Success Alert: ' + alert_detail + '...</div>' +
                    '<div class="alert-time"><i class="bi-clock"></i> <span>' + created_time + '</span></div>' +
                  '</div>';
              }else{
                  text +=
                  '<div class="system-alert alert-seen" id="'+ alert_id +'" onclick="_get_form_with_id(' + "'alert-read'" + "," + "'" + alert_id + "'" + ')">' +
                    '<div class="alert-name"><i class="bi-person"></i> ' + user_name + '<span id="'+ alert_id +'viewed"><i class="bi-check2-all"></i></span></div>' +
                    '<div class="alert-text">Success Alert: ' + alert_detail + '...</div>' +
                    '<div class="alert-time"><i class="bi-clock"></i> <span>' + created_time + '</span></div>' +
                  '</div>';
              }
   
            }       
          }
          _fetch_dashboard_alert();

          $('#date_from').html(date_from);
          $('#date_to').html(date_to);
          $('#view_from').html(view_from);
          $('#view_to').html(view_to);
          $('#all_record_count').html(all_record_count);
        } else {
          var response = info.response;
          if (response < 100) {
            _logout();
          }
          text +=
            '<div class="false-notification-div">' +
            "<p> " + message + " </p>" +
            "</div>";
        }
        $('#fetch_system_alert').html(text);
      },
    });
}



function get_alert_report(id, view_report){
  $('#srch-text').html($('#'+id).html());
  $('.custom-srch-div').fadeOut(500);
    var dataString ='view_report='+ view_report;
  _fetch_system_alert(dataString);
}



function _get_custom_alert_report(datefrom, dateto, view_report){
  var datefrom = $('#datepicker-from').val();
	var dateto = $('#datepicker-to').val();
  var dataString ='datefrom='+ datefrom + "&dateto=" + dateto + "&view_report=" + view_report;

    if ((datefrom == '') || (dateto == '')) {
      $('#datepicker-from, #datepicker-to').addClass('complain');
      $('#warning-div').html('<div><i class="bi-exclamation-circle"></i></div>DATE ERROR<br /> <span>Select date to continue</span>').fadeIn(500).delay(3000).fadeOut(100);
    } else {
    $('#datepicker-from, #datepicker-to').removeClass('complain');
    _fetch_system_alert(dataString);
  }
}


function alert_bell(){
  var dataString = '';
  _fetch_system_alert(dataString);
}

function _fetch_next_alerts() {
  var search_keywords = $("#search_keywords").val();
  var view_to = $("#view_to").html();
  var view_from = parseInt(view_to); 
  var all_record_count = parseInt($("#all_record_count").html());

  if (view_to < all_record_count) {
    var dataString = 'search_keywords=' + search_keywords + '&view_from=' + view_from;
    _fetch_system_alert(dataString);
  }
}




function _fetch_previous_alerts(){
  var search_keywords = $("#search_keywords").val();
  var view_from = $("#view_from").html();
  var view_from = parseInt(view_from - 51); 

 if(view_from >=0){
    var dataString = 'search_keywords=' + search_keywords + '&view_from=' + view_from; 
    _fetch_system_alert(dataString);
   }
}



function _fetch_alerts_by_keywords(){
  var search_keywords = $("#search_keywords").val();
  if (search_keywords.length > 2 || search_keywords == '') {
  
    var dataString = 'search_keywords=' + search_keywords; 
    _fetch_system_alert(dataString);
  }else{
////
  }
}









function _fetch_settings() {
  var dataString = '';
  $.ajax({
    type: "POST",
    url: endPoint + '/admin/settings/fetch-settings',
    data: dataString,
    dataType: "json",
    cache: false,
    headers: {
      'apiKey': apiKey,  
      'Authorization': 'Bearer '+ login_access_key
    },
    success: function (info) {
      var success = info.success;
      var message = info.message;

      if (success == true) {
        var data = info.data[0];
        var sender_name = data.sender_name;
        var smtp_host = data.smtp_host;
        var smtp_username = data.smtp_username;
        var smtp_password = data.smtp_password;
        var smtp_port = data.smtp_port;
        var support_email = data.support_email;
        var subcription_amount = data.subcription_amount;
        var paystack_payment_key = data.paystack_payment_key;
 
        $('#sender_name').val(sender_name);
        $('#smtp_host').val(smtp_host);
        $('#smtp_host').val(smtp_host);
        $('#smtp_username').val(smtp_username);
        $('#smtp_password').val(smtp_password);
        $('#smtp_port').val(smtp_port);
        $('#support_email').val(support_email);
        $('#subcription_amount').val(subcription_amount);
        $('#paystack_payment_key').val(paystack_payment_key);
      } else {
        var response = info.response;
        if (response < 100) {
          _logout();
        }
        $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> <span>'+ message +'</span>').fadeIn(500).delay(5000).fadeOut(100);
      }
    },
  });
}



function _update_backend_settings() {
  var sender_name = $('#sender_name').val();
  var smtp_host = $('#smtp_host').val();
  var smtp_username = $('#smtp_username').val();
  var smtp_password = $('#smtp_password').val();
  var smtp_port = $('#smtp_port').val();
  var support_email = $('#support_email').val();
  var subcription_amount = $('#subcription_amount').val();
  var paystack_payment_key = $('#paystack_payment_key').val();

  $('#sender_name, #smtp_host, #smtp_username, #smtp_password, #smtp_port, #support_email, #subcription_amount, #paystack_payment_key').removeClass('complain');
  
  if (sender_name == '') {
    $('#sender_name').addClass('complain');
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> SENDER NAME ERROR!<br /><span>Check Sender Name And Try Again</span>').fadeIn(500).delay(3000).fadeOut(100);
 
  } else if (smtp_host == '') {
    $('#smtp_host').addClass('complain');
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> SMTP ERROR!<br /><span>Check Smtp And Try Again</span>').fadeIn(500).delay(3000).fadeOut(100);
 
  } else if (smtp_username == '') {
    $('#smtp_username').addClass('complain');
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> SMTP USERNAME ERROR!<br /><span>Check Smtp Username And Try Again</span>').fadeIn(500).delay(3000).fadeOut(100);

  } else if (smtp_password == '') {
    $('#smtp_password').addClass('complain');
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> SMTP PASSWORD ERROR!<br /><span>Check Smtp Password And Try Again</span>').fadeIn(500).delay(3000).fadeOut(100);

  } else if (smtp_port == '') {
    $('#smtp_port').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> SMTP PORT ERROR!<br /><span>Check Smtp Port And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);
 
  } else if (support_email == '') {
    $('#support_email').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> SMTP EMAIL ERROR!<br /><span>Check Smtp Email And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);

  } else if (subcription_amount == '') {
    $('#subcription_amount').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> SUBSCRIPTION AMOUNT ERROR!<br /><span>Check Subscription Amount And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);

  } else if (paystack_payment_key == '') {
    $('#paystack_payment_key').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> PAYSTACK PAYMENT KEY ERROR!<br /><span>Check Paystack Payment And Retry <span>').fadeIn(500).delay(3000).fadeOut(100);

  } else {
    $('#sender_name, #smtp_host, #smtp_username, #smtp_password, #smtp_port, #support_email, #subcription_amount, #paystack_payment_key').removeClass('complain');

    if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
      var btn_text = $("#update_btn").html();
      $("#update_btn").html('<i class="fa fa-spinner fa-spin"></i> PROCESSING');
      document.getElementById("update_btn").disabled = true;

      var form_data = new FormData();
      form_data.append("sender_name", sender_name);
      form_data.append("smtp_host", smtp_host);
      form_data.append("smtp_username", smtp_username);
      form_data.append("smtp_password", smtp_password);
      form_data.append("support_email", support_email);
      form_data.append("smtp_port", smtp_port);
      form_data.append("support_email", support_email);
      form_data.append("subcription_amount", subcription_amount);
      form_data.append("paystack_payment_key", paystack_payment_key);
  
      $.ajax({
        type: "POST",
        url: endPoint + '/admin/settings/update-settings',
        data: form_data,
        dataType: "json",
        contentType: false,
        cache: false,
        headers: {
          'apiKey': apiKey,  
          'Authorization': 'Bearer '+ login_access_key
            },
        processData: false,
        success: function (info) {
          var success = info.success;
          var message = info.message;

          if (success == true) {
            $("#success-div").html('<div><i class="bi-check"></i></div> ' + message +"" ).fadeIn(500).delay(5000).fadeOut(100);
            _alert_close();
          } else {
            $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> ' + message +"").fadeIn(500) .delay(5000).fadeOut(100);
              $("#update_btn").html(btn_text);
              document.getElementById("update_btn").disabled = false;
          }
        },
        error: function (error) {
          console.log(error);
          $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> An error occurred. Please try again').fadeIn(500).delay(5000).fadeOut(100);
          $("#update_btn").html(btn_text);
          document.getElementById("update_btn").disabled = false;
        }
      });
    }
  }
}



function _show_password_visibility(ids,toggle_pass){
	var password = $('#'+ids).val();
	if (password!='') {
	 $('#'+toggle_pass).show();
	} else {
		$('#'+toggle_pass).hide();
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




function _check_password_match() {
  var new_password = $('#new_password').val();
  var confirm_password = $('#confirm_password').val();
  if (new_password !== confirm_password && confirm_password !== '') {
    $('#message').show();
  } else {
    $('#message').hide();
  }
}


function _update_user_password() {
  var old_password=$('#old_password').val();
  var new_password=$('#new_password').val();
  var confirm_password=$('#confirm_password').val();
  $('#old_password, #new_password, #confirm_password').removeClass('complain');

  if(old_password==''){
    $('#old_password').addClass('complain');
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> Please Fill The Old Passwords<br /><span>Fields cannot be empty</span>').fadeIn(500).delay(5000).fadeOut(100);
 
  } else if(new_password==''){
     $('#new_password').addClass('complain');
     $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> Please Fill New Passwords<br /><span>Fields cannot be empty</span>').fadeIn(500).delay(5000).fadeOut(100);

  }else if(confirm_password==''){
     $('#confirm_password').addClass('complain');
     $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> Please Fill Confirm Passwords<br /><span>Fields cannot be empty</span>').fadeIn(500).delay(5000).fadeOut(100);
  
    }else if(new_password !=confirm_password){
     $('#new_password, #confirm_password').addClass('complain');
     $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> Password Error <br /><span> Password Not Match </span>').fadeIn(500).delay(5000).fadeOut(100);
   
    } else if (new_password.length < 8) {
      $('#new_password,#confirm_password').addClass("complain");
      $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> Password Not Accepted <br /><span> Please follow the instructon </span>').fadeIn(500).delay(5000).fadeOut(100);
   
    }else if (new_password.match(/^(?=[^A-Z]*[A-Z])(?=[^!"#$%&'()*+,-.:;<=>?@[\]^_`{|}~]*[!"#$%&'()*+,-.:;<=>?@[\]^_`{|}~])(?=\D*\d).{8,}$/ )){
    
      if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
        var btn_text = $("#submit_btn").html();
        $("#submit_btn").html('<i class="fa fa-spinner fa-spin"></i> PROCESSING');
        document.getElementById("submit_btn").disabled = true;

      var form_data = new FormData();
      form_data.append("old_password", old_password);
      form_data.append("new_password", new_password);
      form_data.append("confirm_password", confirm_password);

      $.ajax({
        type: "POST",
        url: endPoint + '/admin/settings/change-password',
        data: form_data,
        dataType: "json",
        contentType: false,
        cache: false,
        headers: {
          'apiKey': apiKey,  
          'Authorization': 'Bearer '+ login_access_key
            },
        processData: false,
        success: function (info) {
          var success = info.success;
          var message = info.message;

          if (success==true){
            $("#success-div").html('<div><i class="bi-check"></i></div> ' + message +"" ).fadeIn(500).delay(5000).fadeOut(100);
            _alert_close();
            $('#login_user_fullname').html('XXXX');
            _get_form('access_key_validation_info');
          }else{
            $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> ' + message +"").fadeIn(500) .delay(5000).fadeOut(100);
            $('#old_password').addClass('complain');
          }
            $("#submit_btn").html(btn_text);
            document.getElementById("submit_btn").disabled = false;
          },
          error: function (error) {
            console.log(error);
            $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> An error occurred. Please try again').fadeIn(500).delay(5000).fadeOut(100);
            $("#submit_btn").html(btn_text);
            document.getElementById("submit_btn").disabled = false;
          }

        });
      } else {
        $('#new_password,#confirm_password').addClass("complain");
        $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> Password Not Accepted <br /><span> Please follow the instructon </span>').fadeIn(500).delay(5000).fadeOut(100);
      }
  }
}



function _add_questions_manually(tutorial_id) {
  tinyMCE.triggerSave();
  const question_text = $('#question_text').val();
  const question_pix_file = $('#question_pix').prop('files')[0];
  const option_a = $('#option_a').val();
  const option_a_pix_file = $('#option_a_pix').prop('files')[0];
  const option_b = $('#option_b').val();
  const option_b_pix_file = $('#option_b_pix').prop('files')[0];
  const option_c = $('#option_c').val();
  const option_c_pix_file = $('#option_c_pix').prop('files')[0];
  const option_d = $('#option_d').val();
  const option_d_pix_file = $('#option_d_pix').prop('files')[0];
  const option_e = $('#option_e').val();
  const option_e_pix_file = $('#option_e_pix').prop('files')[0];
  const answer = $('#answer').val();

  $('#question_text, #question_pix, #option_a, #option_a_pix, #option_b, #option_b_pix, #answer').removeClass('complain');

  if ((!question_text) && (!question_pix_file)) {
    $('#question_text').addClass('complain');
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> QUIZ QUESTION ERROR!<br /><span>Check question And Try Again</span>').fadeIn(500).delay(3000).fadeOut(100);

  } else if ((!option_a) && (!option_a_pix_file)) {
    $('#option_a').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> OPTION A ERROR!<br /><span>Check Option A And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);
 
  } else if ((!option_b) && (!option_b_pix_file)) {
    $('#option_b').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> OPTION B ERROR!<br /><span>Check Option B And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);

  } else if (answer == '') {
    $('#answer').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> ANSWER ERROR!<br /><span>Check Answer And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);

  } else {
    
    $('#question_text, #question_pix, #option_a, #option_a_pix, #option_b, #option_b_pix, #answer').removeClass('complain');

    if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
      const btn_text = $("#submit_btn").html();
      $("#submit_btn").html('<i class="fa fa-spinner fa-spin"></i> PROCESSING');
      document.getElementById("submit_btn").disabled = true;

      const form_data = new FormData();
      form_data.append("tutorial_id", tutorial_id);
      form_data.append("question_pix", question_pix_file);
      form_data.append("question_text", question_text);
      form_data.append("option_a", option_a);
      form_data.append("option_a_pix", option_a_pix_file);
      form_data.append("option_b", option_b);
      form_data.append("option_b_pix", option_b_pix_file);
      form_data.append("option_c", option_c);
      form_data.append("option_c_pix", option_c_pix_file);
      form_data.append("option_d", option_d);
      form_data.append("option_d_pix", option_d_pix_file);
      form_data.append("option_e", option_e);
      form_data.append("option_e_pix", option_e_pix_file);
      form_data.append("answer", answer);
  
      $.ajax({
        type: "POST",
        url: endPoint + '/admin/cbt/add-quiz-question-manually',
        data: form_data,
        dataType: "json",
        contentType: false,
        cache: false,
        headers: {
          'apiKey': apiKey,  
          'Authorization': 'Bearer '+ login_access_key
            },
        processData: false,
        success: function (info) {
          const success = info.success;
          const message = info.message;

          if (success == true) {
            $("#success-div").html('<div><i class="bi-check"></i></div>' + message +"" ).fadeIn(500).delay(5000).fadeOut(100);       
            _get_page_contents('question_bank_details', tutorial_id);
          } else {
            $("#warning-div")
            .html('<div><i class="bi-exclamation-octagon-fill"></i></div> ' + message +"").fadeIn(500) .delay(5000).fadeOut(100);
            $("#submit_btn").html(btn_text);
            document.getElementById("submit_btn").disabled = false;
          }
        },
        error: function (error) {
          console.log(error);
          $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> An error occurred. Please try again').fadeIn(500).delay(5000).fadeOut(100);
          $("#submit_btn").html(btn_text);
          document.getElementById("submit_btn").disabled = false;
        }
      });
    }
  }
}


function _fetch_each_question(page, tutorial_id, question_id) {
  _get_active_modal_link(page);
   $('#get_page_details').html('<div class="ajax-loader cbt-ajax-loader"><img src="all-images/images/ajax-loader2.gif"/></div>').fadeIn(500);
   var action = 'get_page_details';
   var dataString = 'action=' + action + '&page=' + page + '&ids=' + tutorial_id + '&question_id=' + question_id;
   $.ajax({
     type: "POST",
     url: admin_local_portal_url,
     data: dataString,
     cache: false,
     success: function (html) {
       $('#get_page_details').html(html);
     }
   });
 }

function _checkAll(){
  $(document).ready(function() {
    $('#parent').on('change', function() {
        $('.child').prop('checked', this.checked);
    });
    $('.child').on('change', function() {
        $('#parent').prop('checked', $('.child:checked').length===$('.child').length);
    });
});
}



function _get_fetch_question_bank(tutorial_id) {
  $('#fetch_all_question_bank').html('<div class="ajax-loader cbt-ajax-loader"><img src="all-images/images/ajax-loader2.gif"/></div>').fadeIn(500);
  const dataString = 'tutorial_id=' + tutorial_id;
 
  $.ajax({
    type: "POST",
    url: endPoint + '/admin/cbt/fetch-question-bank-by-tutorial',
    data: dataString,
    dataType: "json",
    cache: false,
    headers: {
      'apiKey': apiKey,  
      'Authorization': 'Bearer '+ login_access_key
        },
    success: function (info) {
      const fetch = info.questions;
      const success = info.success;
      const message = info.message;
      const quiz_status = info.quiz_status;

      let no=0;
      let text = '';
      if (success == true) {
        if (!fetch || (Array.isArray(fetch) && fetch.length === 0)) {
          text +=
          '<div class="false-notification-div">' +"<p> " + message +" </p>" +"</div>";
        } else {
          for (let i = 0; i < fetch.length; i++) {
            no++;
            const question_id = fetch[i].question_id;
            const question_text = fetch[i].question_text;
            const question_pix = fetch[i].question_pix;
            const questionsStoragePath = fetch[i].questionsStoragePath;
            const options = fetch[i].options;
            const answer = fetch[i].answer;

            text +=
            '<div class="question-div" id="question_'+ question_id +'">'+
              '<div class="div-in">'+
                '<div class="check-div">'+
                  '<label>'+
                      '<input type="checkbox" class="child" name="question_id[]" data-value="'+ question_id +'">'+
                      '<span>Question '+ no +'</span>'+
                  '</label>'; 

                  if(quiz_status=='7'){
                    text +=
                    '<div class="btn-div">'+                    
                      '<button class="btn" title="Edit Question" onclick="_fetch_each_question(' +"'load_questions_manually'" +"," +"'" + tutorial_id +"'" +"," +"'" + question_id +"'"+')"><i class="bi-pencil-square"></i> Edit</button>'+
                      '<button class="btn delete-btn" id="del_btn_'+ question_id +'" title="Delete Question" onclick="_delete_question('+ "'" + question_id + "'" + ')"><i class="bi-trash"></i></button>'+             
                    '</div>';
                  }
                  text +=
                '</div>'+

                '<div class="each-question">';
                  if(!(question_pix=='avatar.jpg')){
                    text += '<div class="pix-div"><img src="'+ questionsStoragePath+ '/'+ question_pix +'" alt="'+ question_id +'"/></div>';
                  }

                  text +=
                  '<div class="text-div">'+
                    '<div>'+ question_text +'</div>'+
                    '<div class="options-div">';

                      for (let j = 0; j < options.length; j++) {
                        const option_id = options[j].option_id;
                        const option_text = options[j].option_text;
                        const option_pix = options[j].option_pix;
                        const optionsStoragePath = options[j].optionsStoragePath;
                        
                        if ((option_id==answer)){
                          text +=
                          '<div class="each-option correct-option">'+                             
                            '<div class="letter">'+ option_id +'</div>';
                            if(!(option_pix=='avatar.jpg')){
                              text +=  '<div class="pix"><img src="'+ optionsStoragePath +'/'+ option_pix +'" alt="'+ option_id +'"/></div>';
                            }
                            text +=
                            '<div>'+ option_text +'</div>'+
                          '</div>';                       
                        }else{
                          text +=
                          '<div class="each-option">'+                               
                            '<div class="letter">'+ option_id +'</div>';
                            if(!(option_pix=='avatar.jpg')){
                              text +=  '<div class="pix"><img src="'+ optionsStoragePath +'/'+ option_pix +'" alt="'+ option_id +'"/></div>';
                            }
                            text +=
                            '<div>'+ option_text +'</div>'+
                          '</div>';
                        }     
                      }
                    text += '</div>'+ 
                  '</div>'+
                '</div>'+         
              '</div>'+
            '</div>';          
          }  
        }    
        $('#fetch_all_question_bank').html(text);
         _checkAll();
      } else {
        const response = info.response;
        if (response < 100) {
          _logout();
        }
        text +=
          '<div class="false-notification-div">' +
            "<p> " + message +" </p>" +
          "</div>";
        $('#fetch_all_question_bank').html(text);
      }
    },
  });
}





function _get_fetch_each_quiz_question(tutorial_id, question_id) {
  const dataString = 'tutorial_id=' + tutorial_id + '&question_id=' + question_id;
  $.ajax({
    type: "POST",
    url: endPoint + '/admin/cbt/fetch-question-bank-by-tutorial',
    data: dataString,
    dataType: "json",
    cache: false,
    headers: {
      'apiKey': apiKey,  
      'Authorization': 'Bearer '+ login_access_key
    },
    success: function (info) {
      const success = info.success;
      const message = info.message;

      if (success == true) {
        const data = info.questions[0];
        const question_pix = data.question_pix;
        const question_text = data.question_text;
        const questionsStoragePath = data.questionsStoragePath;
        const options = data.options;
        const answer = data.answer;

        $('#quiz_question_pix').attr('src', questionsStoragePath + '/' + question_pix);
        $('#answer').val(answer);
        setTimeout(function() {
          tinymce.get('question_text').setContent(question_text);
        }, 2000);

        options.forEach(function(option) {
          const option_text = option.option_text;
          const option_pix = option.option_pix;
          const optionsStoragePath = option.optionsStoragePath;

          if (option.option_id === 'A') {
            $('#quiz_option_a_pix').attr('src', optionsStoragePath + '/' + option_pix);
            setTimeout(function() {
              tinymce.get('option_a').setContent(option_text);
            }, 2000);
          }

          if (option.option_id === 'B') {
            $('#quiz_option_b_pix').attr('src', optionsStoragePath + '/' + option_pix);
            setTimeout(function() {
              tinymce.get('option_b').setContent(option_text);
            }, 2000);
          }

          if (option.option_id === 'C') {
            $('#quiz_option_c_pix').attr('src', optionsStoragePath + '/' + option_pix);
            setTimeout(function() {
              tinymce.get('option_c').setContent(option_text);
            }, 2000);
          }

          if (option.option_id === 'D') {
            $('#quiz_option_d_pix').attr('src', optionsStoragePath + '/' + option_pix);
            setTimeout(function() {
              tinymce.get('option_d').setContent(option_text);
            }, 2000);
          }

          if (option.option_id === 'E') {
            $('#quiz_option_e_pix').attr('src', optionsStoragePath + '/' + option_pix);
            setTimeout(function() {
              tinymce.get('option_e').setContent(option_text);
            }, 2000);
          }
      });

      }else{
        const response = info.response;
        if(response<100){
          _logout();
        }else{
          $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> <span>'+ message +'</span>').fadeIn(500).delay(5000).fadeOut(100);
        }
      }
    },
  });
}




function _update_questions_manually(tutorial_id,question_id) {
  tinyMCE.triggerSave();
  const question_text = $('#question_text').val();
  const question_pix_file = $('#question_pix').prop('files')[0];
  const option_a = $('#option_a').val();
  const option_a_pix_file = $('#option_a_pix').prop('files')[0];
  const option_b = $('#option_b').val();
  const option_b_pix_file = $('#option_b_pix').prop('files')[0];
  const option_c = $('#option_c').val();
  const option_c_pix_file = $('#option_c_pix').prop('files')[0];
  const option_d = $('#option_d').val();
  const option_d_pix_file = $('#option_d_pix').prop('files')[0];
  const option_e = $('#option_e').val();
  const option_e_pix_file = $('#option_e_pix').prop('files')[0];
  const answer = $('#answer').val();

  $('#question_text, #question_pix, #option_a, #option_a_pix, #option_b, #option_b_pix, #answer').removeClass('complain');

  if ((!question_text) && (!question_pix_file)) {
    $('#question_text').addClass('complain');
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> QUIZ QUESTION ERROR!<br /><span>Check question And Try Again</span>').fadeIn(500).delay(3000).fadeOut(100);

  } else if ((!option_a) && (!option_a_pix_file)) {
    $('#option_a').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> OPTION A ERROR!<br /><span>Check Option A And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);
 
  } else if ((!option_b) && (!option_b_pix_file)) {
    $('#option_b').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> OPTION B ERROR!<br /><span>Check Option B And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);

  } else if (answer == '') {
    $('#answer').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> ANSWER ERROR!<br /><span>Check Answer And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);

  } else {
    
    $('#question_text, #question_pix, #option_a, #option_a_pix, #option_b, #option_b_pix, #answer').removeClass('complain');

    if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
      const btn_text = $("#update_btn").html();
      $("#update_btn").html('<i class="fa fa-spinner fa-spin"></i> PROCESSING');
      document.getElementById("update_btn").disabled = true;

      const form_data = new FormData();
      form_data.append("question_id", question_id);
      form_data.append("question_pix", question_pix_file);
      form_data.append("question_text", question_text);
      form_data.append("option_a", option_a);
      form_data.append("option_a_pix", option_a_pix_file);
      form_data.append("option_b", option_b);
      form_data.append("option_b_pix", option_b_pix_file);
      form_data.append("option_c", option_c);
      form_data.append("option_c_pix", option_c_pix_file);
      form_data.append("option_d", option_d);
      form_data.append("option_d_pix", option_d_pix_file);
      form_data.append("option_e", option_e);
      form_data.append("option_e_pix", option_e_pix_file);
      form_data.append("answer", answer);
  
      $.ajax({
        type: "POST",
        url: endPoint + '/admin/cbt/update-quiz-question-manually',
        data: form_data,
        dataType: "json",
        contentType: false,
        cache: false,
        headers: {
          'apiKey': apiKey,  
          'Authorization': 'Bearer '+ login_access_key
            },
        processData: false,
        success: function (info) {
          const success = info.success;
          const message = info.message;

          if (success == true) {
            $("#success-div").html('<div><i class="bi-check"></i></div>' + message +"" ).fadeIn(500).delay(5000).fadeOut(100);       
            _get_page_contents('question_bank_details',tutorial_id);
          } else {
            $("#warning-div")
            .html('<div><i class="bi-exclamation-octagon-fill"></i></div> ' + message +"").fadeIn(500) .delay(5000).fadeOut(100);
            $("#update_btn").html(btn_text);
            document.getElementById("update_btn").disabled = false;
          }
        },
        error: function (error) {
          console.log(error);
          $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> An error occurred. Please try again').fadeIn(500).delay(5000).fadeOut(100);
          $("#update_btn").html(btn_text);
          document.getElementById("update_btn").disabled = false;
        }
      });
    }
  }
}






function _set_questions_as_quiz(tutorial_id) {
  const all_question_id = []; 
  $(".child:checked").each(function () {
    all_question_id.push($(this).data("value"));
  });

  const checked = $('input[name="question_id[]"]:checked').length;
  $("#all_question_id").removeClass("complain");

  if (checked < 1) {
  $("#all_question_id").addClass("complain");
  $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> SET QUIZ ERROR!<br /><span>Pick at least 1 Quiz And Try Again</span>').fadeIn(500) .delay(3000).fadeOut(100);
  } else {
    $("#all_question_id").removeClass("complain");

    if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
      const btn_text = $("#submit_btn").html();
      $("#submit_btn").html('<i class="fa fa-spinner fa-spin"></i> PROCESSING');
      document.getElementById("submit_btn").disabled = true;
      ///////////////////////////////////////////////
  
      const form_data = new FormData();
      form_data.append("tutorial_id", tutorial_id);
      form_data.append("all_question_id", all_question_id);

      $.ajax({
        type: "POST",
        url: endPoint + '/admin/cbt/set-questions-as-quiz',
        data: form_data,
        dataType: "json",
        contentType: false,
        cache: false,
        headers: {
          'apiKey': apiKey,  
          'Authorization': 'Bearer '+ login_access_key
            },
        processData: false,
        success: function (info) {
          const success = info.success;
          const message = info.message;
          
          if (success == true) {	
            $("#success-div").html('<div><i class="bi-check"></i></div> ' + message +"" ).fadeIn(500).delay(5000).fadeOut(100);
            _get_page_contents('quiz_question', tutorial_id);
          }else {
            $('#warning-div').html('<div><i class="bi-exclamation-circle"></i></div>' + message + '').fadeIn(500).delay(3000).fadeOut(100);
          }
          $('#submit_btn').html(btn_text);
          document.getElementById('submit_btn').disabled = false;
        },
        error: function (error) {
          console.log(error);
          $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> An error occurred. Please try again').fadeIn(500).delay(5000).fadeOut(100);
          $("#submit_btn").html(btn_text);
          document.getElementById("submit_btn").disabled = false;
        }
      });
    }
  }
}





function _get_fetch_quiz_question(tutorial_id) {
  $('#fetch_all_quiz_question').html('<div class="ajax-loader cbt-ajax-loader"><img src="all-images/images/ajax-loader2.gif"/></div>').fadeIn(500);
  const dataString = 'tutorial_id=' + tutorial_id;
 
  $.ajax({
    type: "POST",
    url: endPoint + '/admin/cbt/fetch-quiz-questions',
    data: dataString,
    dataType: "json",
    cache: false,
    headers: {
      'apiKey': apiKey,  
      'Authorization': 'Bearer '+ login_access_key
        },
    success: function (info) {
      const fetch = info.questions;
      const success = info.success;
      const message = info.message;
      const quiz_status = info.quiz_status;
      const quiz_duration = info.quiz_duration;

      let no=0;
      let text = '';
      let showButton = '';
      if (success == true) {
        if (!fetch || (Array.isArray(fetch) && fetch.length === 0)) {
          text +=
          '<div class="false-notification-div">' +"<p> " + message +" </p>" +"</div>";
        } else {
          for (let i = 0; i < fetch.length; i++) {
            no++;
            const question_id = fetch[i].question_id;
            const question_text = fetch[i].question_text;
            const question_pix = fetch[i].question_pix;
            const questionsStoragePath = fetch[i].questionsStoragePath;
            const options = fetch[i].options;
            const answer = fetch[i].answer;

            text +=
            '<div class="question-div" id="question_id">'+
              '<div class="div-in">'+
                '<div class="check-div">'+
                  '<label>'+                    
                    '<span>Question '+ no +'</span>'+
                  '</label>'+
                '</div>'+

                '<div class="each-question">';
                  if(!(question_pix=='avatar.jpg')){
                    text += '<div class="pix-div"><img src="'+ questionsStoragePath+ '/'+ question_pix +'" alt="'+ question_id +'"/></div>';
                  }

                  text +=
                  '<div class="text-div">'+
                    '<div>'+ question_text +'</div>'+
                    '<div class="options-div">';

                      for (let j = 0; j < options.length; j++) {
                        const option_id = options[j].option_id;
                        const option_text = options[j].option_text;
                        const option_pix = options[j].option_pix;
                        const optionsStoragePath = options[j].optionsStoragePath;
                        
                        if ((option_id==answer)){
                          text +=
                          '<div class="each-option correct-option">'+                             
                            '<div class="letter">'+ option_id +'</div>';
                            if(!(option_pix=='avatar.jpg')){
                              text +=  '<div class="pix"><img src="'+ optionsStoragePath +'/'+ option_pix +'" alt="'+ option_id +'"/></div>';
                            }
                            text +=
                            '<div>'+ option_text +'</div>'+
                          '</div>';                       
                        }else{
                          text +=
                          '<div class="each-option">'+                               
                            '<div class="letter">'+ option_id +'</div>';
                            if(!(option_pix=='avatar.jpg')){
                              text +=  '<div class="pix"><img src="'+ optionsStoragePath +'/'+ option_pix +'" alt="'+ option_id +'"/></div>';
                            }
                            text +=
                            '<div>'+ option_text +'</div>'+
                          '</div>';
                        }     
                      }
                    text += '</div>'+ 
                  '</div>'+
                '</div>'+         
              '</div>'+
            '</div>';          
          }  
        }    

        if(quiz_status==7){
          showButton += '<button class="btn" title="Activate Question(s)" onClick="_get_secondary_form_with_id(' +"'set_quiz_time_form'" +"," +"'" + tutorial_id +"'"+')"><i class="bi-check2-circle"></i> Activate Quiz</button>';
        }else{
          showButton += '<button class="btn delete" type="button" id="submit_btn" title="Deactivate Question(s)" onclick="_deactivate_quiz('+ "'" + tutorial_id + "'" + ')"><i class="bi-trash"></i> Deactivate Quiz</button>';
        }

        $('#quiz_status').html(showButton);
        $('#quiz_duration').html(quiz_duration);
        $('#fetch_all_quiz_question').html(text);
        
      } else {
        const response = info.response;
        if (response < 100) {
          _logout();
        }
        text +=
          '<div class="false-notification-div">' +
            "<p> " + message +" </p>" +
          "</div>";
        $('#fetch_all_quiz_question').html(text);
      }
    },
  });
}







function _activate_quiz(tutorial_id) {
  const quiz_hour = $('#quiz_hour').val();
  const quiz_min = $('#quiz_min').val();
  const quiz_sec = $('#quiz_sec').val();

  $('#quiz_hour, #quiz_min, #quiz_sec').removeClass('complain');
  if (quiz_hour =='') {
    $("#quiz_hour").addClass("complain");
    $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> QUIZ HOUR ERROR!<br /><span>Select Hour And Try Again</span>').fadeIn(500) .delay(3000).fadeOut(100);
  
  }else if (quiz_min =='') {
    $("#quiz_min").addClass("complain");
    $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> QUIZ MINUTES ERROR!<br /><span>Select Minutes And Try Again</span>').fadeIn(500) .delay(3000).fadeOut(100);
  
  }else if (quiz_sec =='') {
    $("#quiz_sec").addClass("complain");
    $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> QUIZ SECONDS ERROR!<br /><span>Select Seconds And Try Again</span>').fadeIn(500) .delay(3000).fadeOut(100);

  } else {
    $('#quiz_hour, #quiz_min, #quiz_sec').removeClass('complain');

    if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
      const btn_text = $("#submit_btn").html();
      $("#submit_btn").html('<i class="fa fa-spinner fa-spin"></i> PROCESSING');
      document.getElementById("submit_btn").disabled = true;
      ///////////////////////////////////////////////
  
      const form_data = new FormData();
      form_data.append("tutorial_id", tutorial_id);
      form_data.append("quiz_hour", quiz_hour);
      form_data.append("quiz_min", quiz_min);
      form_data.append("quiz_sec", quiz_sec);

      $.ajax({
        type: "POST",
        url: endPoint + '/admin/cbt/activate-quiz',
        data: form_data,
        dataType: "json",
        contentType: false,
        cache: false,
        headers: {
          'apiKey': apiKey,  
          'Authorization': 'Bearer '+ login_access_key
            },
        processData: false,
        success: function (info) {
          const success = info.success;
          const message = info.message;
          
          if (success == true) {	
            $("#success-div").html('<div><i class="bi-check"></i></div> ' + message +"" ).fadeIn(500).delay(5000).fadeOut(100);
            _alert_secondary_close();
            _get_page_contents('quiz_question', tutorial_id);
          }else {
            $('#warning-div').html('<div><i class="bi-exclamation-circle"></i></div>' + message + '').fadeIn(500).delay(3000).fadeOut(100);
          }
          $('#submit_btn').html(btn_text);
          document.getElementById('submit_btn').disabled = false;
        },
        error: function (error) {
          console.log(error);
          $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> An error occurred. Please try again').fadeIn(500).delay(5000).fadeOut(100);
          $("#submit_btn").html(btn_text);
          document.getElementById("submit_btn").disabled = false;
        }
      });
    }
  }
}




function _deactivate_quiz(tutorial_id) {
  if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
    const btn_text = $("#submit_btn").html();
    $("#submit_btn").html('<i class="fa fa-spinner fa-spin"></i> PROCESSING');
    document.getElementById("submit_btn").disabled = true;

    const form_data = new FormData();
    form_data.append("tutorial_id", tutorial_id);

    $.ajax({
      type: "POST",
      url: endPoint + '/admin/cbt/deactivate-quiz',
      data: form_data,
      dataType: "json",
      contentType: false,
      cache: false,
      headers: {
        'apiKey': apiKey,
        'Authorization': 'Bearer ' + login_access_key
      },
      processData: false,
      success: function (info) {
        const success = info.success;
        const message = info.message;

        if (success == true) {
          $("#success-div").html('<div><i class="bi-check"></i></div>' + message).fadeIn(500).delay(5000).fadeOut(100);
            _alert_secondary_close();
            _get_page_contents('quiz_question', tutorial_id);
        } else {
          $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> ' + message).fadeIn(500).delay(5000).fadeOut(100);
          btn.html(btn_text).prop('disabled', false); 
        }
      },
      error: function (error) {
        console.log(error);
        $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> An error occurred. Please try again').fadeIn(500).delay(5000).fadeOut(100);
        btn.html(btn_text).prop('disabled', false);
      }
    });
  }
}




function _delete_question(question_id) {
  if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
    const btn =$("#del_btn_"+ question_id);
    const btn_text = btn.html();
    btn.html('<i class="fa fa-spinner fa-spin"></i>').prop('disabled', true);

    const form_data = new FormData();
    form_data.append("question_id", question_id);

    $.ajax({
      type: "POST",
      url: endPoint + '/admin/cbt/delete-question',
      data: form_data,
      dataType: "json",
      contentType: false,
      cache: false,
      headers: {
        'apiKey': apiKey,
        'Authorization': 'Bearer ' + login_access_key
      },
      processData: false,
      success: function (info) {
        const success = info.success;
        const message = info.message;

        if (success == true) {
          $("#success-div").html('<div><i class="bi-check"></i></div>' + message).fadeIn(500).delay(5000).fadeOut(100);
          $('#question_' + question_id).fadeOut(300);
        } else {
          $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> ' + message).fadeIn(500).delay(5000).fadeOut(100);
          btn.html(btn_text).prop('disabled', false); 
        }
      },
      error: function (error) {
        console.log(error);
        $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> An error occurred. Please try again').fadeIn(500).delay(5000).fadeOut(100);
        btn.html(btn_text).prop('disabled', false); 
      }
    });
  }
}





function _download_question_template() {
  if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
    const btn_text = $("#submit_btn").html();
    $("#submit_btn").html('<i class="fa fa-spinner fa-spin"></i> PROCESSING');
    document.getElementById("submit_btn").disabled = true;

    const form_data = new FormData();
    $.ajax({
      type: "POST",
      url: endPoint + '/admin/cbt/dowload-quiz-question-template',
      data: form_data,
      dataType: "json",
      contentType: false,
      cache: false,
      headers: {
        'apiKey': apiKey,
        'Authorization': 'Bearer ' + login_access_key
      },
      processData: false,
      success: function (info) {
        const success = info.success;
        const message = info.message;

        if (success == true) {
          const url = info.url;
          window.open(url, '_blank');
          $("#success-div").html('<div><i class="bi-check"></i></div>' + message).fadeIn(500).delay(5000).fadeOut(100);
        } 
        $("#submit_btn").html(btn_text).prop('disabled', false);
      },
      error: function (error) {
        console.log(error);
        $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> An error occurred. Please try again').fadeIn(500).delay(5000).fadeOut(100);
        $("#submit_btn").html(btn_text).prop('disabled', false);
      }
    });
  }
}





function _add_questions_automatically(tutorial_id) {
  const quiz_question_template = $('#quiz_question_template').val();
  const csv_question_file = $('#quiz_question_template').prop('files')[0];

  $('#quiz_question_template').removeClass('complain');

  if (!csv_question_file) {
    $('#quiz_question_template').addClass('complain');
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> TEMPLATE FORMAT ERROR!<br /><span>Choose File And Try Again</span>').fadeIn(500).delay(3000).fadeOut(100);
  } else {
    
    $('#quiz_question_template').removeClass('complain');

    if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
      const btn_text = $("#auto_btn").html();
      $("#auto_btn").html('<i class="fa fa-spinner fa-spin"></i> PROCESSING');
      document.getElementById("auto_btn").disabled = true;

      const form_data = new FormData();
      form_data.append("tutorial_id", tutorial_id);
      form_data.append("quiz_question_template", quiz_question_template);
      form_data.append("quiz_question_template", csv_question_file);
  
      $.ajax({
        type: "POST",
        url: endPoint + '/admin/cbt/add-quiz-question-automatically',
        data: form_data,
        dataType: "json",
        contentType: false,
        cache: false,
        headers: {
          'apiKey': apiKey,  
          'Authorization': 'Bearer '+ login_access_key
            },
        processData: false,
        success: function (info) {
          const success = info.success;
          const message = info.message;

          if (success == true) {
            $("#success-div").html('<div><i class="bi-check"></i></div>' + message +"" ).fadeIn(500).delay(5000).fadeOut(100);       
            _get_page_contents('question_bank_details',tutorial_id);
          } else {
            $("#warning-div")
            .html('<div><i class="bi-exclamation-octagon-fill"></i></div> ' + message +"").fadeIn(500) .delay(5000).fadeOut(100);
            $("#auto_btn").html(btn_text);
            document.getElementById("auto_btn").disabled = false;
          }
        },
        error: function (error) {
          console.log(error);
          $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> An error occurred. Please try again').fadeIn(500).delay(5000).fadeOut(100);
          $("#auto_btn").html(btn_text);
          document.getElementById("auto_btn").disabled = false;
        }
      });
    }
  }
}





function _add_agent() {
  const company_name = $('#company_name').val();
  const company_address = $('#company_address').val();
  const company_phone = $('#company_phone').val();
  const company_email = $('#company_email').val();
  const company_logo_file = $('#company_logo').prop('files')[0];
  const company_status_id = $('#reg_company_status_id').val();
  const leaders_tutors_commission = parseFloat($('#leaders_tutors_commission').val()) || 0;
  const leaders_network_commission = parseFloat($('#leaders_network_commission').val()) || 0;
  const company_commission = parseFloat($('#company_commission').val()) || 0;
  const contact_name = $('#contact_name').val();
  const contact_email = $('#contact_email').val();
  const contact_phone = $('#contact_phone').val();
  const contact_role_id = $('#reg_contact_role_id').val();
  const contact_status_id = $('#reg_contact_status_id').val();

  $('#company_name, #company_address, #company_phone, #company_email, #company_logo, #reg_company_status_id, #leaders_tutors_commission, #leaders_network_commission, #company_commission, #contact_name, #contact_email, #contact_phone, #contact_role_id, #reg_contact_status_id').removeClass('complain');

  const totalCommission = leaders_tutors_commission + leaders_network_commission + company_commission;

  if (company_name == '') {
    $('#company_name').addClass('complain');
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> COMPANY NAME ERROR!<br /><span>Check Company Name And Try Again</span>').fadeIn(500).delay(3000).fadeOut(100);
  
  } else if (company_address == '') {
    $('#company_address').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> COMPANY ADDRESS ERROR!<br /><span>Check Company Add And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);
  
  } else if (company_phone == '') {
    $('#company_phone').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> COMPANY PHONE ERROR!<br /><span>Check Company Phone And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);
  
  } else if (company_email == '' || $('#company_email').val().indexOf("@") <= 0) {
    $('#company_email').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> COMPANY EMAIL ERROR!<br /><span>Check Company Email And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);
  
  } else if (!company_logo_file) {
    $('#company_logo').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> COMPANY LOGO ERROR!<br /><span>Check Company Logo And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);
  
  } else if (company_status_id == '') {
    $('#reg_company_status_id').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> COMPANY STATUS ERROR!<br /><span>Check Company Status And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);
  
  } else if (contact_name == '') {
    $('#contact_name').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> CONTACT NAME ERROR!<br /><span>Check Contact Name And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);
  
  } else if (contact_email == '' || $('#contact_email').val().indexOf("@") <= 0) {
    $('#contact_email').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> CONTACT EMAIL ERROR!<br /><span>Check Contact Email And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);
  
  } else if (contact_phone == '') {
    $('#contact_phone').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> CONTACT PHONE ERROR!<br /><span>Check Contact Phone And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);
  
  } else if (contact_role_id == '') {
    $('#reg_contact_role_id').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> CONTACT ROLE ERROR!<br /><span>Check Contact Role And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);
  
  } else if (contact_status_id == '') {
    $('#reg_contact_status_id').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> CONTACT STATUS ERROR!<br /><span>Check Contact Status And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);
  
  } else if (leaders_tutors_commission == '') {
    $('#leaders_tutors_commission').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> LEADERSTUTOR COMMISSION ERROR!<br /><span>Check Commission And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);
  
  } else if (leaders_network_commission == '') {
    $('#leaders_network_commission').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> LEADERSNETWORK COMMISSION ERROR!<br /><span>Check Commission And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);
  
  } else if (company_commission == '') {
    $('#company_commission').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> COMPANY COMMISSION ERROR!<br /><span>Check Commission And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);
  
  } else if (totalCommission > 100) {
    $('#leaders_tutors_commission, #leaders_network_commission, #company_commission').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> COMMISSION ERROR!<br /><span>Total commission must not exceed 100%</span>').fadeIn(500).delay(3000).fadeOut(100);
  
  } else {
    $('#company_name, #company_address, #company_phone, #company_email, #company_logo, #reg_company_status_id, #leaders_tutors_commission, #leaders_network_commission, #company_commission, #contact_name, #contact_email, #contact_phone, #contact_role_id, #reg_contact_status_id').removeClass('complain');

    if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
      const btn_text = $("#submit_btn").html();
      $("#submit_btn").html('<i class="fa fa-spinner fa-spin"></i> PROCESSING');
      document.getElementById("submit_btn").disabled = true;

      const form_data = new FormData();
      form_data.append("company_name", company_name);
      form_data.append("company_address", company_address);
      form_data.append("company_phone", company_phone);
      form_data.append("company_email", company_email);
      form_data.append("company_logo", company_logo_file);
      form_data.append("company_status_id", company_status_id);
      form_data.append("leaders_tutors_commission", leaders_tutors_commission);
      form_data.append("leaders_network_commission", leaders_network_commission);
      form_data.append("company_commission", company_commission);
      form_data.append("contact_name", contact_name);
      form_data.append("contact_email", contact_email);
      form_data.append("contact_phone", contact_phone);
      form_data.append("contact_role_id", contact_role_id);
      form_data.append("contact_status_id", contact_status_id);
  
      $.ajax({
        type: "POST",
        url: endPoint + '/admin/agent/add-agent',
        data: form_data,
        dataType: "json",
        contentType: false,
        cache: false,
        headers: {
          'apiKey': apiKey,  
          'Authorization': 'Bearer '+ login_access_key
        },
        processData: false,
        success: function (info) {
          const success = info.success;
          const message = info.message;

          if (success == true) {
            $("#success-div").html('<div><i class="bi-check"></i></div>' + message +"" ).fadeIn(500).delay(5000).fadeOut(100);       
            _alert_close();
            _get_page('active_agents', 'agents');
          } else {
            $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> ' + message +"").fadeIn(500) .delay(5000).fadeOut(100);
            $("#submit_btn").html(btn_text);
            document.getElementById("submit_btn").disabled = false;
          }
        },
        error: function (error) {
          console.log(error);
          $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> An error occurred. Please try again').fadeIn(500).delay(5000).fadeOut(100);
          $("#submit_btn").html(btn_text);
          document.getElementById("submit_btn").disabled = false;
        }
      });
    }
  }
}




function _get_fetch_all_agent() {
  const search_keywords = $('#search_keywords').val();
  const status_id = $('#status_id').val();
  $('#fetch_all_agent').html('<div class="ajax-loader"><img src="' + website_url + '/all-images/images/ajax-loader.gif"/></div>').fadeIn("fast");
  
  if (search_keywords.length > 2 || search_keywords == '') {
    let dataString = 'status_id=' + status_id + '&search_keywords=' + search_keywords;
    $.ajax({
      type: "POST",
      url: endPoint + '/admin/agent/fetch-agent',
      data: dataString,
      dataType: "json",
      cache: false,
      headers: {
        'apiKey': apiKey,  
        'Authorization': 'Bearer ' + login_access_key
      },
      success: function(info) {
        const fetch = info.data;
        const success = info.success;
        const message = info.message;
        
        let text = '';
        if (success) {
          if (!fetch || (Array.isArray(fetch) && fetch.length === 0)) {
            text +=
              '<div class="false-notification-div">' +
              "<p> " + message + " </p>" +
              '<button class="btn" onclick="_get_form(' + "'agent_reg'" + ')"><i class="bi-person-plus"></i>ADD A NEW AGENT</button>' + "</div>";
          } else {
            for (let i = 0; i < fetch.length; i++) {
              const company_id = fetch[i].company_id;
              const name = fetch[i].name;
              const phone = fetch[i].phone;
              const email = fetch[i].email;
              const logo = fetch[i].logo;
              const status_name = fetch[i].status_name;
              const documentStoragePath = fetch[i].documentStoragePath;

              text +=
              '<div class="student-profile">'+
                '<div class="details">'+
                  '<div class="pix"><img src="' + documentStoragePath + "/" + logo + '"alt="'+ name +'"/></div>'+                  
                  '<div class="text">'+
                    '<h3>'+ name +'</h3>'+
                    '<div class="info">'+
                        '<div>'+
                          '<p>Email: <span>'+ email +'</span></p>'+
                          '<p>Phone: <span>'+ phone +'</span></p>'+
                        '</div>'+                               
                        '<button class="status-btn '+ status_name +'">'+ status_name +'</button>'+
                    '</div>'+
                  '</div>'+
                '</div>'+
                '<button class="btn" title="View Company Details" onClick="_get_form_with_id(' + "'agent_profile'" + "," + "'" + company_id + "'" + ')">VIEW DETAILS</button>'+
              '</div>';
            }
          }
          $('#fetch_all_agent').html(text);
        } else {
          const response = info.response;
          if (response < 100) {
            _logout();
          }
          text +=
            '<div class="false-notification-div">' +
            "<p> " + message + " </p>" +
            '<button class="btn" onclick="_get_form(' + "'agent_reg'" + ')"><i class="bi-person-plus"></i>ADD A NEW AGENT</button>' + "</div>";
          $('#fetch_all_agent').html(text);
        }
      },
    });
  } else {
    ///
  }
}





function _get_fetch_each_agent(company_id) {
  const dataString = "company_id=" + company_id;

  $.ajax({
    type: "POST",
    url: endPoint + '/admin/agent/fetch-agent',
    data: dataString,
    dataType: "json",
    cache: false,
    headers: {
      'apiKey': apiKey,  
      'Authorization': 'Bearer '+ login_access_key
    },
    success: function (info) {
      const success = info.success;
      const message = info.message;

      if (success == true) {
        const data = info.data[0];
        const company_id = data.company_id;  
        const name = data.name;
        const phone = data.phone;
        const email = data.email;
        const address = data.address;
        const logo = data.logo;
        const referral_code = data.referral_code;
        const created_time = data.created_time;
        const status_name = data.status_name;
        const status_id = data.status_id;
        const wallet_balance = data.wallet_balance;
        const documentStoragePath = data.documentStoragePath;
        const commission = data.commission;

        function formatDate(date) {
          const options = { day: '2-digit', month: 'long', year: 'numeric' };
          const formattedDate = new Date(date).toLocaleDateString('en-GB', options);
          
          const dateParts = formattedDate.split(' ');
          return `${dateParts[0]}-${dateParts[1]}-${dateParts[2]}`;
        }
        
        const formattedDate = formatDate(created_time);
        $('#created_time').html(formattedDate);
        $('#company_id').html(company_id);
        $('#name, #name_detail').html(name);
        $('#company_name').val(name);
        $('#phone, #phone_detail').html(phone);
        $('#email, #email_detail').html(email);
        $('#address').html(address);
        $('#company_address').val(address);
        $('#company_phone').val(phone);
        $('#company_email').val(email);
        $('#referral_code_detail').html(referral_code);
        $('#company_referral_code').val(referral_code);
        $('#status_name, #status_name_detail').html(status_name);
        $('#wallet_balance').html(wallet_balance);  
        $('#agent_logo, #agent_pix').attr('src', documentStoragePath + '/' + logo);
        $('#reg_company_status_id').append('<option value="' + status_id +'" selected="selected">' + status_name +"</option>");
        
        commission.forEach(function(commission) {
          const leaders_tutors = commission.leaders_tutors;
          const leaders_network = commission.leaders_network;
          const company = commission.company;

          $('#leaders_tutors_commission').val(leaders_tutors);
          $('#leaders_network_commission').val(leaders_network);
          $('#company_commission').val(company);         
        });

        let statusButton='';
        statusButton += '<button class="status-btn '+status_name+'" id="status_name">'+status_name+'</button>';
        $('#show_status_name').html(statusButton);

      }else{
        const response = info.response;
        if(response<100){
          _logout();
        }else{
          $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> <span>'+ message +'</span>').fadeIn(500).delay(5000).fadeOut(100);
        }
      }
    },
  });
}







function _update_agent(company_id) {
  const company_name = $('#company_name').val();
  const company_address = $('#company_address').val();
  const company_phone = $('#company_phone').val();
  const company_email = $('#company_email').val();
  const updt_company_logo_file = $('#company_logo').prop('files')[0];
  const company_status_id = $('#reg_company_status_id').val();
  const company_referral_code = $('#company_referral_code').val();
  const leaders_tutors_commission = parseFloat($('#leaders_tutors_commission').val()) || 0;
  const leaders_network_commission = parseFloat($('#leaders_network_commission').val()) || 0;
  const company_commission = parseFloat($('#company_commission').val()) || 0;

  $('#company_name, #company_address, #company_phone, #company_email, #reg_company_status_id, #company_referral_code, #leaders_tutors_commission, #leaders_network_commission, #company_commission').removeClass('complain');

  const totalCommission = leaders_tutors_commission + leaders_network_commission + company_commission;

  if (company_name == '') {
    $('#company_name').addClass('complain');
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> COMPANY NAME ERROR!<br /><span>Check Company Name And Try Again</span>').fadeIn(500).delay(3000).fadeOut(100);
  
  } else if (company_address == '') {
    $('#company_address').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> COMPANY ADDRESS ERROR!<br /><span>Check Company Add And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);
  
  } else if (company_phone == '') {
    $('#company_phone').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> COMPANY PHONE ERROR!<br /><span>Check Company Phone And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);
  
  } else if (company_email == '' || $('#company_email').val().indexOf("@") <= 0) {
    $('#company_email').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> COMPANY EMAIL ERROR!<br /><span>Check Company Email And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);
  
  } else if (company_status_id == '') {
    $('#reg_company_status_id').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> COMPANY STATUS ERROR!<br /><span>Check Company Status And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);
  
  } else if (company_referral_code == '') {
    $('#company_referral_code').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> COMPANY REFERRAL CODE ERROR!<br /><span>Check Company Referral Code And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);

  } else if (leaders_tutors_commission == '') {
    $('#leaders_tutors_commission').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> LEADERSTUTOR COMMISSION ERROR!<br /><span>Check Commission And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);
  
  } else if (leaders_network_commission == '') {
    $('#leaders_network_commission').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> LEADERSNETWORK COMMISSION ERROR!<br /><span>Check Commission And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);
  
  } else if (company_commission == '') {
    $('#company_commission').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> COMPANY COMMISSION ERROR!<br /><span>Check Commission And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);
  
  } else if (totalCommission > 100) {
    $('#leaders_tutors_commission, #leaders_network_commission, #company_commission').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> COMMISSION ERROR!<br /><span>Total commission must not exceed 100%</span>').fadeIn(500).delay(3000).fadeOut(100);
  
  } else {
    $('#company_name, #company_address, #company_phone, #company_email, #reg_company_status_id, #company_referral_code, #leaders_tutors_commission, #leaders_network_commission, #company_commission').removeClass('complain');

    if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
      const btn_text = $("#submit_btn").html();
      $("#submit_btn").html('<i class="fa fa-spinner fa-spin"></i> PROCESSING');
      document.getElementById("submit_btn").disabled = true;

      const form_data = new FormData();
      form_data.append("company_id", company_id);
      form_data.append("company_name", company_name);
      form_data.append("company_address", company_address);
      form_data.append("company_phone", company_phone);
      form_data.append("company_email", company_email);
      form_data.append("company_logo", updt_company_logo_file);
      form_data.append("company_status_id", company_status_id);
      form_data.append("company_referral_code", company_referral_code);
      form_data.append("leaders_tutors_commission", leaders_tutors_commission);
      form_data.append("leaders_network_commission", leaders_network_commission);
      form_data.append("company_commission", company_commission);
  
      $.ajax({
        type: "POST",
        url: endPoint + '/admin/agent/update-agent',
        data: form_data,
        dataType: "json",
        contentType: false,
        cache: false,
        headers: {
          'apiKey': apiKey,  
          'Authorization': 'Bearer '+ login_access_key
        },
        processData: false,
        success: function (info) {
          const success = info.success;
          const message = info.message;

          if (success == true) {
            $("#success-div").html('<div><i class="bi-check"></i></div>' + message +"" ).fadeIn(500).delay(5000).fadeOut(100);       
            _alert_secondary_close();
            _get_form_with_id('agent_profile', company_id);
            _get_page('active_agents', 'agents');
          } else {
            $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> ' + message +"").fadeIn(500) .delay(5000).fadeOut(100);
            $("#submit_btn").html(btn_text);
            document.getElementById("submit_btn").disabled = false;
          }
        },
        error: function (error) {
          console.log(error);
          $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> An error occurred. Please try again').fadeIn(500).delay(5000).fadeOut(100);
          $("#submit_btn").html(btn_text);
          document.getElementById("submit_btn").disabled = false;
        }
      });
    }
  }
}







function _get_fetch_all_contact_person(company_id) {
  $('#fetch_all_contact_person').html('<div class="ajax-loader agent-ajax-loader"><img src="all-images/images/ajax-loader2.gif"/></div>').fadeIn("fast");
  
  const dataString = 'company_id=' + company_id;
  $.ajax({
    type: "POST",
    url: endPoint + '/admin/agent/fetch-staff',
    data: dataString,
    dataType: "json",
    cache: false,
    headers: {
      'apiKey': apiKey,  
      'Authorization': 'Bearer ' + login_access_key
    },
    success: function(info) {
      const fetch = info.data;
      const success = info.success;
      const message = info.message;
      
      let text = '';
      if (success) {
        if (!fetch || (Array.isArray(fetch) && fetch.length === 0)) {
          text +=
            '<div class="false-notification-div">' +
              "<p> " + message + " </p>" +
            "</div>";
        } else {
          for (let i = 0; i < fetch.length; i++) {
            const staff_id = fetch[i].staff_id;
            const name = capitalizeFirstLetterOfEachWord(fetch[i].name);
            const phone = fetch[i].phone;
            const email = fetch[i].email;
            const status_name = fetch[i].status_name;
            const isApproved = fetch[i].isApproved;

            text +=
            '<div class="student-profile">'+
              '<div class="details">';        
              if (isApproved== null){
                text +='<div class="status-icon pending"><i class="bi-dash"></i></div>';
              }else if (isApproved== 'NO'){
                text +='<div class="status-icon declined"><i class="bi-x"></i></div>';
              }else if (isApproved== 'YES'){
                text +='<div class="status-icon"><i class="bi-check"></i></div>';
              }

              text +=
              '<div class="pix"><img src="'+ website_url +'/admin/a/all-images/images/avatar.jpg" alt="Profile Picture"/></div>'+                  
                '<div class="text">'+
                  '<h3>'+ name +'</h3>'+
                  '<div class="info">'+
                      '<div>'+
                        '<p>Email: <span>'+ email +'</span></p>'+
                        '<p>Phone: <span>'+ phone +'</span></p>'+
                      '</div>'+                               
                      '<button class="status-btn '+ status_name +'">'+ status_name +'</button>'+
                  '</div>'+
                '</div>'+
              '</div>'+
                '<button class="btn" title="View staff details" onClick="_get_agent_staff_secondary_form_with_id(' +"'update_contact_person_form'" +"," +"'" + company_id +"'" +"," +"'" + staff_id +"'"+')">VIEW DETAILS</button>'+
              '</div>';
          }
        }
        $('#fetch_all_contact_person').html(text);
      } else {
        const response = info.response;
        if (response < 100) {
          _logout();
        }
        text +=
          '<div class="false-notification-div">' +
            "<p> " + message + " </p>" +
          "</div>";
        $('#fetch_all_contact_person').html(text);
      }
    },
  });
}



function _get_agent_staff_secondary_form_with_id(page, company_id, staff_id) {
  $("#get-more-div-secondary").html('<div class="ajax-loader"><img src="'+website_url+'/all-images/images/ajax-loader.gif"/></div>').css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);
  var action = "get_secondary_form_with_id";
  var dataString = "action=" + action + "&page=" + page + "&company_id=" + company_id + "&staff_id=" + staff_id;
  $.ajax({
    type: "POST",
    url: admin_local_portal_url,
    data: dataString,
    cache: false,
    success: function (html) {
      $("#get-more-div-secondary").html(html);
    },
  });
}


function _get_fetch_each_contact_person(company_id, staff_id) {
  const dataString = 'company_id=' + company_id + '&staff_id=' + staff_id;

  $.ajax({
    type: "POST",
    url: endPoint + '/admin/agent/fetch-staff',
    data: dataString,
    dataType: "json",
    cache: false,
    headers: {
      'apiKey': apiKey,  
      'Authorization': 'Bearer '+ login_access_key
    },
    success: function (info) {
      const success = info.success;
      const message = info.message;

      if (success == true) {
        const data = info.data[0];  
        const name = capitalizeFirstLetterOfEachWord(data.name);
        const phone = data.phone;
        const email = data.email;
        const status_name = data.status_name;
        const status_id = data.status_id;
        const role_name = data.role_name;
        const role_id = data.role_id;

        $('#contact_name').val(name);
        $('#contact_email').val(email);
        $('#contact_phone').val(phone);
        $('#reg_contact_role_id').append('<option value="' + role_id +'" selected="selected">' + role_name +"</option>");
        $('#reg_contact_status_id').append('<option value="' + status_id +'" selected="selected">' + status_name +"</option>");
        
      }else{
        const response = info.response;
        if(response<100){
          _logout();
        }else{
          $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> <span>'+ message +'</span>').fadeIn(500).delay(5000).fadeOut(100);
        }
      }
    },
  });
}




function _add_contact_person(company_id) {
  const contact_name = $('#contact_name').val();
  const contact_email = $('#contact_email').val();
  const contact_phone = $('#contact_phone').val();
  const contact_role_id = $('#reg_contact_role_id').val();
  const contact_status_id = $('#reg_contact_status_id').val();
 
  $('#contact_name, #contact_email, #contact_phone, #company_email, #reg_contact_role_id, #reg_contact_status_id').removeClass('complain');

  if (contact_name == '') {
    $('#contact_name').addClass('complain');
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> NAME ERROR!<br /><span>Check Name And Try Again</span>').fadeIn(500).delay(3000).fadeOut(100);
  
  } else if (contact_email == '' || $('#contact_email').val().indexOf("@") <= 0) {
    $('#contact_email').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> EMAIL ERROR!<br /><span>Check Email And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);
  
  } else if (contact_phone == '') {
    $('#contact_phone').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> PHONE NUMBER ERROR!<br /><span>Check Phone Number And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);
  
  } else if (contact_role_id == '') {
    $('#reg_contact_role_id').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> ROLE ERROR!<br /><span>Check Role And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);

  } else if (contact_status_id == '') {
    $('#reg_contact_status_id').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> STATUS ERROR!<br /><span>Check Status And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);

  } else {
    $('#contact_name, #contact_email, #contact_phone, #company_email, #reg_contact_role_id, #reg_contact_status_id').removeClass('complain');

    if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
      const btn_text = $("#submit_btn").html();
      $("#submit_btn").html('<i class="fa fa-spinner fa-spin"></i> PROCESSING');
      document.getElementById("submit_btn").disabled = true;

      const form_data = new FormData();
      form_data.append("company_id", company_id);
      form_data.append("contact_name", contact_name);
      form_data.append("contact_email", contact_email);
      form_data.append("contact_phone", contact_phone);  
      form_data.append("contact_status_id", contact_status_id);
      form_data.append("contact_role_id", contact_role_id);
    
      $.ajax({
        type: "POST",
        url: endPoint + '/admin/agent/add-staff',
        data: form_data,
        dataType: "json",
        contentType: false,
        cache: false,
        headers: {
          'apiKey': apiKey,  
          'Authorization': 'Bearer '+ login_access_key
        },
        processData: false,
        success: function (info) {
          const success = info.success;
          const message = info.message;

          if (success == true) {
            $("#success-div").html('<div><i class="bi-check"></i></div>' + message +"" ).fadeIn(500).delay(5000).fadeOut(100);       
            _alert_secondary_close();
            _get_agent_page_contents('contact_person_details', company_id);
          } else {
            $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> ' + message +"").fadeIn(500) .delay(5000).fadeOut(100);
            $("#submit_btn").html(btn_text);
            document.getElementById("submit_btn").disabled = false;
          }
        },
        error: function (error) {
          console.log(error);
          $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> An error occurred. Please try again').fadeIn(500).delay(5000).fadeOut(100);
          $("#submit_btn").html(btn_text);
          document.getElementById("submit_btn").disabled = false;
        }
      });
    }
  }
}




function _update_contact_person(company_id, staff_id) {
  const contact_name = $('#contact_name').val();
  const contact_email = $('#contact_email').val();
  const contact_phone = $('#contact_phone').val();
  const contact_role_id = $('#reg_contact_role_id').val();
  const contact_status_id = $('#reg_contact_status_id').val();
 
  $('#contact_name, #contact_email, #contact_phone, #company_email, #reg_contact_role_id, #reg_contact_status_id').removeClass('complain');

  if (contact_name == '') {
    $('#contact_name').addClass('complain');
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> NAME ERROR!<br /><span>Check Name And Try Again</span>').fadeIn(500).delay(3000).fadeOut(100);
  
  } else if (contact_email == '' || $('#contact_email').val().indexOf("@") <= 0) {
    $('#contact_email').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> EMAIL ERROR!<br /><span>Check Email And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);
  
  } else if (contact_phone == '') {
    $('#contact_phone').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> PHONE NUMBER ERROR!<br /><span>Check Phone Number And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);

  } else if (contact_status_id == '') {
    $('#reg_contact_status_id').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> STATUS ERROR!<br /><span>Check Status And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);
  
  } else if (contact_role_id == '') {
    $('#reg_contact_role_id').addClass("complain");
    $('#warning-div').html('<div><i class="bi-exclamation-octagon-fill"></i></div> ROLE ERROR!<br /><span>Check Role And Try Again <span>').fadeIn(500).delay(3000).fadeOut(100);

  } else {
    $('#contact_name, #contact_email, #contact_phone, #company_email, #reg_contact_role_id, #reg_contact_status_id').removeClass('complain');

    if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
      const btn_text = $("#submit_btn").html();
      $("#submit_btn").html('<i class="fa fa-spinner fa-spin"></i> PROCESSING');
      document.getElementById("submit_btn").disabled = true;

      const form_data = new FormData();
      form_data.append("company_id", company_id);
      form_data.append("staff_id", staff_id);
      form_data.append("contact_name", contact_name);
      form_data.append("contact_email", contact_email);
      form_data.append("contact_phone", contact_phone);  
      form_data.append("contact_status_id", contact_status_id);
      form_data.append("contact_role_id", contact_role_id);
    
      $.ajax({
        type: "POST",
        url: endPoint + '/admin/agent/update-staff',
        data: form_data,
        dataType: "json",
        contentType: false,
        cache: false,
        headers: {
          'apiKey': apiKey,  
          'Authorization': 'Bearer '+ login_access_key
        },
        processData: false,
        success: function (info) {
          const success = info.success;
          const message = info.message;

          if (success == true) {
            $("#success-div").html('<div><i class="bi-check"></i></div>' + message +"" ).fadeIn(500).delay(5000).fadeOut(100);       
            _alert_secondary_close();
            _get_agent_page_contents('contact_person_details', company_id);
          } else {
            $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> ' + message +"").fadeIn(500) .delay(5000).fadeOut(100);
            $("#submit_btn").html(btn_text);
            document.getElementById("submit_btn").disabled = false;
          }
        },
        error: function (error) {
          console.log(error);
          $("#warning-div").html('<div><i class="bi-exclamation-octagon-fill"></i></div> An error occurred. Please try again').fadeIn(500).delay(5000).fadeOut(100);
          $("#submit_btn").html(btn_text);
          document.getElementById("submit_btn").disabled = false;
        }
      });
    }
  }
}
