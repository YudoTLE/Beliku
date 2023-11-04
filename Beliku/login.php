<?php include('config.php'); ?>


<!DOCTYPE html>
<html>
	<head>
	    <title>Login</title>
	</head>
	<body>
	    <form action='login_process.php' method='POST'><fieldset>
	        <h3>Login</h3>
	        <p>
				<label for='username'>Username </label>
				<input type='text' name='username' placeholder='username' />
			</p>
	        <p>
				<label for='password'>Password </label>
				<input type='text' name='password' placeholder='password' />
			</p>
			<p>
				<input type='submit' name='login' value='login' />
			</p>
		</fieldset></form>
	</body>
</html>
