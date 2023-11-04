<?php
include("config.php");


session_start();

if (!isset($_POST['edit_list']))
{
	die("Access Blocked");
}

$list_id     = $_POST['list_id'];
$name        = $_POST['name'];
$description = $_POST['description'];
$price       = $_POST['price'];
$stock       = $_POST['stock'];

// $query1 = pg_query("INSERT INTO Item VALUES(DEFAULT, '$name', '$description', $price) RETURNING id");
// $item_id = pg_fetch_array($query1)['id'];
// $query2 = pg_query("UPDATE List SET item_id = $item_id, stock = $stock WHERE id = $list_id");

$query = pg_query("CALL edit_list('$list_id', '$name', '$description', $price, $stock)");

header('Location: myshop.php');
?>
