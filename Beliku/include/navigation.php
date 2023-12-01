<section id="header">
    <img src="../image/ui/logo.png" width="70" class="logo" alt="">
    <div>
        <ul id="navbar">
            <?php
            if ($_SERVER['PHP_SELF'] == '/Beliku/page/beranda.php')
                echo "<li><a class='active' href='../page/beranda.php'>Home</a></li>";
            else
                echo "<li><a href='../page/beranda.php'>Home</a></li>";
            if ($_SERVER['PHP_SELF'] == '/Beliku/page/myshop.php')
                echo "<li><a class='active' href='../page/myshop.php'>My Shop</a></li>";
            else
                echo "<li><a href='../page/myshop.php'>My Shop</a></li>";
            if ($_SERVER['PHP_SELF'] == '/Beliku/page/shop.php')
                echo "<li><a class='active' href='../page/shop.php'>Shop</a></li>";
            else
                echo "<li><a href='../page/shop.php'>Shop</a></li>";
            if ($_SERVER['PHP_SELF'] == '/Beliku/page/topup.php')
                echo "<li><a class='active' href='../page/topup.php'>Top Up</a></li>";
            else
                echo "<li><a href='../page/topup.php'>Top Up</a></li>";
            if ($_SERVER['PHP_SELF'] == '/Beliku/page/history.php')
                echo "<li><a class='active' href='../page/history.php'>History</a></li>";
            else
                echo "<li><a href='../page/history.php'>History</a></li>";
            
            if ($logged_in)
            {
                echo "<form action='../process/logout_process.php' method='POST'>";
                    echo "<input type='hidden' name='logout'>";

                    echo "<button>log out</button>";
                echo "</form>";
            }
            else
            {
                echo "<form action='../page/Login-Regist.php' method='POST'>";
                    echo "<input type='hidden' name='login'>";

                    echo "<button>log in</button>";
                echo "</form>";
            }
            echo "<a href='#' id='close'><i class='far fa-times'></i></a>";
            ?>
        </ul>
    </div>
    <div id="mobile">
        <i id="bar" class="fas fa-outdent"></i>
    </div>
</section>