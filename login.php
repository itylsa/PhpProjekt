<?php

$connection = mysqli_connect("localhost", "root", "goliath", "pinnwand") or die("Couldn't connect to database!");


if ($_POST['email'] && $_POST['password']){
	$email = mysqli_real_escape_string($connection, $_POST['email']);
	$password = mysqli_real_escape_string($connection, hash("sha512", $_POST['password']));
	$result = mysqli_query($connection, "SELECT * FROM `pinnwand` WHERE `email`='$email'");
	$fetcharray = mysqli_fetch_assoc($result);
	$dbemail = $fetcharray['email'];
	$dbpassword = $fetcharray['password'];
	if ($email == $dbemail){
		if ($password == $dbpassword){
			$salt = hash("sha512", rand() . rand() . rand());
			setcookie("c_user", hash("sha512", $email), time() + 24 * 60 * 60, "/");
			setcookie("c_salt", $salt, time() + 24 * 60 * 60, "/");
			$userID = $fetcharray['id'];
			mysqli_query($connection, "UPDATE `pinnwand` SET `salt`='$salt' WHERE `id`='$userID'");
			header("Location: http://dakochmachine.goip.de/schule/");
		} else {
			die("Passwort inkorrekt!");
		}
	} else {
	die("Es existiert kein Account mit der Email: " . $email);
	}
	$clientip = $_SERVER['REMOTE_ADDR'];
	$message = $fetcharray['name'] . " " . $fetcharray['lname'] . " logged in from " . $clientip;
	exec("./servermsg.sh '$message'");
}

include "checkcookie.php";

if ($uid != ''){
    header('Location: http://dakochmachine.goip.de/schule/');
}


?>


<!DOCTYPE html>
<html lang="de">
<head>
<title>Car&Bike Kleinanzeigen</title>
<link rel="icon" href="motorcycle-side-view.png">
<link rel="stylesheet" type="text/css" href="./style.css">
</head>

<body>
<div id="seite">
  <div id="kopfbereich">
    <center>
			<br>
			<a href="index.php"><img src="./carandbike.png" width="900px"/></a>
			<br>
       <br>
    </center>
  </div>

  <div id="spaltelinks">
		<br>
		<?php $date = date("d.m.Y"); echo "<p>$date</p>";?>
		<br>
		<hr>
    <a href="./index.php" style="text-decoration: none; color: black;">Home</a>
		<hr>
    <a href="./kontakt.php" style="text-decoration: none; color: black;">Kontakt</a>
	</div>
  
  <div id="spalterechts">
		<br>
		<?php
		if($uid != ''){
			echo "<p>Willkommen</p><p>$vorname $nachname!</p>";
		} else {
			echo "<p>Willkommen!</p>";
		}
		?>
	
		<br>
		<hr>
		
		<?php
		if($uid != ''){
			header("Location: http://dakochmachine.goip.de/schule/");
		} else {
			echo '<a href="./registrieren.php" style="text-decoration: none; color: black;">Registrieren</a>';
		}
		?>
  </div>

  <div id="inhalt">
		<br>
		<center>
			<form action="" method="post">
				<table cellspacing="10">
					<tr>
						<td>Email </td>
						<td><input type="email" name="email" size="25%" required /></td>
					</tr>
					<tr>
						<td>Passwort </td>
						<td><input type="password" name="password" size="25%" required /></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="reset" value="Abbrechen" /> <input type="submit" value="Login" /></td>
					</tr>
				</table>
			</form>
		</center>
		<br>
		<hr>
	</div>

<footer>
  <div id="fussbereich">
    <br>
		<p>Copyright &copy; <?php $copyrightyear = date("Y"); echo "$copyrightyear";?> Car&Bike Kleinanzeigen. Alle Rechte vorbehalten.<p>
		<br>
  </div>
</footer>
</div>
</body>
</html>