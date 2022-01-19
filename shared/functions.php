<?php

function check_login($con)
{

	if(isset($_SESSION['user_id']))
	{

		$id = $_SESSION['user_id'];
		$query = "select * from users where user_id = '$id'";

		// $query = "select * from users where user_id = '$id' limit 1";

		$result = mysqli_query($con,$query);
		if($result && mysqli_num_rows($result) > 0)
		{

			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}


		//redirect to login
		header("Location: login.php");
		die;


	} else if(isset($_COOKIE['token']))
	{

		$cookie = $_COOKIE['token'];

		$query = "select * from users where cookie = '$cookie' limit 1";

		$result = mysqli_query($con,$query);
		if($result && mysqli_num_rows($result) > 0)
		{

			$user_data = mysqli_fetch_assoc($result);

			return $user_data;
		}

		//redirect to login
		header("Location: main.php");
		die;
	}


}


function set_user_desc($con, $user_name, $desc)
{

	if(isset($user_name) && isset($desc))
	{
        
        //update user description
		// $query = "select * from users where cookie = '$cookie' limit 1";


        $query = "UPDATE users
                    SET user_description = '$desc'
                    WHERE user_name = '$user_name'";

		$result = mysqli_query($con,$query);
		
	}
	if ($user_name === 'admin'){
		header("Location: secret.php");
	}


	//redirect to login
	header("Location: index.php");
	die;

}

function random_num($length)
{

	$text = "";
	if($length < 5)
	{
		$length = 5;
	}

	$len = rand(4,$length);

	for ($i=0; $i < $len; $i++) { 
		# code...

		$text .= rand(0,9);
	}

	return $text;
}
