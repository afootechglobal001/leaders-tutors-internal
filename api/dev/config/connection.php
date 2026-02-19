<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_WARNING);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Authorization, Origin, X-Requested-With, Content-Type, Accept, apiKey");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header('Content-Type: application/json; charset=UTF-8');

////////////for live connect  
$_HOST_NAME = "152.53.89.36";  
$_DB_USERNAME ="leaderst_admin";
$_DB_PASSWORD ="Headoffcie@2016";

$conn = mysqli_connect($_HOST_NAME, $_DB_USERNAME, $_DB_PASSWORD)or die("Unable to connect to MySQL1");
mysqli_select_db($conn,"leaderst_dev_db");
mysqli_set_charset($conn, "utf8mb4");
/////////////////////////////////////////////////////////////////
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);



require_once 'crud.php';
require_once 'errorHandlers.php';
require_once 'helper.php';
require_once 'functions.php';
require_once 'constants.php';