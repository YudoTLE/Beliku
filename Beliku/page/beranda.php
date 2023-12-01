<?php
include('../include/config.php');


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
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BeliKu</title>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
        <link rel="stylesheet" href="../style/style.css">
    </head>

    <body>
        <?php include('../include/navigation.php') ?>

        <section id="hero">
            <?php
            if ($logged_in)
            {
                echo "<div class='fe-box'>";
                    echo "<img src='../image/ui/balance.svg' width = 50% alt=''>";
                    echo "<h6>Rp$balance</h6>";
                echo "</div>";
                echo "<br>";
                echo "<div class='text'>";
                    echo "<h2>Welcome $name!</h2>";
                    echo "<h4>click 'My Shop'</h4>";
                    echo "<h4>or 'Shop'</h4>";
                    echo "<h5>Enjoy!</h5>";
                echo "</div>";
            }
            else
            {
                echo "<div class='text'>";
                    echo "<h2>Please log in or create new account!</h2>";
                echo "</div>";
            }
            ?>
        </section>

        <script src="../script/script.js"></script>
    </body>
</html>