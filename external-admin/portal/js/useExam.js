$(function () {
	examLogoPixPreview = {
	UpdatePreview: function (obj) {
		if (!window.FileReader) {
		// Handle browsers that don't support FileReader
		console.error("FileReader is not supported.");
		} else {
		var reader = new FileReader();

		reader.onload = function (e) {
			$('#examLogoPreview').prop("src", e.target.result);
		};
		reader.readAsDataURL(obj.files[0]);
		}
	},
	};
});

/// Create And Update Exam ////
function _createAndUpdateExam(){
	let useEachExamSession = JSON.parse(sessionStorage.getItem("useEachExamSession"));
	try {
		////////get all needed values////////////
		let issueCount = 0;
		const examAbbreviation = $('#examAbbreviation').val().trim();
		const examName = $('#examName').val().trim();
		const examLogo = $("#examLogo").prop("files")[0];
        const statusId = $('#statusId').val().trim();
		
		///// empty field validation//////////
		issueCount += _validateEmptyValue("examAbbreviation", "EXAM ABBREVIATION");
		issueCount += _validateEmptyValue("examName", "EXAM NAME");
		issueCount += _validateEmptyValue("statusId", "STATUS");

		if (!useEachExamSession){
			if (!examLogo) {
				$("#issues_examLogo").html("EXAM LOGO IS REQUIRED").fadeIn();
				issueCount ++
			} else {
				$("#issues_examLogo").html("");
			}
		}

		if (issueCount > 0) return;

		/////Gather form data////
		const formData = new FormData();
		formData.append("examAbbreviation", examAbbreviation);
		formData.append("examName", examName);
		formData.append("statusId", statusId);

		if (examLogo) {
			formData.append("examLogo", examLogo);
		}

		////// confirm action////
		_showCustomConfirm({
		callback: () => {
			_saveCreateAndUpdateExamCallback(formData);
		},
			title: "Are you sure?",
			message: 'Are you sure you want to continue? This action is irreversible.',
			alertType: "warning",
			falseActionBtn: true,
			closeOnOverlayClick: true,
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _createAndUpdateExam());
	}
}

/// Save Create And Update Exam CallBack ///
function _saveCreateAndUpdateExamCallback(formData) {
    let useEachExamSession = JSON.parse(sessionStorage.getItem("useEachExamSession"));
	///// get btn text/////
	const btnText = $("#submitBtn").html();
	_btnDisable("submitBtn", btnText, true);
	
    let callUrl= useEachExamSession?.examId ? `admin/exams/update-exam?examId=${useEachExamSession?.examId}` : `admin/exams/create-exam`;

	//// call endpoint //////
	_callFileEndPoints({
		url: callUrl,
		formData,
		accessKey: true,
	})
    .then((response) => {
		const message = response.message;
		const newExamLogo = response?.data?.examLogo;
		const oldExamLogo = response?.oldExamLogo;
		
		_uploadExamLogo(newExamLogo, oldExamLogo, message);
		_btnDisable("submitBtn", btnText, false);
    })
    .catch((error) => {
		_staffValidationCheck(error.response);
		console.error("Error:", error);
		if (error.status==0) {
			_callAjaxError(() => _saveCreateAndUpdateExamCallback(formData), error.message); // retry if needed
			_btnDisable("submitBtn", btnText, false);
		} else {
			_actionAlert(error.message, false);
			_btnDisable("submitBtn", btnText, false);
		}
    });
}

/// Upload Exam Logo ///
function _uploadExamLogo(newExamLogo, oldExamLogo, message) {
    var examLogo = document.getElementById("examLogoPreview").src;

    // Only proceed if it's a NEW image (base64)
    if (!examLogo.startsWith("data:image")) {
        _showCustomConfirm({
            callback: () => {
                _getActivePage({page:'examPage', divid:'examPage'});
                _alertClose();
            },
            title: 'Success!',
            message: message,
            alertType: 'success',
            trueActionBtnText: 'OK, Thanks.',
        });
        return;
    }

    const formData = new FormData();
    formData.append("action", "uploadExamLogo");
    formData.append("examLogo", examLogo);
    formData.append("newExamLogo", newExamLogo);
    formData.append("oldExamLogo", oldExamLogo);

    _callFileEndPoints({
        url: adminPortalLocalUrl,
        formData,
        expectJson: false,
    })
    .then(() => {
        _showCustomConfirm({
            callback: () => {
                _getActivePage({page:'examPage', divid:'examPage'});
                _alertClose();
            },
            title: 'Success!',
            message: message,
            alertType: 'success',
            trueActionBtnText: 'OK, Thanks.',
        });
    })
    .catch((error) => {
        console.error("Error:", error);
        _callAjaxError(() => _uploadExamLogo(newExamLogo, oldExamLogo, message));
    });
}

/// Fetch Exam Data ///
function _fetchExamData() {
	try {
		//// call endpoint //////
		_callFetchEndPoints({
			url: `admin/exams/fetch-exams`,
			accessKey: true,
		})
		.then((response) => {
            _initFetchExamData(response.data);
		 })
		.catch((error) => {
			_staffValidationCheck(error.response);
			console.error("Error:", error);
			if (error.status==0) {
				_showFalseNotification({
					container: "#examContent",
					message: "Check your internet connection and try again",
					paginationContainer: "#examContentPaginationControls",
				});

				_callAjaxError(() => _fetchExamData(), error.message); // retry if needed
			} else {
				_showFalseNotification({
					container: "#examContent",
					message: error.message,
					button: `
						<button class="btn" title="ADD NEW EXAM" onclick="sessionStorage.removeItem('useEachExamSession'); _getForm({page: 'examReg', url: adminPortalLocalUrl});">
							<i class="bi-plus-square"></i> ADD NEW EXAM
						</button>
					`,
					paginationContainer: "#examContentPaginationControls",
				});
			}
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _fetchExamData());
  	}
}

/// Render Exam Data ///
function _renderExamData(data) {
  const content = data.map((item) => {
    const updatedTime = _fetchFormatDate(item.updatedTime);

    return `<div class="exam-div">
      <div class="exam-image">
        <img src="${examLogoPath}/${item.examLogo}" alt="${item.examName} EXAM" />
      </div>
      <div class="exam-status ${item?.statusData?.statusName}">${item?.statusData?.statusName}</div>
      <div class="exam-info">
        <h3>${item.examAbbreviation}</h3>
        <p>${item.examName}</p>
        <div class="exam-time">
          <p><i class="bi bi-calendar"></i> Updated on:
            <strong>${updatedTime}</strong>
          </p>
        </div>
      </div>
      <button class="btn" title="View Details" onclick="_fetchEachExam('${item.examId}');">
        <i class="bi bi-eye"></i> View Details
      </button>
    </div>`;
  }).join("");

  return content;
}

/// Initialize Fetch Exam Data ///
function _initFetchExamData(data) {
  const paginator = new Paginator(
    data,
    _renderExamData,
    "examContentPaginationControls",
    "examContent",
    10
  );
  __paginatorHandlers["examContentPaginationControls"] = paginator;
  paginator.renderPage();
}

/// filter exam ///
function _filtersExam(value) {
  $("#examContent .exam-div").each(function () {
    var text = $(this).text();
    text.toLowerCase().indexOf(value.toLowerCase()) > -1
      ? $(this).show()
      : $(this).hide();
  });
}

/// Fetch Each Exam ///
function _fetchEachExam(examId) {
    $("#get-form-more-div").css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);
	try {
		//// call endpoint //////
		_callFetchEndPoints({
			url: `admin/exams/fetch-exams?examId=${examId}`,
			accessKey: true,
		})
		.then((response) => {
			sessionStorage.setItem("useEachExamSession", JSON.stringify(response.data[0]));
			_getForm({page: 'examReg', url: adminPortalLocalUrl});
		 })
		.catch((error) => {
			_staffValidationCheck(error.response);
			_alertClose();
			console.error("Error:", error);
			_callAjaxError(() => _fetchEachExam(examId), error.message); // retry if needed
		});
	} catch (error) {
		_alertClose();
		console.error("Error:", error);
		_callCatchError(() => _fetchEachExam(examId));
  	}
}