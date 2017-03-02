<?php

$connection = mysqli_connect("localhost", "root", "goliath", "pinnwand") or die("Couldn't connect to database!");


$vorname = $_POST['vorname'];
$nachname = $_POST['nachname'];
$email = $_POST['email'];
$message = '"' . $_POST['nachricht'] . '"';

if ($email != ''){
	exec("./contact.sh $vorname $nachname $email $message");
	header('Location: http://dakochmachine.goip.de/schule/index.php');
}

include "checkcookie.php";

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
			echo '		<a href="./erstelleanzeige.php" style="text-decoration: none; color: black;">Anzeige erstellen</a>
						<hr>
						<br>
						<hr>
						<a href="./anzeigen.php" style="text-decoration: none; color: black;">Meine Anzeigen</a>
						<hr>
						<a href="./beobachtungen.php" style="text-decoration: none; color: black;">Meine Beobachtungen</a>
						<hr>
						<br>
						<hr>
						<a href="./profil.php" style="text-decoration: none; color: black;">Profil bearbeiten</a>
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
						<td><input type="text" name="vorname" <?php if ($uid != ''){echo "value=$vorname";}?> size="25%" required /></td>
					</tr>
					<tr>
						<td>Nachname </td>
						<td><input type="text" name="nachname" <?php if ($uid != ''){echo "value=$nachname";}?> size="25%" required /></td>
					</tr>
					<tr>
						<td>Email </td>
						<td><input type="email" name="email" <?php if ($uid != ''){echo "value=$email";}?> size="25%" required /></td>
					</tr>
					<tr>
						<td style="vertical-align: top">Nachricht </td>
						<td><textarea name="nachricht" cols="30%" rows="10" required></textarea></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="reset" value="Abbrechen" /> <input type="submit" value="Senden" /></td>
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