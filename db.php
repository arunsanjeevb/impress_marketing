<?php

error_reporting(0);
@ini_set('display_errors', 0);
date_default_timezone_set("Asia/Kolkata");
$datetime = date("Y-m-d-H:i:s");
$ymd = date("Y-m-d");
$date = date("d/m/Y");
$time = date("H:i:s");
$newDate = date('d/m/Y h:i:s A');
$host = str_replace("www.", "", $_SERVER['HTTP_HOST']);

if ($host == "15.206.173.184") {
    $mysqli = $conn = new mysqli("127.0.0.1", "nithrauser", "Nithra@123", "impress_marketing");
    $mysql_conn = new mysqli("nithramobi.cxgl4yqtdoco.ap-south-1.rds.amazonaws.com", "root", "NithrA123321", "nithrausers");
//    $url1 = "http://13.233.231.197/upload/homam_services/";
}
else {
    $mysqli = $conn = new mysqli("nithramobi.cxgl4yqtdoco.ap-south-1.rds.amazonaws.com", "root", "NithrA123321", "impress_marketing");
//    $url1 = "https://nithra.mobi/homam_services/";
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else {
    // echo "connection Successful";
}

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");

mysqli_query($conn, "set character_set_server='utf8'");
mysqli_query($conn, "set character_set_client='utf8'");
mysqli_query($conn, "set character_set_results='utf8'");
mysqli_query($conn, "set collation_connection='utf8mb4_general_ci'");
$conn->set_charset('utf8mb4');
?>
