<?php

session_start();

if (isset($_SESSION['user']))
{
	header("Location: app.php");
	die();
}
else
{
	if (isset($_POST["username"]) && (isset($_POST["password"]))) 
	{
		
		$username = $_POST["username"];
		$password = $_POST["password"];

		if($username == "test" && $password == "test")
		{	
			$_SESSION['user'] = "test";
			header("Location: app.php");
			die();
		}
		if($username == "admin" && $password == "password")
		{	
			$_SESSION['user'] = "test";
			header("Location: app.php");
			die();
		}
	}
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
		<h4> Please login below to continue </h4>
		<form name="login" action="index.php" method="post" accept-charset="utf-8">
		
				<li>
					<label for="usermail">Username</label>
					<input type="name" name="username" placeholder="Username" required>
				</li>
				<li>
					<label for="password">Password</label>
					<input type="password" name="password" placeholder="Password" required>
				</li>
				<li>
					<input type="submit" value="Login">
				</li>

		</form>

	</section>
</body>
</html>
