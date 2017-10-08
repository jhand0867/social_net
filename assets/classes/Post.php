<?php 
// Post.php
require "Utils.php";

class Post
{
	private $user_obj;
	private $conn;

	public function __construct($conn , $user)
	{
		$this->conn = $conn;
		$this->user_obj = new User( $conn , $user );
	}

	public function submitPost($body , $user_to)
	{
		// safe text
		$utils = new Utils();

		$post_body = $utils->stringSafe($this->conn, $post_body);
		//$post_body = mysqli_real_escape_string( $this->conn , $post_body );
		$check_empty = preg_replace( '/\s+/' , '' , $post_body );

		if($check_empty != "")
		{
			// ok to post
			$post_date = date("Y-m-d H-i-s"); // post date and time
			$post_user = $this->user_obj->getUsername();

			// post to self?
			if ( $user_to == $post_user)
			{
				$user_to = "none";
			}

			$insert_post_qry = mysqli_query( $this->conn, 
				"INSERT INTO soc_posts
				(id,post_body,post_added_by,post_user_to,post_date,post_user_closed,post_deleted,post_likes)
				VALUES ('' , '$post_body' , '$post_user', '$user_to', '$post_date','no','no','0')");
			$returned_id = mysqli_insert_id($this->conn);

			// add notification 


			// adjust user's posts count
			$this->user_obj->increaseNumPost();
	
		}
	}

	public function loadPostsFriends( $data , $limit )
	{
		$page = $data['page'];
		$userLoggedIn = $this->user_obj->getUsername();

		if ($page == 1)
			$start = 0;
		else
			$start = ($page - 1) * $limit;

		$str = ""; // to build up
		$data_posts = mysqli_query($this->conn, 
			"SELECT * 
			FROM soc_posts 
			WHERE post_deleted = 'no' 
			ORDER BY id DESC");

		if ( mysqli_num_rows($data_posts) > 0 )
		{
			$num_iterations = 0; //Number of results checked (not necasserily posted)
			$count = 1;

			while ( $row = mysqli_fetch_array($data_posts) )
			{
				$id = $row['id'];
				$body = $row['post_body'];
				$added_by = $row['post_added_by'];
				$date_time = $row['post_date'];

				// echo $date_time;

				// is it self posted? ... or do I need to get user name

				if($row['post_user_to'] == "none")
				{
					$user_to = "";
				}
				else
				{
					$user_to_obj = new User( $this->conn, $row['post_user_to']);
					$user_to_full_name = $user_to_obj->getFirstAndLastName();
					$user_to_name = $user_to_obj->getFirstName();
					$user_to = "to <a href='" . $row['post_user_to'] . "'>" . $user_to_name . "</a>";
				}

				// is the posting account closed?

				$added_by_obj = new User( $this->conn, $added_by );
				$user_closed = $added_by_obj->isAccountClosed();
				if ( $user_closed )
				{
					continue;
				}

				// is post from friends?


				if ( $this->user_obj->isFriend($added_by) )
				{
					if ( $num_iterations++ < $start )
					{
						continue;
					}

					// set limit posts already loaded?

					if ( $count > $limit )
					{
						break;					
					}
					else
					{
						$count++;
					}


					// not closed, get some info for who's posting

					$added_by_full_name = $added_by_obj->getFirstAndLastName();
					$added_by_name = $added_by_obj->getUsername();
					$added_by_pic = $added_by_obj->getPic();

					?>

					<script>

					function toggle<?php echo $id; ?>()
					{
						var target = $(event.target);
						if(!target.is("a"))
						{
							element = document.getElementById("toggleComment<?php echo $id;?>");

							if (element.style.display == "block")
								element.style.display = "none";
							else
								element.style.display = "block";				
						}
					}


					</script>

					<?

					// how many comments ?
					$comments_check = mysqli_query( $this->conn,
						"SELECT * 
						 FROM soc_comments
						 WHERE comment_to_post_id = '$id'" );
					$comments_check_count = mysqli_num_rows($comments_check);


					// time since last post

					$utils = new Utils();

					$time_message = $utils->postInterval( $date_time );

					// build the post
					
					$str .= "<div class='status_post' onClick='javascript:toggle$id()'>
								<div class='post_profile_pic'>
									<img src='$added_by_pic' width='50'>
								</div>

								<div class='posted_by' style='color:ACACAC;'>
									<a href='$added_by_name'>$added_by_full_name</a> 
									$user_to &nbsp;&nbsp;&nbsp;$time_message 
								</div>

								<div id='post_body' >
									$body<br><br><br>
								</div>

								<div class='newsfeedPostOptions'>
									Comments($comments_check_count)&nbsp;&nbsp;&nbsp;
									<iframe src='like.php?post_id=$id' scrolling='no'></iframe>
								</div>
							</div>

							<div class='post_comment' id='toggleComment$id' style='display:none;'>	
								<iframe src='comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0'></iframe>
							</div>
							<hr>";
				}
			} // while ends here

			// more posts to be loaded
			if ( $count > $limit )
			{
				$str .= "<input type='hidden' class='next_page' value='" . ($page + 1) ."'>
				<input type='hidden' class='no_more_posts' value='false'>";

			}
			// all posts loaded
			else
			{
				$str .= "<input type='hidden' class='no_more_posts' value='true'>
				<p style='text-align: centre;'>That's all folks!</p>";
			}

		// show the post
		echo $str;

		}
	}

	public function increaseLikes( $post_id, $username )
	{
		// update the number of likes in a post

		$find_post = mysqli_query( $this->conn , 
			"SELECT post_likes 
			 FROM soc_posts
			 WHERE id = '$post_id'");

		$row = mysqli_fetch_array($find_post);
		$post_likes = $row['post_likes'];
		$post_likes ++;

		$post_update = mysqli_query( $this->conn , 
			"UPDATE soc_posts 
			SET post_likes = $post_likes 
			WHERE id = '$post_id'");

		// udpate likes

		$like_date = date("Y-m-d H-i-s"); // post date and time

		$insert_like = mysqli_query( $this->conn, 
			"INSERT INTO soc_likes(id,like_username,like_to_post_id,like_date)
			VALUES ('' , '$username' , '$post_id', '$like_date')");
			$returned_id = mysqli_insert_id($this->conn);
		
	}

	public function decreaseLikes( $post_id, $username )
	{
		// update the number of likes in a post

		$find_post = mysqli_query( $this->conn , 
			"SELECT post_likes 
			 FROM soc_posts
			 WHERE id = '$post_id'");

		$row = mysqli_fetch_array($find_post);
		$post_likes = $row['post_likes'];
		$post_likes --;

		$post_update = mysqli_query( $this->conn , 
			"UPDATE soc_posts 
			 SET post_likes = $post_likes 
			 WHERE id = '$post_id'");

		// get rid off the like

		$insert_like = mysqli_query( $this->conn, 
			"DELETE 
			 FROM soc_likes
			 WHERE like_to_post_id = '$post_id' AND like_username = '$username'");

	}	
}

?>