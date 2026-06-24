function _getActivePagesTab(props) {
	const {
        page = '',
        divid = '',
		pageContainer='getPagesDetails'
    } = props;
	_getActivePagesTabLink(divid);
	if(page){
		_getPage({page: page, pageContainer: pageContainer,  url: adminPortalLocalUrl});
	}
}
function _getActivePagesTabLink(divid){
	$('#questionBank, #quizQuestion, #loadQuestionManually, #loadQuestionAutomatically').removeClass('active-li');
	$("#"+divid).addClass('active-li');
}

$(function () {
	tutorialPicturePreview = {
	UpdatePreview: function (obj) {
		if (!window.FileReader) {
		// Handle browsers that don't support FileReader
		console.error("FileReader is not supported.");
		} else {
		var reader = new FileReader();

		reader.onload = function (e) {
			$('#tutorialPicturePreview').prop("src", e.target.result);
		};
		reader.readAsDataURL(obj.files[0]);
		}
	},
	};
});

function _getSelectDepartment(fieldId) {
	try {
		//// call endpoint //////
		_callFetchEndPoints({
			url: `preset-data/fetch-departments?statusId=1`,
		})
		.then((response) => {
			for (let i = 0; i < response.data.length; i++) {
				const id = response.data[i].departmentId;
				const value = response.data[i].departmentName;
				$('#searchList_'+ fieldId).append('<li onclick="_clickOption(\'searchList_' + fieldId + '\', \'' + id + '\', \'' + value + '\');">'+ value +'</li>');
			}				
		})
		.catch((error) => {
			console.error("Error:", error);
		});
	} catch (error) {
		console.error("Error:", error);
		_actionAlert('An unexpected error occurred. Please try again.', false);
  	}
}

function _getSelectTutorialExam(fieldId) {
	try {
		//// call endpoint //////
		_callFetchEndPoints({
			url: `preset-data/fetch-external-exams?statusId=1`,
		})
		.then((response) => {
			for (let i = 0; i < response.data.length; i++) {
				const id = response.data[i].examId;
				const value = response.data[i].examAbbreviation;
				$('#searchList_'+ fieldId).append('<li onclick="_clickOption(\'searchList_' + fieldId + '\', \'' + id + '\', \'' + value + '\');">'+ value +'</li>');
			}				
		})
		.catch((error) => {
			console.error("Error:", error);
		});
	} catch (error) {
		console.error("Error:", error);
		_actionAlert('An unexpected error occurred. Please try again.', false);
  	}
}

function _proceedFetchTutorialByDepartmentAndExam(){

	////////get all needed values////////////
	let issueCount = 0;
	const departmentId = $('#departmentId').val().trim();
	const examId = $('#examId').val().trim();
	
	///// empty field validation//////////
	issueCount += _validateEmptyValue("departmentId", "DEPARTMENT");
	issueCount += _validateEmptyValue("examId", "EXAM");

	if (issueCount > 0) return;

	const fetchDepartmentExamParams = {
		departmentId: departmentId,
		examId: examId,
	};

	sessionStorage.setItem(
		"fetchDepartmentExamParams",
		JSON.stringify(fetchDepartmentExamParams),
	);
	_getActivePage({page:'tutorialPage', divid:'tutorialPage'});
	_alertClose();
}

/// Proceed Fetch Tutorial By Department And Exam ////
function _fetchTutorialByDepartmentAndExamData(){
	let fetchDepartmentExamParams = JSON.parse(
    	sessionStorage.getItem("fetchDepartmentExamParams"),
  	);

	const departmentId = fetchDepartmentExamParams?.departmentId;
	const examId = fetchDepartmentExamParams?.examId;

	try {
		//// call endpoint //////
		_callFetchEndPoints({
			url: `admin/tutorials/fetch-tutorials-by-department-and-exam?departmentId=${departmentId}&examId=${examId}`,
            accessKey: true,
        })
        .then((response) => {
			const departmentName = response?.departmentData?.departmentName || '';
			const examAbbreviation = response?.examData?.examAbbreviation || '';
			$("#departmentName").html(departmentName);
			$("#examAbbreviation").html(examAbbreviation);
			sessionStorage.setItem("useTutorialByDepartmentSession", JSON.stringify(response));
			_initFetchTutorialByDepartmentAndExam(response);
		})
		.catch((error) => {
			_staffValidationCheck(error.response);
			console.error("Error:", error);
			if (error.status==0) {
				_showFalseNotification({
					container: "#fetchTutorialDepartmentExamContent",
					message: "Check your internet connection and try again",
				});
				_callAjaxError(() => _fetchTutorialByDepartmentAndExamData(), error.message); // retry if needed
			} else {
				_showFalseNotification({
					container: "#fetchTutorialDepartmentExamContent",
					message: error.message,
				});
			}
		});
		
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _fetchTutorialByDepartmentAndExamData());
	}
}

