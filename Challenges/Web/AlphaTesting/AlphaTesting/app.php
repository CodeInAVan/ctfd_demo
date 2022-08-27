<?php

session_start();

$WIN = "flag{3ASY_CR3DS_FOR_FL4G5}";

if (isset($_SESSION['user']))
{

$HTML = <<<FINISH
<!DOCTYPE html>
<html>
<head>
	<title>Admin panel</title>
	<link rel="stylesheet" href="normalize.css">
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<section class="loginform cf">
		<h3> Test / debug user authorised </h3>
		<h4> Application functions show here </h4>
		
		<a href="logout.php">Logout</a>

		<textarea style="margin-top:20px; width:400px; height:200px" placeholder="App">
			$WIN
		</textarea>

	</section>
</body>
</html>
FINISH;

echo $HTML;

}
else
{
	header("Location: index.php");
	die();
} 

?>

