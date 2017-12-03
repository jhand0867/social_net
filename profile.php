<?php 

require 'includes/header.php';
require_once 'assets/classes/Utils.php';

$U = new Utils();
$lang = $U->selectLanguage($con , $loggedUsername);

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

$message_obj = new Message($con , $loggedUsername);
if (isset($_GET['u']))
	$user_to = $_GET['u'];
else 
{
	$user_to = $message_obj->getMostRecentUser();
	if ($user_to == 'false')
		$user_to = 'new';
}
if ($user_to != 'new')
	$user_to_obj = new User ($con , $user_to);
if (isset($_POST['post_msg']))
{
	if (isset($_POST['msg_body']))
	{
		$check_safe = $U->stringSafe($con , $_POST['msg_body']);
		$body = $check_safe;

		$date = date("Y-m-d H:i:s");
		$message_obj->sendMessage($user_to,$body,$date);
		$_POST['msg_body'] = "";
		//$user_to = "";
		$body = "";
		$date = "";
	}
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
			<!-- Button trigger modal -->
			<input type="submit" class="deep_blue" data-toggle="modal" data-target="#postForm"
				style="width: 95%;height: 35px;margin: 7px 0 0 7px;color: #fff;border: none;
				border-radius: 5px;" value="Post to User">
	</div>
	<img src=""> <a href=""></a>
	<div class="profile_friends_column column">
		<?php 
			if($username != $loggedUsername)
			{
				// this is not logged user profile page

				$friends = $profile_user->getMutualFriends($loggedUsername);

				foreach ($friends as $f) 
				{
				 	$user_obj = new User($con , $f);
				 	echo "<div class='post_profile_pic'> 
				 			<img src='" . $user_obj->getPic() . "'>
				 			<a href='" .$user_obj->getUsername() ."'><br>" 
				 			.$user_obj->getFirstname() ."&nbsp;".$user_obj->getLastname() . "</a>
				 		  </div>";
				} 
				  	echo "<div class='friend_list'>
				 			<div>Common Friends</div> <div><a href='#'>List All</a></div> 
				 			</div>";
			}
			else
			{
				// this is logged user profile page

				$user = new User($con , $loggedUsername);
				$friends = $user->getMutualFriends($loggedUsername);
				$numfriends = sizeof($friends);
				$numfriend = 0;
				$elipsis = false;
				if ($numfriends > 5)
					$elipsis == true;
				foreach ($friends as $f) 
				{
					$numfriend++;
					if ($numfriend == 6) 
						break;
				 	$user_obj = new User($con , $f);
				 	echo "<div class='post_profile_pic'> 
				 			<img src='" . $user_obj->getPic() . "'>
				 			<a href='" . $user_obj->getUsername() . "'><br>" 
				 			.$user_obj->getFirstname() ."&nbsp;".$user_obj->getLastname() . "</a>
				 		  </div>";
				 }
				 if ($elipsis) 
				 	echo "..." ;
				 echo "	<div class='friend_list'>
				 			<div>My Friends</div> <div><a href='#'>List All</a></div> 
				 			</div>";
			}

		 ?>
	</div >
	<div class="profile_main_column column">
		<div class="container">
			<ul class="nav nav-tabs">
			  <li class="nav-item">
			    <a class="nav-link active" data-toggle="tab" href="#posts">Posts</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" data-toggle="tab" href="#chats">Chats</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" data-toggle="tab" href="#menu2">Other</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link disabled" data-toggle="tab" href="#">Disabled</a>
			  </li>
			</ul>
			<div class="tab-content">
				<div id="posts" class="tab-pane active in">
					<div class="posts_area">  </div>
					<img id="loading" src="assets/icons/loading.gif" >
				</div>
				<div id="chats" class="tab-pane fade">
<!--- chats from messages -->

<?

if ($user_to != 'new')

	echo "<h4>You and <a href='$user_to'>" .$user_to_obj->getFirstAndLastName() ."</a></h4><hr><br>";
?>

<div class="post_message">
	<form action="" method="POST">
	<?
	if($user_to == "new")
	{
	?>
		Select the user you would like to send a message
		<br><br>
		To: <input type="text" onkeyup="getUsers(this.value, '<? echo $loggedUsername ?>');"
		name="q" placeholder="Name" autocomplete="off" id="search_text_input">
		<div class="results" id="results"></div>
	<?
	}
	else
	{
	?>
		<textarea name="msg_body" id="msg_textarea" placeholder="Type your message.."></textarea>
		<input type="submit" class="info" name="post_msg" id="msg_submit" value="Send">
	<?
	}
	?>
	</form>
</div>
<?
	echo "<div class='loaded_messages'>";
	$messages = $message_obj->getMessages($user_to);
	
	if ($messages != "none")
	{
		?>
		<div class="container">
			<table class="table-hover">
				<tbody> 
		<? 
		foreach ($messages as $row) 
		{
			$height = 70;
			$body_len = strlen($row['msg_body'])/25;
			
			if ($body_len > 1)
			{
				$height = (round($body_len) + 1) * 35; 
			}
			
			if ($loggedUsername == $row['msg_user_to'])
			{
				$user = new User($con , $row['msg_user_to']);
				echo "<td ><img class='pic_row' src='".$user->getPic($row['msg_user_to'])."'></td>";
				echo "<td class='msg_send' background='assets/images/backgrounds/callout_noline_left.png' 
				style='background-repeat:no-repeat;background-size: 350px ". $height ."px; 
				width: 350px; height: ". $height . "px;'>" . $row['msg_body'] . "</td>"; 
				echo "<td></td>";
				echo "<td></td>";
				echo "</tr>";
				echo "<tr class='tr_empty'></tr>";
			}
			else
			{
				$user = new User($con , $row['msg_user_to']);
				echo "<td ><img class='pic_row' src='".$user->getPic($row['msg_user_to'])."'></td>";
				echo "<td></td>";
				echo "<td></td>";
				echo "<td class='msg_send' background='assets/images/backgrounds/callout_noline_right.png' 
				style='background-repeat:no-repeat;background-size: 350px ". $height ."px; 
				width: 350px; height: ". $height . "px;'>" . $row['msg_body'] . "</td>"; 
				echo "</tr>";			
				echo "<tr class='tr_empty'></tr>";
			}
		}
		?>
				</tbody>
			</table>
		</div>
	<?
	}
	?>
</div>


<!--- end of chats from messages -->
				</div>
				<div id="menu2" class="tab-pane fade">
					This is other TBD
				</div>
			</div>
		</div>
	</div>

		<!-- Modal -->
		<div class="modal fade" id="postForm" tabindex="-1" role="dialog" aria-labelledby="postModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">

		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Post Something!</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>

		      <div class="modal-body">
		        <p>This will show in the user's profile and his newsfeed for friends to see.</p>

		        <form class="profile_post" action="" method="POST">
		        	<div class="form-group">
		        		<? echo "profile_post"; ?>
		        		<textarea class="form-control" name="post_body"></textarea>
		        		<input type="hidden" name="user_from" value="<? echo $loggedUsername; ?>">
		        		<input type="hidden" name="user_to" value="<? echo $profile_user->getUsername(); ?>">
		        		<!-- <input type="submit"> -->
		        	</div>

		        </form>
		      </div>

		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-primary" name="post_button" id="submit_profile_post">Post</button>
		      </div>

		    </div>
		  </div>
		</div>
	<script>
		//alert( '<? echo $loggedUsername; ?>' );
		var userLoggedIn = '<? echo $loggedUsername; ?>';
		var profileUsername = '<? echo $username; ?>';


		$(document).ready(function() {

			$('#loading').show();

			// loading first set of posts
			$.ajax({
				url: "includes/handlers/ajax_load_profile_posts.php",
				type: "POST",
				data: "page=1&userLoggedIn=" + userLoggedIn + "&profileUsername=" + profileUsername,
				cache: false,

				success: function (data) {
					$('#loading').hide();
					$('.posts_area').html(data);

				}
			});

			$(window).scroll(function() {

				var height = $('.posts_area').height();  // posts div
				var scroll_top = $(this).scrollTop();
				var page = $('.posts_area').find('.next_page').val();
				var noMorePosts = $('.posts_area').find('.no_more_posts').val();

				if ( (document.body.scrollHeight >= document.body.scrollTop + window.innerHeight) 
					&& noMorePosts == 'false' ) {

					$('#loading').show();

					
					var ajaxReq = $.ajax({
						url: 'includes/handlers/ajax_load_profile_posts.php',
						type: 'POST',
						data: 'page=' + page + '&userLoggedIn=' + userLoggedIn + "&profileUsername=" + profileUsername,
						cache: false,

						success: function (response) {
							// get rid of currect shown page
							$('.posts_area').find('.next_page').remove();
							$('.posts_area').find('.no_more_posts').remove();

							$('#loading').hide();
							$('.posts_area').append(response);

						}
					});	
				
				} // end if document.body.scrollHeight

				return false;

			}); // end $(window).scroll(function()
		});


	</script>


</div>

</body>
</html>

