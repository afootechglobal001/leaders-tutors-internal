<div class="side-nav-div animated fadeInLeft">
    <div class="div-in">
        <div class="logo-div">
            <img src="<?php echo $websiteUrl ?>/images/logo.png" alt="<?php echo $appName ?> logo" />
        </div>

        <div class="nav-wrapper">
            <div class="nav-back-div">
                <div class="nav-div active-li" title="Dashboard" id="dashboard"
                    onclick="_getActivePage({page:'dashboard', divid:'dashboard'});">
                    <i class="bi-speedometer2"></i>
                    <span>Dashboard</span>
                </div>

                <div class="nav-div" title="Exams" id="examPage"
                    onclick="_getActivePage({page:'examPage', divid:'examPage'});">
                    <i class="bi-journal-check"></i>
                    <span>Exams</span>
                </div>

                <div class="nav-div" title="Tutorials" id="dashboard"
                    onclick="_getForm({page: 'proceedTutorialForm', url: adminPortalLocalUrl});">
                    <i class="bi-play-circle"></i>
                    <span>Tutorials</span>
                </div>

                <div class="nav-div" title="Students" id="studentPage"
                    onclick="_getActivePage({page:'studentPage', divid:'studentPage'});">
                    <i class="bi-people"></i>
                    <span>Students</span>
                </div>

                <div class="nav-div" title="Subscriptions" id="subscriptionPage"
                    onclick="_getActivePage({page:'subscriptionPage', divid:'subscriptionPage'});">
                    <i class="bi-credit-card"></i>
                    <span>Subscriptions</span>
                </div>
            </div>

            <div class="nav-back-div">
                <div class="nav-div" title="Settings" id="settings"
                    onclick="">
                    <i class="bi-gear"></i>
                    <span>Settings</span>
                </div>

                <div class="nav-div" title="Log-Out"
                    onclick="_confirmLogOut();">
                    <i class="bi-box-arrow-right"></i>
                    <span>Log-Out</span>
                </div>
            </div>
        </div>
    </div>
</div>