<div class="success-div animated fadeInRight" id="success-div">
    <div><i class="bi-check-all"></i></div> 
    PASSWORD RESET SUCCESSFUL!<br /> 
    <span>Check your email to confirm.</span>
</div>


<div class="success-div animated fadeInRight" id="not-success-div">
    <div><i class="bi-x-circle"></i></div> 
    INVALID LOGIN PARAMETERS!<br /> 
    <span>Please check the login detail.</span>
</div>


<div class="success-div animated fadeInRight" id="warning-div">
    <div><i class="bi-exclamation-circle"></i></div> 
    USER ERROR!<br /> 
    <span>Fill The Fields To Continue</span>
</div>

<div id="get-more-div"></div>
<div id="get-more-div-secondary"></div>












<div class="sidenavdiv">
    <div class="sidenavdiv-in" onclick="_close_side_nav()"></div>
</div>


<div class="live-chat-back-div"> 

    <a href="tel:+2348127000262" title="Call Customer Care">
        <div class="chat-div">
            <div class="icon-div" style="background:#008040;"><i class="bi-telephone-outbound"></i></div>
            <div class="text">+234-812-700-0262</div>
          <br clear="all" />
        </div>
    </a>
    <a href="https://api.whatsapp.com/send?text=Hello Leaders Tutors &phone=+2348127000262" target="_blank" title="Whatsapp">
        <div class="chat-div">
            <div class="icon-div" style="background:#25D366;"><i class="bi-whatsapp"></i></div>
            <div class="text">+234-812-700-0262</div>
          <br clear="all" />
        </div>
    </a>

    <a href="https://web.facebook.com/" target="_blank" title="Facebook">
        <div class="chat-div">
            <div class="icon-div" style="background:#2980b9;"><i class="bi-facebook"></i></div>
            <div class="text">Facebook Page </div>
          <br clear="all" />
        </div>
    </a>

    <a href="https://twitter.com/" target="_blank" title="Twitter">
        <div class="chat-div">
            <div class="icon-div" style="background:#3498db;"><i class="bi-twitter"></i></div>
            <div class="text">Twitter Page</div>
          <br clear="all" />
        </div>
    </a>

    <a href="https://www.instagram.com/" target="_blank" title="Instagram">
        <div class="chat-div">
            <div class="icon-div" style="background-image: linear-gradient(to right,#03F, #F0F);"><i class="bi-instagram"></i></div>
            <div class="text">Instagram Page</div>
          <br clear="all" />
        </div>
    </a>
  
</div>


<div class="index-menu-back-div"> 
    <div class="top-div">
        <div class="logo-div">
            <a href="<?php echo $website_url?>"><img src="<?php echo $website_url?>/all-images/images/logo.png" alt="<?php echo $thename?> Logo"  class="animated zoomIn"/></a>   
        </div>
    </div>

    <div class="div-in">
        <div class="div">
            <a href="<?php echo $website_url;?>" title="Home Page">
            <li <?php if ($page=='index.php') {?> id="active-li"<?php }?>><i class="bi-house"></i> Home Page</li></a>
        </div>

        <div class="div">
            <a href="<?php echo $website_url ?>/how-it-works" title="How it works">
            <li <?php if ($page=='how-it-works.php') {?> id="active-li"<?php }?>><i class="bi-building-check"></i> How it Works</li></a>
        </div>

        <div class="div">
            <li onclick="_open_li('tutorial')"><i class="bi-activity"></i> Tutorial <i class="bi-plus" id="side-expand"></i></li>
            <div class="sub-li" id="tutorial-sub-li">
                
            </div>
        </div>

        <div class="div">
            <a href="<?php echo $website_url;?>/our-agents" title="Our Agents">
            <li <?php if ($page=='our-agents.php') {?> id="active-li"<?php }?>><i class="bi-people"></i> Our Agents</li></a>
        </div>

        <div class="div">
            <a href="<?php echo $website_url;?>/our-partners" title="Our Partners">
            <li <?php if ($page=='our-partners.php') {?> id="active-li"<?php }?>><i class="bi-person-check"></i> Our Partners</li></a>
        </div>

        <div class="div">
            <a href="<?php echo $website_url;?>/faq" title="Frequently Asked Questions">
            <li <?php if ($page=='faq.php') {?> id="active-li"<?php }?>><i class="bi-patch-question"></i> FAQ</li></a>
        </div>

        <div class="div">
            <a href="<?php echo $website_url;?>/contact" title="Contact Us">
            <li <?php if ($page=='contact.php') {?> id="active-li"<?php }?>><i class="bi-telephone-inbound"></i> Contact Us</li></a>
        </div>
        
        <div class="menu-title" style="height:100px;"> &nbsp;</div>
    </div>
    
</div> 