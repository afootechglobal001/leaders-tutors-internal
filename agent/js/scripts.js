function _logout(){
	sessionStorage.removeItem("agentLoginData");
	window.parent.location.href = website_url + "/agent/login";
}

function _alert_close(){
	$('#get-more-div').html('').fadeOut(200);
}

function _alert_secondary_close(){
	$('#get-more-div-secondary').html('').fadeOut(200);
}

function select_search() {
	$(".srch-select").toggle("fast");
}
  
  
function srch_custom(text){
	$('#srch-text').html(text);
	$('.custom-srch-div').fadeIn(500);
};


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



function _get_form(page) {
	$("#get-more-div").html('<div class="ajax-loader"><img src="' +website_url +'/all-images/images/ajax-loader.gif"/></div>').css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);
	var action = "get_form";
	var dataString = "action=" + action + "&page=" + page;
	$.ajax({
	  type: "POST",
	  url: agent_portal_local_url,
	  data: dataString,
	  cache: false,
	  success: function (html) {
		$("#get-more-div").html(html);
	  },
	});
}
  
  
function _get_form_with_id(page, ids) {
	$("#get-more-div").html('<div class="ajax-loader"><img src="'+website_url+'/all-images/images/ajax-loader.gif"/></div>').css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);
	var action = "get_form_with_id";
	var dataString = "action=" + action + "&page=" + page + "&ids=" + ids;
	$.ajax({
	  type: "POST",
	  url: agent_portal_local_url,
	  data: dataString,
	  cache: false,
	  success: function (html) {
		$("#get-more-div").html(html);
	  },
	});
}


function _get_secondary_form_with_id(page, ids){
	$("#get-more-div-secondary").html('<div class="ajax-loader"><img src="'+website_url+'/all-images/images/ajax-loader.gif"/></div>').css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);
	var action = "get_secondary_form_with_id";
	var dataString = "action=" + action + "&page=" + page + "&ids=" + ids;
		$.ajax({
		type: "POST",
		url: agent_portal_local_url,
		data: dataString,
		cache: false,
		success: function(html){
		   $('#get-more-div-secondary').html(html);
		},
	});
}

function _get_agent_staff_secondary_form_with_id(page, company_id, staff_id) {
	$("#get-more-div-secondary").html('<div class="ajax-loader"><img src="'+website_url+'/all-images/images/ajax-loader.gif"/></div>').css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);
	var action = "get_secondary_form_with_id";
	var dataString = "action=" + action + "&page=" + page + "&company_id=" + company_id + "&staff_id=" + staff_id;
	$.ajax({
	  type: "POST",
	  url: agent_portal_local_url,
	  data: dataString,
	  cache: false,
	  success: function (html) {
		$("#get-more-div-secondary").html(html);
	  },
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
	  url: agent_portal_local_url,
	  data: dataString,
	  cache: false,
	  success: function (html) {
		$('.company-back-details').html(html);
	  }
	});
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


function _check_active_session() {
	let agentLoginData_ = JSON.parse(sessionStorage.getItem("agentLoginData"));
	if (!agentLoginData_ || !agentLoginData_.hasOwnProperty("access_key")) {
		_logout();
		
	}
}


function _getSelectStataus(select_id,status_id){
	_check_active_session();
	var dataString = "status_id=" + status_id;
	$.ajax({
		type: "POST",
		url: endPoint + '/setups/status',
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
					const status_id = fetch[i].status_id;
					const status_name = fetch[i].status_name;
					$('#'+ select_id).append('<option value="'+ status_id +'">'+ status_name +'</option>');
				}
			}else{
				_actionAlert(message, false);
		  	}
		}, 
	});
}

  

