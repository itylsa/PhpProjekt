<?php

$connection = mysqli_connect("localhost", "root", "goliath", "pinnwand") or die("Couldn't connect to database!");

include "checkcookie.php";

if ($uid != ''){
        header('Location: http://sandroiv.goip.de/schule/');
}


if ($_POST['email'] && $_POST['passwort']){
	$email = mysqli_real_escape_string($connection, $_POST['email']);
	$password = mysqli_real_escape_string($connection, $_POST['passwort']);
	$passwordbes = mysqli_real_escape_string($connection, $_POST['passwortbes']);
	if ($password != $passwordbes){
		die("Passwörter stimmen nicht überein!");
	}
	$name = $_POST['vorname'];
	$lname = $_POST['nachname'];
	$strundhn = $_POST['strundhn'];
	$plz = $_POST['plz'];
	$ort = $_POST['ort'];
	$arrayresult = mysqli_query($connection, "SELECT * FROM `orte` WHERE `plz`='$plz'");
	$fetcharray = mysqli_fetch_assoc($arrayresult);
	$check = $fetcharray['plz'];
	if ($check == $plz){
	} else {
		mysqli_query($connection, "INSERT INTO `orte` (`plz`, `ort`) VALUES ('$plz', '$ort')");
	}
	$arrayresult = mysqli_query($connection, "SELECT * FROM `pinnwand` WHERE `email`='$email'");
	$fetcharray = mysqli_fetch_assoc($arrayresult);
	$check = $fetcharray['id'];
	if ($check != ''){
		die("Account existiert bereits!");
		header("Location: http://sandroiv.goip.de/schule/login.php");
	}
	$salt = hash("sha512", rand() . rand() . rand());
	mysqli_query($connection, "INSERT INTO `pinnwand` (`email`, `password`, `name`, `lname`, `strundhn`, `plz`, `salt`) VALUES ('$email', '$password', '$name', '$lname', '$strundhn', '$plz', '$salt')") or die("Error");
	sleep(1);
	$arrayresult = mysqli_query($connection, "SELECT * FROM `pinnwand` WHERE `email`='$email'");
	$fetcharray = mysqli_fetch_assoc($arrayresult);
	$uid = $fetcharray['id'];
	setcookie("c_user", hash("sha512", $email), time() + 24 * 60 * 60, "/");
	setcookie("c_salt", $salt, time() + 24 * 60 * 60, "/");
	header("Location: http://sandroiv.goip.de/schule/");
}

?>


<!DOCTYPE html>
<html lang="de">
<head>
<title>Kleinanzeigen</title>

<link rel="stylesheet" type="text/css" href="./style.css">
</head>

<body>
<div id="seite">
  <div id="kopfbereich">
    <center>
			<br>
			<a href="index.php" style="text-decoration: none; color: black;"><h1>Kleinanzeigen</h1></a>
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
		if ($uid != ''){
			echo "<p>Willkommen</p><p>$vorname $nachname!</p>";
		} else {
			echo "<p>Willkommen!</p>";
		}
		?>
	
		<br>
		<hr>
		
		<?php
		if ($uid != ''){
			echo '<a href="./anzeigen.php" style="text-decoration: none; color: black;">Meine Anzeigen</a>
						<hr>
						<a href="./beobachtungen.php" style="text-decoration: none; color: black;">Meine Beobachtungen</a>
						<hr>
						<a href="./logout.php" style="text-decoration: none; color: black;">Ausloggen</a>';
		} else {
			echo '<a href="./login.php" style="text-decoration: none; color: black;">Einloggen</a>';
		}
		?>
  </div>

  <div id="inhalt">
		<br>
		<center>
			<form action="" method="post">
				<table cellspacing="10">
					<tr>
						<td>Vorname </td>
						<td><input type="text" name="vorname" pattern="[A-Z]{1}[a-z]{1,15}" size="25%" required /></td>
					</tr>
					<tr>
						<td>Nachname </td>
						<td><input type="text" name="nachname" pattern="[A-Z]{1}[a-z]{1,15}" size="25%" required /></td>
					</tr>
					<tr>
						<td>Email </td>
						<td><input type="email" name="email" size="25%" required /></td>
					</tr>
					<tr>
						<td>Straße und Hausnummer</td>
						<td><input type="text" name="strundhn" size="25%" required /></td>
					</tr>
					<tr>
						<td>Postleitzahl</td>
						<td><input type="text" name="plz" pattern="[0-9]{5}" size="25%" required /></td>
					</tr>
					<tr>
						<td>Ort</td>
						<td><input type="text" name="ort" pattern="[A-ZÜÖÄ][a-züöä]*[-]?[A-ZÜÖÄ]?[a-züöä]*" size="25%" required /></td>
					</tr>
					<tr>
						<td>Passwort </td>
						<td><input type="password" name="passwort" size="25%" required /></td>
					</tr>
					<tr>
						<td>Passwort bestätigen</td>
						<td><input type="password" name="passwortbes" size="25%" required /></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="reset" value="Abbrechen" /> <input type="submit" value="Registrieren" /></td>
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
		<p>Copyright &copy; <?php $copyrightyear = date("Y"); echo "$copyrightyear";?> Kleinanzeigen. Alle Rechte vorbehalten.<p>
		<br>
  </div>
</footer>
</div>
</body>
</html>
