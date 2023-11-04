<?php
include('config.php');


session_start();

if (!isset($_SESSION['username']) or !isset($_POST['buy']))
{
    die("Access Blocked");
}

$list_id = $_POST['list_id'];

$query  = pg_query("SELECT name, description, price, stock FROM List l JOIN Item i ON item_id = i.id WHERE l.id = $list_id");
$result = pg_fetch_array($query);

$name        = $result['name'];
$description = $result['description'];
$price       = $result['price'];
$stock       = $result['stock'];
?>

<!DOCTYPE html>
<html>
	<head>
	    <title>Buy Item</title>
	</head>
	<body>
    	<form action='buy_process.php' method='POST'><fieldset>
            <?php
            echo "<h1>$name</h1>";
            echo "<p>$description</p>";
            echo "<p>price: $price</p>";
            echo "<p>stock: $stock</p>";

            echo "<input type='hidden' name='list_id' value=$list_id>";
            
            echo "<p>";
                echo "<label for'amount'>Amount </label>";
                echo "<input type='number' name='amount' min=1 max=$stock value=1 />";
            echo "</p>";
			echo "<p>";
				echo "<input type='submit' name='buy' value='buy' />";
			echo "</p>";
            ?>            
		</fieldset></form>
	</body>
</html>
