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
		$message_qry = mysqli_query($this->conn , 
			"SELECT msg_user_to, msg_user_from 
			 FROM soc_messages
			 WHERE msg_user_to = '$loggedInUser' 
			 OR msg_user_from = '$loggedInUser'
			 ORDER BY id DESC 
			 LIMIT 1");
		if (mysqli_num_rows($message_qry) == 0)
			$most_recent = false;
		else 
		{
			$row = mysqli_fetch_array($message_qry);

			$user_to = $row['user_to'];
			$user_from = $row['user_from'];

			if ($user_to != $loggedInUser)
				$most_recent = $user_to;
			else
				$most_recent = $user_from;	
		}
		return $most_recent;
	}
}

 ?>