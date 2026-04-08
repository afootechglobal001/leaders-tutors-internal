<?php
/////// developed by Mike Afolabi on 19-02-2025//////////////////////
$appName = "Leaders Tutors External";
$appDescription = "API for Leaders Tutors External Application";

////////////////////////////////////////////////////////////////////////
$frontEndApiKey = isset($_SERVER['HTTP_APIKEY']) ? $_SERVER['HTTP_APIKEY'] : null;
////////////////////////////////////////////////////////////////////////
/// all constance
// $websiteUrl='http://localhost/leaders-network/leaders-tutors-internal';
$websiteUrl = 'https://leaderstutors.com';
$backEndApiKey = '2820239fbc6d13f580a389d8d3694483'; //leadersTutors@2025

// Read the raw JSON input
$json = file_get_contents('php://input');
// Decode the JSON into an associative array
$data = json_decode($json, true);

$checkBasicSecurity = true;
///// check for API security
if ($frontEndApiKey != $backEndApiKey) {/// start if 1
    $checkBasicSecurity = false;
}