<?php

$connection = mysqli_connect("localhost", "root", "goliath", "kleinanzeigen") or die("Couldn't connect to database!");

include "checkcookie.php";

$uaid = $_GET['id'];

$arrayresult = mysqli_query($connection, "SELECT * FROM `anzeigen` WHERE `aid`='$uaid'");
$fetcharray = mysqli_fetch_assoc($arrayresult);

$titel = $fetcharray['titel'];
$kategorie = $fetcharray['kategorie'];
$pbname = $fetcharray['name'];
$beschreibung = $fetcharray['beschreibung'];
$preis = $fetcharray['preis'];
$preistyp = $fetcharray['preistyp'];
$datum = $fetcharray['datum'];


if ($_POST['update']){
	
	$titel = $_POST['titel'];
	$kategorie = $_POST['kategorie'];
	$pbname = $_POST['pbname'];
	$beschreibung = $_POST['beschreibung'];
	$preis = $_POST['preis'];
	$preistyp = $_POST['preistyp'];
	
	if($_FILES['titelfoto']['size']){
		ini_set('upload_tmp_dir','/home/php/tmp/');
		move_uploaded_file($_FILES['titelfoto']['tmp_name'], "/var/www/html/schule/adphotos/$uaid/1.jpg");
	}
	

	mysqli_query($connection, "UPDATE `anzeigen` SET `titel`='$titel',`kategorie`='$kategorie',`name`='$pbname',`beschreibung`='$beschreibung',`plz`='$plz',`preis`='$preis',`preistyp`='$preistyp',`datum`='$datum' WHERE `aid`='$uaid'");

	
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
												echo "<option selected>$vorname</option>";
												echo "<option>$vorname $nachname</option>";
										} else {
												echo "<option>$vorname</option>";
												echo "<option selected>$vorname $nachname</option>";
										}
										
													
										echo "</select></td></tr><tr>
														<td style='vertical-align: top;'>Beschreibung </td>
														<td><textarea name='beschreibung' cols='40%' rows='10' required>$beschreibung</textarea></td>
													</tr>
													<tr>
														<td>Titelfoto</td>
														<td><input type='file' name='titelfoto' /></td>
													</tr>
													<tr>
														<td>Preis (in Euro)</td>
														<td><input type='text' name='preis' value='$preis' size='25%' pattern='[0-9]{1,10}' required /></td>
													</tr>
													<tr>
														<td>Preistyp </td>
														<td><select name='preistyp' required>";
										
														if ($preistyp == "VHB"){
															echo "<option selected>VHB</option>";
															echo "<option>FP</option>";
														} else {
															echo "<option>VHB</option>";
															echo "<option selected>FP</option>";
														}
														
										echo "</select></td></tr>
											<tr>
												<td></td>
												<td><input type='reset' value='Abbrechen' /> <input type='submit' value='Speichern' name='update'/></td>
											</tr>";
										
					
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
