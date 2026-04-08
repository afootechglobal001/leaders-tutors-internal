//// Toggle Check Function ////
function _toggleCheck(){
	$('.switch input').on('change', function () {
		const label = $(this).next().next(); // Grab the toggle-label span
		label.text($(this).prop('checked') ? 'Yes' : 'No');
	});
}

function _checkedExamAndSubject() {
    const sessionData = JSON.parse(sessionStorage.getItem("useSingleYearSession"));

    if (!sessionData) return;
    const exams = sessionData.examsData || [];
    const subjects = sessionData.subjectsData || [];

    //// CHECK EXAMS ////
    exams.forEach(exam => {
        const checkbox = $(`#exam_${exam.examId}`);
        checkbox.prop('checked', true);

        // Update label
        checkbox.next().next().text('Yes');
    });

    //// CHECK SUBJECTS ////
    subjects.forEach(subject => {
        const checkbox = $(`#subject_${subject.subjectId}`);
        checkbox.prop('checked', true);

        // Update label
        checkbox.next().next().text('Yes');
    });
}

/// Fetch External Exam Toggle ///
function _fetchExternalExamToggle() {
	try {
		_callFetchEndPoints({
		url: `preset-data/fetch-external-exams`,
		accessKey: true,
		})
		.then((response) => {
			_initFetchExternalExamToggle(response.data);
		})
		.catch((error) => {
			console.error("Error:", error);
		});
	} catch (error) {
		console.error("Error:", error);
	}
}

//// Initialize Fetch External Exam Toggle ////
function _initFetchExternalExamToggle(data) {
    let examHtml = '';
	for (let i = 0; i < data.length; i++) {
		const {examId, examAbbreviation} = data[i];

		examHtml += `
        <div class="each-toggle-div">
            <span>${examAbbreviation}</span>
            <label for="exam_${examId}" class="switch">
                <input type="checkbox" class="child exam-checkbox" id="exam_${examId}" name="examId[]" data-value="${examId}">
                <span class="slider"></span>
                <span class="toggle-label">No</span>
            </label>
        </div>`;
	}
	$('#examToggle').html(examHtml);
	_toggleCheck();
    _checkedExamAndSubject();
}

//// Fetch External Subject Toggle ////
function _fetchExternalSubjectToggle() {
	try {
		_callFetchEndPoints({
		url: `preset-data/fetch-external-subjects`,
		accessKey: true,
		})
		.then((response) => {
			_initFetchExternalSubjectToggle(response.data);
		})
		.catch((error) => {
			console.error("Error:", error);
		});
	} catch (error) {
		console.error("Error:", error);
	}
}

//// Initialize Fetch External Subject Toggle ////
function _initFetchExternalSubjectToggle(data) {
    let subjectHtml = '';
	for (let i = 0; i < data.length; i++) {
		const {subject_id, subject_name} = data[i];

		subjectHtml += `
        <div class="each-toggle-div">
            <span>${subject_name}</span>
            <label for="subject_${subject_id}" class="switch">
                <input type="checkbox" class="child subject-checkbox" id="subject_${subject_id}" name="subjectId[]" data-value="${subject_id}">
                <span class="slider"></span>
                <span class="toggle-label">No</span>
            </label>
        </div>`;
	}
	$('#subjectToggle').html(subjectHtml);
	_toggleCheck();
    _checkedExamAndSubject();
}

