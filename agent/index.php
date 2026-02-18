<?php include '../config/constants.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include 'meta.php'?>
    <title><?php echo $thename?> - Agent Dashboard</title>
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
<?php  include 'header.php'?>

    <div class="body-content-div" data-aos="fade-down" data-aos-duration="1200">
        <div class="mini-profile-div">
            <div class="profile-content">
                <span><i class="bi-speedometer2"></i> Agent Dashboard</span>
                <div class="main-profile">
                    <div class="inner-profile">
                        <div class="img-div"><img src="all-images/body-pix/avatar.jpg" alt="Agent Profile"/></div> 
                        <div class="pro-text-div">
                            <h2>👋 Hi Agent </h2>
                            <div class="info"> 
                                <div>                            
                                    <p>Email: <span id="login_email">seunemmanuel107@gmail.com</span></p>                               
                                    <p>Last Login Date: <span id="last_login_date">seunemmanuel107@gmail.com</span></p> 
                                </div>
                                <button class="status-btn ACTIVE">ACTIVE</button>                             
                            </div>                                              
                        </div>
                    </div>    
                </div>
            </div>
        </div>

        <div class="agent-content-div">
            <div class="dashboard-content">
                <div class="btn-div">
                    <div class="alert alert-success agent-alert"> <span><i class="bi-people-fill"></i> COMPANY LIST </span></div>
                </div>

                <div class="list" id="fetch_all_company">
                    <!-- <div class="student-profile">
                        <div class="details">
                            <div class="pix"><img src="<?php //echo $website_url?>/agent/all-images/body-pix/afootech.jpg" alt="Profile Picture"/></div>
                            <div class="text">
                                <h3>AfooTECH Global IT Solution</h3>
                                <div class="info">
                                    <div>
                                        <p>Email: <span>afootechglobal@gmail.com</span></p>
                                        <p>Phone: <span>08131252996</span></p>
                                    </div>                               
                                    <button class="status-btn active">ACTIVE</button>
                                </div>
                            </div>
                        </div>
                        <button class="btn" onClick="_get_form_with_id('agent_profile')">VIEW DETAILS</button>
                    </div>  -->
                </div> 

            </div>
        </div>
        <script>_fetchDahboardInfo();</script>
    </div>
 
<script src="<?php echo $website_url?>/js/aos.js"></script>
<script>
AOS.init({
  easing: 'ease-in-out-sine'
});
</script>
</body>
</html>


