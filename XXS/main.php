<?php 

session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];
		$form = $_POST['form'];

		if ($form == "login") {
			if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
			{

				//read from database
				$query = "select * from users where user_name = '$user_name' limit 1";
				$result = mysqli_query($con, $query);

				if($result)
				{
					if($result && mysqli_num_rows($result) > 0)
					{

						$user_data = mysqli_fetch_assoc($result);
						
						if($user_data['password'] === md5($password))
						{
							$cookie = $user_data['cookie'];
							setcookie('token', $cookie, time()+3600, '/');

							header("Location: index.php");
							die;
						}
					}
				}
				
				echo "Wrong username or password!";
			}else
			{
				echo "Wrong username or password!";
			}
		} else if ($form == "signup") {

			if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
			{   
				//check if exists
				$query = "select * from users where user_name = '$user_name' limit 1";
				$result = mysqli_query($con, $query);

				if(mysqli_num_rows($result) == 0){
					//save to database
				
					$user_id = random_num(20);
					$user_name = preg_replace(('/[^a-z0-9]/'),'',$user_name);
					$password = md5($password);
					$cookie = md5(microtime().print_r($_SERVER, true).rand());


					$query = "insert into users (user_id, user_name, password, cookie) values ('$user_id','$user_name','$password','$cookie')";
					$result = mysqli_query($con, $query);

					
					if($result)
					{
						header("Location: index.php");
						die;
					}

				} else
					echo "User exists.";

				

			}else
			{
				echo "Please enter some valid information!";
			}

			}
		
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Main Website</title>
	<link href="style.css" rel="stylesheet">

</head>
<body>
	<div id="container">
		<div id="header">Company Name</div>
		<div id="box">
            <input type="checkbox" class="toggle-btn">

			<div id="login">
				<form method="post">
					<div style="font-size: 20px;margin: 10px;color: white;">Login</div>
                    
                    <span>Username</span>
					<input class="text" type="text" name="user_name">

                    <br><br>

					<!--- Please remember to remove print check for password --->
                    <span>Password</span>
					<input class="text" type="password" name="password">

                    <br><br>

					<input class="button" type="submit" value="Login">

					<input type="hidden" name="form" value="login">

				</form>
			</div>

            <div id="signup">
            <form method="post">
					<div style="font-size: 20px;margin: 10px;color: white;">Sign Up</div>
                    
                    <span>Username</span>
					<input class="text" type="text" name="user_name">

                    <br><br>

					<!--- Please remember to remove print check for password --->
                    <span>Password</span>
					<input class="text" type="password" name="password">
                    
                    <br><br>

					<input class="button" type="submit" value="Sign Up">

					<input type="hidden" name="form" value="signup">


				</form>
            </div>

		</div>

		<div id="footer">.</div>
	</div>
</body>
</html>