<?php

$connection = mysqli_connect("localhost", "root", "goliath", "pinnwand") or die("Couldn't connect to database!");

include "checkcookie.php";

if ($_POST['abbrechen']){
    header("Location: index.php");
}

if ($_POST['loeschen']){
    $anzeigen = mysqli_query($connection, "SELECT * FROM `anzeigen` WHERE `uid`='$uid'");
    
    while ($anzeige = mysqli_fetch_assoc($anzeigen)){
        $aid = $anzeige['aid'];
        mysqli_query($connection, "DELETE FROM `anzeigen` WHERE `aid`='$aid'");
        exec("rm -rf /var/www/html/schule/adphotos/$aid/");
    }
    
    mysqli_query($connection, "DELETE FROM `pinnwand` WHERE `id`='$uid'");
    header("Location: index.php");
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
                <h3>Möchten Sie Ihren Account mit den folgenden Daten wirklich löschen?</h3>
                <br>
				<table cellspacing="10">
					<tr>
						<td>Vorname </td>
						<td><?php echo $vorname; ?></td>
					</tr>
					<tr>
						<td>Nachname </td>
						<td><?php echo $nachname; ?></td>
					</tr>
					<tr>
						<td>Email </td>
						<td><?php echo $email; ?></td>
					</tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
					<tr>
						<td><input type="submit" name="abbrechen" value="Abbrechen" /></td>
						<td><input type="submit" name="loeschen" value="Löschen" style="color: red;"/></td>
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
