<?php 
require "config/config.php";
require "assets/classes/Session.php";
require "assets/classes/Utils.php";
require "assets/classes/User.php";
require "assets/classes/Post.php";
require "assets/classes/Message.php";


// require "includes/global_utils.php";
/* Create a trace file in '/tmp/client.trace' on the local (client) machine: */
//mysqli_debug("d:t:0,/tmp/client.trace");
	
if (isset($_SESSION['username']))
{
	$loggedUsername = $_SESSION['username'];
	$userDetails = mysqli_query($con , "SELECT * FROM soc_users WHERE username='$loggedUsername'");
	$user = mysqli_fetch_array($userDetails);
}
else
	header("Location: registration.php");

$msg_obj = new Message($con, $loggedUsername );
$msg_unread = $msg_obj->countUnopenedMessages($loggedUsername);
$msg_unred_str = '';
$msg_unread = "99+";
if ($msg_unread > 0)
{
	$msg_unred_str = "<span class='unread_msg_badge'>$msg_unread</span>";
}

?>
<html>
<head>
	<title>Social Net</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://unpkg.com/popper.js@1.12.5/dist/umd/popper.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/jquery.jcrop.js"></script>
	<script src="assets/js/jcrop_bits.js"></script>
    <script src="assets/js/bootbox.min.js"></script>
    <script src="https://use.fontawesome.com/4a24d42811.js"></script>
    <script src="assets/js/social_net.js"></script>

    
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.Jcrop.css">

</head>
<body>
	<div class="top_bar">
		<div class="logo">
			<a href="index.php">Social Net</a>
		</div>
		<nav>
			<a href="<? echo "profile.php?profile_username=".$user['username']."&t=0"; ?>">
				<? echo $user['first_name'] ?>
			</a>
			<a href="index.php"><i class="fa fa-home fa-lg" aria-hidden="true"></i>
				&nbsp;&nbsp;
			</a>
<!--			<a href="messages.php?u=new"><i class="fa fa-envelope fa-lg" aria-hidden="true"></i></a> -->
			<a href="javascript:void(0);" 
			   onclick="getDropdownData('<? echo $loggedUsername ?>', 'message')">
			   <i class="fa fa-envelope fa-lg" aria-hidden="true"></i>
			   &nbsp;<? echo $msg_unred_str; ?>&nbsp;
			</a>
			<a href="#">
				<i class="fa fa-bell fa-lg" aria-hidden="true"></i>
				&nbsp;&nbsp;
			</a>
			<a href="request.php"><i class="fa fa-users fa-lg" aria-hidden="true"></i>
				&nbsp;&nbsp;
			</a>
			<a href="settings.php"><i class="fa fa-cog fa-lg" aria-hidden="true"></i>
				&nbsp;&nbsp;
			</a>
			<a href="includes/handlers/logout.php"><i class="fa fa-sign-out fa-lg" aria-hidden="true"></i>
				&nbsp;&nbsp;
			</a>
		</nav>
		<div class="dropdown_data_window" style="height:0"></div>
		<input type="hidden" id="dropdown_data_type" value="">
	</div>

	<div class="wrapper">