<?php include '../../config/constants.php'; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <?php include 'meta.php' ?>
    <title><?php echo $thename ?> | User Account Sign Up</title>
    <meta name="keywords" content="User Account Sign-Up - <?php echo $thename ?>" />
    <meta name="description" content="User Account Sign-Up <?php echo $thename ?>" />
</head>
<script src="https://js.paystack.co/v1/inline.js"></script>
<body>
<script> 
    _getUserReferralLink();
</script>
<?php require_once 'alert.php' ?>

    <div class="login-right-div">
        <div class="log-in-div animated fadeInRight">
            <div class="logo-div" onClick="window.location.reload();"><img src="<?php echo $website_url ?>/account/login/all-images/images/logo.png" alt="<?php echo $thename ?> - Logo"></div>
            <br clear="all" />
            <div class="form-header">
                <h1 id="page-title">Sign-Up</h1>
            </div>

            <div id="page-content">
                <?php $page = 'signup'; ?>
                <?php include 'content/page-content.php'; ?>
            </div>

            <br clear="all" />
            <div class="notification-div login-footer-div">
                Have you already have an account? <br> <a href="<?php echo $website_url?>/account/login/"><span class="footer-in" id="flogin">Log-In</span></a>
            </div>
        </div>

    </div>

    <div class="login-left-div">
        <div class="side-in-div  animated zoomIn">
            <div class="side-text">
                <div class="logo-div" onClick="window.location.reload();"><img src="<?php echo $website_url ?>/account/login/all-images/images/logo.png" alt="<?php echo $thename ?> - Logo"></div>
                <h1>Welcome To Leaders Tutors</h1>
                <p>Where education meets innovation! Our cutting-edge application redefines the learning experience with a dynamic Education Video Learning system.</p>
            </div>

            <div class="social-div">
                <div class="icon-div"><i class="bi-facebook"></i></div>
                <div class="icon-div"><i class="bi-instagram"></i></div>
                <div class="icon-div"><i class="bi-twitter"></i></div>
                <div class="icon-div"><i class="bi bi-linkedin"></i></div>
            </div>

            <div class="acute-angle"></div>
        </div>
    </div>


</body>

</html>