<?php

$REGISTERED = <<<FINISHED

<html>
<head>
</head>
<body>
<h4>Error: Admin account already registered!</h4>
</body>
</html>

FINISHED;

$cookie_name = "Warwick-CTF";

if(isset($_COOKIE[$cookie_name])) {
    if ($_COOKIE[$cookie_name] == "admin" ){
		echo "<h4>flag{I_CaN_HaZ_Adm1n_Ple4s3}</h4>";
    } else {
		echo "<h4>Welcome " . $_COOKIE[$cookie_name] . ", please enjoy a cat picture!</h4>";
		echo '<img src="cat.jpg" alt="cat" style="width:304px;height:228px;">';
		echo '</br></br>';
		echo '<a href="/logout.php">Logout</a>';
    }
} else {
	if (!empty($_POST)) {
		if ($_POST["username"] == "admin") {
			echo $REGISTERED;
		} else {
			$username = $_POST["username"];
			setcookie($cookie_name, $username, time() + (86400 * 30), "/"); 
			echo "<h4>Welcome " . $username . ", please enjoy a cat picture!</h4>";
			echo '<img src="cat.jpg" alt="cat" style="width:304px;height:228px;">';
			echo '</br></br>';
			echo '<a href="/logout.php">Logout</a>';
		}
	} else {
		header("Location: /index.php");
		die();
	}
}



?>
