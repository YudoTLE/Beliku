<?php
include('config.php');


session_start();

$logged_in = isset($_SESSION['username']);
if (!$logged_in)
{
    die('Access Blocked');
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
<html>
    <head>
    	<title>Transaction History</title>
    </head>
    <body>
        <header>
	    	<h1>Transaction History</h1>
	    </header>

        <form action='index.php' method='POST'>
	        <input type='submit' name='home' value='home' />
	    </form>

        <table><tbody><tr>
            <td><form action='transaction_history.php' method='POST'>
                <input type='submit' name='status' value='in' />
            </form></td>
            <td><form action='transaction_history.php' method='POST'>
                <input type='submit' name='status' value='out' />
            </form></td>
        </tr></tbody></table>
        
        <?php
        if ($status == 'in')
        {
            $query = pg_query("SELECT t.id t_id, a.name a_buyer, i.name i_name, t.amount t_amount, t.date t_date, i.price i_price FROM Transaction t JOIN Account a ON a.username = t.buyer_username JOIN Item i ON i.id = t.item_id WHERE t.seller_username = '$username'");
            echo "<table border='1'>";
                echo "<thead>";
                    echo "<tr>";
                        echo "<th>Transaction ID</th>";
                        echo "<th>Buyer</th>";
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
                    $seller_username = $result['a_buyer'];
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
        }
        if ($status == 'out')
        {
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
        }
        ?>
	</body>
</html>
