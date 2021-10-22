<?php 
session_start();

	include("connection.php");
	include("functions.php");

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$desc = $_POST['desc'];

		
		set_user_desc($con, $user_name, $desc);

	}

	$user_data = check_login($con);


?>

<!DOCTYPE html>
<html>
<head>
	<title>My website</title>
	<link href="stylesheet.css" rel="stylesheet" type="text/css">

</head>
<body>

	<a href="logout.php">Logout</a>
	<h1>Profile</h1>
	<h2>Hello, <?php echo $user_data['user_name']; ?></h2>
	<?php if ($user_data['user_name'] === 'admin'){ ?>
		<h3>THM{XSS}</h3>
	<?php } ?>
	<h3><?php echo $user_data['user_description']?></h3>
	


	<form method="post">
		<div id="box">
			<div style="font-size: 20px;margin: 10px;color: white;">Submit description</div>
			<input type="hidden" name="user_name" value="<?php echo $user_data['user_name'] ?>">

			<input id="text" name="desc"><br><br>
			<input id="button" type="submit" value="Submit"><br><br>
		</div>


	</form>
	
</body>
</html>