<?php

if (isset($_POST["address"])) 
{
	$user_input = $_POST["address"];

	$validAddress = 0;

	// validate network address 
	if (strlen($user_input) > 60)
	{
		$error = "Address is too long";
	}
	elseif (preg_match('/[`;$()| \'>"\t]/', $user_input)) 
	{
    		$error = "Invalid character(s) detected";
	}
	else
	{
		$validAddress = 1;
	}
} 

?>
<!DOCTYPE html>
<html>
<head>
	<title>Advanced Network Debugging Tool: Ping</title>
	<link rel="stylesheet" href="normalize.css">
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<section class="loginform cf">
		<h3>"ping" advanced network debugging tool</h3>
		<h4>Enter a domain name or IP address to ping it</h4>
		<form name="network" action="index.php" method="post" accept-charset="utf-8">
			<ul>
				<li>
					<label for="usermail">Address:</label>
					<input type="name" name="address" placeholder="Name or IP address" required>
				</li>
				<li>
					<input type="submit" value="Send">
				</li>
			</ul>
		</form>

		<textarea style="margin-top:20px; width:400px; height:200px" placeholder="Result">
<?php if (isset($error)) { print $error; } ?>
<?php if ($validAddress) { @system("bash -c 'ping -c1 $user_input' 2>&1"); } ?>
		</textarea>

	</section>
</body>
</html>
