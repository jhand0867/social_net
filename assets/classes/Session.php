<?php 
// Session.php
require_once("includes/chromephp/ChromePhp.php");

class Session
{
	protected $session_id;
	protected $user;
	protected $start_timestamp;
	protected $end_timestamp;


	public function __construct($conn)
	{
		$this->session_id = session_id();
		$this->user = $_SESSION['username'];
		
		if (! isset($_SESSION['username']))
		{
			$this->start_timestamp = date("Y-m-d H:i:s:u");

			$this->startSession($conn);
		}
	}

	public function __destruct()
	{

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
		
		$session_qry = mysqli_query( $connection ,
			"INSERT INTO soc_log(session_id,username,log,login_date_time,logout_date_time)
			 VALUES ('$this->session_id','$this->user',
			 	'$this->start_timestamp SESS Starting Session: $this->session_id','$this->start_timestamp','')");
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
			$rows = mysqli_fetch_all($log_sessions, MYSQL_ASSOC);
		}
		//ChromePhp::log($rows);
		return $rows;
	}
}

 ?>