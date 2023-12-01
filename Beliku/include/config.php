<?php
$db = pg_connect('host=localhost dbname=beliku user=yudotle password=password');
if (!$db)
{
    die("Failed connecting to database: ".pg_connect_error());
}
?>