/// Initialize Fetch Year by Department Data ///
function _initFetchTutorialByDepartmentAndExam(response) {
  	const content = response.data.map((year) => {
	const toggleId = `view_${year.yearId}`;

    // Map Years Content  for each department ////
    const departmentSubjectContent = year.subjects.length > 0 ? year.subjects.map((subject) => {
	const subjectToggleId = `view_${year.yearId}_${subject.subjectData.subject_id}`;

	const tutorialContent = subject.tutorials.length > 0 ? subject.tutorials.map((tutorial) => {

	return `
		<div class="topics-container">
			<div class="image-div">
				<img src="${tutorialPixPath}${tutorial.tutorialPicture}?t=${Date.now()}" alt="${tutorial.tutorialTitle}" />
			</div>

			<div class="content-div">
				<div class="top-content">
					<h4>${tutorial.tutorialTitle}</h4>
					${tutorial.tutorialDescription || ''}
				</div>

				<div class="bottom-content">
					<div class="left-div">
						<div>
							Status:
							<span class="status-div ${tutorial.statusName}">
								${tutorial.statusName}
							</span>
						</div>

						<div>
							Duration:
							<span class="duration">
								<strong>${tutorial.tutorialDuration}</strong>
							</span>
						</div>
					</div>

					<div class="btn-div">
						<button class="btn edit" title="EDIT VIDEO"
							onclick="sessionStorage.removeItem('useEachTutorialSession'); _fetchEachTutorial('${tutorial.tutorialId}')">
							<i class="bi-pencil-square"></i> EDIT
						</button>

						<button class="btn" title="VIEW CBT"
							onclick="_getForm({page: 'videoPageDetails', url: adminPortalLocalUrl});">
							<span class="count">0</span> CBT
						</button>
					</div>
				</div>
			</div>
		</div>
	`;

	}).join('')
	: `
		<div class="false-notification-div">
			<p>No tutorial found!</p>
			<div>
				<button class="btn" title="ADD NEW VIDEO"
					onclick="sessionStorage.removeItem('useEachTutorialSession'); _getFetchEachYearWithId('${year.yearId}','${subject.subjectData.subject_id}');">
					<i class="bi-plus-square"></i> ADD NEW VIDEO
				</button>
			</div>
		</div>
	`;

	return `
		<div class="pages-toggle-div">
			<div class="pages-toggle-title" title="CLICK TO VIEW ${subject.subjectData.subject_name} VIDEOS">
				<div class="title-back-div subject-title-div">
					<h3>${subject.subjectData.subject_name}</h3>
					<div class="bottom-text">
						No of Videos 
						<div class="count">${subject.tutorials.length}</div>
					</div>
				</div>

				<div class="btn-back-div">
					<button class="btn" title="ADD NEW VIDEO"
						onclick="sessionStorage.removeItem('useEachTutorialSession'); _getFetchEachYearWithId('${year.yearId}','${subject.subjectData.subject_id}');">
						<i class="bi-plus-square"></i> ADD NEW VIDEO
					</button>

					<div class="expand-div" id="${subjectToggleId}num"
						onclick="_chevronCollapse('${subjectToggleId}');">
						&nbsp;<i class="bi-plus"></i>&nbsp;
					</div>
				</div>
			</div>

			<div class="toggle-expand-div" id="${subjectToggleId}answer" style="display: none;">
				<div class="topics-wrapper">
					${tutorialContent}
				</div>
			</div>
		</div>
	`;

	}).join('')
	: `
		<div class="false-notification-div">
			<p>No record found!</p>
		</div>
	`;

    return `
		<div class="pages-toggle-div">
			<div class="pages-toggle-title" title="CLICK TO VIEW ${response.departmentData.departmentName} SUBJECTS">
				<div class="title-back-div">
					<h3>${response.departmentData.departmentName} (${year.yearValue} ${response.examData.examAbbreviation})</h3>
				</div>

				<div class="btn-back-div">
					<div class="expand-div" id="${toggleId}num" onclick="_chevronCollapse('${toggleId}');">&nbsp;<i class="bi-plus"></i>&nbsp;</div>
				</div>
			</div>

			<div class="toggle-expand-div" id="${toggleId}answer" style="display: none;">
				<!--Each Subject Toggle container -->
				<div class="pages-toggle-back-div">
					${departmentSubjectContent}
				</div>
			</div>
		</div>
    `;
  }).join("");

  $('#fetchTutorialDepartmentExamContent').html(content);
   	// AUTO-OPEN AFTER RELOAD
	const openId = sessionStorage.getItem("openTutorialId");
	if (openId) {
		const toggleId = `view_${openId}`;

		// open toggle
		_chevronCollapse(toggleId);

		// clear after use
		sessionStorage.removeItem("openTutorialId");
	}
}

