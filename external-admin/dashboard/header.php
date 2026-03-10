<?php include 'alert.php' ?>
<header class="fadeInDown animated">
    <div class="header-div-in">
        <div class="header-nav-div">
            <div class="left-nav">
                <ul>
                    <li class="active-li" title="Dashboard" onclick="_getActivePage({page:'dashboard', divid:'topDashboard'});" id="topDashboard"><i class="bi-speedometer2"></i> Dashboard</li>
                </ul>
            </div>

            <div class="right-nav">
                <div class="right-icon-div left-icon-div">
                    <div class="icon-div" onclick="_getActivePage({page:'settings', divid:'settings'});" title="System Settings">
                        <i class="bi-gear"></i>
                    </div>

                    <div class="icon-div bell_notification" onclick="_getActivePage({page:'systemAlert', divid:'systemAlert'});" title="System Alert">
                        <i class="bi-bell"></i>
                        <div>20</div>
                    </div>
                </div>

                <div class="right-icon-div no-border" title="Click To View Profile" onclick="_toggleProfileDiv()">
                    <div class="profile-div">
                        <div class="info-div">
                            <div class="name"><strong id="loginHeaderName">Paul Emmanuel</strong></div>
                            <div class="role" id="loginRoleName">Super Admin</div>
                        </div>

                        <div class="img-div" id="profilePix">
                            <img id="" src="<?php echo $websiteUrl; ?>/images/avatar.jpg" alt="Profile Image">
                        </div>
                    </div>
                </div>

                <div class="toggle">
                    <div class="toggle-in">
                        <div class="toggle-title">
                            <div class="dp" id="loginProfileName">
                                <script>
                                    $("#loginProfileName").html(getFirstLettersOfEachWord('PE'));
                                </script>
                            </div>
                            <div class="text">
                                <h2 id="loginUserFullname">
                                    Paul Emmanuel
                                </h2>
                                <p id="loginUserEmail">
                                    seunemmanuel107@gmail.com
                                </p>
                                <p id="loginUserPhone">
                                    07050903886
                                </p>
                            </div>
                        </div>

                        <ul>
                            <li title="Dashboard" onclick="_getActivePage({page:'dashboard', divid:'dashboard'});">
                                <i class="bi bi-speedometer2"></i> Dashboard
                            </li>
                            <li title="Exams" onclick="_getActivePage({page:'exams', divid:'exams'});">
                                <i class="bi bi-journal-check"></i> Exams
                            </li>
                            <li title="Tutorials" onclick="_getActivePage({page:'tutorial', divid:'tutorial'});">
                                <i class="bi bi-play-circle"></i> Tutorials
                            </li>
                            <li title="Students"
                                onclick="_getActivePage({page:'students', divid:'students'});">
                                <i class="bi bi-people"></i> Students
                            </li>
                            <li title="Subscriptions"
                                onclick="">
                                <i class="bi bi-credit-card"></i> Subscriptions
                            </li>
                            <li class="logOut" title="Log-Out" onclick="_confirmLogOut();">
                                <i class="bi bi-power"></i> Log-Out
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>