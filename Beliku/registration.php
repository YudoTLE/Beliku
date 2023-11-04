<?php include('config.php'); ?>


<!DOCTYPE html>
<html>
	<head>
	    <title>Registration</title>
	</head>
	<body>
    	<form action='registration_process.php' method='POST'><fieldset>
    	    <h3>Register</h3>
    	    <p>
				<label for='username'>Username </label>
				<input type='text' name='username' placeholder='username' />
			</p>
    	    <p>
				<label for='password'>Password </label>
				<input type='text' name='password' placeholder='password' />
			</p>
    	    <p>
				<label for='name'>Name </label>
				<input type='text' name='name' placeholder='name' />
			</p>
			<p>
				<input type='submit' name='register' value='register' />
			</p>
		</fieldset></form>
	</body>
</html>
