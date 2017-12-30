<?php 
// ajax_load_messages.php

include("../../config/config.php");
include("../../assets/classes/User.php");
include("../../assets/classes/Notification.php"); 

$limit = 7; // number of displayed messages

$notification_obj = new Notification( $con, $_REQUEST['userLoggedIn']);

$convos = $notification_obj->getConvosDropdown($_REQUEST , $limit);

foreach ($convos as $user) {
	// create a user object to access info
	$user_obj = new User ($con, $user);

	$nt_text = "";
	$nt_time = "";
	if ($nt = $notification_obj->getLastNotification($user) != 'nothing' )
	{
		echo "
		<div>
			<div class='comvo_pic'>
			  <a href='profile.php?profile_username=".$user_obj->getUsername()."&t=1'>
			     <img src='". $user_obj->getPic()."' style='top:0px; margin-left:5px; height:45px;'></a>
			</div>
			<div class='comvo_msg' style='top: 0px; 
			                              float: right; 
			                              margin: -40px 182px 0px 0px;'>
			   <p style='top: 2px; right: 1px; margin-top: 1px; margin-right: -145px; width: 250; font-size: 15;'>" . 
			   $nt['text'] . "<br><span style='font-size: 12; color: #007bff;'>"
			        . $nt['time'] . "</span></p>
			</div>
		</div>
		<hr>
		";
	}
	else
	{
			echo "<br><br><p style='text-align: center;'>No Notifications at this time</p>";
	}	
}


 ?>