/// Fetch Year by Department Data ///
function _fetchYearByDepartmentData() {
	try {
		//// call endpoint //////
		_callFetchEndPoints({
			url: `admin/years/fetch-year-by-departments`,
			accessKey: true,
		})
		.then((response) => {
            _initFetchYearByDepartmentData(response.data);
		 })
		.catch((error) => {
			_staffValidationCheck(error.response);
			console.error("Error:", error);
			if (error.status==0) {
				_showFalseNotification({
					container: "#departmentByYearContent",
					message: "Check your internet connection and try again",
				});
				_callAjaxError(() => _fetchYearByDepartmentData(), error.message); // retry if needed
			} else {
				 _showFalseNotification({
					container: "#departmentByYearContent",
					message: error.message,
				});
			}
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _fetchYearByDepartmentData());
  	}
}

/// Initialize Fetch Year by Department Data ///
function _initFetchYearByDepartmentData(data) {
  	const content = data.map((dept) => {
	const toggleId = `view_${dept.departmentId}`;

    // Map Years Content  for each department ////
    const yearContent = dept.yearsData.length > 0 ? dept.yearsData.map((year) => {

	return `
		<div class="pages-toggle-div">
            <div class="pages-toggle-title">
                <div class="title-back-div subject-title-div">
                    <h3>${year.yearValue}</h3>
                    <div class="bottom-back-div">
                        <div class="bottom-text">No of Exams <div class="count">${year.examsCount}</div></div> |
                        <div class="bottom-text">No of Subjects <div class="count">${year.subjectsCount}</div></div>
                    </div>
                </div>

                <div class="btn-back-div">
                    <button class="btn" title="EDIT YEAR" onclick="sessionStorage.removeItem('useSingleYearSession'); _fetchSingleYear('${year.yearId}')"><i class="bi-plus-square"></i> EDIT</button>
                </div>
            </div>
        </div>
	`;
	}).join('')
	
	: `
        <div class="false-notification-div">
            <p>No record found!</p>
            <div>
                <button class="btn" title="ADD NEW YEAR" onclick="sessionStorage.removeItem('useSingleYearSession'); _openSingleYearForm(${JSON.stringify(dept).replace(/"/g, "&quot;")});"><i class="bi-plus-square"></i> ADD YEAR</button>
            </div>
        </div>
	`;

    return `
		<div class="pages-toggle-div">
            <div class="pages-toggle-title" title="Click to view years">
                <div class="title-back-div">
                    <h3>${dept.departmentName}</h3>
                </div>

                <div class="btn-back-div">
                    <button class="btn" title="ADD NEW YEAR" onclick="sessionStorage.removeItem('useSingleYearSession'); _openSingleYearForm(${JSON.stringify(dept).replace(/"/g, "&quot;")});"><i class="bi-plus-square"></i> ADD YEAR</button>
                    <div class="expand-div" id="${toggleId}num" onclick="_chevronCollapse('${toggleId}');">&nbsp;<i class="bi-plus"></i>&nbsp;</div>
                </div>
            </div>

            <div class="toggle-expand-div" id="${toggleId}answer" style="display: none;">
                <div class="pages-toggle-back-div">
                    ${yearContent}
                </div>
            </div>
        </div>
    `;
  }).join("");

  $('#departmentByYearContent').html(content);

//// AUTO-OPEN AFTER RELOAD
  const openId = sessionStorage.getItem("openDepartmentToggle");

  if (openId) {
    const toggleId = `view_${openId}`;
    _chevronCollapse(toggleId);
    sessionStorage.removeItem("openDepartmentToggle");
  }
}

///// Fetch Each Year  /////
function _fetchSingleYear(yearId) {
    $("#get-form-more-div").css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);
	try {
		//// call endpoint //////
		_callFetchEndPoints({
			url: `admin/years/fetch-single-year?yearId=${yearId}`,
			accessKey: true,
		})
		.then((response) => {
			const data = response.data;
			sessionStorage.setItem("useSingleYearSession", JSON.stringify(data));

			const departmentInfo = {
				departmentId: data?.departmentData?.departmentId,
				departmentName: data?.departmentData?.departmentName,
          	};

          _openSingleYearForm(departmentInfo);
		})
		.catch((error) => {
			_staffValidationCheck(error.response);
			_alertClose();
			console.error("Error:", error);
			_callAjaxError(() => _fetchSingleYear(yearId), error.message); // retry if needed
		});
	} catch (error) {
		_alertClose();
		console.error("Error:", error);
		_callCatchError(() => _fetchSingleYear(yearId));
  	}
}

