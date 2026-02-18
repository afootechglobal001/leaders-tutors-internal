<div class="side-back-div animated fadeIn" id="menu-list-div">
    <div class="div-in">
        <div class="logo-div"><img src="all-images/images/logo.png" alt="<?php echo $thename?> logo" /></div>
        <br clear="all"/>
        <br clear="all"/>
            <div class="side-link">
                <li class="active-li"  onClick="_getPage('dashboard','dashboard')" id="dashboard"><i class="bi-speedometer2"></i> Dashboard</li>
                <li onClick="_getPage('tutorial_subjects','subjects')" id="subjects"><i class="bi-pencil-square"></i> Tutorial</li>
                <!-- <li onClick="_getPage('terminal_exam','terminal_exam')" id="terminal_exam"><i class="bi-book"></i> Terminal Exam</li>
                <li onClick="_getPage('external_exam','external_exam')" id="external_exam"><i class="bi-book"></i> External Exam</li>
                <li onClick="_getPage('academic_report','academic_report')" id="academic_report"><i class="bi-graph-up-arrow"></i> Academic Report</li> -->
                <li onClick="_getPage('transactions','transactions')" id="transactions"><i class="bi-list-ol"></i> Transactions History</li>
                
                <li onClick="_getPage('subscription_history','subscription_history')" id="subscription_history"><i class="bi-list-ol"></i> Subsription History</li>
            </div>
    </div>

    <div class="div-in side-bottom">
        <div class="side-link">
            <li onClick="_getForm('app_settings')"><i class="bi bi-gear"></i> Settings</li>
            <form method="post" action="config/code" id="logoutform">
            <input type="hidden" name="action" value="logout"/>
            <li onclick="_logOut();"><i class="bi bi-power"></i> Log-Out</li>
            </form>
        </div>
    </div>
</div>





