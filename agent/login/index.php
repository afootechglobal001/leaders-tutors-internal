<?php include '../../config/constants.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include 'meta.php'?>
    <title><?php echo $thename?>  | Agent Account Login</title>
    <meta name="keywords" content="new roject keywords" />
    <meta name="description" content="new roject decription"/>

    <meta property="og:title" content="<?php echo $thename?> - Title here" />
    <meta property="og:image" content="<?php echo $website_url?>/all-images/plugin-pix/banner.jpg"/>
    <meta property="og:description" content="new roject decription"/>

    <meta name="twitter:title" content=" <?php echo $thename?> - Title here"/>
    <meta name="twitter:card" content="<?php echo $thename?>"/>
    <meta name="twitter:image"  content="<?php echo $website_url?>/all-images/plugin-pix/banner.jpg"/>
    <meta name="twitter:description" content="new roject decription"/>
</head>

<body>
<?php  include 'alert.php'?>

<section class="login-session">
    <div class="graphics-div">
        <div class="content" data-aos="fade-left" data-aos-duration="800">
            <div class="logo-div"><img src="<?php echo $website_url?>/agent/login/all-images/images/logo.png" alt="ABCC logo"/></div>
            <div class="graphics" data-aos="fade-left" data-aos-duration="1200"><img src="<?php echo $website_url?>/agent/login/all-images/body-pix/check-result.webp" alt="ABCC Result checker"/></div>
            <h2>Your Client's Education<br> <span>is at Your Fingertips!</span></h2>
        </div>
    </div>

    <div class="login-div">
        <div class="form-back-div">
            <div class="form-div" data-aos="fade-right" data-aos-duration="1600">
                <div class="top-div">
                    <div class="logo-div"><img src="<?php echo $website_url?>/all-images/images/login-icon.png" alt="Leaders Tutor logo"/></div>
                    <h1>👋 Hi Agent<br><span>It’s really nice to see you</span></h1>                   
                </div>
                
                <div class="inner-form">
                    <div class="alert alert-success">
                        Kindly, provide your <span>Email Address</span> to Login
                    </div>
                    <div class="text_field_back_container">  
                        <div class="text_field_container">
                            <input class="text_field" type="email" id="email" placeholder=""/>
                            <div class="placeholder">Email:</div>
                        </div> 
                    </div>                  
                    <button class="btn" title="Proceed" id="proceed_btn" onclick="_confirmLoginEmail();">Proceed <i class="bi-arrow-right"></i></button>
                </div>
                <p>Don't have an account? <a href="<?php echo $website_url?>/agent/sign-up"><span>Sign-Up</span></p></a>
            </div>
        </div>
    </div>
</section>

<?php include 'bottom-scripts.php'?>
</body>
</html>


