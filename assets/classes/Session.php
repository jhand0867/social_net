<?php 
// Session.php
require_once("includes/chromephp/ChromePhp.php");

class Session
{
	protected $session_id;
	protected $user;
	protected $start_timestamp;
	protected $end_timestamp;
	protected $connection;


	public function __construct($conn)
	{
		//echo "Session Started !!";
		$this->session_id = $_SESSION['session_id'];
		$this->user = $_SESSION['username'];
		$this->connection = $conn;

		//print_r($_SESSION);
		
		if (isset($_SESSION['session_id']))
		{
			$this->start_timestamp = date("Y-m-d H:i:s:u");

			$this->startSession($conn);
		}
	}

	public function __destruct()
	{
		//echo "Session Out !!";
		$this->end_timestamp = date("Y-m-d H:i:s:u");
		$this->updateSessionLog($this->connection, "SESS:", "User out " );

		// find session record

		$session_qry = mysqli_query( $this->connection ,	
			"SELECT * 
			FROM soc_log
			WHERE session_id = '$this->session_id' 
			AND logout_date_time = '0000-00-00 00:00:00' ");
		if (mysqli_num_rows($session_qry) > 0)
		{
			$session_data = mysqli_fetch_array($session_qry);
			$logupdate = $session_data['log'];
			$logupdate .=  "\r\nwhat ever....";
		}
		else
		{
			$logupdate = '';
		}
		// add comment to log


		$session_qry = mysqli_query( $this->connection ,
			"UPDATE soc_log 
			 SET log = '$logupdate',logout_date_time ='$this->end_timestamp'
			 WHERE session_id = '$this->session_id' 
			 AND logout_date_time = '0000-00-00 00:00:00'");

	}

	public function __set($variable , $value)
	{

		$this->$variable = $value;
	}

	public function __get($variable)
	{
		return $this->$variable;
	}

	private function startSession( $connection )
	{
		
		// check if session is already in DB
		$log_sessions = mysqli_query( $connection ,
			"SELECT session_id 
			 FROM soc_log
			 WHERE session_id = '$this->session_id'");
		if (mysqli_num_rows($log_sessions) == 0)
		{
			$session_qry = mysqli_query( $connection ,
				"INSERT INTO soc_log(session_id,username,log,login_date_time,logout_date_time)
			 	VALUES ('$this->session_id','$this->user',
			 		'$this->start_timestamp SESS Starting Session: $this->session_id','$this->start_timestamp','')");
		}
	}

	public function updateSessionLog( $connection , $app, $log_line)
	{
		$log = "";
		$log_field = mysqli_query( $connection ,
			"SELECT log 
			 FROM soc_log
			 WHERE username = '$this->user' AND logout_date_time='' ");
		if (mysqli_num_rows($log_field) > 0)
		{
			$rows = mysqli_fetch_array($log_field);
			$log = $rows['log'];
		}

		$log_line_date = date("Y-m-d H:i:s:u");

		$log = $log . "/r/n" .$log_line_date ." ". $app ." ". $log_line;

		$upd_log = mysqli_query( $connection ,
			"UPDATE soc_log(log) VALUES('$log')
			 WHERE username = '$this->user' AND logout_date_time=''");
	}

	public function getActiveSessions( $connection )
	{
		$rows = "none";
		//ChromePhp::log("SELECT username, login_date_time 
		//	 FROM soc_log
		//	 WHERE logout_date_time='0000-00-00 00:00:00' ");


		$log_sessions = mysqli_query( $connection ,
			"SELECT username, login_date_time 
			 FROM soc_log
			 WHERE logout_date_time='0000-00-00 00:00:00' ");
		//ChromePhp::log(mysqli_num_rows($log_sessions));
		if (mysqli_num_rows($log_sessions) > 0)
		{
			$rows = mysqli_fetch_all($log_sessions);
		}
		//ChromePhp::log($rows);
		return $rows;
	}
}

 ?>