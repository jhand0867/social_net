<?php 
ob_start(); // start buffering
// set a new session
session_start();
//session_regenerate_id();
$sessionid = session_id();


$timezone = date_default_timezone_set("America/New_York");

$con = mysqli_connect("localhost","socialdata","Letmein0810","socialdata");
if( mysqli_connect_errno())
{
	echo "Failed to connect " . mysqli_connect_errno();
}
?>