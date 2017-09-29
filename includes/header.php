<?php 
require "config/config.php";
/* Create a trace file in '/tmp/client.trace' on the local (client) machine: */
mysqli_debug("d:t:0,/tmp/client.trace");
	
if (isset($_SESSION['username']))
{
	$loggedUsername = $_SESSION['username'];
	$userDetails = mysqli_query($con , "SELECT * FROM soc_users WHERE username='$loggedUsername'");
	$user = mysqli_fetch_array($userDetails);
}
else
	header("Location: registration.php");

?>
<html>
<head>
	<title>Social Net</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
    <script src="https://use.fontawesome.com/4a24d42811.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

</head>
<body>
	<div class="top_bar">
		<div class="logo">
			<a href="index.php">Social Net</a>
		</div>
		<nav>
			<a href="<? echo $user['first_name']; ?>">
				<? echo $user['first_name'] ?>
			</a>
			<a href="index.php"><i class="fa fa-home fa-lg" aria-hidden="true"></i></a>
			<a href="#"><i class="fa fa-envelope fa-lg" aria-hidden="true"></i></a>
			<a href="#"><i class="fa fa-bell fa-lg" aria-hidden="true"></i></a>
			<a href="#"><i class="fa fa-users fa-lg" aria-hidden="true"></i></a>
			<a href="#"><i class="fa fa-cog fa-lg" aria-hidden="true"></i></a>
			<a href="includes/handlers/logout.php"><i class="fa fa-sign-out fa-lg" aria-hidden="true"></i></a>
		</nav>
	</div>

	<div class="wrapper">