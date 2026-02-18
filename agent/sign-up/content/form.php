<?php if ($page=='otp_form'){?>
    <div class="caption-div animated zoomIn">
        <div class="title-div">
           <div class="title"><i class="bi-person-fill-lock"></i> OTP AUTHENTICATION</div>
           <button class="close-btn" onclick="alert_close()" title="Close"><i class="bi-x-lg"></i></button>
        </div>

        <div class="div-in animated fadeInRight">
            <div class="alert alert-success"> <i class="bi-person"></i> Hi, an <span>OTP</span> has been sent to your email address (<span id="useremail">xxxx</span>) to Complete your Registration. Kindly check your <strong>INBOX</strong> or <strong>SPAM</strong> to confirm.</div>
            <div class="text_field_back_container"> 
                <div class="text_field_container">
                    <input class="text_field" type="number" id="otp" placeholder="" onkeypress="isNumber_Check(event)"/>
                    <div class="placeholder">Enter OTP:</div>
                </div> 
            </div> 
            <button class="btn" type="button" id="submit_btn"  title="Proceed" onclick="_completeRegistration();"><i class="bi-check"></i> PROCEED </button>
            <div id="resendCountdown">Resend in <strong id="timer">30</strong> Sec</div>
            <div id="resendOtpBtn" onclick="_resentOtp();"><strong>Resend OTP</strong></div>
        </div>
    </div>
    <script>_counDownOtp(30)</script>
 <?php } ?>

 <?php if ($page=='compelete_reg_form'){?>
    <div class="caption-div animated zoomIn">
        <div class="title-div">
           <div class="title"><i class="bi-check"></i> REGISTRATION COMPLETE</div>
           <button class="close-btn" onclick="alert_close()" title="Close"><i class="bi-x-lg"></i></button>
        </div>

        <div class="div-in animated fadeInRight">
            <div class="alert alert-success"> <i class="bi-person"></i> Congratulations, (<span id="agentname">xxxx</span>)! <br>You have successfully registered your company as an agent under Leaders Tutor application.<br> Note that your company is under review, as we will revert within 3 working days. Kindly proceed to your dashboard.</div>
            <br clear="all"/>
            <button class="btn" type="button" id="submit_btn"  title="Proceed" onclick="proceedToPortal();"> Go to dashboard <i class="bi-arrow-right"></i></button>
        </div>
    </div>
 <?php } ?>