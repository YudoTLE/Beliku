<?php
include('config.php');


session_start();

if (!isset($_SESSION['username']))
{
    die("Access Blocked");
}

$list_id = $_POST['list_id'];

$query  = pg_query("SELECT name, description, price, stock FROM List l JOIN Item i ON item_id = i.id WHERE l.id = $list_id");
$result = pg_fetch_array($query);

$name        = $result['name'];
$description = $result['description'];
$price       = $result['price'];
$stock       = $result['stock'];
?>

<!DOCTYPE html>
<html>
	<head>
	    <title>Edit List</title>
	</head>
	<body>
    	<form action='edit_list_process.php' method='POST'><fieldset>
            <input type='hidden' name='list_id' value='<?php echo $list_id ?>' />

    	    <h3>Add List</h3>
    	    <p>
				<label for='name'>Name </label>
				<input type='text' name='name' value='<?php echo $name ?>' />
			</p>
    	    <p>
			    <label for="description">Description </label>
			    <textarea name="description"><?php echo $description ?></textarea>
		    </p>
    	    <p>
				<label for='price'>Price </label>
				<input type='number' name='price' value=<?php echo $price ?> />
			</p>
    	    <p>
				<label for='stock'>Stock </label>
				<input type='number' name='stock' value=<?php echo $stock ?> />
			</p>
			<p>
				<input type='submit' name='edit_list' value='edit_list' />
			</p>
		</fieldset></form>
	</body>
</html>
