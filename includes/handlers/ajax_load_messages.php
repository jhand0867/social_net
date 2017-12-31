<?php 
// ajax_load_messages.php

include("../../config/config.php");
include("../../assets/classes/User.php");
include("../../assets/classes/Message.php");

$limit = 7; // number of displayed messages

$message_obj = new Message( $con, $_REQUEST['userLoggedIn']);

$convos = $message_obj->getConvosDropdown($_REQUEST , $limit);

foreach ($convos as $user) {
	// create a user object to access info
	$user_obj = new User ($con, $user);
?>
<div onMouseOver="this.style.backgroundColor='#F8F8F8'" onMouseOut="this.style.backgroundColor='#FFFFFF'">	
<?
	echo "
	
		<div class='comvo_pic'>
		  <a href='profile.php?profile_username=".$user_obj->getUsername()."&t=1'>
		     <img src='". $user_obj->getPic()."' style='top:0px; margin-left:5px; height:45px;'></a>
		</div>
		<div class='comvo_msg' style='top: 0px; 
		                              float: right; 
		                              margin: -40px 182px 0px 0px;'>
		   <p style='top: 2px; right: 1px; margin-top: 1px; margin-right: -145px; width: 250; font-size: 15;'>
		   <span style='font-size: 12; color: #007bff;'>"
		      . $user_obj->getFirstAndLastname() . "&nbsp;&nbsp;" . $message_obj->getLastMessage($user)['time'] . "</span><br>" . 
		   $message_obj->getLastMessage($user)['text'] . "</p>
		</div>
	</div>
	<hr>
	";
}


?>
