<?php 
session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

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
                    header("Location: login.php");
                    die;
                }
            } else
                echo "User exists.";

			

		}else
		{
			echo "Please enter some valid information!";
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
	<link href="style.css" rel="stylesheet" type="text/css">

</head>
<body>


	<div id="box">
		
		<form method="post">
			<div style="font-size: 20px;margin: 10px;color: white;">Signup</div>

			<input id="text" type="text" name="user_name"><br><br>
			<input id="text" type="password" name="password"><br><br>

			<input id="button" type="submit" value="Signup"><br><br>

			<a href="login.php" style="font-size: 15px;margin: 10px;color: white;">Click to Login</a><br><br>
		</form>
	</div>
</body>
</html>