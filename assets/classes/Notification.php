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

		$qry_str = "SELECT * 
		            FROM soc_notifications
		            WHERE msg_user_to = '$user' AND nt_viewed = 'no'";

		$msg_qry = mysqli_query($this->conn , $qry_str);

		$unopen_messages = ($msg_qry->num_rows);
		return $unopen_messages;
	}

}	

?>
