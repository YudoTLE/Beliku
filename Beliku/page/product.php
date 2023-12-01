<?php
include('../include/config.php');


session_start();

$logged_in = isset($_SESSION['username']);
if (!$logged_in)
{
    header("Location: Login-Regist.php");
}

if (!isset($_POST['list_id']))
{
    die("Access Blocked");
}

$list_id = $_POST['list_id'];

$query  = pg_query("SELECT item_id, name, description, price, stock FROM List l JOIN Item i ON item_id = i.id WHERE l.id = $list_id");
$result = pg_fetch_array($query);

$item_id     = $result['item_id'];
$name        = $result['name'];
$description = $result['description'];
$price       = $result['price'];
$stock       = $result['stock'];
?>


<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Shop</title>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
        <link rel="stylesheet" href="../style/style.css">
    </head>

    <body> 
        <?php include('../include/navigation.php'); ?>
        
        <section id="prodetails" class="section-p1">
            <div class="single-pro-image">
                <?php
                if (file_exists("../image/product/".$item_id.".jpg"))
                    echo "<img src='../image/product/".$item_id.".jpg' width='100%' id='image-display' alt=''>";
                else
                    echo "<img src='../image/ui/logo.png' width='100%' id='image-display' alt=''>";
                ?>
            </div>

            <div class="single-pro-details">
                <?php
                echo "<form action='../process/buy_process.php' method='POST'>";
                    echo "<input type='hidden' name='buy' value='buy'>";
                    echo "<input type='hidden' name='list_id' value=$list_id>";

                    echo "<h4>$name</h4>";
                    echo "<h2>$price</h2>";
                    echo "<input type='number' name='amount' value='1'>";
                    echo "<button class='normal'>Check Out</button>";
                    echo "<h4>Product Details</h4>";
                    echo "<span>$description</span>";
                echo "</form>";
                ?>
            </div>
        </section>

        <script src="../script/script.js"></script>
    </body>
</html>