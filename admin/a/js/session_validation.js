 
      (function() {
        function _check_active_session() {
            let login_staff_session_ = JSON.parse(sessionStorage.getItem("login_staff_session"));
            if (!login_staff_session_ || !login_staff_session_.staff.hasOwnProperty("staff_id")) {
                _logout();
            }
        }
    
        _check_active_session();
    })();