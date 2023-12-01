<?php
echo "<input type='hidden' name='list_id' value='".$result['l_id']."'>";

echo "<button type='submit' style='position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0;'></button>";

if (file_exists("../image/product/".$result['item_id'].".jpg"))
    echo "<img src='../image/product/".$result['item_id'].".jpg' alt='' style='flex: 1; object-fit: cover;'>";
else
    echo "<img src='../image/ui/logo.png' alt='' style='flex: 1; object-fit: cover;'>";

echo "<div class='des'>";
    echo "<span>sisa ".$result['stock']."</span>";
    echo "<h5>".$result['name']."</h5>";
    echo "<h4>".$result['price']."</h4>";
echo "</div>";
?>