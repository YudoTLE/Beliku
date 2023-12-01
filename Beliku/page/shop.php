<?php
include('../include/config.php');


session_start();

$logged_in = isset($_SESSION['username']);
if (!$logged_in)
{
    header("Location: Login-Regist.php");
}

$page = 1;
if (isset($_GET['page']))
{
	$page = $_GET['page'];
}
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

        <section id="page-header">
            <div class="text">
                <h2>#StayAtHome</h2>
                <h4>buy everything what you want</h4>
            </div>
        </section>

        <section id="product1" class="section-p1">
            <div class="pro-container">
                <?php
                $username = $_SESSION['username'];
                $query = pg_query("SELECT l.id l_id, item_id, i.name, description, price, stock, a.name a_name FROM List l JOIN Item i ON item_id = i.id JOIN Account a ON owner_username = username WHERE owner_username != '$username' ORDER BY l.id LIMIT 8 OFFSET ($page - 1) * 8");

                while ($result = pg_fetch_array($query))
	            { 
                    echo "<form class='pro' method='POST' action='product.php'>";
                        include('../include/list.php');
                    echo "</form>";
                }
                ?>
            </div>
        
        <?php include('../include/pagination.php'); ?>

        <script src="../script/script.js"></script>
    </body>
</html>