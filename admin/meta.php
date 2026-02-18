<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="ROBOTS" content="ALL">
<meta name="Engine" content="all">
<meta name="distribution" content="global">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="<?php echo $website_url?>/admin/all-images/images/icon.png" rel="shortcut icon" type="image-png"/>

<link href="<?php echo $website_url?>/admin/style/awesome-font/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
<link href="<?php echo $website_url?>/admin/style/icons-1.10.2/font/bootstrap-icons.css" type="text/css" rel="stylesheet" >
<link href="<?php echo $website_url?>/admin/style/animate.css" type="text/css" rel="stylesheet" media="all">
<link href="<?php echo $website_url?>/admin/style/aos.css" type="text/css" rel="stylesheet" />
<link href="<?php echo $website_url?>/admin/style/paramount.css?v=<?php echo $code_version?>" type="text/css" rel="stylesheet" />
<link href="<?php echo $website_url?>/admin/style/main-style.css?v=<?php echo $code_version?>" type="text/css" rel="stylesheet" />
<link href="<?php echo $website_url?>/admin/style/scrollbar.css" type="text/css" rel="stylesheet" />

<script src="<?php echo $website_url?>/admin/js/jquery-v3.6.1.min.js"></script>
<script src="<?php echo $website_url?>/admin/js/superplaceholder.js"></script>
<script src="<?php echo $website_url?>/admin/js/scripts.js?v=<?php echo $code_version?>"></script> 

<meta property="og:type" content="Website" />
<meta property="og:site_name" content="<?php echo $thename?>">
<meta property="og:url" content="<?php echo $website_url?>" />

<script>
   // Check if login_staff_session contains staff_id
   if (login_staff_session && login_staff_session.hasOwnProperty("staff_id")){
    window.parent.location.href = "a/";
} else {
    sessionStorage.setItem("login_staff_session", JSON.stringify(''));
}
</script>
