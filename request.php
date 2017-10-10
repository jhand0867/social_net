<?php
// request.php

require 'includes/header.php';



?>
<div class="main_column column" id="main_column">

	<h4>Friend Requests</h4>

	<?
		$user = new User($con , $loggedUsername);
		$query = mysqli_query($con, 
			"SELECT * 
			 FROM soc_friend_requests
			 WHERE user_to = '$loggedUsername' AND status='P'");

		if (mysqli_num_rows($query) == 0)
		{
			echo "No friend quests at this time...";
		}
		else
		{
			while ($row = mysqli_fetch_array($query)) 
			{
				$user_from = $row['user_from'];
				$user_from_obj = new User($con , $user_from);

				echo $user_from_obj->getFirstAndLastName() . " sent you a Friend Request !";	

				//$user_from_friends_array = $user_from_obj->getFriendsArray();
				
				$req_accept = "accept_request" . $user_from;
				$req_ignore = "ignore_request" . $user_from;
				
				if(isset($_POST[$req_accept]))
				{
					echo 'YAY!!';
					echo "user_from = " .$user_from;
				    echo "user logged = " . $loggedUsername;

					$user->addFriend($user_from);
					$user->removeFriendRequest($loggedUsername, $user_from);

					echo "You are now friend with " . $user_from_obj->getFirstAndLastName();
					//header("Location: request.php");


				}			


				if (isset($_POST[$req_ignore]))
				{
					echo "YOY!";
					

				}			
			?>
			<form action="request.php" method="POST">
				<input type="submit" name="accept_request<?php echo $user_from; ?>" id="accept_button" value="Accept">
				<input type="submit" name="ignore_request<?php echo $user_from; ?>" id="ignore_button" value="Ignore">
			</form>

			<?
				//echo "key " . $req . " , vale " . $field;
				//echo "<br>";
			}
			//print_r($friend_requests);
		}
	?>




</div>

