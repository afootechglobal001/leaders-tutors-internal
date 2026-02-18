let login_staff_session = JSON.parse(
  sessionStorage.getItem("login_staff_session"),
);
//var login_staff_id=login_staff_session.staff_id;

$(document).ready(function () {
  function trim(s) {
    return s.replace(/^\s*/, "").replace(/\s*$/, "");
  }

  $("#view_login").keydown(function (e) {
    if (e.keyCode == 13) {
      _log_in();
    }
  });

  $("#reset_password_info").keydown(function (e) {
    if (e.keyCode == 13) {
      _proceed_reset_password();
    }
  });

  $("#comfirmed_reset_password").keydown(function (e) {
    if (e.keyCode == 13) {
      _comfirmed_reset_password();
    }
  });
});

function _next_page(next_id, divid) {
  $("#view_login,#reset_password_info").hide();
  $("#" + next_id).fadeIn(1000);
  $("#page-title").html($("#" + divid).html());
}

function _alert_close() {
  $("#get-more-div").fadeOut(300);
}

function _show_password_visibility(ids, toggle_pass) {
  var password = $("#" + ids).val();
  if (password != "") {
    $("#" + toggle_pass).show();
  } else {
    $("#" + toggle_pass).hide();
  }
}

function _togglePasswordVisibility(ids, toggle_pass) {
  const passwordInput = document.getElementById(ids);
  const togglePasswordIcon = document.getElementById(toggle_pass);

  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    togglePasswordIcon.innerHTML = '<i class="bi-eye password-toggle"></i>';
  } else {
    passwordInput.type = "password";
    togglePasswordIcon.innerHTML =
      '<i class="bi-eye-slash password-toggle"></i>';
  }
}

function _keep_me_logged_in() {
  // Check for a stored "Keep me logged in" preference when the page loads
  window.addEventListener("load", () => {
    const keepLoggedInCheckbox = document.getElementById("keep-logged-in");
    const storedPreference = localStorage.getItem("keepLoggedIn");

    if (storedPreference === "true") {
      keepLoggedInCheckbox.checked = true;
    } else {
      keepLoggedInCheckbox.checked = false;
    }
  });

  // Handle the "Keep me logged in" checkbox change
  document
    .getElementById("keep-logged-in")
    .addEventListener("change", (event) => {
      localStorage.setItem("keepLoggedIn", event.target.checked);
    });
}

//////////// LOGIN ////////////
function _log_in() {
  var username = $("#username").val();
  var password = $("#password").val();
  $("#username,#password").removeClass("complain");
  if (username != "" && password != "") {
    user_login(username, password);
  } else {
    $("#username,#password").addClass("complain");
    $("#warning-div").fadeIn(500).delay(5000).fadeOut(100);
  }
}

function user_login(username, password) {
  /////////////// get btn text ////////////////
  var btn_text = $("#login_btn").html();
  $("#login_btn").html('Authenticating <i class="fa fa-spinner fa-spin"></i>');
  document.getElementById("login_btn").disabled = true;
  ////////////////////////////////////////////////

  var dataString = "&username=" + username + "&password=" + password;
  $.ajax({
    type: "POST",
    url: endPoint + "/admin/auth/login",
    dataType: "json",
    data: dataString,
    cache: false,
    headers: {
      apiKey: apiKey,
    },
    success: function (data) {
      var success = data.success;
      var message = data.message;
      if (success == true) {
        sessionStorage.setItem("login_staff_session", JSON.stringify(data));
        $("#success-div")
          .html('<div><i class="bi-check"></i></div> ' + message + " ")
          .fadeIn(500)
          .delay(5000)
          .fadeOut(100);
        window.parent.location = admin_portal_url;
      } else {
        $("#warning-div")
          .html(
            '<div><i class="bi-exclamation-octagon-fill"></i></div> ' +
              message +
              " ",
          )
          .fadeIn(500)
          .delay(5000)
          .fadeOut(100);
        $("#login_btn").html(btn_text);
        document.getElementById("login_btn").disabled = false;
      }
    },
    error: function (error) {
      console.log(error);
      $("#warning-div")
        .html(
          '<div><i class="bi-exclamation-octagon-fill"></i></div> An error occurred. Please try again',
        )
        .fadeIn(500)
        .delay(5000)
        .fadeOut(100);
      $("#login_btn").html(btn_text);
      document.getElementById("login_btn").disabled = false;
    },
  });
}

