<?php  include 'alert.php'?>
<header class="animated fadeInDown">
  <div class="inner-div">
    <div class="left-div">
      <div class="logo-div"><img src="<?php echo $website_url?>/agent/all-images/images/logo.png" alt="ABCC logo"/></div>
      <ul>
        <a href="<?php echo $website_url?>/agent" title="Parent Dashboard"><li>Agent Dashboard</li></a>
      </ul>
    </div>
    <button class="btn" title="Log-Out" onclick="_get_form('logout_confirm_form');">Log-Out</button>
    <button class="mobile-logout" title="Log-Out" onclick="_get_form('logout_confirm_form');"><i class="bi-box-arrow-in-right"></i></button>
  </div>
</header>