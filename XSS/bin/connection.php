<?php

$dbhost = "localhost";
$dbuser = "admin";
$dbpass = "password";
$dbname = "CTF2";


if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
	die("Failed to connect!");
}
