<?php
include('../include/config.php');


session_start();

if(!isset($_POST['topup']))
{
    die("Access Blocked");
}

$username = $_SESSION['username'];
$amount   = $_POST['amount'];

$query  = pg_query("UPDATE Account SET balance = balance + $amount WHERE username = '$username'");
$result = pg_fetch_array($query);

header('Location: ../page/beranda.php');
?>