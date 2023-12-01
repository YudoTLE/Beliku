<?php
include('../include/config.php');


session_start();

$logged_in = isset($_SESSION['username']);
if (!$logged_in)
{
    header("Location: Login-Regist.php");
}

if (!isset($_POST['status']))
{
    $status = 'in';
}
else
{
    $status = $_POST['status'];
}

$username = $_SESSION['username'];

$query  = pg_query("SELECT username, name, balance FROM Account WHERE username = '$username'");
$result = pg_fetch_array($query);

$name     = $result['name'];
$balance  = $result['balance'];
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>History</title>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
        <link rel="stylesheet" href="../style/style.css">
    </head>

    <body>
        <?php include('../include/navigation.php'); ?>

        <section id="cont">
        <div class="container">
            <div class="history">
                <div class="title">Transaction History</div>
            </div>
            <?php
            $query = pg_query("SELECT t.id t_id, a.name a_seller, i.name i_name, t.amount t_amount, t.date t_date, i.price i_price FROM Transaction t JOIN Account a ON a.username = t.seller_username JOIN Item i ON i.id = t.item_id WHERE t.buyer_username = '$username'");
            echo "<table border='1'>";
                echo "<thead>";
                    echo "<tr>";
                        echo "<th>Transaction ID</th>";
                        echo "<th>Seller</th>";
                        echo "<th>Item Name</th>";
                        echo "<th>Amount</th>";
                        echo "<th>Date</th>";
                        echo "<th>Total</th>";
                    echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while ($result = pg_fetch_array($query))
                {
                    $transaction_id  = $result['t_id'];
                    $seller_username = $result['a_seller'];
                    $item_name       = $result['i_name'];
                    $amount          = $result['t_amount'];
                    $date            = $result['t_date'];
                    $total           = $result['i_price'] * $amount;

                    echo "<tr>";
	        		    echo "<td>$transaction_id</td>";
                        echo "<td>$seller_username</td>";
                        echo "<td>$item_name</td>";
                        echo "<td>$amount</td>";
                        echo "<td>$date</td>";
                        echo "<td>$total</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
            echo "</table>";
            ?>
        </div>
        </section>

        <script src="../script/script.js"></script>
    </body>
</html>