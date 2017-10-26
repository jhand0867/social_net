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
		$msg_qry = mysqli_query($this->conn ,
			"SELECT * 
			 FROM soc_messages
			 WHERE msg_user_to = '$user' AND msg_deleted = 'no'");
		if (mysqli_num_rows($msg_qry) > 0)
			$messages = mysqli_fetch_all($msg_qry, MYSQL_ASSOC);
		else
			$messages = "none";

		return $messages;
	}
}

 ?>