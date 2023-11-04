<?php
include('config.php');


session_start();

if (!isset($_SESSION['username']))
{
    die("Access Blocked");
}
?>

<!DOCTYPE html>
<html>
	<head>
	    <title>Top Up</title>
	</head>
	<body>
    	<form action='topup_process.php' method='POST'><fieldset>
    	    <h3>Top Up</h3>
    	    <p>
				<label for='amount'>Amount </label>
				<input type='number' name='amount' min='0' placeholder='amount' />
			</p>
			<p>
				<input type='submit' name='topup' value='topup' />
			</p>
		</fieldset></form>
	</body>
</html>
