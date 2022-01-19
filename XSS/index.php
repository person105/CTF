<?php 
session_start();

	include("../shared/connection.php");
	include("../shared/functions.php");

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
	<link href="../shared/site_style_2.css" rel="stylesheet" type="text/css">

</head>
<body>

	<div class="container">
		<div id="header">Hello, <?php echo $user_data['user_name']; ?></div>

		<form method="post">
			<div class="box">

				<?php if ($user_data['user_name'] === 'admin'){ ?>
					<h3>THM{XSS}</h3>
				<?php } ?>

				<div style="font-size: 20px;margin: 10px;color: black;">Submit user description</div>

				<h3><?php echo $user_data['user_description']?></h3>

				<input type="hidden" name="user_name" value="<?php echo $user_data['user_name'] ?>">

				<input class="input-field" name="desc"><br><br>
				<input class="button" type="submit" value="Submit"><br><br>

				<a href="logout.php">Logout</a>

			</div>
		</form>
	</div>
	
	
</body>
</html>

