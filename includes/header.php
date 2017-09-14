<?php 
require "config/config.php";

if (isset($_SESSION['username']))
	$loggedUsername = $_SESSION['username'];
else
	header("Location: registration.php");

?>
<html>
<head>
	<title>Social Net</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
</head>
<body>