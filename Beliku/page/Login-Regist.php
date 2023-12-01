<?php include('../include/config.php'); ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Beliku </title>
    <link rel="stylesheet" href="../style/Login-Regist-Style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
    <body>
        <header>
            <div class="header-left">
                <img class="logo" src="../image/ui/logo.png">
            </div>
          </header>
        <div class="container">
            <input type="checkbox" id="flip">
            <div class="cover">
                <div class="front">
                    <div class="text">
                    <span class="text-1">Beliku <br> your one-stop shop </span>
                    <span class="text-2">Let's get connected</span>
                    </div>
                </div>
            </div>
            <div class="forms">
                <div class="form-content">
                <div class="login-form">
                    <div class="title">Login</div>
                <form action="../process/login_process.php" method="POST">
                    <div class="input-boxes">
                    <div class="input-box">
                        <input type="text" name="username" placeholder="Enter your username" required>
                    </div>
                    <div class="input-box">
                        <input type="password" name="password" placeholder="Enter your password" required>
                    </div>
                    <div class="button input-box">
                        <input type="submit" name="login" value="Submit">
                    </div>
                    <div class="text register-text">Don't have an account? <label for="flip">Register now</label></div>
                    </div>
                </form>
            </div>
                <div class="register-form">
                <div class="title">Register</div>
                <form action="../process/registration_process.php" method="POST">
                    <div class="input-boxes">
                    <div class="input-box">
                        <input type="text" name="username" placeholder="Enter your username" required>
                    </div>
                    <div class="input-box">
                        <input type="password" name="password" placeholder="Enter your password" required>
                    </div>
                    <div class="input-box">
                        <input type="text" name="name" placeholder="Enter your name" required>
                    </div>
                    <div class="button input-box">
                        <input type="submit" name="register" value="Submit">
                    </div>
                    <div class="text register-text">Already have an account? <label for="flip">Login now</label></div>
                    </div>
                </form>
            </div>
            </div>
            </div>
        </div>
    </body>
</html>