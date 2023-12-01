<?php
include('../include/config.php');


session_start();

$logged_in = isset($_SESSION['username']);
if (!$logged_in)
{
    header("Location: Login-Regist.php");
}

$list_id     = NULL;
$item_id     = '';
$name        = '';
$description = '';
$price       = '';
$stock       = 1;

if (isset($_POST['list_id']))
{
    $list_id = $_POST['list_id'];
    
    $query  = pg_query("SELECT item_id, name, description, price, stock FROM List l JOIN Item i ON item_id = i.id WHERE l.id = $list_id");
    $result = pg_fetch_array($query);
    
    $item_id     = $result['item_id'];
    $name        = $result['name'];
    $description = $result['description'];
    $price       = $result['price'];
    $stock       = $result['stock'];
}
?>


<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My Shop</title>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
        <link rel="stylesheet" href="../style/style.css">
    </head>

    <body>
        <?php include('../include/navigation.php'); ?>
        
        <section id="prodetails" class="section-p1">

            <div class="single-pro-image"><label for="image-input">
                <?php
                if (file_exists("../image/product/".$item_id.".jpg"))
                    echo "<img src='../image/product/".$item_id.".jpg' width='100%' id='image-display' alt=''>";
                else
                    echo "<img src='../image/ui/logo.png' width='100%' id='image-display' alt=''>";
                ?>
            </label></div>

            <div class="single-pro-details2">
                <?php
                $val = $list_id ? 'edit' : 'add';
                $txt = $list_id ? 'Save Changes' : 'Add Product';

                echo "<form method='POST' action='../process/edit_list_process.php' enctype='multipart/form-data'>";
                    echo "<input type='hidden' name='list_id' value='".$list_id."'>";
                    
                    echo "<input type='file' name='uploaded-image' id='image-input' style='display: none;' onchange='updateImage()'>";

                    echo "<div class='edit'>";
                        echo "<input type='text' name='name' value='".$name."' placeholder='nama barang' required>";
                        echo "<input type='number' name='price' value='".$price."' placeholder='harga barang' required>";
                    echo "</div>";
                    echo "<input type='text' name='stock' value='".$stock."' placeholder='jumlah stok'>";
                    echo "<span>stok</span>";

                    echo "<h4>Product Details</h4>";
                    echo "<div class='edit-des'>";
                        echo "<input type='text' name='description' value='".$description."' placeholder='deskripsi barang' required>";
                    echo "</div>";

                    echo "<div style='display: flex; justify-content: space-between;'>";
                    if ($list_id)
                    {
                        echo "<button type='submit' name='action' value='edit'>Save Changes</button>";
                        echo "<button type='submit' name='action' value='remove'>Remove This Product</button>";
                    }
                    else
                        echo "<button type='submit' name='action' value='add'>Add Product</button>";  
                    echo "</div>";
                echo "</form>";
                ?>


            </div>  
        </section>

        <script src="../script/script.js"></script>
        <script>
            function updateImage() {
                var fileInput = document.getElementById('image-input');
                var mainImg = document.getElementById('image-display');

                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();
                
                    reader.onload = function (e) {
                        mainImg.src = e.target.result;
                    };
                
                    reader.readAsDataURL(fileInput.files[0]);
                }
            }
        </script>
    </body>
</html>