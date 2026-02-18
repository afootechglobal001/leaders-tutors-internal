<script type="text/javascript" src="js/scrollBar.js"></script>
<script type="text/javascript">
    $(".sb-container").scrollBox();
</script>

<?php if ($page == 'login') { ?>

    <div class="fill-form-div animated fadeIn" id="view_login">
        <div class="form-in">
            <div class="title-div"> EMAIL ADDRESS: <span>*</span></div>
            <input type="email" class="text-field" placeholder="ENTER YOUR EMAIL ADDRESS" id="email" />


            <div class="title-div"> PASSWORD: <span>*</span></div>
            <div class="password-container">
                <input type="password" id="password" onkeyup="_showPasswordVisibility('password','login_pass')" class="text-field pass-text-field" placeholder="ENTER YOUR PASSWORD" id="password" /><br />
                <div id="login_pass" onclick="_togglePasswordVisibility('password','login_pass')">
                    <i class="bi-eye-slash password-toggle"></i>
                </div>
            </div>

            <span class="title-in"> <input type="checkbox" /> Keep me login</span>
            <span class="title-in reset-password" id="reset" onclick="_nextPage('procced_reset_password_info','reset');">Forgot Password? </span>

            <button class="btn" type="button" id="login_btn" onclick="_logIn();"><i class="bi-check"></i> Log-In</button>

            <div class="notification-div login-footer-div">
                Don't have an account? <a href="<?php echo $website_url?>/account/sign-up"><span class="footer-in">Sign-Up </span></a>
            </div>
        </div>
    </div>

    <div class="fill-form-div" id="procced_reset_password_info">
        <div class="form-in">
            <div class="alert alert-success">
                Provide your <span>Email Address</span> to reset your password
            </div>
            <div class="title-div"><i class="bi-envelope"></i> EMAIL ADDRESS: <span>*</span></div>
            <input type="email" id="reset_pass_email" class="text-field" placeholder="ENTER YOUR EMAIL ADDRESS" />

            <button class="btn" type="button" id="reset_password_btn" onclick="_proceedResetPassword();"> Proceed <i class="bi-arrow-right"></i></button>

            <div class="notification-div login-footer-div">
                Have you already have an account? <span class="footer-in" id="flogin" onclick="_nextPage('view_login','flogin');">Log-In</span>
            </div>
        </div>
    </div>

    <script>
        //_mailStorage();
        var search_content = ['Enter your email address', 'e.g afootechglobal@gmail.com', 'leaderstutors@gmail.com', 'info@pec.com.ng'];
        _placeHolder(email, search_content);
        _placeHolder(reset_pass_email, search_content);
    </script>
<?php } ?>


<!-- NOTE THIS -->
<?php if ($page == 'reset_password_pagess') { ?>
    <div class="overlay-off-div">
        <div class="slide-back-div">
            <div class="header-top">
                <h2>RESET PASSWORD</h2> <button class="close-btn" onclick="_alertClose()"><i class="bi-x-lg"></i></button>
            </div>
            <div class="slide-in sb-container">
                <div class="fill-form-div animated fadeIn">
                    <div class="alert alert-success"><i class="bi-person"></i> Dear <span id="username"></span>, an <span>OTP</span> has been sent to your email address (<span id="useremail"></span>) to reset your password. Kindly check your <strong>INBOX</strong> or <strong>SPAM</strong> to confirm.</div>

                    <div class="title-div"> ENTER OTP: <span>*</span>
                        <span id="otp_info"><em>OTP not accepted!</em></span>
                    </div>
                    <input id="reset_password_otp" type="tel" class="text-field" onkeypress="_isNumberCheck('reset_password_otp', 'otp_info')" placeholder="ENTER OTP" title="Enter OTP" />

                    <div class="alert" style="margin-bottom:0px;"><span>OTP</span> not received? <span id="resend" onclick="_resendOtp('resend')"><i class="bi-send"></i> RESEND OTP</span></div>

                    <div class="title-div"> CREATE PASSWORD: <span>*</span></div>
                    <div class="password-container">
                        <input type="password" id="create_reset_password" onkeyup="_showPasswordVisibility('create_reset_password','toggle_create_reset_password')" class="text-field" placeholder="CREATE PASSWORD" title="CREATE PASSWORD" />
                        <div id="toggle_create_reset_password" onclick="_togglePasswordVisibility('create_reset_password','toggle_create_reset_password')">
                            <i class="bi-eye-slash password-toggle"></i>
                        </div>
                    </div>

                    <div class="title-div"> COMFIRMED PASSWORD: <span>*</span> <span id="message"><em>Password Not Matched!</em></span></div>
                    <div class="password-container">
                        <input type="password" id="confirmed_reset_password" class="text-field" placeholder="COMFIRMED PASSWORD" title="COMFIRMED PASSWORD" onkeyup="_checkPasswordMatch('confirmed_reset_password','toggle_confirmed_reset_password')" />
                        <div id="toggle_confirmed_reset_password" onclick="_togglePasswordVisibility('confirmed_reset_password','toggle_confirmed_reset_password')">
                            <i class="bi-eye-slash password-toggle"></i>
                        </div>
                    </div>
                    <!-- <button class="btn" type="button" title-div="Reset" id="comfirmed_reset_btn" onclick="_completeResetPassword('<?php //echo $user_id 
                                                                                                                                        ?>')"><i class="bi-check"></i> Reset Password </button> -->
                    <button class="btn" type="button" title="Reset Password" id="comfirmed_reset_btn" onclick="_completeResetPassword()"><i class="bi-check"></i> Reset Password </button>
                </div>

            </div>
        </div>
    </div>
<?php } ?>



