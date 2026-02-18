<div class="success-div animated bounceInDown" id="success-div">
    <div><i class="bi-check-all"></i></div>
    PASSWORD RESET SUCCESSFUL!<br />
    <span>Check your email to confirm.</span>
</div>


<div class="success-div animated bounceInDown" id="not-success-div">
    <div><i class="bi-x-circle"></i></div>
    INVALID LOGIN PARAMETERS!<br />
    <span>Please check the login detail.</span>
</div>


<div class="success-div animated bounceInDown" id="warning-div">
    <div><i class="bi-exclamation-circle"></i></div>
    USER ERROR!<br />
    <span>Fill The Fields To Continue</span>
</div>


<div id="get-more-div"></div>

<div id="get-more-div-secondary"></div>




<div class="sidenavdiv">
    <div class="sidenavdiv-in" onclick="_closeSideNav()">
        <div class="close-div" onclick="_closeSideNav()">X</div>
    </div>

    <div class="sidenavdiv-menu" id="menu-list-div">
        <div class="pro-back-div">
            <div class="img-div" id="side_user_pix"><img src="<?php echo $website_url ?>/uploaded_files/user_pix/friends.png" alt=""></div>
            <div class="detail-div"><span id="side_fullname">Xxxx Xxxx </span> </div>
            <div class="detail-div id"><em><span id="side_user_id">Xxxxxx</span></em> </div>
            <button class="btn" onclick="_getPageMobile('user_profile','myprofile');"><i class="bi-person"></i> My Profile</button>
        </div>

        <div class="div">
            <li class="active-li" onClick="_getPage('dashboard','dashboard')" id="mobile-dashboard"><i class="bi-speedometer2"></i> Dashboard</li>
        </div>

        <div class="div">
            <li onClick="_getPage('tutorial_subjects','subjects')" id="mobile-subjects"> <i class="bi-pencil-square"></i> Tutorial</li>
        </div>

        <!-- <div class="div">
            <li onClick="_getPage('terminal_exam','terminal-exam')" id="mobile-terminal-exam"> <i class="bi-book"></i> Terminal Exam</li>
        </div>

        <div class="div">
            <li onClick="_getPage('external_exam','external-exam')" id="mobile-external-exam"><i class="bi-book"></i> External Exam</li>
        </div>

        <div class="div">
            <li onClick="_getPage('academic_report','academic-report')" id="mobile-academic-report"><i class="bi-graph-up-arrow"></i> Academic Report</li>
        </div> -->

        <div class="div">
            <li onClick="_getForm('load_user_wallet','load_wallet')" id="mobile-wallet"> <i class="bi bi-wallet2"></i> Load Wallet</li>
        </div>

        <div class="div">
            <li onClick="_getPage('transactions','transactions-history')" id="mobile-transactions-history"><i class="bi-list-ol"></i> Transactions History</li>
        </div>

        <div class="div">
            <li onClick="_getPage('subscription_history','subscription-history')" id="mobile-subscription-history"><i class="bi-list-ol"></i> Subsription History</li>
        </div>


        <div class="div">
            <li onClick="_getForm('app_settings')"> <i class="bi bi-gear"></i> Settings</li>
        </div>

        <form method="post" action="config/code.php" name="logoutform">
            <div class="div puple">
                <li onclick="_getForm('logout_modal_alert');"><i class="bi bi-power"></i> Log-Out</li>
            </div>
            <input type="hidden" name="action" value="logout" />
        </form>
        <div class="menu-title" style="height:100px;"> &nbsp;</div>
    </div>
</div>