function _getFetchEachYearWithId(yearId, subjectId) {
  let storedData = JSON.parse(
    sessionStorage.getItem("useTutorialByDepartmentSession")
  );

  let years = storedData.data;

  // correct key (yearId)
  let year = years.find((y) => y.yearId === yearId);

  // find subject inside that year
  let subject = year.subjects.find(
    (s) => s.subjectData.subject_id === subjectId
  );

  // build selected tutorial data
  let selectedTutorial = {
    yearId: year.yearId,
    yearValue: year.yearValue,

    subjectId: subject.subjectData.subject_id,
    subjectName: subject.subjectData.subject_name,

    examId: storedData.examData.examId,
    examAbbreviation: storedData.examData.examAbbreviation,

    departmentId: storedData.departmentData.departmentId,
    departmentName: storedData.departmentData.departmentName,
  };

  // save to session
  sessionStorage.setItem(
    "selectedTutorialSession",
    JSON.stringify(selectedTutorial)
  );
  _getForm({ page: "tutorialReg", url: adminPortalLocalUrl });
}

/// Create And Update Tutorial Videos ////
function _createAndUpdateTutorialVideos(){
	let useEachTutorialSession = JSON.parse(sessionStorage.getItem("useEachTutorialSession"));
	try {
		tinyMCE.triggerSave();
		////////get all needed values////////////
		let issueCount = 0;
		const tutorialTitle = $('#tutorialTitle').val().trim();
		const tutorialDescription = $('#tutorialDescription').val().trim();
		const tutorialPicture = $("#tutorialPicture").prop("files")[0];
		const tutorialVideo = $("#tutorialVideo").prop("files")[0];
		const tutorialDuration = $('#tutorialDuration').val().trim();
		const tutorialMaterial = $("#tutorialMaterial").prop("files")[0];
        const statusId = $('#statusId').val().trim();
		
		///// empty field validation//////////
		issueCount += _validateEmptyValue("tutorialTitle", "TITLE");
		issueCount += _validateEmptyValue("tutorialDescription", "SUMMARY");
		issueCount += _validateEmptyValue("tutorialDuration", "DURATION");
		issueCount += _validateEmptyValue("statusId", "STATUS");

		$("#tutorialDescription, #tutorialPicture, #tutorialVideo, #tutorialMaterial").removeClass("issue");
  		$("#issue_tutorialDescription, #issues_tutorialPicture, #issues_tutorialVideo, #issues_tutorialMaterial").html("");

		if (!useEachTutorialSession){
			if (!tutorialDescription) {
				$("#tutorialDescription").addClass("issue");
				$("#issue_tutorialDescription").html("SUMMARY IS REQUIRED");
				issueCount++;
			}
		}

		if (!useEachTutorialSession){
			if (!tutorialPicture) {
				$("#tutorialPicture").addClass("issue");
				$("#issues_tutorialPicture").html("VIDEO PICTURE IS REQUIRED").fadeIn();
				issueCount ++
			}
		}

		if (!useEachTutorialSession){
			if (!tutorialVideo) {
				$("#tutorialVideo").addClass("issue");
				$("#issues_tutorialVideo").html("VIDEO IS REQUIRED").fadeIn();
				issueCount ++
			}
		}

		if (!useEachTutorialSession){
			if (!tutorialMaterial) {
				$("#tutorialMaterial").addClass("issue");
				$("#issues_tutorialMaterial").html("MATERIAL IS REQUIRED").fadeIn();
				issueCount ++
			}
		}

		if (issueCount > 0) return;

		/////Gather form data////
		const formData = new FormData();
		formData.append("tutorialTitle", tutorialTitle);
		formData.append("tutorialDescription", tutorialDescription);
		formData.append("tutorialDuration", tutorialDuration);
		formData.append("statusId", statusId);

		if (tutorialPicture) {
			formData.append("tutorialPicture", tutorialPicture);
		}

		if (tutorialVideo) {
			formData.append("tutorialVideo", tutorialVideo);
		}

		if (tutorialMaterial) {
			formData.append("tutorialMaterial", tutorialMaterial);
		}

		////// confirm action////
		_showCustomConfirm({
		callback: () => {
			_createAndUpdateTutorialVideosCallback(formData);
		},
			title: "Are you sure?",
			message: 'Are you sure you want to continue? This action is irreversible.',
			alertType: "warning",
			falseActionBtn: true,
			closeOnOverlayClick: true,
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _createAndUpdateTutorialVideos());
	}
}

function _resetUploadUI(btnText) {
	_btnDisable("submitBtn", btnText, false);
	$("#submitBtn").fadeIn(300);
	$("#validate-progress-alert").hide();
	$(".validate-ajax-progress").width('0%').html('0%');
}

/// Save Create And Update Tutorial Videos CallBack ///
function _createAndUpdateTutorialVideosCallback(formData) {
	let selectedTutorialSession = JSON.parse(sessionStorage.getItem("selectedTutorialSession"));
	let useEachTutorialSession = JSON.parse(sessionStorage.getItem("useEachTutorialSession"));

	const btnText = $("#submitBtn").html();

	// disable + hide button
	_btnDisable("submitBtn", btnText, true);
	$("#submitBtn").hide();
	$("#validate-progress-alert").fadeIn(300);

	let callUrl= useEachTutorialSession?.tutorialId ? `admin/tutorials/update-tutorial?departmentId=${selectedTutorialSession.departmentId}&examId=${selectedTutorialSession.examId}&subjectId=${selectedTutorialSession.subjectId}&yearId=${selectedTutorialSession.yearId}&tutorialId=${useEachTutorialSession?.tutorialId}` : `admin/tutorials/create-tutorial?departmentId=${selectedTutorialSession.departmentId}&examId=${selectedTutorialSession.examId}&subjectId=${selectedTutorialSession.subjectId}&yearId=${selectedTutorialSession.yearId}`;

	_callFileEndPoints({
		xhr: function () {
			let xhr = new XMLHttpRequest();

			// ONLY UPLOAD PROGRESS
			xhr.upload.addEventListener("progress", function (evt) {
				if (evt.lengthComputable) {
					let percent = Math.floor((evt.loaded / evt.total) * 100);

					// cap at 99% to avoid “fake complete”
					if (percent > 99) percent = 99;

					$(".validate-ajax-progress")
						.width(percent + "%")
						.html(percent + "%");
				}
			});
			return xhr;
		},
		url: callUrl,
		formData,
		accessKey: true,
	})
	.then((response) => {
		const message = response.message;
		// SAVE SESSION TO REOPEN ///
    	sessionStorage.setItem("openTutorialId", selectedTutorialSession?.yearId);

		const newtutorialPicture = response?.newtutorialPicture;
		const newtutorialVideo = response?.newtutorialVideo;
		const newtutorialMaterial = response?.newtutorialMaterial;

		/// get old files name ///
		const oldtutorialPicture = response?.oldtutorialPicture;
		const oldtutorialVideo = response?.oldtutorialVideo;
		const oldtutorialMaterial = response?.oldtutorialMaterial;

		_uploadTutorialFiles(newtutorialPicture, newtutorialVideo, newtutorialMaterial, oldtutorialPicture, oldtutorialVideo, oldtutorialMaterial, message, btnText);
	})
	.catch((error) => {
		_staffValidationCheck(error.response);
		console.log("Error:", error);

		if (error.status == 0) {
			_callAjaxError(() => _createAndUpdateTutorialVideosCallback(formData), error.message);
		} else {
			_actionAlert(error.message, false);
		}

		// reset UI on ALL errors
		_resetUploadUI(btnText);
	});
}

function _uploadTutorialFiles(newtutorialPicture, newtutorialVideo, newtutorialMaterial, oldtutorialPicture, oldtutorialVideo, oldtutorialMaterial, message, btnText) {
	$("#validate-progress-alert").hide();
	$("#progress-alert").fadeIn(300);
	$(".ajax-progress").css("width", "0%").html("0%");

    const tutorialPicture = document.getElementById("tutorialPicturePreview").src;
    const uploadTutorialVideoFile = $("#tutorialVideo").prop("files")[0];
    const uploadedTutorialMaterialFile = $("#tutorialMaterial").prop("files")[0];

    const formData = new FormData();
    formData.append("action", "uploadTutorialFiles");

    let hasUpload = false;

    // IMAGE CHECK
    if (tutorialPicture && tutorialPicture.startsWith("data:image")) {
        formData.append("tutorialPicture", tutorialPicture);
        formData.append("newtutorialPicture", newtutorialPicture);
        hasUpload = true;
    }
    formData.append("oldtutorialPicture", oldtutorialPicture);

    // VIDEO CHECK
    if (uploadTutorialVideoFile) {
        formData.append("tutorialVideo", uploadTutorialVideoFile);
        hasUpload = true;
    }
    formData.append("newtutorialVideo", newtutorialVideo);
    formData.append("oldtutorialVideo", oldtutorialVideo);

    // MATERIAL CHECK
    if (uploadedTutorialMaterialFile) {
        formData.append("tutorialMaterial", uploadedTutorialMaterialFile);
        hasUpload = true;
    }

    formData.append("newtutorialMaterial", newtutorialMaterial);
    formData.append("oldtutorialMaterial", oldtutorialMaterial);

    // NO UPLOAD CASE → STILL SUCCESS
    if (!hasUpload) {
        _showCustomConfirm({
            callback: () => {
				_alertClose();
                _fetchTutorialByDepartmentAndExamData();
            },
            title: 'Success!',
            message: message,
            alertType: 'success',
            trueActionBtnText: 'OK, Thanks.',
            closeOnOverlayClick: false,
        });
        return;
    }

    // SEND REQUEST
    _callFileEndPoints({
		xhr: function () {
			let xhr = new XMLHttpRequest();

			// ONLY UPLOAD PROGRESS
			xhr.upload.addEventListener("progress", function (evt) {
				if (evt.lengthComputable) {
					let percent = Math.floor((evt.loaded / evt.total) * 100);

					// cap at 99% to avoid “fake complete”
					if (percent > 99) percent = 99;

					$(".ajax-progress")
						.width(percent + "%")
						.html(percent + "%");
				}
			});
			return xhr;
		},
        url: uploadTutorialUrl,
        formData,
        expectJson: false,
    })
    .then(() => {
        _showCustomConfirm({
            callback: () => {
				_alertClose();
                _fetchTutorialByDepartmentAndExamData();
            },
            title: 'Success!',
            message: message,
            alertType: 'success',
            trueActionBtnText: 'OK, Thanks.',
            closeOnOverlayClick: false,
        });
    })
    .catch((error) => {
        console.error("Error:", error);
        _callAjaxError(() =>
            _uploadTutorialFiles(newtutorialPicture, newtutorialVideo, newtutorialMaterial, oldtutorialPicture, oldtutorialVideo, oldtutorialMaterial, message, btnText)
        );
		// reset UI on ALL errors
		_resetUploadUI(btnText);
    });
}

/// Fetch Each Tutorial ///
function _fetchEachTutorial(tutorialId) {
    $("#get-form-more-div").css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);
	try {
		//// call endpoint //////
		_callFetchEndPoints({
			url: `admin/tutorials/fetch-tutorial-by-id?tutorialId=${tutorialId}`,
			accessKey: true,
		})
		.then((response) => {
			const data = response.data;
			sessionStorage.setItem("useEachTutorialSession", JSON.stringify(data));
			_getForm({page: 'tutorialReg', url: adminPortalLocalUrl});

			let selectedTutorial = {
				tutorialId: data.tutorialId,

				yearId: data.yearData.yearId,
				yearValue: data.yearData.yearValue,

				subjectId: data.subjectData.subject_id,
				subjectName: data.subjectData.subject_name,

				examId: data.examData.examId,
				examAbbreviation: data.examData.examAbbreviation,

				departmentId: data.departmentData.departmentId,
				departmentName: data.departmentData.departmentName,
			};

			sessionStorage.setItem(
			"selectedTutorialSession",
			JSON.stringify(selectedTutorial)
			);
		})
		.catch((error) => {
			_staffValidationCheck(error.response);
			_alertClose();
			console.error("Error:", error);
			_callAjaxError(() => _fetchEachTutorial(tutorialId), error.message); // retry if needed
		});
	} catch (error) {
		_alertClose();
		console.error("Error:", error);
		_callCatchError(() => _fetchEachTutorial(tutorialId));
  	}
}