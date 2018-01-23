<?php 
ob_start(); // start buffering
// set a new session
session_start();
//session_regenerate_id();
$sessionid = session_id();

define("DB_HOST", "127.0.0.1");
define("DB_USER", "socialdata");
define("DB_PASSWORD", "Letmein0810");
define("DB_DATABASE", "socialdata");

#echo DB_HOST . ' ' . DB_USER . ' ' . DB_PASSWORD . ' ' . DB_DATABASE;



$timezone = date_default_timezone_set("America/New_York");

$con = mysqli_connect(DB_HOST , DB_USER, DB_PASSWORD, DB_DATABASE );
if( mysqli_connect_errno())
{
	echo "Failed to connect " . mysqli_connect_errno();
}
?>