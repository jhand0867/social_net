<?php 
// User.ph
// Logic
//require_once('ChromePhp.php');

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

	public function updatePic($newPic , $username)
	{
		$user_query = mysqli_query($this->conn ,
			"UPDATE soc_users 
			SET profile_pic='$newPic' 
			WHERE username='$username'");
		$this->user['profile_pic'] = $newPic;
	}

	public function isFriend($username_to_check)
	{
		$match_username = "," . $username_to_check . ",";
		
		// find if the user is in the array
		if( ( strstr($this->user['friends_array'], $match_username ) ) || 
			$username_to_check == $this->user['username'])
		{
			return true;
		}
		else
		{
			return false;
		}

	}

	public function getFriendsRequests()
	{
		$user_logged_in = $this->user['username'];
		$user_query = mysqli_query($this->conn , 
			"SELECT * 
			 FROM soc_friend_requests
			 WHERE user_to = '$user_logged_in' AND status='P'" );
		if (mysqli_num_rows($user_query) > 0 )
		{
			$friend_requests = mysqli_fetch_array($user_query);
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

	public function getLanguage()
	{
		return $this->user['preferred_lang'];
	}

	public function getFriendsArray()
	{
		return $this->user['friends_array'];
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

	public function removeFriendRequest($user_from, $user_to)
	{		
		// change friend request to A=accepted
		$upd_friend_request_qry = mysqli_query( $this->conn , 
			"UPDATE soc_friend_requests
			 SET status = 'A'
			 WHERE user_from='$user_to' AND user_to='$user_from' "); 
	}

	public function addFriend($username_to_add)
	{
		//echo "<br>In addFriend";

		// get the actual user friend list of who accept the request
		$user_friends_list = $this->user['friends_array'];
		$user_logged_in = $this->user['username'];

		// new user to access who requested to be added
		$requester_user = new User( $this->conn , $username_to_add );
		$requester_user_friend_list = $requester_user->getFriendsArray();


		// add requesting user to who accepted friends list

		$upd_who_accepts_qry = mysqli_query( $this->conn , 
			"UPDATE soc_users
			 SET friends_array = CONCAT('$user_friends_list','$username_to_add,')
			 WHERE username='$user_logged_in'");

		// add who accepted to requesting user friends list

		$upd_who_accepts_qry = mysqli_query( $this->conn , 
			"UPDATE soc_users
			 SET friends_array = CONCAT('$requester_user_friend_list','$user_logged_in,')
			 WHERE username='$username_to_add'");
	}

	public function getMutualFriends($user_to)
	{
		// using friends array to find out common friends

		$mutual_friends = 0;
		$mutual_friends_usernames = [];

		$friends_array = $this->user['friends_array'];
		$friends_array_explode = explode(",", $friends_array);

		$compare_user = new User($this->conn , $user_to);
		$friends_array_compare = explode(",",$compare_user->getFriendsArray());

		foreach ($friends_array_explode as $i) {

			foreach ($friends_array_compare as $j) {
				
				if ( $i == $j && $i!= "")
				{
					$mutual_friends ++;
					$mutual_friends_usernames[$mutual_friends] = $i;
				}
			}
		}

		return $mutual_friends_usernames;
	}

	public function queryUserTable($queryValues)
	{
		// what's in the query?

		 ChromePhp::log("in queryUserTable!!!");

		$names = explode(" ", $queryValues);


		// if it contains "_" underscore
		// look for usernames

		if (strpos('_', $queryValues) !== false)
		{
			$user_query = "SELECT * 
						   FROM soc_users
						   WHERE username LIKE $queryValues% 
						   AND user_closed='no' LIMIT 8" ; 
		}

		// if it's 2 words
		// look for first and lastname respectively
		
		else if (count($names) == 2 )
		{
			$user_query = "SELECT * 
						   FROM soc_users
						   WHERE ( first_name LIKE $names[0]% AND last_name LIKE $names[1]% ) 
						   AND user_closed='no' LIMIT 8" ;
		}
		// if it's 1 word
		// look for first and lastname 
		else if (count($names) == 1 )
		{
			$user_query = "SELECT * 
						   FROM soc_users
						   WHERE ( first_name LIKE $names[0]% OR last_name LIKE $names[0]% ) 
						   AND user_closed='no' LIMIT 8" ;

		}

		$user_tbl_qry = mysqli_query( $this->conn , $user_query );


		/*while ($row = mysqli_fetch_array($user_tbl_qry))
		{
			$user_to_push = 
			($row['nt_user_to'] != $loggedInUser) ? $row['nt_user_to'] : $row['nt_user_from'];

			if (!in_array($user_to_push , $convos))
				array_push($convos, $user_to_push);
		}

		return $convos;*/

		return $user_tbl_qry;






	}


}

 ?>