/// Open Single Year Form ////
function _openSingleYearForm(departmentInfo) {
  sessionStorage.removeItem("useEachDepartmentSession");
  sessionStorage.setItem("useEachDepartmentSession",JSON.stringify(departmentInfo));
  _getForm({ page: "yearReg", url: adminPortalLocalUrl });
}

/// Create and update year ///
function _createAndUpdateYear(){
	try {

		////////get all needed values////////////
		let issueCount = 0;
        let selectedExams = [];
		$('.exam-checkbox:checked').each(function() {
			selectedExams.push({ examId: $(this).data('value') });
		});

        let selectedSubjects = [];
		$('.subject-checkbox:checked').each(function() {
			selectedSubjects.push({ subjectId: $(this).data('value') });
		});

		const yearValue = $('#yearValue').val().trim();
        const statusId = $('#statusId').val().trim();
		
		///// empty field validation//////////
		issueCount += _validateEmptyValue("yearValue", "YEAR VALUE");
		issueCount += _validateEmptyValue("statusId", "STATUS");

        const checkedExams = $('input[name="examId[]"]:checked').length;
        const checkedSubjects = $('input[name="subjectId[]"]:checked').length;

		if (checkedExams < 1 || checkedSubjects < 1) {
			_actionAlert('Assign at least one exam and one subject to continue', false);
			return;
		}
		
		if (issueCount > 0) return;

		// Gather form data
		const formData = {
			yearValue,
            exams: selectedExams,
            subjects: selectedSubjects,
			statusId,
		};

		////// confirm action////
		_showCustomConfirm({
		callback: () => {
			_createAndUpdateYearCallback(formData);
		},
			title: "Are you sure?",
			message: 'Are you sure you want to continue? This action is irreversible.',
			alertType: "warning",
			falseActionBtn: true,
			closeOnOverlayClick: true,
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _createAndUpdateYear());
	}
}

/// Create and update year callback ///
function _createAndUpdateYearCallback(formData) {
    let useEachDepartmentSession = JSON.parse(sessionStorage.getItem("useEachDepartmentSession"));
    let useSingleYearSession = JSON.parse(sessionStorage.getItem("useSingleYearSession"));
    try {
        ///// get btn text/////
        const btnText = $("#submitBtn").html();
        _btnDisable("submitBtn", btnText, true);

        let callUrl = useSingleYearSession?.yearId ? `admin/years/update-year?departmentId=${useEachDepartmentSession?.departmentId}&yearId=${useSingleYearSession?.yearId}` : `admin/years/create-year?departmentId=${useEachDepartmentSession?.departmentId}`;

        //// call endpoint //////
        _callRawEndPoints({
            url: callUrl,
            formData,
            accessKey: true,
        })
        .then((response) => {
            // SAVE AREA TO REOPEN ///
            sessionStorage.setItem("openDepartmentToggle", useEachDepartmentSession?.departmentId);

            _showCustomConfirm({
                callback: () => {
                    _alertClose();
                    _getActivePage({page:'yearPage', divid:'yearPage'});
                },
                title: 'Success!',
                message: response.message,
                alertType: 'success',
                trueActionBtnText: 'OK, Thanks.',
                closeOnOverlayClick: false,
            });
            _btnDisable("submitBtn", btnText, false);
        })
        .catch((error) => {
            _staffValidationCheck(error.response);
            console.error("Error:", error);
            if (error.status==0) {
                _callAjaxError(() => _createAndUpdateYearCallback(formData), error.message); // retry if needed
                _btnDisable("submitBtn", btnText, false);
            } else {
                _showCustomConfirm({
                    title: "Year Already Exists",
                    message: error.message,
                    alertType: "warning",
                    trueActionBtnText: "OK",
                    closeOnOverlayClick: true,
                });
                _btnDisable("submitBtn", btnText, false);
            }
        });
    } catch (error) {
        console.error("Error:", error);
        _callCatchError(() => _createAndUpdateYearCallback(formData));
        _btnDisable("submitBtn", btnText, false);
    }
}