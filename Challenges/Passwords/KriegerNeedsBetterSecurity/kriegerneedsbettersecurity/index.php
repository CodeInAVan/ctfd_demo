<?php

$HTML = <<<FINISH

<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<link rel="stylesheet" href="normalize.css">
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<section class="loginform cf">
		<h3> Welcome to Sterling Archer's login page </h3>
		<h4> Please login below to continue to the secure area </h4>
		<form name="login" action="index.php" method="post" accept-charset="utf-8">
			<ul>
				<li>
					<label for="usermail">Email</label>
					<input type="name" name="username" placeholder="Username" required>
				</li>
				<li>
					<label for="password">Password</label>
					<input type="password" name="password" placeholder="Password" required></li>
				<li>
					<input type="submit" value="Login">
				</li>
			</ul>
		</form>
	</section>
</body>
</html>

FINISH;

$WIN = "flag{d0_u_waNt_t0_b3_H4ck3d}";


if (!empty($_POST)) {
	if (($_POST["username"] == "SterlingArcher") && ($_POST["password"] == "abc123!!")) {
		echo $WIN;
	} else {
		echo $HTML;
	}
} else {
	echo $HTML;
}


?>

