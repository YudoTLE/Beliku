<?php
include('config.php');


session_start();

$logged_in = isset($_SESSION['username']);
if (!$logged_in)
{
    die('Access Blocked');
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
    	<title>My Shop</title>
    </head>
    <body>
        <header>
	    	<h1>My Shop</h1>
	    </header>

        <form action='index.php' method='POST'>
	        <input type='submit' name='home' value='home' />
	    </form>

        <?php
	    $query = pg_query("SELECT l.id l_id, name, description, price, stock FROM List l JOIN Item i ON item_id = i.id WHERE owner_username = '$username'");
        echo "<table border='1'>";
            echo "<thead>";
                echo "<tr>";
                    echo "<th>Name</th>";
                    echo "<th>Description</th>";
                    echo "<th>Price</th>";
                    echo "<th>Stock</th>";
                    echo "<th>Action</th>";
                echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
                while ($result = pg_fetch_array($query))
                {
                    $list_id          = $result['l_id'];
                    $item_name        = $result['name'];
                    $item_description = $result['description'];
                    $item_price       = $result['price'];
                    $item_stock       = $result['stock'];

                    echo "<tr>";
	    	    	    echo "<td>$item_name</td>";
                        echo "<td>$item_description</td>";
                        echo "<td>$item_price</td>";
                        echo "<td>$item_stock</td>";
                        echo "<td>";
                            echo "<form action='edit_list.php' method='POST'>";
                                echo "<input type='hidden' name='list_id' value='$list_id' />";
	                            echo "<input type='submit' name='edit_list' value='edit_list' />";
	                        echo "</form>";
                            echo "<form action='remove_list_process.php' method='POST'>";
                                echo "<input type='hidden' name='list_id' value='$list_id' />";
	                            echo "<input type='submit' name='remove' value='remove' />";
	                        echo "</form>";
                        echo"</td>";
                    echo "</tr>";
                }
            echo "</tbody>";
        echo "</table>";

        echo "<form action='add_list.php' method='POST'>";
	        echo "<input type='submit' name='add_list' value='add_list' />";
	    echo "</form>";
        ?>
	</body>
</html>
