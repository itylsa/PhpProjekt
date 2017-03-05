<?php

$connection = mysqli_connect("localhost", "root", "goliath", "kleinanzeigen") or die("Couldn't connect to database!");

include "checkcookie.php";


$titel = $_POST['titel'];
$kategorie = $_POST['kategorie'];
$pbname = $_POST['pbname'];

# Alle restlichen Daten auslesen und in Datenbank speichern

$preis = $_POST['preis'];

if ($preis != ''){
	
	$titel = $_POST['titel'];
	$kategorie = $_POST['kategorie'];
	$pbname = $_POST['pbname'];
	$beschreibung = $_POST['beschreibung'];
	$preis = $_POST['preis'];
	$preistyp = $_POST['preistyp'];
	$datum = date("d.m.Y");
	
	
	mysqli_query($connection, "INSERT INTO `anzeigen` (`uid`, `titel`, `kategorie`, `name`, `beschreibung`, `plz`, `preis`, `preistyp`, `datum`) VALUES ('$uid', '$titel', '$kategorie', '$pbname', '$beschreibung', '$plz', '$preis', '$preistyp', '$datum')");

	$arrayresult = mysqli_query($connection, "SELECT * FROM `anzeigen` WHERE `titel`='$titel' AND `datum`='$datum'");
	$fetcharray = mysqli_fetch_assoc($arrayresult);
	$aid = $fetcharray['aid'];
	
	exec("mkdir /var/www/html/schule/adphotos/$aid");
	
	ini_set('upload_tmp_dir','/home/php/tmp/');
	move_uploaded_file($_FILES['titelfoto']['tmp_name'], "/var/www/html/schule/adphotos/$aid/1.jpg");
	
	header("Location: anzeigen.php");
	
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
			echo '			<a href="./anzeigen.php" style="text-decoration: none; color: black;">Meine Anzeigen</a>
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
			<form action="" method="post" enctype="multipart/form-data">
				<table cellspacing="10">
					<?php
					
					if ($titel != ''){
						
						echo "	<tr>
											<td>Titel </td>
											<td><input type='text' name='titel' value='$titel' size='25%' required /></td>
										</tr>
										<tr>
											<td>Kategorie </td>
											<td><select name='kategorie' required>";
											
											if ($kategorie == "Fahrzeug"){
													echo "<option selected>Fahrzeug</option>
														  <option>Immobilien</option>
														  <option>Tiermarkt</option>
														  <option>Haushalt</option>
														  <option>Elektronik</option>
														  <option>Sonstiges</option>";
											}		  
											if ($kategorie == "Immobilien"){
													echo "<option>Fahrzeug</option>
														  <option selected>Immobilien</option>
														  <option>Tiermarkt</option>
														  <option>Haushalt</option>
														  <option>Elektronik</option>
														  <option>Sonstiges</option>";
											}
											if ($kategorie == "Tiermarkt"){
													echo "<option>Fahrzeug</option>
														  <option>Immobilien</option>
														  <option selected>Tiermarkt</option>
														  <option>Haushalt</option>
														  <option>Elektronik</option>
														  <option>Sonstiges</option>";
											}
											if ($kategorie == "Haushalt"){
													echo "<option>Fahrzeug</option>
														  <option>Immobilien</option>
														  <option>Tiermarkt</option>
														  <option selected>Haushalt</option>
														  <option>Elektronik</option>
														  <option>Sonstiges</option>";
											}
											if ($kategorie == "Elektronik"){
													echo "<option>Fahrzeug</option>
														  <option>Immobilien</option>
														  <option>Tiermarkt</option>
														  <option>Haushalt</option>
														  <option selected>Elektronik</option>
														  <option>Sonstiges</option>";
											}
											if ($kategorie == "Sonstiges"){
													echo "<option>Fahrzeug</option>
														  <option>Immobilien</option>
														  <option>Tiermarkt</option>
														  <option>Haushalt</option>
														  <option>Elektronik</option>
														  <option selected>Sonstiges</option>";
											}		
													
											echo "</select></td>
																</tr>";
											

										echo "<tr>
											<td>Veröffentlichter Name </td>
											<td><select name='pbname' required>";
										
										if ($pbname == "$vorname"){
												echo "<option>$vorname</option>";
										} else {
												echo "<option>$vorname $nachname</option>";
										}
										
										
										echo "<tr>
														<td style='vertical-align: top;'>Beschreibung </td>
														<td><textarea name='beschreibung' cols='40%' rows='10' required></textarea></td>
													</tr>
													<tr>
														<td>Titelfoto</td>
														<td><input type='file' name='titelfoto' required /></td>
													</tr>
													<tr>
														<td>Preis (in Euro)</td>
														<td><input type='text' name='preis' size='25%' pattern='[0-9]{1,10}' required /></td>
													</tr>
													<tr>
														<td>Preistyp </td>
														<td><select name='preistyp' required>
																	<option>VHB</option>
																	<option>FP</option>
														</select></td>
													</tr>";
										
										echo "</select></td>
										</tr>
										<tr>
											<td></td>
											<td><input type='reset' value='Abbrechen' /> <input type='submit' value='Erstellen' /></td>
										</tr>";
										

					} else {
						
						echo "	<tr>
											<td>Titel </td>
											<td><input type='text' name='titel' size='25%' required /></td>
										</tr>
										<tr>
											<td>Kategorie </td>
											<td><select name='kategorie' required>";
											$getkategorie = mysqli_query($connection, "SELECT kategorie FROM `kategorien`");
													while ($kategorien = mysqli_fetch_assoc($getkategorie)){
															$kategorie = $kategorien['kategorie'];
															echo "<option>$kategorie</option>";
													}
										echo "</select></td>
										</tr>
										<tr>
											<td>Veröffentlichter Name </td>
											<td><select name='pbname' required>
														<option>$vorname</option>
														<option>$vorname $nachname</option>
													</select></td>
										</tr>
										<tr>
											<td></td>
											<td><input type='reset' value='Abbrechen' /> <input type='submit' value='Weiter' /></td>
										</tr>";
						
						
					}
					
					?>
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
