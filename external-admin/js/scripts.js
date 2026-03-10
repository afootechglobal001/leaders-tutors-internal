function _nextLoginPage(props) {
  const { page = "" } = props;
  _getPage({ page: page, url: adminLocalUrl });
}

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
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
