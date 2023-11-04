<?php
include('config.php');


session_start();

if(!isset($_POST['login']))
{
    die("Access Blocked");
}

$username = $_POST['username'];
$password = $_POST['password'];

$query  = pg_query("SELECT COUNT(username) cnt FROM Account WHERE username = '$username' AND password = '$password'");
$result = pg_fetch_array($query);

$found = $result['cnt'];

if ($found)
{
    $_SESSION['username'] = $username;
    header('Location: index.php');
}
else
{
    header('Location: login.php');
}
?>
