<?php

$connection = mysqli_connect("localhost", "root", "goliath", "pinnwand") or die("Couldn't connect to database!");

include "checkcookie.php";


if ($_POST['speichern']){
	$name = $_POST['vorname'];
	$lname = $_POST['nachname'];
	$email = $_POST['email'];
	$strundhn = $_POST['strundhn'];
	$plz = $_POST['plz'];
	$ort = $_POST['ort'];
	$passwort = $_POST['passwort'];
	$passwortbes = $_POST['passwortbes'];
	
	if ($passwort != $passwortbes){
		die("Passw&ouml;rter stimmen nicht &uuml;berein!");
	}
	
	$passwort = mysqli_real_escape_string($connection, $_POST['passwort']);
	$salt = hash("sha512", rand() . rand() . rand());
	
	if (!empty($name)){
		mysqli_query($connection, "UPDATE `pinnwand` SET `name`='$name' WHERE `id`='$uid'");
	}
	if (!empty($lname)){
		mysqli_query($connection, "UPDATE `pinnwand` SET `lname`='$lname' WHERE `id`='$uid'");
	}
	if (!empty($email)){
		mysqli_query($connection, "UPDATE `pinnwand` SET `email`='$email' WHERE `id`='$uid'");
	}
	if (!empty($strundhn)){
		mysqli_query($connection, "UPDATE `pinnwand` SET `strundhn`='$strundhn' WHERE `id`='$uid'");
	}
	if (!empty($plz)){
		$arrayresult = mysqli_query($connection, "SELECT * FROM `orte` WHERE `plz`='$plz'");
		$fetcharray = mysqli_fetch_assoc($arrayresult);
		$check = $fetcharray['plz'];
		mysqli_query($connection, "UPDATE `pinnwand` SET `plz`='$plz' WHERE `id`='$uid'");
		if ($check == $plz){
		} else {
			mysqli_query($connection, "INSERT INTO `orte` (`plz`, `ort`) VALUES ('$plz', '$ort')");
		}
	}
	if (!empty($passwort)){
	mysqli_query($connection, "UPDATE `pinnwand` SET `password`='$passwort' WHERE `id`='$uid'");
	}
	
	header('Location: http://sandroiv.goip.de/schule/login.php');
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
			echo "<p>Willkommen</p><br><p>$vorname $nachname!</p><br>";
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
						<td><input type="text" name="vorname" <?php if ($uid != ''){echo "value='$vorname'";}?> size="25%" /></td>
					</tr>
					<tr>
						<td>Nachname </td>
						<td><input type="text" name="nachname" <?php if ($uid != ''){echo "value='$nachname'";}?> size="25%" /></td>
					</tr>
					<tr>
						<td>Email </td>
						<td><input type="email" name="email" <?php if ($uid != ''){echo "value='$email'";}?> size="25%" /></td>
					</tr>
					<tr>
						<td>Straße und Hausnummer</td>
						<td><input type="text" name="strundhn" <?php if ($uid != ''){echo "value='$strundhn'";}?> size="25%" required /></td>
					</tr>
					<tr>
						<td>Postleitzahl</td>
						<td><input type="text" name="plz" pattern="[0-9]{5}" <?php if ($uid != ''){echo "value='$plz'";}?> size="25%" required /></td>
					</tr>
					<tr>
						<td>Ort</td>
						<td><input type="text" name="ort" pattern="[A-ZÜÖÄ][a-züöä]*[-]?[A-ZÜÖÄ]?[a-züöä]*" <?php if ($uid != ''){echo "value='$ort'";}?> size="25%" required /></td>
					</tr>
					<tr>
						<td>Passwort </td>
						<td><input type="password" name="passwort" size="25%" /></td>
					</tr>
					<tr>
						<td>Passwort bestätigen</td>
						<td><input type="password" name="passwortbes" size="25%" /></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="reset" value="Abbrechen" /> <input type="submit" value="Speichern" name="speichern"/></td>
					</tr>
				</table>
			</form>
			
			<br>
			<br>
			<a href="./accountloeschen.php" style="text-decoration: none; color: red;">Account löschen</a>
			<br>
			<br>
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
