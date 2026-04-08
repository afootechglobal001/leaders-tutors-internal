<?php
	error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_WARNING);
	$websiteAutoUrl =(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$appName='Leaders Tutors External Admin'; 

	//$websiteUrl='https://getfoodstuffs.com'; /// For Live Server Url //
	$websiteUrl='http://localhost/leaders-network/leaders-tutors-internal/external-admin';
	$codeVersion= date('Ymdhis');
?>

<script>
	var websiteUrl = "<?php echo $websiteUrl;?>";
	var apiKey='2820239fbc6d13f580a389d8d3694483'; /// For API Key //
	var endPoint='https://leaderstutors.com/api/external/dev'; /// Server End Point url
	var documentdocumentStoragePath='https://leaderstutors.com/api/uploaded-files/dev'; /// For Document Storage Path //
	
	/// Admin Middleware Urls ///
	var adminLocalUrl=websiteUrl+'/config/admin/code'; /// For Admin Login Local Url //
	var adminPortalLocalUrl=websiteUrl+'/portal/config/code'; /// For Admin Portal Local Url //
	var adminPortalUrl=websiteUrl+'/'; /// For Portal Url //
	var adminUrl=websiteUrl+'/admin'; /// For Admin Url //
	var adminDashboardUrl=websiteUrl+'/portal'; /// For Admin Portal Local Url //

	var staffPixPath=documentdocumentStoragePath+'/staff-pix/'; /// For Staff Profile Pix Path //
	var examLogoPath=websiteUrl+'/uploaded_files/examLogo/'; /// For Exam Logo Path //
</script>