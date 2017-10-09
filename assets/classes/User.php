<?php 
// User.ph
// Logic

class User
{
	private $user;
	private $conn;

	public function __construct($conn , $user)
	{
		//echo "User created<br>";
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

	public function getFriendsList()
	{
		$user_logged_in = $this->user['username'];
		$user_query = mysqli_query($this->conn , 
			"SELECT * 
			 FROM soc_friend_requests
			 WHERE user_to = '$user_logged_in'" );
		if (mysqli_num_rows($user_query) > 0 )
		{
			$friend_requests = mysqli_fetch_array($user_query , MYSQL_ASSOC);
		}
		else
		{
			$friend_requests = "";
		}
		return $friend_requests;
	}

	public function getFriendsCount()
	{
		return (substr_count( $this->user['friends_array'], "," )) - 1;
	}

	public function didReceivedFriendRequest($user_from)
	{
		$user_to = $this->user['username'];
		$friends_query = mysqli_query($this->conn , 
			"SELECT * 
			 FROM soc_friend_requests 
			 WHERE user_from ='$user_from' AND user_to = '$user_to'");
		if ( mysqli_num_rows($friends_query) > 0 )
			return true;
		else
			return false;
	}

	public function didSendFriendRequest($user_to)
	{
		$user_from = $this->user['username'];
		$friends_query = mysqli_query($this->conn , 
			"SELECT * 
			 FROM soc_friend_requests 
			 WHERE user_from ='$user_from' AND user_to = '$user_to'");
		if ( mysqli_num_rows($friends_query) > 0 )
			return true;
		else
			return false;
	}

	public function removeFriend($username_to_remove)
	{
		echo "<br>Remove Friend " . $username_to_remove ;
		$user_logged_in = $this->user['username'];
		
		// check if friends with 
		$friends_query = mysqli_query($this->conn , 
			"SELECT friends_array 
			 FROM soc_users 
			 WHERE username ='$username_to_remove'");
		$row = mysqli_fetch_array($friends_query);

		// actual friends list
		$friends_array_username = $row['friends_array'];

		// remove from logged user friend's list

		$new_friends_array = 
			str_replace($username_to_remove . ",", "", $this->user['friends_array']);

		$remove_friend = mysqli_query($this->conn , 
			"UPDATE soc_users 
			 SET friends_array = '$new_friends_array' 
			 WHERE username ='$user_logged_in'");

		// remove from friend friend's list
		$new_friends_array = 
			str_replace($user_logged_in . ",", "", $friends_array_username);

		$remove_friend = mysqli_query($this->conn , 
			"UPDATE soc_users 
			 SET friends_array = '$new_friends_array' 
			 WHERE username ='$username_to_remove'");

	}

	public function sendFriendRequest($user_to)
	{
		$user_from = $this->user['username'];
		$date_time = date("Y-m-d H-i-s");

		$request_query = mysqli_query( $this->conn ,
			"INSERT INTO soc_friend_requests (id, user_from, user_to, req_date)
			 VALUES('', '$user_from', '$user_to', '$date_time' ) ");
		$returned_id = mysqli_insert_id($this->conn);
	}

	public function addFriend($username_to_add)
	{

	}


}

 ?>