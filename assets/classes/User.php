<?php 
// User.ph
// Logic

class User
{
	private $user;
	private $conn;

	public function __construct($conn , $user)
	{
		echo "creae User obj <br>";
		$this->conn = $conn;
		$user_details_qry = mysqli_query($conn, "SELECT * FROM soc_users WHERE username = '$user'");
		$this->$user = mysqli_fetch_array($user_details_qry);
		
	}

	public function getUsername()
	{
		echo "getUserName <br>";
		return $this->user['username'];
	}

	public function getNumPosts()
	{
		echo "getNumPosts <br>";
		return $this->user['num_post'];
	}

	public function increaseNumPost()
	{
		echo "increase <br>";
		$num_posts = $this->user['num_posts']++;
		$update_num_post = mysqli_query($this->conn, "UPDATE soc_users SET num_post = '$num_posts'");
	}


	public function getFirstAndLastName()
	{
		$username = $this->user['username'];
		$firstAndLastName = $this->user['first_name'] . " " . $this->user['last_name'];
		return $firstAndLastName;
	}
}

 ?>