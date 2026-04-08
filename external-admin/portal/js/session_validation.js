(function() {
    function _checkActiveSession() {
        let staffLoginData_ = JSON.parse(sessionStorage.getItem("staffLoginData"));       
        if (!staffLoginData_ || !staffLoginData_.hasOwnProperty("staff_id")) {
            _logOut();
        }
    }
    _checkActiveSession();
})();