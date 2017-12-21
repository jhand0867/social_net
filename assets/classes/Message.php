<?php 
// Message.php

require_once "Utils.php";

class Message
{
	private $user_obj;
	private $conn;

	public function __construct($conn , $user)
	{
		$this->conn = $conn;
		$this->user_obj = new User( $conn , $user );
	}

	public function getMostRecentUser()
	{
		$loggedInUser = $this->user_obj->getUsername();
		$most_recent = false;

		// find who received or send the most recent message
		$msg_qry = mysqli_query($this->conn , 
			"SELECT msg_user_to, msg_user_from 
			 FROM soc_messages
			 WHERE msg_user_to = '$loggedInUser' 
			 OR msg_user_from = '$loggedInUser'
			 ORDER BY id DESC 
			 LIMIT 1");
		if (mysqli_num_rows($msg_qry) == 0)
			$most_recent = false;
		else 
		{
			$row = mysqli_fetch_array($msg_qry);

			$user_to = $row['msg_user_to'];
			$user_from = $row['msg_user_from'];

			if ($user_to != $loggedInUser)
				$most_recent = $user_to;
			else
				$most_recent = $user_from;	
		}
		return $most_recent;
	}

	public function sendMessage($user, $msg, $date)
	{
		//echo "in sendMessage, $msg ";
		if ($msg != '')
		{
			$loggedInUser = $this->user_obj->getUsername();
			$msg_qry = mysqli_query($this->conn ,
				"INSERT INTO soc_messages(id, msg_user_to, msg_user_from, msg_body, 
					msg_date, msg_opened, msg_viewed, msg_deleted)
			    VALUES('','$user','$loggedInUser','$msg','$date','no','no','no')");
		}
	}

	public function getMessages($user)
	{
		$loggedInUser = $this->user_obj->getUsername();

		// udate opened flag 
		$msg_qry = mysqli_query($this->conn ,
			"UPDATE soc_messages
			 SET msg_opened = 'yes' 
			 WHERE msg_user_to = '$loggedInUser' AND msg_user_from = '$user'");

		$msg_qry1 = mysqli_query($this->conn ,
			"SELECT * 
			 FROM soc_messages
			 WHERE ((msg_user_to = '$loggedInUser' AND msg_user_from = '$user') 
			 OR (msg_user_from = '$loggedInUser' AND msg_user_to = '$user')) AND msg_deleted = 'no'
			 ORDER BY msg_date DESC");
		if (mysqli_num_rows($msg_qry1) > 0)
			$messages = mysqli_fetch_all($msg_qry1, MYSQL_ASSOC);
		else
			$messages = "none";

		return $messages;
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
		$qry_str = "UPDATE soc_messages
			 SET msg_viewed = 'yes' 
			 WHERE msg_user_to = '$loggedInUser'";
	
		$msg_qry = mysqli_query($this->conn , $qry_str);

		$qry_str = "SELECT msg_user_to, msg_user_from
			 FROM soc_messages
			 WHERE ((msg_user_to = '$loggedInUser') 
			 OR (msg_user_from = '$loggedInUser')) AND msg_deleted = 'no'
			 ORDER BY msg_date DESC ";

		//echo $qry_str;

		$msg_qry1 = mysqli_query($this->conn , $qry_str	);
		
		while ($row = mysqli_fetch_array($msg_qry1))
		{
			$user_to_push = ($row['msg_user_to'] != $loggedInUser) ? $row['msg_user_to'] : $row['msg_user_from'];

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

	public function getLastMessage($user)
	{
		$msg = $this->getMessages($user);

		/*
		{ ["id"]=> string(2) "77" 
		  ["msg_user_to"]=> string(14) "maria_handschu" 
		  ["msg_user_from"]=> string(15) "joseph_handschu" 
		  ["msg_body"]=> string(21) "mari are you there? " 
		  ["msg_date"]=> string(19) "2017-12-01 20:45:38" 
		  ["msg_opened"]=> string(2) "no" 
		  ["msg_viewed"]=> string(2) "no" 
		  ["msg_deleted"]=> string(2) "no" 
		 } 
		*/

		$last_msg = array();
		$utils = new Utils();

		$last_msg_str = $msg[0]['msg_body'];
		$last_msg_time = $utils->postInterval($msg[0]['msg_date']);

		$last_msg['text']=$last_msg_str;
		$last_msg['time']=$last_msg_time;

		return $last_msg;
	}

	public function countUnopenedMessages($user)
	{
		$unopen_messages = 0;

		$qry_str = "SELECT * 
		            FROM soc_messages
		            WHERE msg_user_to = '$user' AND msg_viewed = 'no'";

		$msg_qry = mysqli_query($this->conn , $qry_str);

		$unopen_messages = ($msg_qry->num_rows);
		return $unopen_messages;
	}
}

 ?>