<?php
include("config.php");


session_start();

if (!isset($_POST['remove']))
{
	die("Access Blocked");
}

$list_id = $_POST['list_id'];

$query = pg_query("DELETE FROM List WHERE id = $list_id");
   
header('Location: myshop.php');
?>