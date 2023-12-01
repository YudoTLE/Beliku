<?php
include('../include/config.php');


session_start();

if(!isset($_POST['logout']))
{
    die("Access Blocked");
}

unset($_SESSION['username']);
header('Location: ../page/beranda.php');
?>
