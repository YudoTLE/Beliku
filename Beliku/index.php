<?php
include('config.php');


session_start();

$logged_in = isset($_SESSION['username']);
if ($logged_in)
{
    $username = $_SESSION['username'];

    $query  = pg_query("SELECT username, name, balance FROM Account WHERE username = '$username'");
    $result = pg_fetch_array($query);

    $name     = $result['name'];
    $balance  = $result['balance'];
}
?>

<!DOCTYPE html>
<html>
    <head>
    	<title>Beliku</title>
    </head>
    <body>
	    <header>
            <?php
	    	if ($logged_in)
            {
                echo "<h1>$name</h1>";
            }
            else
            {
                echo "<h1>Unlogged User</h1>";
            }
            ?>
	    </header>
        
        <?php
        if ($logged_in)
        {
            echo "<form action='logout_process.php' method='POST'>";
	    	    echo "<input type='submit' name='logout' value='logout' />";
	        echo "</form>";
        
            echo "<p>Balance: $balance</p>";
        
            echo "<table><tbody><tr>";
                echo "<td><form action='topup.php' method='POST'>";
	    	        echo "<input type='submit' name='topup' value='topup' />";
	            echo "</form></td>";
                echo "<td><form action='transaction_history.php' method='POST'>";
                    echo "<input type='submit' name='transaction_history' value='transaction_history' />";
                echo "</form></td>";
                echo "<td><form action='myshop.php' method='POST'>";
	    	        echo "<input type='submit' name='myshop' value='myshop' />";
	            echo "</form></td>";
                echo "<td><form action='shop.php' method='POST'>";
	                echo "<input type='submit' name='shop' value='shop' />";
                echo "</form></td>";
            echo "</tr></tbody></table>";
        }
        else
        {
            echo "<table><tbody><tr>";
                echo "<td><form action='login.php' method='POST'>";
                    echo "<input type='submit' name='login' value='login' />";
                echo "</form></td>";
                echo "<td><form action='registration.php' method='POST'>";
                    echo "<input type='submit' name='register' value='register' />";
                echo "</form></td>";
            echo "</tr></tbody></table>";
        }
        ?>
        
	</body>
</html>
