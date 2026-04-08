function _getActivePage(props) {
  const { page = "", divid = "", nav = "" } = props;
  _getActiveLink(divid);
  if (page) {
    _getPage({ page: page, url: adminPortalLocalUrl });
  }
}

function _getActiveLink(divid) {
  _removeClass();
  $("#" + divid).addClass("active-li");
}

function _removeClass() {
  $(
    "#dashboard, #topDashboard, #examPage, #yearPage, #studentPage, #subscriptionPage, #tutorialPage"
  ).removeClass("active-li");
}

function _open_li(ids) {
  $("#" + ids + "-sub-li").toggle("slow");
}

function _toggleProfileDiv() {
  $(".toggle").toggle("slow");
}

function _closeProfileDiv(event) {
  if (!$(event.target).closest(".toggle, .right-icon-div").length) {
    $(".toggle").hide("slow");
  }
}
$(document).on("click", _closeProfileDiv);

function select_search() {
  $(".srch-select").toggle("fast");
}

function srch_custom(text) {
  $("#srch-text").html(text);
  $(".custom-srch-div").fadeIn(500);
}

function _closeSearchDiv(event) {
  if (!$(event.target).closest(".srch-select, .text-right").length) {
    $(".srch-select").hide("slow");
  }
}
$(document).on("click", _closeSearchDiv);

function capitalizeFirstLetterOfEachWord(inputText) {
  const words = inputText.toLowerCase().split(" ");
  for (let i = 0; i < words.length; i++) {
    words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1);
  }
  const result = words.join(" ");
  return result;
}

function getFirstLettersOfEachWord(str) {
  return str
    .split(" ") // split by spaces
    .filter((word) => word) // remove empty strings (in case of double spaces)
    .map((word) => word[0].toUpperCase()) // take first letter and uppercase it
    .join(""); // join into a single string
}

function filters(selectBoxId) {
  var valThis = $("#search" + selectBoxId).val();
  $(
    "#page" +
      selectBoxId +
      " > tbody .tb-row, .grid-div, .faq-back-div, .testimony-div, .exam-div, .book-back-div"
  ).each(function () {
    var text = $(this).text();
    text.toLowerCase().indexOf(valThis.toLowerCase()) > -1
      ? $(this).show()
      : $(this).hide();
  });
}

function _chevronCollapse(divId) {
  var x = document.getElementById(divId + "num");
  var titleDiv = x.closest(".pages-toggle-title");

  if (x.innerHTML === '&nbsp;<i class="bi-plus"></i>&nbsp;') {
    x.innerHTML = '&nbsp;<i class="bi-dash"></i>&nbsp;';
    $("#" + divId + "answer").addClass("active-li");
    $(titleDiv).addClass("active-toggle");
  } else {
    x.innerHTML = '&nbsp;<i class="bi-plus"></i>&nbsp;';
    $(titleDiv).removeClass("active-toggle");
  }

  $("#" + divId + "answer").slideToggle("slow");
}

function _logOut(){
	sessionStorage.clear();
	window.parent.location.href = adminPortalUrl;
}

function _confirmLogOut() {
  _showCustomConfirm({
    callback: () => {
      _logOut();
    },
    title: "Confirm Logout Action!",
    message:
      "Are you sure you want to log out? You may miss important notifications or updates until you sign in again.",
    alertType: "warning",
    falseActionBtn: true,
  });
}

function _staffValidationCheck(code) {
  if (code === 401 || code === 403) {
    _logOut();
    return;
  }
}

function _toggleCheck() {
  $(".switch input").on("change", function () {
    const label = $(this).next().next(); // Grab the toggle-label span
    label.text($(this).prop("checked") ? "Yes" : "No");
  });
}

function formatDate(date) {
  if (!date) return "";
  // If input comes in as YYYY-MM-DD (from <input type="date">)
  if (date.includes("-")) {
    const [year, month, day] = date.split("-");
    return `${year}/${month}/${day}`;
  }
  // If input comes in as DD/MM/YYYY
  if (date.includes("/")) {
    const [day, month, year] = date.split("/");
    return `${year}/${month}/${day}`;
  }
  return date; // fallback
}

function _fetchFormatDate(dateString) {
  if (!dateString) return "N/A"; // fallback if no date
  const dateObj = new Date(dateString);
  const options = { day: "2-digit", month: "short", year: "numeric" };
  // Example: 25 Jan 2025
  return dateObj.toLocaleDateString("en-GB", options).replace(" ", " ");
}

function thousandSeparator(val) {
  let dp = 2;
  const formatter = new Intl.NumberFormat("ng-NG", {
    style: "decimal",
    maximumFractionDigits: dp,
    minimumFractionDigits: dp,
  });
  //   return formatter.format(val);
  return isNaN(parseFloat(formatter.format(val))) ? "-" : formatter.format(val);
}

///// Admin SelectFields ///////////
function _getSelectStatusId(fieldId, statusIds){
	try {
		$.ajax({
			type: "GET",
			url: endPoint+"/preset-data/fetch-status?statusId="+statusIds,
			dataType: "json",
			cache: false,
			headers: {
				'apiKey': apiKey,
				'Authorization': 'Bearer ' + loginAccessKey
			},
			success: function(info) {
				const data = info.data;
				const success = info.success;

				if (success === true) {
					for (let i = 0; i < data.length; i++) {
						const id = data[i].statusId;
						const value = data[i].statusName;
						$('#searchList_'+ fieldId).append('<li onclick="_clickOption(\'searchList_' + fieldId + '\', \'' + id + '\', \'' + value + '\');">'+ value +'</li>');
					}	
				} else {
					_actionAlert(info.message, false);
					const response = info.response;
					if (response < 100) {
						_logOut();
					}
				}
			}
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred. Please try again.', false);
	}
}