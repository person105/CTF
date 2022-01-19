<?php 
session_start();

	include("../shared/connection.php");
	include("../shared/functions.php");

	$user_data = check_login($con);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Company Name</title>
	<link href="../shared/site_style_1.css" rel="stylesheet">

</head>
<body>

	<div class="container">
		<div id="header-box">
			<div class="header">
				Hello, <?php echo $user_data['user_name']; ?>
			</div>

		</div>
		<div class="content">
			<div class="text">
				<h2>{TAG}</h2>
				<a href="logout.php">Logout</a>
			</div>
			
		</div>


	</div>


	
</body>
</html>