function _proceed_reset_password() {
  try {
    var email = $("#reset_pass_email").val();

    $("#reset_pass_email").removeClass("complain");
    if (email == "" || $("#reset_pass_email").val().indexOf("@") <= 0) {
      $("#reset_pass_email").addClass("complain");
      $("#warning-div")
        .html(
          '<div><i class="bi-exclamation-octagon-fill"></i></div> EMAIL ERROR!<br /><span>Fill Correct Email Address To Continue </span>',
        )
        .fadeIn(500)
        .delay(5000)
        .fadeOut(100);
    } else {
      $("#reset_pass_email").removeClass("complain");

      //////////////// get btn text ////////////////
      var btn_text = $("#reset_password_btn").html();
      $("#reset_password_btn").html(
        'PROCESSING <i class="fa fa-spinner fa-spin"></i>',
      );
      document.getElementById("reset_password_btn").disabled = true;
      ////////////////////////////////////////////////

      var dataString = "&email=" + email;
      $.ajax({
        type: "POST",
        url: endPoint + "/admin/auth/reset-password",
        data: dataString,
        cache: false,
        dataType: "json",
        cache: false,
        headers: {
          apiKey: apiKey,
        },
        success: function (data) {
          _reset_password(data.staff_id, data.fullname, data.email);
        },
      }).catch((error) => {
        var message = error.responseJSON
          ? error.responseJSON.message
          : "An error occurred. Please try again";
        $("#warning-div")
          .html(
            '<div><i class="bi-exclamation-octagon-fill"></i></div> ' + message,
          )
          .fadeIn(500)
          .delay(5000)
          .fadeOut(100);
        $("#reset_password_btn").html(btn_text);
        document.getElementById("reset_password_btn").disabled = false;
      });
    }
  } catch (error) {
    $("#warning-div")
      .html(
        '<div><i class="bi-exclamation-octagon-fill"></i></div> An error occurred. Please try again',
      )
      .fadeIn(500)
      .delay(5000)
      .fadeOut(100);
    $("#reset_password_btn").html(btn_text);
    document.getElementById("reset_password_btn").disabled = false;
  }
}

function _reset_password(staff_id, fullname, email) {
  $("#get-more-div")
    .html(
      '<div class="ajax-loader"><img src="' +
        website_url +
        '/all-images/images/ajax-loader.gif"/></div>',
    )
    .fadeIn("fast");
  var action = "reset_password";
  var dataString =
    "action=" +
    action +
    "&staff_id=" +
    staff_id +
    "&fullname=" +
    fullname +
    "&email=" +
    email;
  $.ajax({
    type: "POST",
    url: admin_login_local_url,
    data: dataString,
    cache: false,
    success: function (html) {
      $("#get-more-div").html(html);
      $("#username").html(fullname);
      $("#useremail").html(email);
    },
  });
}

function _resend_otp(ids, staff_id) {
  var btn_text = $("#" + ids).html();
  $("#" + ids).html('SENDING <i class="fa fa-spinner fa-spin"></i>');
  var dataString = "&staff_id=" + staff_id;
  $.ajax({
    type: "POST",
    url: endPoint + "/admin/auth/resend-otp",
    data: dataString,
    cache: false,
    headers: {
      apiKey: apiKey,
    },
    success: function (data) {
      var message = data.message;

      $("#success-div")
        .html('<div><i class="bi-check"></i></div> ' + message + " <br> " + " ")
        .fadeIn(500)
        .delay(5000)
        .fadeOut(100);
      $("#" + ids).html(btn_text);
    },
  });
}

///// accept number ////
function isNumber_Check() {
  var e = window.event;
  var key = e.keyCode && e.which;

  if (!((key >= 48 && key <= 57) || key == 43 || key == 45)) {
    if (e.preventDefault) {
      e.preventDefault();
      $("#otp_info").fadeIn(300);
      document.getElementById("otp").style.border = "#F00 1px solid";
    } else {
      e.returnValue = false;
    }
  } else {
    $("#otp_info").fadeOut(300);
    document.getElementById("otp").style.border = "rgba(0, 0, 0, .1) 1px solid";
  }
}

function _check_password_match() {
  var password = $("#password").val();
  var confirm_password = $("#confirm_password").val();
  if (password != confirm_password && confirm_password != "") {
    $("#message").show();
  } else {
    $("#message").hide();
  }
}

