<?php include 'alert.php' ?>

<div class="header-div">
    <div class="header-div-in">
        <div class="menu-div" title="Open Menu" onclick="_openMenu()" id="menu-div"><i class="fa fa-navicon (alias)"></i></div>

        <div class="logo-div" onClick="_getPage('dashboard','dashboard')"><img src="all-images/images/logo.png" alt="<?php echo $thename ?> logo" /></div>

        <h1 class="title-text1">USER PORTAL</h1>

        <div class="nav-div" data-aos="fade-right" data-aos-duration="1500">
            <li class="active-li" onClick="_getPage('dashboard', 'dashboard','');" id="_dashboard"><i class="bi-speedometer2"></i> Dashboard</li>
            <li onClick="_getPage('user_profile','myprofile')" id="myprofile"><i class="bi bi-person-square"></i> My Profile</li>
        </div>

        <div class="header-profile-pix-div" title="User Account" onclick="_toggleProfilePixDiv()">

            <div class="img-div" id="option_pix"><img src="<?php echo $website_url ?>/uploaded_files/user_pix/friends.png" id="passportimg1" alt="Profile image"></div>


            <div class="toggle-profile-div">
                <div class="toggle-profile-pix-div" id="header_pix">
                    <img src="<?php echo $website_url ?>/uploaded_files/user_pix/friends.png" id="passportimg2" />
                </div>
                <div class="toggle-profile-name"><span id="profile_name">Xxxx</span></div>
                <div class="toggle-profile-others">User ID: <span id="user_id">STF0000</span> <br /><span id="user_mobile">09021947874</span> </div>

                <button class="logout-btn" onclick="_getForm('logout_modal_alert');" title="Log-Out"><i class="fa fa-sign-out"></i> Log-Out</button>

                <button class="logout-btn" type="button" title="My Profile" onclick="_getPage('user_profile','myprofile');"><i class="bi-person"></i> Profile</button>

                <br clear="all" />
            </div>
        </div>




        <div class="notification" onClick="_getPage('system_alert', 'system_alert')" title="System Alert">
            <i class="bi-bell"></i>
        </div>


        <!------>
        <span id="_system_alert" style="display:none;"><i class="bi-bell"></i> System Alert</span>
        <!------>

    </div>
</div>