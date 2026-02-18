<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="ROBOTS" content="ALL">
<meta name="Engine" content="all">
<meta name="distribution" content="global">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="<?php echo $website_url ?>/account/all-images/images/icon.png" rel="shortcut icon" type="image-png" />

<link href="<?php echo $website_url ?>/account/style/awesome-font/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
<link href="<?php echo $website_url ?>/account/style/icons-1.10.2/font/bootstrap-icons.css" type="text/css" rel="stylesheet">
<link href="<?php echo $website_url ?>/account/style/animate.css" type="text/css" rel="stylesheet" media="all">
<link href="<?php echo $website_url ?>/account/style/aos.css" type="text/css" rel="stylesheet" />


<link href="<?php echo $website_url ?>/account/style/paramount.css?v=<?php echo $code_version?>" type="text/css" rel="stylesheet" />
<link href="<?php echo $website_url ?>/account/style/main-style.css?v=<?php echo $code_version?>" type="text/css" rel="stylesheet" />
<link href="<?php echo $website_url ?>/account/style/scrollbar.css" type="text/css" rel="stylesheet" />
<link href="<?php echo $website_url ?>/account/style/nav-style.css?v=<?php echo $code_version?>" type="text/css" rel="stylesheet" />
<link href="<?php echo $website_url ?>/account/style/network-alert.css?v=<?php echo $code_version?>" type="text/css" rel="stylesheet" />

<script src="<?php echo $website_url ?>/account/js/jquery-v3.6.1.min.js"></script>

<script>
  let loginUserInfoSession = JSON.parse(sessionStorage.getItem("loginUserInfoSession"));
  if (loginUserInfoSession) {
    var login_user_id = loginUserInfoSession.user[0].user_id;
    var login_access_key = loginUserInfoSession.user[0].access_key; 
  } else {
    sessionStorage.removeItem("loginUserInfoSession");
    window.parent.location.href = website_url + "/account/login/";
  }
</script>

<script src="<?php echo $website_url ?>/account/js/scripts.js?v=<?php echo $code_version?>"></script>
<script src="<?php echo $website_url ?>/account/js/bottom-scripts.js?v=<?php echo $code_version?>"></script>
<script src="<?php echo $website_url ?>/account/js/aos.js"></script>

<script src="<?php echo $website_url ?>/account/js/canvasjs.min.js"></script>
<script src="<?php echo $website_url ?>/account/js/superplaceholder.js"></script>

<meta property="og:type" content="Website" />