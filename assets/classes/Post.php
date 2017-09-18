<?php 
// Post.ph
// Logic

class Post
{
	private $user_obj;
	private $conn;

	public function __construct($conn , $user)
	{
		echo "create Post obj <br>";
		$this->conn = $conn;
		$this->user_obj = new User( $conn , $user );
	}

	public function submitPost($body , $user_to)
	{
		echo "submitPost<br>";
		// safe text
		$post_body = strip_tags($body); 
		$post_body = mysqli_real_escape_string( $this->conn , $post_body );
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
}

 ?>