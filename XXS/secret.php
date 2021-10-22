<?php 

session_start();

	include("connection.php");
	include("functions.php");


	
	//simulate login of admin
	$user_name = "admin";

	

	//read from database
	$query = "select * from users where user_name = '$user_name' limit 1";
	$result = mysqli_query($con, $query);

	if($result)
	{
		if($result && mysqli_num_rows($result) > 0)
		{

			$user_data = mysqli_fetch_assoc($result);
			
			
			if(isset($_COOKIE['token']))
			{
				unset($_COOKIE['token']);

			}
			$cookie = $user_data['cookie'];
			setcookie('token', $cookie, time()+3600, '/');

			header("Location: index.php");
			die;
		
		}
	}
	
?>