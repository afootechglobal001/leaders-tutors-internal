<?php
//=========================================================================================================================
$thename='Leaders Tutors';
$appDescription="Leaders Tutors is an online platform that connects students with qualified tutors for personalized learning experiences. We offer a wide range of subjects and flexible scheduling to help students achieve their academic goals.";

$frontEndApiKey = isset($_SERVER['HTTP_APIKEY']) ? $_SERVER['HTTP_APIKEY'] : null;
$backEndApiKey='f3f68f9fb56337fbe3842c8fb9ee54e9';

$ipAddress=$_SERVER['REMOTE_ADDR']; //ip used
$systemName=gethostname();//computer used

$websiteUrl='https://leaderstutors.com';
$documentStoragePath=$websiteUrl.'/api/uploaded-files/dev';
$referralLink=$websiteUrl.'/account/sign-up/?ref=';

$staffProfilePixPath = '../../../uploaded-files/dev/staff-pix/';
$departmentPixPath= '../../../uploaded-files/dev/department-pix/';
$subjectPixPath= '../../../uploaded-files/dev/subject-pix/';
$classPixPath= '../../../uploaded-files/dev/class-pix/';
$tutorialMaterialPath= '../../../uploaded-files/dev/tutorial-material/';
$tutorialPixPath= '../../../uploaded-files/dev/tutorial-pix/';
$tutorialVideoPath= '../../../uploaded-files/dev/tutorial-video/';
$userProfilePixPath = '../../../uploaded-files/dev/user-pix/';
$cbtQuestionPixPath= '../../../uploaded-files/dev/cbt-question-pix/';
$cbtOptionPixPath= '../../../uploaded-files/dev/cbt-option-pix/';
$cbtQuestionTemplatePath='../../../uploaded-files/dev/cbt-question-template/';
$companyLogoPath='../../../uploaded-files/dev/company-logo/';




$checkBasicSecurity=true;
///// check for API security
if ($frontEndApiKey!=$backEndApiKey){/// start if 1
	$response['response']=96; 
	$response['success']=false;
	$response['message']="SECURITY ACCESS DENIED! You are not allowed to execute this command due to security bridge.";
    $checkBasicSecurity=false;
}

// Read the raw JSON input
$json = file_get_contents('php://input');
// Decode the JSON into an associative array
$data = json_decode($json, true);