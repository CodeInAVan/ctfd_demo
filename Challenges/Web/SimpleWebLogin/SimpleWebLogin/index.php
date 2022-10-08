<?php

$HTML = <<<FINISH

<!DOCTYPE html>
<html>
<head>
	<title>Simple Login Page</title>
	<link rel="stylesheet" href="normalize.css">
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<section class="loginform cf">
		<h3> Welcome to the simple login page </h3>
		<h4> Please login below to continue to the secure area </h4>
		<form name="login" action="index.php" method="post" accept-charset="utf-8">
			<ul>
				<li>
					<label for="username">Username</label>
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

<!--
TODO: Make sure this code is safe.

//if (!empty(\$_POST)) { if (\$_POST["username"] == "admin") && (\$_POST["password"] == "a38b4f6yRt")) { echo \$HTML; } else { echo \$HTML; } } else { echo \$HTML; }

-->

FINISH;

$WIN = "flag{I_CaN_rEaD_T3H_SRC_C0De}";


if (!empty($_POST)) {
	if (($_POST["username"] == "admin") && ($_POST["password"] == "a38b4f6yRt")) {
		echo $WIN;
	} else {
		echo $HTML;
	}
} else {
	echo $HTML;
}


?>

