<?php include '../../config/constants.php';?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php include 'meta.php'?>
<title><?php echo $thename?>  | User Account Login</title>
<meta name="keywords" content="User Account Login - <?php echo $thename?>" />
<meta name="description" content="User Account Login <?php echo $thename?>"/>
</head>

<body>
<?php require_once 'alert.php'?>

    <section class="login-section">
      
      <div class="login-side-div"></div>

            <div class="div-in">
                <div class="side-in-div  animated zoomIn">
                    <div class="side-text">
                        <div class="logo-div" onClick="window.location.reload();"><img src="<?php echo $website_url?>/account/login/all-images/images/logo.png"  alt="<?php echo $thename?> - Logo"></div>
                            <h1>Welcome To Leaders Tutors</h1>
                            <p>Access high-quality education from anywhere, at any time. Explore a wide range of subjects and courses delivered through virtual platforms on SSCE, GCE, NABTEB.</p>
                        </div>
                        
                        <div class="social-div">
                            <div class="icon-div"><i class="bi-facebook"></i></div>
                            <div class="icon-div"><i class="bi-instagram"></i></div>
                            <div class="icon-div"><i class="bi-twitter"></i></div>
                            <div class="icon-div"><i class="bi bi-linkedin"></i></div>
                        </div>

                        <div class="acute-angle"></div>
                    </div>

                    <div class="log-in-div">
                        <div class="form-div animated fadeInRight">
                            <div class="logo-div" onClick="window.location.reload();"><img src="<?php echo $website_url?>/account/login/all-images/images/logo.png" alt="<?php echo $thename?> - Logo"></div>
                            <br clear="all"/>
                                <div class="form-header">
                                    <h1 id="page-title">Log-In</h1>
                                    <br clear="all" />
                                    <hr>
                                </div>

                                <div  id="more-info">
                                <?php $page='login';?>
                                <?php include 'content/page-content.php';?> 
                                </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</body>
</html>