<?php if ($page == 'reset_password') { ?>
    <div class="overlay-off-div">
        <div class="slide-back-div">
            <div class="header-top">
                <h2>RESET PASSWORD</h2> <button class="close-btn" onclick="_alertClose()"><i class="bi-x-lg"></i></button>
            </div>
            <div class="slide-in sb-container">
                <div class="fill-form-div container-div animated fadeIn">
                    <div class="alert alert-success"><i class="bi-person"></i> Dear <span id="username"></span>, an <span>OTP</span> has been sent to your email address (<span id="useremail"></span>) to reset your password. Kindly check your <strong>INBOX</strong> or <strong>SPAM</strong> to confirm.</div>

                    <div class="title-div"> ENTER OTP: <span>*</span>
                        <div id="otp_info" style="float:right;font-size:12px;display:none;color:#f00"><span>OTP not accepted!</span></div>
                    </div>
                    <input id="reset_password_otp" type="tel" class="text-field" onkeypress="_isNumberCheck('reset_password_otp', 'otp_info')" placeholder="ENTER OTP" title="Enter OTP" />

                    <div class="alert" style="margin-bottom:0px;"><span>OTP</span> not received? <span id="resend" onclick="_resendOtp('resend')"><i class="bi-send"></i> RESEND OTP</span></div>

                    <div class="title-div"> CREATE PASSWORD: <span>*</span></div>
                    <div class="password-container">
                        <input type="password" id="create_reset_password" onkeyup="_showPasswordVisibility('create_reset_password','toggle_create_reset_password')" class="text-field" placeholder="CREATE PASSWORD" title="CREATE PASSWORD" />
                        <div id="toggle_create_reset_password" onclick="_togglePasswordVisibility('create_reset_password','toggle_create_reset_password')">
                            <i class="bi-eye-slash password-toggle"></i>
                        </div>
                    </div>

                    <div class="title-div"> COMFIRMED PASSWORD: <span>*</span> <span id="message">Password Not Matched!</span></div>
                    <div class="password-container">
                        <input type="password" id="confirmed_reset_password" class="text-field" placeholder="COMFIRMED PASSWORD" title="COMFIRMED PASSWORD" onkeyup="_checkPasswordMatch('confirmed_reset_password','toggle_confirmed_reset_password')"/>
                        <div id="toggle_confirmed_reset_password" onclick="_togglePasswordVisibility('confirmed_reset_password','toggle_confirmed_reset_password')">
                            <i class="bi-eye-slash password-toggle"></i>
                        </div>
                    </div>
                    <!-- <button class="btn" type="button" title-div="Reset" id="comfirmed_reset_btn" onclick="_completeResetPassword('<?php //echo $user_id ?>')"><i class="bi-check"></i> Reset Password </button> -->
                    <button class="btn" type="button" title="Reset Password" id="comfirmed_reset_btn" onclick="_completeResetPassword()"><i class="bi-check"></i> Reset Password </button>
                </div>

            </div>
        </div>
    </div>
<?php } ?>















<?php if($page=='password_reset_successful'){?>
    <div class="overlay-off-div animated fadeIn">
        <div class="successful-div animated zoomIn">
            <div class="success-in">
                <div class="gif">
                    <img src="<?php echo $website_url?>/account/login/all-images/images/success.gif" alt="successful gif">
                </div>
                <h3>PASSWORD RESET SUCCESSFUL </h3>
                <span>Click on okay to login and continue</span>
                <button onClick="_alertClose2('view_login','flogin')" type="button">Okay, Thanks</button> <br>
            </div> 
        </div>
    </div>
<?php }?>
