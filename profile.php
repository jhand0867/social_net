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
					foreach ($friends as $f) 
					{
					 	$user_obj = new User($con , $f);
					 	echo "<div class='post_profile_pic'> 
					 			<img src='" . $user_obj->getPic() . "'>
					 			<a href='" . $user_obj->getUsername() . "'><br>" 
					 			.$user_obj->getFirstname() ."&nbsp;".$user_obj->getLastname() . "</a>
					 		  </div>";
					 } 
					 echo "	<div class='friend_list'>
					 			<div>My Friends</div> <div><a href='#'>List All</a></div> 
					 			</div>";
				}

			 ?>
	</div >
	<div class="profile_main_column column">
		<div class="posts_area">  </div>
		<img id="loading" src="assets/icons/loading.gif" >


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

