<?php
include("../include/config.php");


session_start();

if (!isset($_SESSION['username']))
{
	die("Access Blocked");
}

if (!isset($_POST['action']))
{
	die("Access Blocked");
}

$action = $_POST['action'];

if ($action == 'add')
{
	$username    = $_SESSION['username'];
	$name        = $_POST['name'];
	$description = $_POST['description'];
	$price       = $_POST['price'];
	$stock       = $_POST['stock'];

	$item_id = pg_fetch_array(pg_query("INSERT INTO Item VALUES(DEFAULT, '$name', '$description', $price) RETURNING id"))['id'];
	pg_query("INSERT INTO List VALUES(DEFAULT, '$username', $item_id, $stock)");


	$image       = $_FILES['uploaded-image']['tmp_name'];

	move_uploaded_file($image, "../image/product/".$item_id.".jpg");
}
if ($action == 'edit')
{
	$list_id     = $_POST['list_id'];
	$name        = $_POST['name'];
	$description = $_POST['description'];
	$price       = $_POST['price'];
	$stock       = $_POST['stock'];
	
	pg_query("CALL edit_list('$list_id', '$name', '$description', $price, $stock)");


	$image       = $_FILES['uploaded-image']['tmp_name'];
	$item_id     = pg_fetch_array(pg_query("SELECT item_id FROM List WHERE id = ".$list_id))['item_id'];

	move_uploaded_file($image, "../image/product/".$item_id.".jpg");
}
if ($action == 'remove')
{
	$list_id     = $_POST['list_id'];

	$query = pg_query("DELETE FROM List WHERE id = $list_id");
}


header('Location: ../page/myshop.php');
?>