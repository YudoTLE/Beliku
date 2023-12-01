<?php
include('../include/config.php');


session_start();

$logged_in = isset($_SESSION['username']);
if (!$logged_in)
{
    header("Location: Login-Regist.php");
}

$username = $_SESSION['username'];

$query  = pg_query("SELECT username, name, balance FROM Account WHERE username = '$username'");
$result = pg_fetch_array($query);

$name     = $result['name'];
$balance  = $result['balance'];


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
        <title>My Shop</title>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
        <link rel="stylesheet" href="../style/style.css">
    </head>

    <body>
        <?php include('../include/navigation.php'); ?>

        <section id="page-header">
            <div class="text">
                <h2>#GetRichWithBeliKu</h2>
                <h4>sell yours!</h4>
            </div>
        </section>
        
        <form action='productmyshop.php' method='POST'>
            <button class='butt'>Add</button>
        </form>

        <section id="product2" class="section-p1">
            <div class="pro-container">
                <?php
                $query = pg_query("SELECT l.id l_id, item_id, name, description, price, stock FROM List l JOIN Item i ON item_id = i.id WHERE owner_username = '$username' ORDER BY l.id LIMIT 8 OFFSET ($page - 1) * 8");
                
                while ($result = pg_fetch_array($query))
	            { 
                    echo "<form class='pro' method='POST' action='productmyshop.php'>";
                        include('../include/list.php');
                    echo "</form>";
                }
                ?>
            </div>
        </section>
        
        <?php include('../include/pagination.php'); ?>

        <script src="../script/script.js"></script>
    </body>
</html>