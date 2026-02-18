
<div class="header-div fadeInDown animated">
	<div class="header-div-in">
        <div class="menu-div" title="Open Menu" onclick="_open_menu()" id="menu-div"><i class="fa fa-navicon (alias)"></i></div>
    	<div class="logo-div"><img src="all-images/images/logo.png" alt="<?php echo $thename?> logo" /></div>
       
        <div class="header-profile-pix-div" title="User Account" onclick="_toggle_profile_pix_div()">
            <div class="div-in">
            <div class="info">
                    <div class="name" id="header_profile_name"><strong>xxxx</strong></div>
                    <div class="role" id="header_role_name">xxxx</div>
                </div>
                <div class="img-div" id="header_pix"></div>
            </div>   

            <div class="toggle-profile-div">
                <div class="toggle-profile-pix-div" id="toggle_header_pix"></div>
                <div class="toggle-profile-name"><span id="profile_name">xxxx</span></div>
                    <div class="toggle-profile-others">User ID: <span id="user_id">xxxx</span> <br /><span id="user_mobile">xxxx</span> </div>
                    <button class="logout-btn" type="button" onclick="_get_form('logout_confirm_form');"><i class="fa fa-sign-out"></i> Log-Out</button>
                   
                    <button class="logout-btn" type="button" onclick="_get_form_with_id('my_profile','<?php echo $login_staff_id?>');"><i class="fa fa-user"></i> Profile</button>
                    <div class="hidden" id="_myprofile"><i class="fa fa-user-circle"></i> User Profile</div>
                <br clear="all" />
                </div>
            </div>
            
           
            <div class="notification bell_notification" onClick="_get_page('system_alert', 'system_alert')" title="System Alert">
                <i class="bi-bell"></i>
                <script>get_notification_number()</script>
            </div>

               
            <div class="notification" onClick="_get_page()" title="System Search">
                <i class="bi-search"></i>
            </div>

            <div class="notification" onClick="_get_form('app_settings')" title="System Settings">
                <i class="bi-gear"></i>
            </div>

            <div class="notification" onClick="_get_page('faqs')" title="Frequently Asked Questions">
                <i class="bi-question-square"></i>
            </div> 

            <!------>
            <span id="_system_alert" style="display:none;"><i class="bi-bell"></i> System Alert</span>
            <!------>  
                       
       </div>

</div>