function _getSelectRole(select_id,role_id){
	_check_active_session();
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

function _fetchDahboardInfo() {
	_check_active_session();
	let agentLoginData = JSON.parse(sessionStorage.getItem("agentLoginData"));
	const login_email = agentLoginData.email;
	const last_login_date = agentLoginData.last_login_date;

	$('#login_email').html(login_email);
	$('#last_login_date').html(last_login_date);
	_fetchAgentCompanies();
}


function _fetchAgentCompanies() {
    _check_active_session();
    let agentLoginData = JSON.parse(sessionStorage.getItem("agentLoginData"));
    $('#fetch_all_company').html('');
    let companies = agentLoginData.companies;
    let text = '';

    if (companies.length === 0) {
        text ='<div class="false-notification-div">' + "<p>No Record Found!!!</p></div>";
    } else {
        for (let i = 0; i < companies.length; i++) {
            const company = companies[i].company_details;
            const isApproved = companies[i].isApproved;

            const company_id = company.company_id;
            const name = company.name;
            const phone = company.phone;
            const email = company.email;
            const logo = company.logo;
            const documentStoragePath = company.documentStoragePath;
            const status_name = company.status_name;
			const status_id = company.status_id;
            
            if (isApproved === null) {
                text +=
                '<div class="student-profile">'+
                    '<div class="details">'+
                        '<div class="pix"><img src="' + documentStoragePath + "/" + logo + '"/></div>'+
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
                    '<button class="btn app-decl-btn" onClick="_get_form_with_id(' +"'agent_approve_profile'" +"," +"'" + company_id +"'" +');">APPROVE/DECLINE</button>'+                                
                '</div>';
            } else {
                text +=
                '<div class="student-profile">'+
                    '<div class="details">'+
                        '<div class="pix"><img src="' + documentStoragePath + "/" + logo + '"/></div>'+
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
                    '</div>';
					if(status_id==3){
						text +='<button class="btn" onClick="_get_form_with_id(' +"'agent_pending_profile'" +"," +"'" + company_id +"'" +');">VIEW DETAILS</button>';           
					}else{
						text +='<button class="btn" onClick="_get_form_with_id(' +"'agent_profile'" +"," +"'" + company_id +"'" +');">VIEW DETAILS</button>';           
					}
                 text +='</div>';
            }
        }
    }

    $('#fetch_all_company').html(text);
}




function _fetchEachCompanyInfo(companyIdToFind) {
	_check_active_session();
	let agentLoginData = JSON.parse(sessionStorage.getItem("agentLoginData"));
	let all_companies =agentLoginData.companies;
    const company = all_companies.find(s => s.company_id === companyIdToFind);

	const company_id = company.company_details.company_id;
	const name = company.company_details.name;
	const address = company.company_details.address;
	const email = company.company_details.email;
	const phone = company.company_details.phone;
	const logo = company.company_details.logo;
	const documentStoragePath = company.company_details.documentStoragePath;
	const referral_code = company.company_details.referral_code;
	const status_name = company.company_details.status_name;
	const wallet_balance = company.company_details.wallet_balance;
	const created_time = company.company_details.created_time;
	const role_id = company.role_id;

		function formatDate(date) {
			const options = { day: '2-digit', month: 'long', year: 'numeric' };
			const formattedDate = new Date(date).toLocaleDateString('en-GB', options);
			
			const dateParts = formattedDate.split(' ');
			return `${dateParts[0]}-${dateParts[1]}-${dateParts[2]}`;
	  	}
	  
	const formattedDate = formatDate(created_time);
	$('#created_time').html(formattedDate);
	$('#company_id').html(company_id);
	$('#name, #name_detail, #cont_company_name').html(name);
	$('#company_name').val(name);
	$('#address, #cont_company_address').html(address);
	$('#company_address').val(address);
	$('#company_phone').val(phone);
	$('#phone, #phone_detail, #cont_company_phone').html(phone);
    $('#company_email').val(email);
	$('#email, #email_detail, #cont_company_email').html(email);
	$('#agent_logo, #agent_pix').attr('src', documentStoragePath + '/' + logo);
	$('#referral_code_detail, #cont_company_referral_code').html(referral_code);
	$('#company_referral_code').val(referral_code);
	$('#status_name_detail, #company_status_id, #cont_status_name').html(status_name);
	$('#wallet_balance').html(wallet_balance);

	let statusButton='';
	statusButton += '<button class="status-btn '+status_name+'">'+status_name+'</button>';
	$('#show_status_name').html(statusButton);

	if (role_id > 1) {     
		let adminText =              
		'<li title="Contact Person" id="contact_person_details" onclick="_get_agent_page_contents(' +"'contact_person_details'" +"," +"'" + company_id +"'" +')">Contact Person</li>';
		$('#adminstrator_link').html(adminText);
	}
}





function _fetchAllContactPerson(company_id) {
	_check_active_session();
    let agentLoginData = JSON.parse(sessionStorage.getItem("agentLoginData"));
    let companies = agentLoginData.companies;
    let text = '';

    for (let i = 0; i < companies.length; i++) {
        if (companies[i].company_id === company_id) {
            const contact_persons = companies[i].company_details.contact_persons;

            for (let j = 0; j < contact_persons.length; j++) {
                const contact_person = contact_persons[j];

				const company_id = contact_person.company_id;
				const staff_id = contact_person.staff_id;
				const name = capitalizeFirstLetterOfEachWord(contact_person.name);
                const phone = contact_person.phone;
                const email = contact_person.email;
                const status_name = contact_person.status_name;
				const isApproved = contact_person.isApproved;

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
						'<div class="pix"><img src="all-images/body-pix/avatar.jpg" alt="Profile Picture"/></div>'+
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
            break;
        }
    }
    $('#fetch_all_contact_person').html(text);
}





function _fetchEachContactPersonInfo(companyIdToFind, staffId) {
	_check_active_session();
    let agentLoginData = JSON.parse(sessionStorage.getItem("agentLoginData"));
    let all_companies = agentLoginData.companies;
    const company = all_companies.find(s => s.company_id === companyIdToFind);
    
	const contactPerson = company.company_details.contact_persons.find(p => p.staff_id === staffId);
	
	const name = capitalizeFirstLetterOfEachWord(contactPerson.name);
	const email = contactPerson.email;
	const phone = contactPerson.phone;
	const status_id = contactPerson.status_id;
	const status_name = contactPerson.status_name;
	const role_id = contactPerson.role_id;
	const role_name = contactPerson.role_name;

	$('#contact_name').val(name);
	$('#contact_email').val(email);
	$('#contact_phone').val(phone);
	$('#contact_status_id').append('<option value="' + status_id +'" selected="selected">' + status_name +"</option>");  
    $('#contact_role_id').append('<option value="' + role_id +'" selected="selected">' + role_name +"</option>");  

	let showUpdateButton = '';
	if (company.staff_id !== contactPerson.staff_id) {
		showUpdateButton += '<button class="btn" type="button" title="SUBMIT" id="submit_btn" onclick="_updateContactPerson('+"'" + company.company_id +"'" +"," +"'" + contactPerson.staff_id +"'"+');"> <i class="bi-check"></i> UPDATE PROFILE </button>';
	}
	$('#showUpdateButton').html(showUpdateButton);
}




function _approveDeclineAgentInvitation(action,company_id) {
    if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
        const approve_decline_btn_container = $("#approve_decline_btn_container").html();
        $("#approve_decline_btn_container,#approve_decline_btn_container_1").html('<i class="fa fa-spinner fa-spin"></i>');

        const form_data = new FormData();
        form_data.append("company_id", company_id);
		var newEndPoint=null;
		if(action=='approve'){
			newEndPoint=endPoint + '/agent/verifier/approve';
		}else{
			newEndPoint=endPoint + '/agent/verifier/decline';
		}
        $.ajax({
            type: "POST",
            url: newEndPoint,
            data: form_data,
            dataType: "json",
            contentType: false,
            cache: false,
            headers: {
                'apiKey': apiKey,
                'Authorization': 'Bearer ' + agent_access_key
            },
            processData: false,
            success: function (info) {
                const success = info.success;
                const message = info.message;
	
                if (success == true) {

					let agentLoginData = JSON.parse(sessionStorage.getItem("agentLoginData"));
					agentLoginData.companies=info.companies
                    sessionStorage.setItem("agentLoginData", JSON.stringify(agentLoginData));
					_actionAlert(message, true);
					_fetchDahboardInfo();

					if(action=='approve'){
						_get_form_with_id('agent_profile', company_id);
					}else{
						_alert_close();
					}
                } else {
                    _actionAlert(message, false);
					$("#approve_decline_btn_container,#approve_decline_btn_container_1").html(approve_decline_btn_container);	
                }			
            },
        });
    }
}



function _updateAgent(company_id) {
	const updt_company_logo_file = $('#company_logo').prop('files')[0];
	const company_referral_code = $('#company_referral_code').val();
	
	if (!company_referral_code) {
		$("#company_referral_code").addClass("issue");
		_actionAlert('Provide referral code to Continue', false);
	} else {
	$("#company_referral_code").removeClass("issue");

	  if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
		const btn_text = $("#submit_btn").html();
		$("#submit_btn").html('<i class="fa fa-spinner fa-spin"></i> PROCESSING');
		document.getElementById("submit_btn").disabled = true;
  
		const form_data = new FormData();
		form_data.append("company_id", company_id);
		form_data.append("company_logo", updt_company_logo_file);
		form_data.append("company_referral_code", company_referral_code);

		$.ajax({
		  type: "POST",
		  url: endPoint + '/agent/profile/update-agent',
		  data: form_data,
		  dataType: "json",
		  contentType: false,
		  cache: false,
		  headers: {
			'apiKey': apiKey,  
			'Authorization': 'Bearer '+ agent_access_key
		  },
		  processData: false,
		  success: function (info) {
			const success = info.success;
			const message = info.message;
  
			if (success == true) {
				let agentLoginData = JSON.parse(sessionStorage.getItem("agentLoginData"));
				agentLoginData.companies=info.companies
				sessionStorage.setItem("agentLoginData", JSON.stringify(agentLoginData));
				_actionAlert(message, true);
				_fetchDahboardInfo();
				_alert_secondary_close();
				_get_form_with_id('agent_profile', company_id);
			} else {
				_actionAlert(message, false);
				$("#submit_btn").html(btn_text);
			  	document.getElementById("submit_btn").disabled = false;
			}		
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
}



function _updatePendingAgent(company_id) {
	const company_name = $('#company_name').val();
	const company_address = $('#company_address').val();
	const company_phone = $('#company_phone').val();
	const company_email = $('#company_email').val();
	const company_pending_logo_file = $('#company_logo').prop('files')[0];

	$('#company_name, #company_address, #company_phone, #company_email').removeClass('issue');
	
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
		$('#company_name, #company_address, #company_phone, #company_email').removeClass('issue');

	  if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
		const btn_text = $("#update_btn").html();
		$("#update_btn").html('<i class="fa fa-spinner fa-spin"></i> PROCESSING');
		document.getElementById("update_btn").disabled = true;
  
		const form_data = new FormData();
		form_data.append("company_id", company_id);
		form_data.append("company_name", company_name);
		form_data.append("company_address", company_address);
		form_data.append("company_phone", company_phone);
		form_data.append("company_email", company_email);
		form_data.append("company_logo", company_pending_logo_file);

		$.ajax({
		  type: "POST",
		  url: endPoint + '/agent/profile/update-pending-agent',
		  data: form_data,
		  dataType: "json",
		  contentType: false,
		  cache: false,
		  headers: {
			'apiKey': apiKey,  
			'Authorization': 'Bearer '+ agent_access_key
		  },
		  processData: false,
		  success: function (info) {
			const success = info.success;
			const message = info.message;
  
			if (success == true) {
				let agentLoginData = JSON.parse(sessionStorage.getItem("agentLoginData"));
				agentLoginData.companies=info.companies
				sessionStorage.setItem("agentLoginData", JSON.stringify(agentLoginData));
				_actionAlert(message, true);
				_fetchDahboardInfo();
				_alert_secondary_close();
				_get_form_with_id('agent_pending_profile', company_id);
			} else {
				_actionAlert(message, false);
				$("#update_btn").html(btn_text);
			  	document.getElementById("update_btn").disabled = false;
			}		
		  },
		  	error: function (error) {
			console.log(error);
			_actionAlert('An error occurred. Please try again', false);	
			$("#update_btn").html(btn_text);
			document.getElementById("update_btn").disabled = false;	
		}
		});
	  }
	}
}



function _addContactPerson(company_id) {
const contact_name = $('#contact_name').val();
const contact_email = $('#contact_email').val();
const contact_phone = $('#contact_phone').val();
const contact_role_id = $('#contact_role_id').val();
const contact_status_id = $('#contact_status_id').val();

$('#contact_name, #contact_email, #contact_phone, #company_email, #contact_role_id, #reg_contact_status_id').removeClass('issue');

if (!contact_name) {
	$('#contact_name').addClass('issue');
	_actionAlert('Provide contact name to Continue', false);

} else if (!contact_email || $('#contact_email').val().indexOf("@") <= 0) {
	$('#contact_email').addClass("issue");
	_actionAlert('Provide Email Address to Continue', false);

} else if (!contact_phone) {
	$('#contact_phone').addClass("issue");
	_actionAlert('Provide mobile number to Continue', false);

} else if (!contact_role_id) {
	$('#contact_role_id').addClass("issue");
	_actionAlert('Select role to Continue', false);

} else if (!contact_status_id) {
	$('#contact_status_id').addClass("issue");
	_actionAlert('Select status to Continue', false);

} else {
	$('#contact_name, #contact_email, #contact_phone, #company_email, #contact_role_id, #contact_status_id').removeClass('complain');

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
		url: endPoint + '/agent/profile/add-staff',
		data: form_data,
		dataType: "json",
		contentType: false,
		cache: false,
		headers: {
		'apiKey': apiKey,  
		'Authorization': 'Bearer '+ agent_access_key
		},
		processData: false,
		success: function (info) {
		const success = info.success;
		const message = info.message;

		if (success == true) {
			let agentLoginData = JSON.parse(sessionStorage.getItem("agentLoginData"));
			agentLoginData.companies=info.companies
			sessionStorage.setItem("agentLoginData", JSON.stringify(agentLoginData));
			_actionAlert(message, true);
			_alert_secondary_close();
			_get_agent_page_contents('contact_person_details', company_id);
		} else {
			_actionAlert(message, false);
			$("#submit_btn").html(btn_text);
			document.getElementById("submit_btn").disabled = false;
		}		
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
}


function _updateContactPerson(company_id, staff_id) {
	const contact_name = $('#contact_name').val();
	const contact_email = $('#contact_email').val();
	const contact_phone = $('#contact_phone').val();
	const contact_role_id = $('#contact_role_id').val();
	const contact_status_id = $('#contact_status_id').val();
   
	$('#contact_name, #contact_email, #contact_phone, #company_email, #contact_role_id, #contact_status_id').removeClass('issue');
  
	if (!contact_name) {
	  $('#contact_name').addClass('issue');
	  _actionAlert('Provide contact name to Continue', false);
	
	} else if (!contact_email || $('#contact_email').val().indexOf("@") <= 0) {
	  $('#contact_email').addClass("issue");
	  _actionAlert('Provide Email Address to Continue', false);
	
	} else if (!contact_phone) {
	  $('#contact_phone').addClass("issue");
	  _actionAlert('Provide mobile number to Continue', false);
	
	} else if (!contact_role_id) {
	  $('#contact_role_id').addClass("issue");
	  _actionAlert('Select role to Continue', false);
  
	} else if (!contact_status_id) {
	  $('#contact_status_id').addClass("issue");
	  _actionAlert('Select status to Continue', false);
  
	} else {
	  $('#contact_name, #contact_email, #contact_phone, #company_email, #contact_role_id, #contact_status_id').removeClass('complain');
  
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
		  url: endPoint + '/agent/profile/update-staff',
		  data: form_data,
		  dataType: "json",
		  contentType: false,
		  cache: false,
		  headers: {
			'apiKey': apiKey,  
			'Authorization': 'Bearer '+ agent_access_key
		  },
		  processData: false,
		  success: function (info) {
			const success = info.success;
			const message = info.message;
  
			if (success == true) {
				let agentLoginData = JSON.parse(sessionStorage.getItem("agentLoginData"));
				agentLoginData.companies=info.companies
				sessionStorage.setItem("agentLoginData", JSON.stringify(agentLoginData));
				_actionAlert(message, true);
				_alert_secondary_close();
			  _get_agent_page_contents('contact_person_details', company_id);
			} else {
				_actionAlert(message, false);
				$("#submit_btn").html(btn_text);
			  	document.getElementById("submit_btn").disabled = false;
			}		
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
  }
