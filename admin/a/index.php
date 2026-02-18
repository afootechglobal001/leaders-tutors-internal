
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php include '../../config/constants.php';?>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include 'meta.php'?>
<title>Administrative Portal | <?php echo $thename;?></title>
</head>
<body>
   
<?php include 'header.php'?>
<?php  include 'alert.php'?>
<?php include 'side-bar.php'?>


<div class="content-div">
    <div class="page-title-div animated fadeInDown">
        <div class="div-in">
                <span id="page-title"><i class="bi-speedometer2"></i> Admin Dashboard Overview</span>
                <div class="user-name" >Hi, <span id="login_user_fullname"></span></div>
        </div>
    </div>

    <div id="page-content">
        <script>_get_page('dashboard')</script>	
    </div> 
</div>

<div class="side-div-right">
    <div class="alert-dashboard-title"><div><i class="bi-bell"></i> Recent Activities</div> <span>See All</span></div>
        <div class="alert-dashboard-div animated ZoomIn" id="fetch_dashboard_alert">
                <script> _fetch_dashboard_alert();</script>
        </div>
</div>



<script type="text/javascript" src="js/scrollBar.js"></script>
<script type="text/javascript">$(".sb-container").scrollBox();</script>




    
</body>
</html>
