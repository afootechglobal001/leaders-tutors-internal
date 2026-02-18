<?php include '../config/constants.php' ?>
<?php include 'config/welcome_profile.php' ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
	<?php include 'meta.php' ?>
	<title>User Account | <?php echo $thename; ?></title>
</head>
<script src="https://js.paystack.co/v1/inline.js"></script>

<body>
	<?php include 'header.php' ?>
	<?php include 'side-bar.php' ?>

	<div class="page-content">
		<div class="page-div-in">
			<?php $callclass->_UserWelcomeProfile($website_url); ?>
			<div id="page-content">
				<?php $page = 'dashboard'; ?>
				<?php require_once 'content/page-content.php' ?>
				<!-- <script>_getFormWithId('cbt_summary_details', 'TUT004')</script> -->
			</div>

		</div>
		<div class="bottom-menu-div animated fadeIn">
			<div class="div-in">
				<div class="menu-icon-div active-li" onClick="_getPage('dashboard','dashboard')" id="mobile2-dashboard">
					<i class="bi bi-speedometer2"></i>
					<span>Dashboard</span>
				</div>
				<div class="menu-icon-div" onClick="_getPage('tutorial_subjects','mobile2-subjects')" id="mobile2-subjects">
					<i class="bi-pencil-square"></i>
					<span>Tutorial</span>
				</div>
				<div class="menu-icon-div" onclick="_openMenu()">
					<i class="fa fa-navicon (alias)"></i>
					<span>Menu</span>
				</div>
				<div class="menu-icon-div" onClick="_getForm('app_settings')">
					<i class="bi bi-gear"></i>
					<span>Settings</span>
				</div>
				<div class="menu-icon-div" id="mobile2-myprofile" onclick="_getPage('user_profile','myprofile');">
					<i class="bi bi-person-circle"></i>
					<span>Me</span>
				</div>
			</div>
		</div>
	</div>


</body>

</html>