<?php
include('config.php');


session_start();

$logged_in = isset($_SESSION['username']);
?>

<!DOCTYPE html>
<html>
    <head>
    	<title>Shop</title>
    </head>
    <body>
	    <header>
	    	<h1>Shop</h1>
	    </header>

        <form action='index.php' method='POST'>
	        <input type='submit' name='home' value='home' />
	    </form>

        <?php
        if ($logged_in)
        {
            $username = $_SESSION['username'];
	        $query = pg_query("SELECT l.id l_id, i.name, description, price, stock, a.name a_name FROM List l JOIN Item i ON item_id = i.id JOIN Account a ON owner_username = username WHERE owner_username != '$username'");
        }
        else
        {
	        $query = pg_query("SELECT l.id l_id, i.name, description, price, stock, a.name a_name FROM List l JOIN Item i ON item_id = i.id JOIN Account a ON owner_username = username");
        }
        echo "<table border='1'>";
            echo "<thead>";
                echo "<tr>";
                    echo "<th>Name</th>";
                    echo "<th>Description</th>";
                    echo "<th>Price</th>";
                    echo "<th>Stock</th>";
                    echo "<th>Owner</th>";
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
                    $owner_name       = $result['a_name'];

                    echo "<tr>";
	    	    	    echo "<td>$item_name</td>";
                        echo "<td>$item_description</td>";
                        echo "<td>$item_price</td>";
                        echo "<td>$item_stock</td>";
                        echo "<td>$owner_name</td>";
                        echo "<td>";
                            echo "<form action='buy.php' method='POST'>";
                                echo "<input type='hidden' name='list_id' value='$list_id' />";
	                            echo "<input type='submit' name='buy' value='buy' />";
	                        echo "</form>";
                        echo"</td>";
                    echo "</tr>";
                }
            echo "</tbody>";
        echo "</table>";
        ?>
	</body>
</html>
