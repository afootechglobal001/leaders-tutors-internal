 
      (function() {
        function _checkActiveSession() {
            let loginUserInfoSession_ = JSON.parse(sessionStorage.getItem("loginUserInfoSession"));
            if (!loginUserInfoSession_ || !loginUserInfoSession.user[0].hasOwnProperty("user_id")) {
                _logOut();
            }
        }
    
        _checkActiveSession();
    })();