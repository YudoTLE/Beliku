<?php
include("config.php");


session_start();

if (!isset($_POST['register']))
{
	die("Access Blocked");
}

$username = $_POST['username'];
$password = $_POST['password'];
$name     = $_POST['name'];

$query = pg_query("INSERT INTO Account VALUES('$username', '$password', '$name', 0)");
    
if($query)
{
	$_SESSION['username'] = $username;
	header('Location: index.php');
}
else
{
	header('Location: registration.php');
}
?>
