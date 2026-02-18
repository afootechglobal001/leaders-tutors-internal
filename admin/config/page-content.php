
<?php if($page=='login'){?>
    
    <div class="fill-form-div animated fadeIn" id="view_login">

        <div class="title-div"><i class="bi-envelope"></i> EMAIL ADDRESS:<span>*</span></div> 
        <input type="email" id="username" class="text-field" placeholder="ENTER YOUR EMAIL ADDRESS"  />

        <div class="title-div"><i class="bi-lock"></i> PASSWORD: <span>*</span></div>
        <div class="password-container">
            <input type="password" id="password" onkeyup="_show_password_visibility('password','login_pass')" class="text-field" placeholder="ENTER YOUR PASSWORD" id="password" /><br/>
            <div id="login_pass" onclick="_togglePasswordVisibility('password','login_pass')">
                <i class="bi-eye-slash password-toggle"></i>
            </div>
        </div>

        <div class="title-in">
            <input type="checkbox" id="keep-logged-in" />
            <label for="keep-logged-in">Keep me logged in</label>
        </div>

        <button class="btn" type="button" id="login_btn" onclick="_log_in();"><i class="bi-check"></i> LOG-IN</button>

        <div class="notification-div footer-div">
        Forget Password? <span class="footer-in" id="reset" onclick="_next_page('reset_password_info','reset');">RESET PASSWORD</span>
        </div>
    </div>


    <div class="fill-form-div" id="reset_password_info">
        <div class="notification-div">
            Provide your <span>Email Address</span> to reset your password
        </div>
        <div class="title-div"><i class="bi-envelope"></i> EMAIL ADDRESS: <span>*</span></div> 
        <input type="email" id="reset_pass_email" class="text-field" placeholder="ENTER YOUR EMAIL ADDRESS" />
    
        <button class="btn" type="button" id="reset_password_btn" onclick="_proceed_reset_password();"> PROCEED <i class="bi-arrow-right"></i></button>
        
        <div class="notification-div footer-div">
           Have you already have an account? <span class="footer-in"  id="flogin" onclick="_next_page('view_login','flogin');">LOG-IN</span>
        </div>
    </div>

    <script>
		superplaceholder({
			el: username,
				sentences: [ 'ENTER YOUR EMAIL ADDRESS', 'e.g afootechglobal@gmail.com', 'info@pec.com.ng', 'leaderstutors@gmail.com' ],
				options: {
				letterDelay: 80,
				loop: true,
				startOnFocus: false
			}
		});

        superplaceholder({
			el: reset_pass_email,
				sentences: [ 'ENTER YOUR EMAIL ADDRESS', 'e.g afootechglobal@gmail.com', 'info@pec.com.ng', 'leaderstutors@gmail.com' ],
				options: {
				letterDelay: 80,
				loop: true,
				startOnFocus: false
			}
		});
    </script>
    <script>_keep_me_logged_in();</script>
<?php }?>



<?php if ($page=='reset_password'){?>
<div class="overlay-off-div">
        <div class="slide-back-div">
            <div class="header-title">
                <div class="header-inner">
                    <h2>RESET PASSWORD</h2> <button class="close-btn" onclick="_alert_close()"><i class="bi-x-lg"></i></button>
                </div>
            </div>
            <div class="slide-in-div">
                <div class="fill-form-div container-div animated fadeIn" id="comfirmed_reset_password">
                    <div class="notification-div"><i class="bi-person"></i> Dear <span id="username">xxx</span>, an <span>OTP</span> has been sent to your email address (<span id="useremail">xxxx</span>) to reset your password. Kindly check your <strong>INBOX</strong> or <strong>SPAM</strong> to confirm.</div>
                        
                    <div class="title-div"> ENTER OTP: <span>*</span> <div id="otp_info" style="float:right;font-size:12px;display:none;color:#f00"><span>OTP not accepted!</span></div></div>
                    <input id="otp" type="tel" class="text-field" onkeypress="isNumber_Check()" placeholder="ENTER OTP" title-div="Enter OTP"/>

                    <div class="notification-div alert-otp" style="margin-bottom:0px;"><span>OTP</span> not received? <span id="resend" onclick="_resend_otp('resend','<?php echo $staff_id?>')"><i class="bi-send"></i> RESEND OTP</span></div>

                    <div class="title-div"> CREATE PASSWORD: <span>*</span></div>
                    <input type="password" id="password" class="text-field" placeholder="CREATE PASSWORD" title="CREATE PASSWORD"  />
                    <div class="pswd_info"><em>At least 8 charaters required including upper & lower cases and special characters and numbers.</em></div>


                    <div class="title-div"> COMFIRMED PASSWORD: <span>*</span> <span id="message">Password Not Matched!</span></div>
                    <input type="password" id="confirm_password" class="text-field" onkeyup="_check_password_match()" placeholder="COMFIRMED PASSWORD" title="COMFIRMED PASSWORD" />
                        
                
                    <button class="btn" type="button"  title-div="Reset" id="comfirmed_reset_btn" onclick="_comfirmed_reset_password('<?php echo $staff_id?>')"><i class="bi-check"></i> Reset Password </button>
                </div>
            </div>
        </div>
</div>  
 <?php } ?>


 <?php if($page=='password_reset_successful'){?>
    <div class="overlay-off-div">
        <div class="successful-div animated bounceInDown">
            <div class="success-in">
                <div class="gif">
                    <img src="<?php echo $website_url?>/all-images/images/success.gif" alt="successful gif">
                </div>
                <h3>PASSWORD RESET SUCCESSFULL</h3>
                <button onClick="window.location.reload();" type="button">OKAY</button> <br>
            </div> 
        </div>
     </div>
<?php }?>


<script type="text/javascript" src="js/scrollBar.js"></script>
<script type="text/javascript">$(".sb-container").scrollBox();</script>