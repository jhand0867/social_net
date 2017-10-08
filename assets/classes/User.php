<?php 
// User.ph
// Logic

class User
{
	private $user;
	private $conn;

	public function __construct($conn , $user)
	{
		$this->conn = $conn;
		$user_details_qry = mysqli_query($conn, "SELECT * FROM soc_users WHERE username = '$user'");
		$this->user = mysqli_fetch_array($user_details_qry);

	}

	public function getUsername()
	{
		return $this->user['username'];
	}

	public function getNumPosts()
	{
		return $this->user['num_posts'];
	}

	public function getLikesNum()
	{
		return $this->user['num_likes'];
	}

	public function increaseNumPost()
	{
		$num_posts = $this->user['num_posts']+ 1;
		$username = $this->user['username'];

		// UPDATE soc_users set `num_posts`=0

		$update_num_post = mysqli_query($this->conn, 
			"UPDATE soc_users 
			SET num_posts = $num_posts 
			WHERE username = '$username'");
	}

	public function increaseLikes()
	{
		$num_likes = $this->user['num_likes']+ 1;
		$username = $this->user['username'];

		$update_num_post = mysqli_query($this->conn, 
			"UPDATE soc_users 
			SET num_likes = $num_likes 
			WHERE username = '$username'");
	}

	public function decreaseLikes()
	{
		$num_likes = $this->user['num_likes']- 1;
		$username = $this->user['username'];

		$update_num_post = mysqli_query($this->conn, 
			"UPDATE soc_users 
			SET num_likes = $num_likes 
			WHERE username = '$username'");
	}

	public function getFirstAndLastName()
	{
		$username = $this->user['username'];
		$firstAndLastName = $this->user['first_name'] . " " . $this->user['last_name'];
		return $firstAndLastName;
	}

	public function getFirstName()
	{
		return $this->user['first_name'];
	}

	public function getLastName()
	{
		return $this->user['last_name'];
	}

	public function isAccountClosed()
	{
		$accountClosed = false;

		if ($this->user['user_closed'] == "yes")
		{
			$accountClosed = true;
		}
		else
		{
			$accountClosed = false;
		}

		return $accountClosed;
	}

	public function getPic()
	{
		return $this->user['profile_pic'];
	}

	public function isFriend($username_to_check)
	{
		$match_username = "," . $username_to_check . ",";
		
		// find if the user is in the array
		if( ( strstr($this->user['friends_array'], $match_username ) ) || 
			$match_username == $this->user['username'])
		{
			return true;
		}
		else
		{
			return false;
		}

	}

	public function getFriendsCount()
	{
		return (substr_count( $this->user['friends_array'], "," )) - 1;
	}

	public function receivedFriendRequest($username_to_check)
	{
		$user_from = $this->user['username'];
		$friends_query = mysqli_query($this->conn , 
			"SELECT * 
			 FROM soc_friend_requests 
			 WHERE user_from ='$username_to_check' AND user_to = '$user_from'");
		if ( mysqli_num_rows($friends_query) > 0 )
			return true;
		else
			return false;
	}
	public function sentFriendRequest($username_from_check)
	{
		$user_to = $this->user['username'];
		$friends_query = mysqli_query($this->conn , 
			"SELECT * 
			 FROM soc_friend_requests 
			 WHERE user_from ='$username_from_check' AND user_to = '$user_to'");
		if ( mysqli_num_rows($friends_query) > 0 )
			return true;
		else
			return false;
	}


}

 ?>