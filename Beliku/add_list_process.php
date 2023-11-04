<?php
include('config.php');


session_start();

if (!isset($_POST['add_list']))
{
	die('Access Blocked');
}

$username    = $_SESSION['username'];
$name        = $_POST['name'];
$description = $_POST['description'];
$price       = $_POST['price'];
$stock       = $_POST['stock'];

$query1 = pg_query("INSERT INTO Item VALUES(DEFAULT, '$name', '$description', $price) RETURNING id");
$item_id = pg_fetch_array($query1)['id'];
$query2 = pg_query("INSERT INTO List VALUES(DEFAULT, '$username', $item_id, $stock)");

header('Location: myshop.php');
?>
