<?php 
// global_utils.php

// make string safe

class Utils 
{

	public function stringSafe( $stringToSafe )
	{
		$safeString = strip_tags($stringToSafe); 
		$safeString = mysqli_real_escape_string( $this->conn , $safeString );

		return $safeString;
	}

	// calculate time since last post

	public function postInterval( $post_date_time )
	{

		$date_time_now = date("Y-m-d H:i:s");

		$start_date = new DateTime($post_date_time);
		$end_date = new DateTime($date_time_now);
		$interval = $start_date->diff($end_date);

		if ( $interval->y >= 1 )
		{
			if ( $interval->y == 1 )
			{
				$time_message = $interval-y . " year ago";
			}
			else
			{
				$time_message = $interval-y . " years ago";
			}
		}
		else if ( $interval->m >= 1 )
		{
			if ( $interval->d == 0 )
			{
				$days = $interval->d . " ago";
			}
			else if ( $interval->d == 1)
			{
				$days =  $interval->d . " day ago";
			}
			else
			{
				$days =  $interval->d . " days ago";
			}

			if ( $interval->m == 1 )
			{
				$time_message = $interval->m . " month" . $days;
			}
			else
			{
				$time_message = $interval->m . " months" . $days;	
			}
		}

		else if ($interval->d >= 1)
		{
			if ( $interval->d == 1)
			{
				$time_message = " yesterday";
			}
			else
			{
				$time_message =  $interval->d . " days ago";
			}
		}

		else if ($interval->h >= 1 )
		{
			if ( $interval->h == 1)
			{
				$time_message = $interval->h . " hour ago";
			}
			else
			{
				$time_message =  $interval->h . " hours ago";
			}
		}

		else if ($interval->i >= 1 )
		{
			if ( $interval->i == 1)
			{
				$time_message = $interval->i . " minute ago";
			}
			else
			{
				$time_message =  $interval->i . " minutes ago";
			}
		}

		else 
		{
			if ($interval->s < 30 )
			{

				$time_message = " Just now";
			}
			else
			{
				$time_message =  $interval->s . " seconds ago";
			}
		}

		return $time_message;
	}


}

?>