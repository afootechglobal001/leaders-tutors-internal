
<?php include 'alert.php'?>

<header class="fadeInDown animated"> 
    <div class="header-top-div">
        <div class="div-in">
            <div class="contact"><i class="bi-envelope"></i> Info@leaderstutors.com</div>
            <div class="contact phone"><i class="bi-telephone"></i> +(234) 708 701 3213</div>

            <ul>
                <a href="#" target="_blank" title="linkedin">
                <li class="li"><i class="bi-linkedin"></i></li></a>
                <a href="#" target="_blank" title="instagram">
                <li class="li"><i class="bi-instagram"></i></li></a>
                <a href="#" target="_blank" title="facebook">
                <li class="li"><i class="bi-facebook"></i></li></a>
                <a href="#" target="_blank" title="Whatsapp">
                <li><i class="bi-whatsapp"></i></li></a>
                <a href="#" title="Call Customer Care">
                <li><i class="bi-telephone"></i></li></a>
            </ul>
            <a href="<?php echo $website_url ?>/account/login" title="My Account">
            <button class="btn" title="My Account"><i class="bi-person"></i> My Account</button></a>
        </div>   
    </div>  
    
    <div class="header-div-in">
        <div class="logo-div">
            <a href="<?php echo $website_url ?>"><img src="<?php echo $website_url?>/all-images/images/logo.png" alt="<?php echo $thename?> Logo"  class="animated zoomIn"/></a>   
        </div>
        <nav>
            <ul>                          
                <a href="<?php echo $website_url ?>" title="Home Page"><li <?php if (($website_auto_url=="$website_url/index")||($website_auto_url=="$website_url/")||($website_auto_url=="$website_url")) {?> class="active" <?php }?>> Home</li></a>        
                <a href="<?php echo $website_url ?>/how-it-works" title="How It Works"><li <?php if (($website_auto_url=="$website_url/how-it-works")) {?> class="active" <?php }?>>How It Works</li></a>        
                <a href="<?php echo $website_url ?>" title="Our Tutorial"><li id="expand"  <?php if (strstr($website_auto_url, "$website_url/exams/")) {?> class="active" <?php }?>><i class="bi-plus"></i>Tutorial          
                    <div class="sub-nav-div animated fadeIn">
                        <a href="<?php echo $website_url?>" title="Exams Categories">
                        <div class="li" id="li"><strong>Available Tutorials</strong></div></a>

                    </div>
                </li></a> 

                <li class="Our-agents <?php if (strstr($website_auto_url, "$website_url/our-agents")) {?> active <?php }?>">
                    <a href="<?php echo $website_url?>/our-agents" title="Our Agents">Our Agents</a>
                </li>

                <li class="our-partners <?php if (strstr($website_auto_url, "$website_url/our-partners")) {?> active <?php }?>">
                    <a href="<?php echo $website_url?>/our-partners" title="Our Partners">Our Partners</a>
                </li>

                <li class="faq <?php if (strstr($website_auto_url, "$website_url/faq")) {?> active <?php }?>">
                    <a href="<?php echo $website_url?>/faq" title="Frequently Ask Question">FAQ</a>
                </li>

                <li class="contact-us <?php if (strstr($website_auto_url, "$website_url/contact")) {?> active <?php }?>">
                    <a href="<?php echo $website_url?>/contact" title="Contact Us">Contact Us</a>
                </li>

                <li id="expand-div" class="read-more <?php if (strstr($website_auto_url, "$website_url/more")) {?> active <?php }?>">
                    <i class="bi-plus"></i> Read More 
                    <div class="sub-div animated fadeIn">
                        <ul class="ul-class">
                            <a href="#" title="Contact Us">
                            <li class="li">Contact Us</li></a>
                            <a href="#" title="FAQ">
                            <li class="li">FAQ</li></a>
                            <a href="#" title="Our Partners">
                            <li class="li">Our Partners</li></a>
                        </ul>
                    </div>
                </li>
            </ul>
        
            <a href="<?php echo $website_url?>/account/login" title="My Account">
            <button class="sign-up" title="My Account"><i class="bi-person"></i> My Account</button></a>
            <button class="mobile-btn" onclick="_open_menu()"><i class="bi-list"></i></button>
        </nav>
    </div> 
</header>