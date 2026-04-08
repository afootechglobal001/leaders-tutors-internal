<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_WARNING);

// Allow all origins (for testing; restrict in production)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Authorization, Origin, X-Requested-With, Content-Type, Accept, apiKey, userOsBrowser, userIpAddress, userDeviceId");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header('Content-Type: application/json; charset=UTF-8');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit(); // stop further execution
}

// --- rest of your code ---
$appName = "Leaders Tutors External";
$appVersion = "1.0.0";
$_HOST_NAME = "152.53.89.36";
$_DB_USERNAME = "leaderst_admin";
$_DB_PASSWORD = "Headoffcie@2016";

///// for admin API database can be optimized for transactional operations.
$connAdmin = mysqli_connect($_HOST_NAME, $_DB_USERNAME, $_DB_PASSWORD) or die("Unable to connect to MySQL");
mysqli_select_db($connAdmin, "leaderst_production_db") or die("Could not select database");
mysqli_set_charset($connAdmin, "utf8mb4");

///// for external API database can be optimized for transactional operations.
$conn = mysqli_connect($_HOST_NAME, $_DB_USERNAME, $_DB_PASSWORD) or die("Unable to connect to MySQL");
mysqli_select_db($conn, "leaderst_external_dev") or die("Could not select database");
mysqli_set_charset($conn, "utf8mb4");

/////////////////////////////////////////////////////////////////
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

require_once 'crud.php';
require_once 'errorHandlers.php';
require_once 'helper.php';
require_once 'functions.php';
require_once 'constants.php';