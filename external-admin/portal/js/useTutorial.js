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