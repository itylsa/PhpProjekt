<?php

$connection = mysqli_connect("localhost", "root", "goliath", "pinnwand") or die("Couldn't connect to database!");

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
			echo '<a href="./erstelleanzeige.php" style="text-decoration: none; color: black;">Anzeige erstellen</a>
						<hr>
						<br>
						<hr>
						<a href="./anzeigen.php" style="text-decoration: none; color: black;">Meine Anzeigen</a>
						<hr>
						<a href="./beobachtungen.php" style="text-decoration: none; color: black;">Meine Beobachtungen</a>
						<hr>
						<br>
						<hr>
						<a href="./chat.php" style="text-decoration: none; color: green;">Nachrichten (beta in 2017)</a>
						<hr>
						<br>
						<hr>
						<a href="./profil.php" style="text-decoration: none; color: black;">Profil bearbeiten</a>
						<hr>
						<a href="./logout.php" style="text-decoration: none; color: black;">Ausloggen</a>';
		} else {
			echo '<a href="./login.php" style="text-decoration: none; color: black;">Einloggen</a>
						<hr>
						<a href="./registrieren.php" style="text-decoration: none; color: black;">Registrieren</a>';
		}
		?>
	
  </div>

  <div id="inhalt">
		<br>
		<center>
			<form action="">
				<input type="text" name="query" placeholder="Suchbegriff" size="30" /> in Kategorie
				<select name="kategorie">
					<option>Alle</option>
					<option>Auto</option>
					<option>Motorrad</option>
				</select>
				<input type="submit" name="suche" value="Suchen" />
			</form>
		<br>
		<hr>
		<?php
		
		if (!$_GET['suche']){
			echo "<br>
						<h2>Willkommen zu unserem</h2>
						<h2>Schulprojekt</h2>
						<br>
						<hr width='40%' color='black'>
						<br>
						<h2>Car&Bike Kleinanzeigen</h2>
						<br>
						<hr width='40%' color='black'>
						<br>
						<h2>Klasse E3FS7</h2>
						<br>
						<h2>Heinrich-Hertz-Schule Karlsruhe</h2>
						<br>";		
		}?>

		
		<?php
			
			if ($_GET['suche']){
						$query = $_GET['query'];
						$kategorie = $_GET['kategorie'];
						
						if($kategorie == "Alle"){
							$abfrage = mysqli_query($connection, "SELECT * FROM anzeigen WHERE titel LIKE '%$query%' ORDER BY preis ASC");
						} else {
							$abfrage = mysqli_query($connection, "SELECT * FROM anzeigen WHERE titel LIKE '%$query%' AND `kategorie`='$kategorie' ORDER BY preis ASC");
						}
						
									
						while($ad = mysqli_fetch_assoc($abfrage)){
										$uaid = $ad['uid'];
										$aid = $ad['aid'];
										$titel = $ad['titel'];
										$kategorie = $ad['kategorie'];
										$kilometer = $ad['kilometer'];
										$ezmonat = $ad['ezmonat'];
										$ezjahr = $ad['ezjahr'];
										$vorbesitzer = $ad['vorbesitzer'];
										$leistung = $ad['leistung'];
										$getriebe = $ad['getriebe'];
										$tueren = $ad['tueren'];
										$preistyp = $ad['preistyp'];
										$preis = $ad['preis'];
										$plz = $ad['plz'];
										$adort = $ad['ort'];
										
										$ortsabfrage = mysqli_query($connection, "SELECT * FROM orte WHERE `plz`='$plz'");
										$resultortsabfrage = mysqli_fetch_assoc($ortsabfrage);
										$adort = $resultortsabfrage['ort'];
							
										if($kategorie == "Auto"){
												echo "<br>
															<table width='80%'>
																<tr>
																	<td align='left'><a href='./anzeige.php?id=$aid' style='text-decoration: none; font-weight: bold; color: black;'>$titel</a></td>
																	<td width='120px'></td>
																	<td align='right' width='150px' style='font-weight: bold;'>$preis € $preistyp</td>
																</tr>
																<tr>
																	<td><a href='./anzeige.php?id=$aid'><img src='adphotos/$aid/1.jpg' width='300px'/></a><p>$plz $adort</p></td>
																	<td><b><p>KM</p><p>EZ</p><p>Leistung</p><p>Getriebe</p><p>Türen</p><p>Vorbesitzer</p></b></td>
																	<td><p>$kilometer</p><p>$ezmonat/$ezjahr</p><p>$leistung</p><p>$getriebe</p><p>$tueren</p><p>$vorbesitzer</p></td>
																</tr>
															</table>";
												if($uaid == $uid){
													echo "<table width='80%'>
																<tr>
																	<td></td>
																	<td align='right'><a href='./anzeigebearbeiten.php?id=$aid'>Bearbeiten</a></td>
																</tr>
																<tr>
																	<td style='font-weight: bold;'>Ihre Anzeige</td>
																	<td align='right'><a href='./anzeigeloeschen.php?id=$aid'>Löschen</a></td>
																</tr>
															</table>";
												}
													echo "<br>
															<hr>";
										} else {
											echo "<br>
															<table width='80%'>
																<tr>
																	<td align='left'><a href='./anzeige.php?id=$aid' style='text-decoration: none; font-weight: bold; color: black;'>$titel</a></td>
																	<td width='120px'></td>
																	<td align='right' width='150px' style='font-weight: bold;'>$preis € $preistyp</td>
																</tr>
																<tr>
																	<td><a href='./anzeige.php?id=$aid'><img src='adphotos/$aid/1.jpg' width='300px'/></a><p>$plz $adort</p></td>
																	<td><b><p>KM</p><p>EZ</p><p>Leistung</p><p>Getriebe</p><p>Vorbesitzer</p></b></td>
																	<td><p>$kilometer</p><p>$ezmonat/$ezjahr</p><p>$leistung</p><p>$getriebe</p><p>$vorbesitzer</p></td>
																</tr>
															</table>";
												if($uaid == $uid){
													echo "<table width='80%'>
																<tr>
																	<td></td>
																	<td align='right'><a href='./anzeigebearbeiten.php?id=$aid'>Bearbeiten</a></td>
																</tr>
																<tr>
																	<td style='font-weight: bold;'>Ihre Anzeige</td>
																	<td align='right'><a href='./anzeigeloeschen.php?id=$aid'>Löschen</a></td>
																</tr>
															</table>";
												}
													echo "<br>
															<hr>";	
										}
									}
											
									if ($aid == ''){
											$output = shell_exec("sudo python spellcheck.py $query");
											
											if($kategorie == "Alle"){
													$abfrage = mysqli_query($connection, "SELECT * FROM anzeigen WHERE titel LIKE '%$query%' ORDER BY preis ASC");
											} else {
													$abfrage = mysqli_query($connection, "SELECT * FROM anzeigen WHERE titel LIKE '%$query%' AND `kategorie`='$kategorie' ORDER BY preis ASC");
											}
											
											echo "<br>
														<p>Keine Ergebnisse</p>
														<br>
														<p>Meinten Sie: <a href='index.php?query=$output&kategorie=Alle&suche=Suchen'>$output</a>?</p>";
									}
									
			}?>
		
		<br>
		<br>
		<br>
		</center>
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