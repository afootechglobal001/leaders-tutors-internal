<?php include '../../config/constants.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include 'meta.php'?>
    <title><?php echo $thename?>  | Agent Account Sign Up</title>
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
                    <div class="logo-div"><img src="<?php echo $website_url?>/all-images/images/login-icon.png" alt="ABCC logo"/></div>
                    <h1>👋 Sign-Up<br><span></h1>               
                </div>

                <div id="page-content">
                    <?php $page = 'signUp'; ?>
                    <?php include 'content/page-content.php'; ?>
                </div>

                <p>Have you already have an account? <a href="<?php echo $website_url?>/agent/login"><span>Log-In</span></p></a>
            </div>
        </div>
    </div>
</section>


<?php include 'bottom-scripts.php'?>
</body>
</html>


