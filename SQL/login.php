<?php 


session_start();

	$error = "";
	$query = "";


	include("../shared/connection.php");
	include("../shared/functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];
		$hash = md5($password);

		if(!empty($user_name) && !empty($password))
		{

			//read from database
			$query = "select * from users where user_name = '$user_name' and password = '$hash' limit 1";
			
			// print($query."\n");
			$result = mysqli_query($con, $query) or print(mysqli_error($con)."\n");


			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);

					
					// if($user_data['password'] === md5($password))
					// {

						$_SESSION['user_id'] = $user_data['user_id'];
						$error = "";

						header("Location: index.php");
						die;
					// }
				}
			}
			
			$error = "Wrong username or password!";
		}else
		{
			$error = "Wrong username or password!";
		}
	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Main Website</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
	<script src="login.js"></script>  


	<link href="../shared/login_style_1.css" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<style>
  	.error{
    	color: red;
		font-size: 18px;
        font-style: italic;
		left: 0;
		padding-top: 10px;
		padding-bottom: 10px;    
    }
  </style>

<body>
	<div id="container">
		<div id="header">Company Name</div>

		<div class="filler">.</div>

		<div class="content">
			<div id="box">
				<form method="post" id="login">
					<div style="font-size: 20px;margin: 10px;color: white;">Login</div>
					
					<span>Username</span>
					<input class="text" type="text" name="user_name">

					<br><br>

					<!--- Please remember to remove print check for password --->
					<span>Password</span>
					<input class="text" type="password" name="password">

					<br><br>

					<input class="button" type="submit" value="Login">


					<br><br>

					<div class="error"><?php echo $error ?></div>


				</form>
			
		
			</div>
		</div>

		<div id="helpbar">
			<input type="checkbox" class="toggle">
			<div class="textbox">
				<div class="text">
					Hint: How do you alter the conditions of the query to be true?
					<br><br>
					<span style="color: red;"><?php echo $query ?></span>
				</div>
			</div>
		</div>


		<div id="footer">.</div>
	</div>

	
</body>
</html>