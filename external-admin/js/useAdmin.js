$(document).ready(function () {
  function trim(s) {
    return s.replace(/^\s*/, "").replace(/\s*$/, "");
  }
  $("#viewLogin").keydown(function (e) {
    if (e.keyCode == 13) {
      _confirmLogin();
    }
  });
});


////// ADMIN LOGIN FUNCTION ////////
function _confirmLogin(){
	try {
		////////get all needed values////////////
		let issueCount = 0;
		const userName = $('#userName').val().trim();
		const password = $("#password").val().trim();

		///// empty field validation//////////
		issueCount += _validateEmptyValue("userName", "EMAIL ADDRESS");
		issueCount += _validateEmail("userName", "EMAIL ADDRESS");
		issueCount += _validateEmptyValue("password", "PASSWORD");

		if (issueCount > 0) return;

		// Gather form data
		const formData = {
			userName: userName,
			password: password,
		};

		////// confirm action////
		_proceedLoginCallback(formData);
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _confirmLogin());
	}
}

function _proceedLoginCallback(formData) {
	///// get btn text/////
	const btnText = $("#submitBtn").html();
	_btnDisable("submitBtn", btnText, true);
	
	//// call endpoint //////
	_callRawEndPoints({
		url: `admin/auth/login`,
		formData,
	})
    .then((response) => {
		sessionStorage.setItem("staffLoginData", JSON.stringify(response.data));
		_actionAlert(response.message, true);
		window.location.href = adminDashboardUrl;
    })
	.catch((error) => {
		console.error("Error:", error);
		if (error.status==0) {
			_actionAlert('Check your internet connection and try again', false);
			_btnDisable("submitBtn", btnText, false);
		} else {
			_actionAlert(error.message, false);
			_btnDisable("submitBtn", btnText, false);
		}
	});
}