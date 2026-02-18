
<?php if($page=='accept-cookies'){?>

	<div class="cookies-settings-div animated fadeInUp">
    	<div class="div-in">
            <div class="text-div">
                <p>By clicking '<strong>Accept All Cookies</strong>', you agree to the storing of cookies on your device to enhance site navigation, analyze site usage, and assist in our marketing efforts. You can withdraw your consent at any time. <a href="<?php echo $website?>/cookies-policy" title="Cookies Policy">More information</a></p>
            </div>
            <div class="btn-div">
                <button class="btn" onclick="alert_close()">Accept All Cookies</button>
                <button class="btn hash-btn" onclick="_get_form('cookies-settings')">Cookies Settings</button>
            </div>
            <br clear="all" />
        </div>
    </div>
<?php }?>


<?php if($page=='cookies-settings'){?>
<div class="flyout-back-div animated fadeInLeft">
    <div class="flyout-title-div">
        <div class="div-in">
            <i class="bi-gear"></i> COOKIES SETTINGS
            <div class="close" title="Close" onclick="_get_form('accept-cookies')">X</div>
        </div>
    </div>
    
    <div class="flyout-content-div">
    	<div class="inner-div privacy-policy-flyout">
        
                    <h4>Privacy Preference Center</h5>
                    <p>
                    When you visit any website, it may store or retrieve information on your browser, mostly in the form of cookies. This information might be about you, your preferences or your device and is mostly used to make the site work as you expect it to. The information does not usually directly identify you, but it can give you a more personalized web experience. Because we respect your right to privacy, you can choose not to allow some types of cookies. Click on the different category headings to find out more and change our default settings. However, blocking some types of cookies may impact your experience of the site and the services we are able to offer. You can withdraw your consent with effect for the future by changing your selection for the individual categories at any time using the sliders below. Please confirm your selection afterwards with the "Confirm my choices" button. 
                    <br /> <a href="<?php echo $website_url?>/cookies-policy" title="Cookies Policy">More information</a>
                    </p>
                     
                     <h4>Manage consent preferences</h5>

                    <div class="expand">
                    	<div class="title"> <span onClick="_collapse('cookies1')"><span id="cookies1num">&nbsp;<i class="bi-plus"></i>&nbsp;</span></span> Strictly Necessary Cookies <span class="span">Always Active</span></div>
                        <div class="text" id="cookies1answer">These cookies are necessary for the website to function and cannot be switched off in our systems. They are usually only set in response to actions made by you which amount to a request for services, such as setting your privacy preferences, logging in or filling in forms. You can set your browser to block or alert you about these cookies, but some parts of the site will not then work. These cookies do not store any personally identifiable information.</div>
                    </div>
                    <div class="expand">
                    	<div class="title"> <span onClick="_collapse('cookies2')"><span id="cookies2num">&nbsp;<i class="bi-plus"></i>&nbsp;</span></span> Performance Cookies <em id="Performance" onclick="_switch_cookies('Performance');"><img src="<?php echo $website_url?>/all-images/images/switch-off.jpg" /></em></div>
                        <div class="text" id="cookies2answer">These cookies allow us to count visits and traffic sources so we can measure and improve the performance of our site. They help us to know which pages are the most and least popular and see how visitors move around the site. All information these cookies collect is aggregated and therefore anonymous. If you do not allow these cookies we will not know when you have visited our site, and will not be able to monitor its performance.</div>
                    </div>
                    <div class="expand">
                    	<div class="title"> <span onClick="_collapse('cookies3')"><span id="cookies3num">&nbsp;<i class="bi-plus"></i>&nbsp;</span></span> Functional Cookie <span class="span">Always Active</span></div>
                        <div class="text" id="cookies3answer">These cookies enable the website to provide enhanced functionality and personalisation. They may be set by us or by third party providers whose services we have added to our pages. If you do not allow these cookies then some or all of these services may not function properly.</div>
                    </div>
                    <div class="expand">
                    	<div class="title"> <span onClick="_collapse('cookies4')"><span id="cookies4num">&nbsp;<i class="bi-plus"></i>&nbsp;</span></span> Targeting Cookie <em id="Targeting" onclick="_switch_cookies('Targeting');"><img src="<?php echo $website_url?>/all-images/images/switch-off.jpg" /></em></div>
                        <div class="text" id="cookies4answer">These cookies may be set through our site by our advertising partners. They may be used by those companies to build a profile of your interests and show you relevant adverts on other sites. They do not store directly personal information, but are based on uniquely identifying your browser and internet device. If you do not allow these cookies, you will experience less targeted advertising.</div>
                    </div>
             <button class="btn" onclick="alert_close()">Confirm My Choices</button>
        
        </div>
    </div>
</div>
<?php }?>

