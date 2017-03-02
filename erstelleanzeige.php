<?php

$connection = mysqli_connect("localhost", "root", "goliath", "pinnwand") or die("Couldn't connect to database!");

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
	$fahrzeugtyp = $_POST['fahrzeugtyp'];
	$kilometer = $_POST['kilometer'];
	$ezmonat = $_POST['ezmonat'];
	$ezjahr = $_POST['ezjahr'];
	$vorbesitzer = $_POST['vorbesitzer'];
	$leistung = $_POST['leistung'];
	$getriebe = $_POST['getriebe'];
	$kraftstoff = $_POST['kraftstoff'];
	$tueren = $_POST['tueren'];
	$beschreibung = $_POST['beschreibung'];
	$preis = $_POST['preis'];
	$preistyp = $_POST['preistyp'];
	$datum = date("d.m.Y");
	
	
	#die("$titel | $kategorie | $pbname | $fahrzeugtyp | $kilometer | $erstzulassung | $leistung | $getriebe | $kraftstoff | $tueren | <br> $beschreibung <br> $preis | $preistyp | $datum");
	
	if($kategorie == "Auto"){
		mysqli_query($connection, "INSERT INTO `anzeigen` (`uid`, `titel`, `kategorie`, `name`, `fahrzeugtyp`, `kilometer`, `ezmonat`, `ezjahr`, `vorbesitzer`, `leistung`, `getriebe`, `kraftstoff`, `tueren`, `beschreibung`, `plz`, `preis`, `preistyp`, `datum`) VALUES ('$uid', '$titel', '$kategorie', '$pbname', '$fahrzeugtyp', '$kilometer', '$ezmonat', '$ezjahr', '$vorbesitzer', '$leistung', '$getriebe', '$kraftstoff', '$tueren', '$beschreibung', '$plz', '$preis', '$preistyp', '$datum')");
	} else {
	mysqli_query($connection, "INSERT INTO `anzeigen` (`uid`, `titel`, `kategorie`, `name`, `kilometer`, `ezmonat`, `ezjahr`, `vorbesitzer`, `leistung`, `getriebe`, `kraftstoff`, `beschreibung`, `plz`, `preis`, `preistyp`, `datum`) VALUES ('$uid', '$titel', '$kategorie', '$pbname', '$kilometer', '$ezmonat', '$ezjahr', '$vorbesitzer', '$leistung', '$getriebe', '$kraftstoff', '$beschreibung', '$plz', '$preis', '$preistyp', '$datum')");
	}
	
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
											
											if ($kategorie == "Auto"){
													echo "<option>Auto</option>";
													echo "</select></td>
																</tr>";
													
													echo "<tr>
																	<td>Fahrzeugtyp</td>
																	<td><select name='fahrzeugtyp'>";
													$getftyp = mysqli_query($connection, "SELECT typ FROM `fahrzeugtyp`");
													while ($ftypen = mysqli_fetch_assoc($getftyp)){
															$ftyp = $ftypen['typ'];
															echo "<option>$ftyp</option>";
													}
													
													echo "</select></td></tr>";
																
																
											} else {
													echo "<option>Motorrad</option>";
													echo "</select></td>
																</tr>";
											}

										echo "<tr>
											<td>Veröffentlichter Name </td>
											<td><select name='pbname' required>";
										
										if ($pbname == "$vorname"){
												echo "<option>$vorname</option>";
										} else {
												echo "<option>$vorname $nachname</option>";
										}
										
										echo "<tr>
														<td>Kilometer </td>
														<td><input type='text' name='kilometer' size='25%' pattern='[0-9]{1,6}' required /></td>
													</tr>
													<tr>
														<td>Erstzulassung </td>
														<td><select name='ezmonat'>";
														
										for($i = 1; $i <= 12; $i++){
											if($i >= 10){
												echo "<option>$i</option>";
											} else {
												echo "<option>0$i</option>";
											}
										}
														
										echo "</select><select name='ezjahr'>";
										
										for($i = date("Y"); $i >= 1900; $i--){
												echo "<option>$i</option>";
										}
														
										echo "</select></td>
													</tr>
													<tr>
														<td>Vorbesitzer</td>
														<td><input type='text' name='vorbesitzer' size='25%' pattern='[0-9]{1}' required /></td>
													</tr>
													<tr>
														<td>Leistung (in PS) </td>
														<td><input type='text' name='leistung' size='25%' pattern='[0-9]{1,4}' required /></td>
													</tr>
													<tr>
														<td>Getriebe </td>
														<td><select name='getriebe' required>
																	<option>Manuell</option>
																	<option>Automatik</option>
														</select></td>
													</tr>
													<tr>
														<td>Kraftstoff </td>
														<td><select name='kraftstoff' required>
																	<option>Benzin</option>
																	<option>Diesel</option>
																	<option>Gas</option>
																	<option>Strom</option>
																</select></td>
													</tr>";
													
													if ($kategorie == "Auto"){
														
														echo "<tr>
														<td>Türen </td>
														<td><select name='tueren' required>
																	<option>3</option>
																	<option>5</option>
																</select></td>
														</tr>";
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
											<td><select name='kategorie' required>
														<option>Auto</option>
														<option>Motorrad</option>
													</select></td>
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
		<p>Copyright &copy; <?php $copyrightyear = date("Y"); echo "$copyrightyear";?> Car&Bike Kleinanzeigen. Alle Rechte vorbehalten.<p>
		<br>
  </div>
</footer>
</div>
</body>
</html>