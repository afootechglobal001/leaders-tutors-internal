 
      (function() {
        function _check_active_session() {
            let login_staff_session_ = JSON.parse(sessionStorage.getItem("login_staff_session"));
            console.log("login_staff_session_", login_staff_session_);
            if (!login_staff_session_ || !login_staff_session_.staff[0].hasOwnProperty("staff_id")) {
                _logout();
            }
        }
    
        _check_active_session();
    })();