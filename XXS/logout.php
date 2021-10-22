<?php

session_start();

if(isset($_COOKIE['token']))
{
	unset($_COOKIE['token']);

}

header("Location: main.php");
die;