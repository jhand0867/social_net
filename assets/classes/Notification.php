<?php 
// Notification.php

require_once "Utils.php";

class Notification
{
	private $user_obj;
	private $conn;

	public function __construct($conn , $user)
	{
		$this->conn = $conn;
		$this->user_obj = new User( $conn , $user );
	}

	public function countNotifications($user)
	{
		$unopen_messages = 0;
		$not_qry = '';

		$qry_str = "SELECT * 
		            FROM soc_notifications
		            WHERE nt_user_to = '$user' AND nt_viewed = 'no'";

		try {

			$not_qry = mysqli_query($this->conn , $qry_str);
			$unopen_messages = ($not_qry->num_rows);
			
			
		} catch (Exception $e) {
			
			print_r($e);
		}
		
		return $unopen_messages;
	}

	public function getConvosDropdown($data , $limit) 
	{
		$loggedInUser = $this->user_obj->getUsername();
		$page = $data['page'];
		$user = $data['userLoggedIn'];

		$returnString = '';
		$convos = array();

		// how many messages to load?
		if ($page == 1)
			$startLoading = 0;
		else
			$startLoading = ($page -1) * $limit;

		// udate opened flag 
		$qry_str = "UPDATE soc_notifications
			 SET nt_viewed = 'yes' 
			 WHERE nt_user_to = '$loggedInUser'";
	
		$nt_qry = mysqli_query($this->conn , $qry_str);

		$qry_str = "SELECT nt_user_to, nt_user_from
			 FROM soc_notifications
			 WHERE ((nt_user_to = '$loggedInUser')
			 OR (nt_user_from = '$loggedInUser')) 
			 ORDER BY nt_datetime DESC ";

		$nt_qry1 = mysqli_query($this->conn , $qry_str);

		while ($row = mysqli_fetch_array($nt_qry1))
		{
			$user_to_push = ($row['nt_user_to'] != $loggedInUser) ? $row['nt_user_to'] : $row['nt_user_from'];

			if (!in_array($user_to_push , $convos))
				array_push($convos, $user_to_push);
		}

		return $convos;

		/* sample comvos
		array(4) { [0]=> string(14) "maria_handschu" 
		           [1]=> string(16) "matthew_handschu" 
		           [2]=> string(15) "lorena_handschu" 
		           [3]=> string(18) "matthew_handschu_1" }
		*/

	}

	public function createNotification($post_id , $to , $type)
	{
		$loggedInUser = $this->user_obj->getUsername();
		$loggedInFullName = $this->user_obj->getFirstAndLastname();

		$date_time = date("Y-m-d H:i:s");

		echo "<br>type = " . $type . "<br>";

		switch ($type) {
			case 'frien_request':
				# code...
			    $message = $loggedInFullName . " sent a friend request";
				break;
			case 'like':
				# code...
			    $message = $loggedInFullName . " liked your post";
				break;
			case 'message':
				# code...
			    $message = $loggedInFullName . " sent a friend request";
				break;
			case 'comment':
				# code...
			    $message = $loggedInFullName . " sent a friend request";
				break;
			case 'wall':
				# code...
			    $message = $loggedInFullName . " posted in your profile";
				break;
			case 'comment_non_owner':
				# comment on a comment user commented on
			    $message = $loggedInFullName . " commented on a post you commented on";
				break;

			default:
				# code...
				break;
		}

		// build unique post url 
		$link = "post.php?id=" . $post_id;

		// add notification to db
		$qry_str = "INSERT INTO soc_notifications(id, nt_user_to, nt_user_from, nt_text, nt_link, 
					nt_datetime, nt_opened, nt_viewed) 
                    VALUES('', '$to', '$loggedInUser', '$message', '$link', '$date_time', 'no', 'no')";

		echo $qry_str;

		$nt_sql = mysqli_query($this->conn, $qry_str);

	}

	public function getNotifications($user)
	{
		/* to-do
			FIX notifications!!!
		*/
		$loggedInUser = $this->user_obj->getUsername(); 

		// udate opened flag 
		$nt_qry = mysqli_query($this->conn ,
			"UPDATE soc_notifications
			 SET nt_viewed = 'yes' 
			 WHERE nt_user_to = '$loggedInUser' AND nt_user_from = '$user'");

		$qry_str = "SELECT * 
			 FROM soc_notifications
			 WHERE (nt_user_to = '$loggedInUser' AND nt_user_from = '$user') 
			 AND nt_opened = 'no'
			 ORDER BY nt_datetime DESC";

		echo $qry_str;

		$nt_qry1 = mysqli_query($this->conn ,$qry_str);

		print_r($nt_qry1);

		if (mysqli_num_rows($nt_qry1) > 0)
			$messages = mysqli_fetch_all($nt_qry1, MYSQL_ASSOC);
		else
			$messages = "none";

		return $messages;
	}

	public function getLastNotification($user)
	{
		$nts = $this->getNotifications($user);

		/*
		{ ["id"]=> string(2) "77" 
		  ["nt_user_to"]=> string(14) "maria_handschu" 
		  ["nt_user_from"]=> string(15) "joseph_handschu" 
		  ["nt_body"]=> string(21) "mari are you there? " 
		  ["nt_date"]=> string(19) "2017-12-01 20:45:38" 
		  ["nt_opened"]=> string(2) "no" 
		  ["nt_viewed"]=> string(2) "no" 
		  ["nt_deleted"]=> string(2) "no" 
		 } 
		*/

		$last_nt = array();
		$utils = new Utils();

		$last_nt_str = $nts[0]['nt_text'];
		$last_nt_time = $utils->postInterval($nts[0]['nt_datetime']);

		$last_nt['text']=$last_nt_str;
		$last_nt['time']=$last_nt_time;

		return $last_nt;
	}




}	

?>

