<?php 

// index.php

require 'includes/header.php';
require 'includes/chromephp/ChromePhp.php';

// verify user preferred_lang

$U = new Utils();
$U->selectLanguage($con , $user['username']);


//session_destroy();

// deal with the post

//echo "starting.. <br>";



if(isset($_POST['post_button']))
{
	$post = new Post($con, $loggedUsername);
	$post->submitPost($_POST['post_text'] , 'none');
}


?>
	<div class="user_details column">
		<a href="<? echo $user['username']; ?>">
			<img src="<? echo $user['profile_pic'] ?>">
		</a>
		<div class="user_details_left_right">
			<!-- User Details Data -->
			<a href=" <? echo $user['username']; ?> ">
			<?
				echo $user['first_name'] . "<br>"; 
			?>
			</a>
			<?
				echo "Posts: " . $user['num_posts'] . "<br>" ;
				echo "Likes: " . $user['num_likes'];
			?>
		</div>
	</div>

	<div class="main_column column">
		<form class="post_form" action="index.php" method="POST">
			<textarea class="post_text" name="post_text" id="post_text" 
			placeholder="Say something, post something"></textarea>
			<input class="post_button" type="submit" name="post_button" id="post_button" value="Post">
			<hr>
		</form>
		
		<!--  <?php 
			// display posts
			//$post = new Post($con, $loggedUsername);
			//$post->loadPostsFriends();

		 ?> -->

		 <div class="posts_area">  </div>
		 <img id="loading" src="assets/icons/loading.gif" >

	</div>
	<script>
		//alert( '<? echo $loggedUsername; ?>' );
		var userLoggedIn = '<? echo $loggedUsername; ?>';

		$(document).ready(function() {

			$('#loading').show();

			// loading first set of posts
			$.ajax({
				url: "includes/ajax_load_posts.php",
				type: "POST",
				data: "page=1&userLoggedIn=" + userLoggedIn,
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
						url: 'includes/ajax_load_posts.php',
						type: 'POST',
						data: 'page=' + page + '&userLoggedIn=' + userLoggedIn,
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
<!--
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
-->
</body>
</html>

