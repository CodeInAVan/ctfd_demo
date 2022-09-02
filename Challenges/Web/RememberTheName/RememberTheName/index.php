<?php
	$cookie_name = "Warwick-CTF";

	if(isset($_COOKIE[$cookie_name])) {
		header("Location: /auth.php");
		die();
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Application login panel</title>
	<link rel="stylesheet" href="normalize.css">
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<section class="loginform cf">
		<h3> Welcome to the application login panel </h3>
		<h4> Please register below to continue </h4>
		<form name="login" action="auth.php" method="post" accept-charset="utf-8">
		
				<li>
					<label for="usermail">Username</label>
					<input type="name" name="username" placeholder="Username" required>
				</li>
				<li>
					<label for="password">Password</label>
					<input type="password" name="password" placeholder="Password" required>
				</li>
				<li>
					<input type="submit" value="Register">
				</li>

		</form>

	</section>
</body>
</html>
