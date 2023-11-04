<?php
include('config.php');


session_start();

if (!isset($_SESSION['username']))
{
    die('Access Blocked');
}
?>

<!DOCTYPE html>
<html>
	<head>
	    <title>Add List</title>
	</head>
	<body>
    	<form action='add_list_process.php' method='POST'><fieldset>
    	    <h3>Add List</h3>
    	    <p>
				<label for='name'>Name </label>
				<input type='text' name='name' />
			</p>
    	    <p>
			    <label for="description">Description </label>
			    <textarea name="description"></textarea>
		    </p>
    	    <p>
				<label for='price'>Price </label>
				<input type='number' name='price' />
			</p>
    	    <p>
				<label for='stock'>Stock </label>
				<input type='number' name='stock' />
			</p>
			<p>
				<input type='submit' name='add_list' value='add_list' />
			</p>
		</fieldset></form>
	</body>
</html>
