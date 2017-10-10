<?php 

require 'includes/header.php';
require_once 'assets/classes/Utils.php';

if(isset($_GET['profile_username']))
{
	$username = $_GET['profile_username'];
	$profile_user = new User( $con , $username );
}

if(isset($_POST['remove_friend']))
{
	echo "Removed Friend clicked";

	$user = new User( $con , $loggedUsername );
	$user->removeFriend($username);
}

if(isset($_POST['add_friend']))
{
	echo "add friend clicked";
	$user = new User( $con , $loggedUsername );
	$user->sendFriendRequest($username);
}

if(isset($_POST['respond_request']))
{
	header("Location: requests.php");
}


?>
	<style type="text/css">
		.wrapper {
			margin-left: 0px;
			padding-left: 0px;
		}

	</style>
	<div class="profile_left">
		<img src="<? echo $profile_user->getPic() ?>">

		<div class="profile_info">
			<p>Posts: <? echo $profile_user->getNumPosts() ?> <p>
			<p>Likes: <? echo $profile_user->getLikesNum() ?> <p>
			<p>Friends: <? echo $profile_user->getFriendsCount() ?> <p>
		</div>

		<form action = "<? echo $username; ?>" method="POST" >

			<? 
				if($profile_user->isAccountClosed())
				{
					header("Location: user_closed.php");
				}
				else 
				{
					$logged_in_user_obj = new User($con , $loggedUsername);
					if ( $username != $loggedUsername )
					{
						if ( $logged_in_user_obj->isFriend( $username ))
						{
							// show unfriend button
							echo ' <input type="submit" class="danger" name="remove_friend" 
							value="Unfriend" style="width: 90%;
													height: 35px;
													margin: 7px 0 0 7px;
													color: #fff;
													border: none;
													border-radius: 5px;"><rb> ';
						}
						else if ( $logged_in_user_obj->didReceivedFriendRequest( $username ))
						{
							// show Accept Request from friend button
							echo ' <input type="submit" class="warning" name="request_friend" 
							value="Friend Request" style="width: 90%;
													height: 35px;
													margin: 7px 0 0 7px;
													color: #fff;
													border: none;
													border-radius: 5px;"><rb> ';							
						}
						else if ( $logged_in_user_obj->didSendFriendRequest( $username ))
						{
							// show friend button
							echo ' <input type="submit" class="default" name="" 
							value="Request Friend"style="width: 90%;
													height: 35px;
													margin: 7px 0 0 7px;
													color: #fff;
													border: none;
													border-radius: 5px;"><rb> ';							
						}
						else
						{
							// show friend button
							echo ' <input type="submit" class="success" name="add_friend" 
							value="Add Friend"style="width: 90%;
													height: 35px;
													margin: 7px 0 0 7px;
													color: #fff;
													border: none;
													border-radius: 5px;"><rb> ';							

						}

					}


				}


			?>


		</form>
	</div>
	
	<div class="main_column column">
		


	</div>


</div>

</body>
</html>

