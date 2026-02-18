(function() {
    function _check_active_session() {
        let agentLoginData_ = JSON.parse(sessionStorage.getItem("agentLoginData"));
        if (!agentLoginData_ || !agentLoginData_.hasOwnProperty("access_key")) {
            _logout();
        }
    }
    _check_active_session();
})();
