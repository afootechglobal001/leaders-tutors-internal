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