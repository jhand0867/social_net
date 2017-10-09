<?php
// request.php

require 'includes/header.php';
require 'assets/classes/User.php';
require 'assets/classes/Post.php';



?>
<div class="main_column column" id="main_column">

	<h4>Friend Requests</h4>

	<?
		$user = new User($con , $loggedUsername);
		$friend_requests = $user->getFriendsList();
		if ($friend_requests == "")
		{
			echo "No friend quests at this time...";
		}
		else
		{
			foreach ($friend_requests as $req => $field) 
			{
				echo "key " . $req . " , vale " . $field;
				echo "<br>";
			}
			//print_r($friend_requests);
		}
	?>



</div>

