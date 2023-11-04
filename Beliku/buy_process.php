<?php
include('config.php');


session_start();

if (!isset($_POST['buy']))
{
	die('Access Blocked');
}

$buyer_username = $_SESSION['username'];
$list_id        = $_POST['list_id'];
$amount         = $_POST['amount'];

$query = pg_query("SELECT buy('$buyer_username', $list_id, $amount)");
// echo pg_fetch_row($query)[0];

header('Location: index.php');
?>
