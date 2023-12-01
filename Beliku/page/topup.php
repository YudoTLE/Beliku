<?php
include('../include/config.php');


session_start();

$logged_in = isset($_SESSION['username']);
if (!$logged_in)
{
    header("Location: Login-Regist.php");
}
?>


<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Top Up</title>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
        <link rel="stylesheet" href="../style/style.css">
    </head>

    <body>
        <?php include('../include/navigation.php') ?>

        <section id="topup">
            <div class="container">
                <div class="forms">
                    <div class="form-content">
                        <div class="topup">
                            <div class="title">Top Up</div>
                        <form action="../process/topup_process.php" method="POST">
                            <div class="input-boxes">
                            <div class="input-box">
                                <input type="text" name="amount" placeholder="Enter amount" required>
                            </div>
                            </div>
                            <div class="input-box">
                            <div class="button input-box">
                                <input class="topup" type="submit" name="topup" value="Top Up">
                            </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script src="../script/script.js"></script>
    </body>
</html>