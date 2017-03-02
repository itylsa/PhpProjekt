<?php

$connection = mysqli_connect("localhost", "root", "goliath", "pinnwand") or die("Couldn't connect to database!");

include "checkcookie.php";

$uaid = $_GET['id'];

$arrayresult = mysqli_query($connection, "SELECT * FROM `anzeigen` WHERE `aid`='$uaid'");
$fetcharray = mysqli_fetch_assoc($arrayresult);

$titel = $fetcharray['titel'];
$kategorie = $fetcharray['kategorie'];
$pbname = $fetcharray['name'];
$fahrzeugtyp = $fetcharray['fahrzeugtyp'];
$kilometer = $fetcharray['kilometer'];
$ezmonat = $fetcharray['ezmonat'];
$ezjahr = $fetcharray['ezjahr'];
$vorbesitzer = $fetcharray['vorbesitzer'];
$leistung = $fetcharray['leistung'];
$getriebe = $fetcharray['getriebe'];
$kraftstoff = $fetcharray['kraftstoff'];
$tueren = $fetcharray['tueren'];
$beschreibung = $fetcharray['beschreibung'];
$preis = $fetcharray['preis'];
$preistyp = $fetcharray['preistyp'];
$datum = $fetcharray['datum'];
# Alle restlichen Daten auslesen und in Datenbank speichern

if ($_POST['update']){
	
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
	
	if($_FILES['titelfoto']['size']){
		ini_set('upload_tmp_dir','/home/php/tmp/');
		move_uploaded_file($_FILES['titelfoto']['tmp_name'], "/var/www/html/schule/adphotos/$uaid/1.jpg");
	}
	
	#die("$titel | $kategorie | $pbname | $fahrzeugtyp | $kilometer | $erstzulassung | $leistung | $getriebe | $kraftstoff | $tueren | <br> $beschreibung <br> $preis | $preistyp | $datum");
	if($kategorie == "Auto"){
		mysqli_query($connection, "UPDATE `anzeigen` SET `titel`='$titel',`kategorie`='$kategorie',`name`='$pbname',`fahrzeugtyp`='$fahrzeugtyp',`kilometer`='$kilometer',`ezmonat`='$ezmonat',`ezjahr`='$ezjahr',`vorbesitzer`='$vorbesitzer',`leistung`='$leistung',`getriebe`='$getriebe',`kraftstoff`='$kraftstoff',`tueren`='$tueren',`beschreibung`='$beschreibung',`plz`='$plz',`preis`='$preis',`preistyp`='$preistyp',`datum`='$datum' WHERE `aid`='$uaid'");
	} else {
		mysqli_query($connection, "UPDATE `anzeigen` SET `titel`='$titel',`kategorie`='$kategorie',`name`='$pbname',`kilometer`='$kilometer',`ezmonat`='$ezmonat',`ezjahr`='$ezjahr',`vorbesitzer`='$vorbesitzer',`leistung`='$leistung',`getriebe`='$getriebe',`kraftstoff`='$kraftstoff',`beschreibung`='$beschreibung',`plz`='$plz',`preis`='$preis',`preistyp`='$preistyp',`datum`='$datum' WHERE `aid`='$uaid'");	
	}
	
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
					
						
						echo "	<tr>
											<td>Titel </td>
											<td><input type='text' name='titel' value='$titel' size='25%' required /></td>
										</tr>
										<tr>
											<td>Kategorie </td>
											<td><select name='kategorie' required>
													<option>Auto</option>
												</select></td>
										</tr>";
													
													
													
													echo "<tr>
																	<td>Fahrzeugtyp</td>
																	<td><select name='fahrzeugtyp'>";
																	
																	$getftyp = mysqli_query($connection, "SELECT typ FROM `fahrzeugtyp`");
																	while ($ftypen = mysqli_fetch_assoc($getftyp)){
																		$ftyp = $ftypen['typ'];
																		
																		if ($fahrzeugtyp == $ftyp){
																			echo "<option selected>$fahrzeugtyp</option>";
																		} else {
																			echo "<option>$ftyp</option>";
																		}
																		
																	}
																	
																	
													echo "</select></td></tr>";
																

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
										
										echo "<tr>
														<td>Kilometer </td>
														<td><input type='text' name='kilometer' value='$kilometer' size='25%' pattern='[0-9]{1,6}' required /></td>
													</tr>
													<tr>
														<td>Erstzulassung </td>
														<td><select name='ezmonat'>";
														
										for($i = 1; $i <= 12; $i++){
											
											if($ezmonat < $i){
												if($i >= 10){
													echo "<option>$i</option>";
												} else {
													echo "<option>0$i</option>";
												}		
											} elseif($ezmonat > $i){
												if($i >= 10){
													echo "<option>$i</option>";
												} else {
													echo "<option>0$i</option>";
												}
											} else {
												if($ezmonat >= 10){
													echo "<option selected>$i</option>";
												} else {
													echo "<option selected>0$i</option>";
												}
											}
											
											
										}
														
										echo "</select><select name='ezjahr'>";
										
										for($i = date("Y"); $i >= 1900; $i--){
											if($ezjahr == $i){
												echo "<option selected>$i</option>";
											} else {
												echo "<option>$i</option>";
											}
										}
														
										echo "</select></td>
													</tr>
													<tr>
														<td>Vorbesitzer</td>
														<td><input type='text' name='vorbesitzer' value='$vorbesitzer' size='25%' pattern='[0-9]{1}' required /></td>
													</tr>
													<tr>
														<td>Leistung (in PS) </td>
														<td><input type='text' name='leistung' value='$leistung' size='25%' pattern='[0-9]{1,4}' required /></td>
													</tr>
													<tr>
														<td>Getriebe </td>
														<td><select name='getriebe' required>";
														
														if ($getriebe == "Manuell"){
															echo "<option selected>Manuell</option>";
															echo "<option>Automatik</option>";
														} else {
															echo "<option>Manuell</option>";
															echo "<option selected>Automatik</option>";
														}
										
										echo "</select></td>
													</tr>
													<tr>
														<td>Kraftstoff </td>
														<td><select name='kraftstoff' required>";
														
														if ($kraftstoff == "Benzin"){
															echo "<option selected>Benzin</option>";
															echo "<option>Diesel</option>";
															echo "<option>Gas</option>";
															echo "<option>Strom</option>";
														} elseif ($kraftstoff == "Diesel") {
															echo "<option>Benzin</option>";
															echo "<option selected>Diesel</option>";
															echo "<option>Gas</option>";
															echo "<option>Strom</option>";
														} elseif ($kraftstoff == "Gas") {
															echo "<option>Benzin</option>";
															echo "<option>Diesel</option>";
															echo "<option selected>Gas</option>";
															echo "<option>Strom</option>";
														} else {
															echo "<option>Benzin</option>";
															echo "<option>Diesel</option>";
															echo "<option>Gas</option>";
															echo "<option selected>Strom</option>";
														}
														
										echo "</select></td>";
										
													if ($kategorie == "Auto"){
														
														echo "<tr>
														<td>Türen </td>
														<td><select name='tueren' required>";
																	
														if ($tueren == 3){
															echo "<option selected>3</option>";
															echo "<option>5</option>";
														} else {
															echo "<option>3</option>";
															echo "<option selected>5</option>";
														}
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
		<p>Copyright &copy; <?php $copyrightyear = date("Y"); echo "$copyrightyear";?> Car&Bike Kleinanzeigen. Alle Rechte vorbehalten.<p>
		<br>
  </div>
</footer>
</div>
</body>
</html>