function _comfirmed_reset_password(staff_id) {
  var otp = $("#otp").val();
  var password = $("#password").val();
  var confirm_password = $("#confirm_password").val();

  $("#otp,#password,#confirm_password").removeClass("complain");
  if (otp == "") {
    $("#otp").addClass("complain");
    $("#warning-div")
      .html(
        '<div><i class="bi-exclamation-octagon-fill"></i></div> OTP Error!  <br /><span> Kindly Fill fields to continue. </span>',
      )
      .fadeIn(500)
      .delay(5000)
      .fadeOut(100);
  } else if (password == "") {
    $("#password").addClass("complain");
    $("#warning-div")
      .html(
        '<div><i class="bi-exclamation-octagon-fill"></i></div> Create New Password Error <br /><span> Kindly Fill fields to continue. </span>',
      )
      .fadeIn(500)
      .delay(5000)
      .fadeOut(100);
  } else if (confirm_password == "") {
    $("#confirm_password").addClass("complain");
    $("#warning-div")
      .html(
        '<div><i class="bi-exclamation-octagon-fill"></i></div> Confirm New Password Error <br /><span> Kindly Fill fields to continue.</span>',
      )
      .fadeIn(500)
      .delay(5000)
      .fadeOut(100);
  } else if (password != confirm_password) {
    $("#password,#confirm_password").addClass("complain");
    $("#warning-div")
      .html(
        '<div><i class="bi-exclamation-octagon-fill"></i></div> Password Error <br /><span> Password Not Match </span>',
      )
      .fadeIn(500)
      .delay(5000)
      .fadeOut(100);
  } else if (password.length < 8) {
    $("#otp,#password,#confirm_password").removeClass("complain");
    $("#warning-div")
      .html(
        '<div><i class="bi-exclamation-octagon-fill"></i></div> Password Not Accepted <br /><span> Please follow the instructon </span>',
      )
      .fadeIn(500)
      .delay(5000)
      .fadeOut(100);
  } else if (
    password.match(
      /^(?=[^A-Z]*[A-Z])(?=[^!"#$%&'()*+,-.:;<=>?@[\]^_`{|}~]*[!"#$%&'()*+,-.:;<=>?@[\]^_`{|}~])(?=\D*\d).{8,}$/,
    )
  ) {
    //////////////// get btn text ////////////////
    var btn_text = $("#comfirmed_reset_btn").html();
    $("#comfirmed_reset_btn").html(
      'RESETTING <i class="fa fa-spinner fa-spin"></i>',
    );
    document.getElementById("comfirmed_reset_btn").disabled = true;
    ////////////////////////////////////////////////

    var dataString =
      "&staff_id=" +
      staff_id +
      "&otp=" +
      otp +
      "&password=" +
      password +
      "&confirm_password=" +
      confirm_password;
    $.ajax({
      type: "POST",
      url: endPoint + "/admin/auth/create-new-password",
      data: dataString,
      cache: false,
      dataType: "json",
      cache: false,
      headers: {
        apiKey: apiKey,
      },
      success: function (data) {
        var success = data.success;
        var message = data.message;

        if (success == true) {
          _get_page("password_reset_successful");
        } else {
          $("#warning-div")
            .html(
              '<div><i class="bi-exclamation-octagon-fill"></i></div> ' +
                message +
                " <br />" +
                "",
            )
            .fadeIn(500)
            .delay(5000)
            .fadeOut(100);
          $("#otp").addClass("complain");
        }
        $("#comfirmed_reset_btn").html(btn_text);
        document.getElementById("comfirmed_reset_btn").disabled = false;
      },
    });
  } else {
    $("#password,#confirm_password").addClass("complain");
    $("#warning-div")
      .html(
        '<div><i class="bi-exclamation-octagon-fill"></i></div> Password Not Accepted <br /><span> Please follow the instructon </span>',
      )
      .fadeIn(500)
      .delay(5000)
      .fadeOut(100);
  }
}

function _get_page(page) {
  $("#get-more-div")
    .html(
      '<div class="ajax-loader"><img src="' +
        website_url +
        '/all-images/images/ajax-loader.gif"/></div>',
    )
    .fadeIn("fast");
  var action = "password_reset_successful";
  var dataString = "action=" + action + "&page=" + page;
  $.ajax({
    type: "POST",
    url: admin_login_local_url,
    data: dataString,
    cache: false,
    success: function (html) {
      $("#get-more-div").html(html);
    },
  });
}
