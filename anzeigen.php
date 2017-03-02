<?php

$connection = mysqli_connect("localhost", "root", "goliath", "pinnwand") or die("Couldn't connect to database!");

include "checkcookie.php";

if ($uid == ''){
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
		<h2>Meine Anzeigen</h2>
		<br>
		<hr>
		
		
		<?php
			

						$abfrage = mysqli_query($connection, "SELECT * FROM anzeigen WHERE `uid`='$uid' ORDER BY datum ASC");
										
						while($ad = mysqli_fetch_assoc($abfrage)){
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
																	<td><b><p>KM</p><p>EZ</p><p>Leistung</p><p>Getriebe</p><p>Türen</p><p>Vorbesitzer</p><p>Beobachter</p></b></td>
																	<td><p>$kilometer</p><p>$ezmonat/$ezjahr</p><p>$leistung</p><p>$getriebe</p><p>$tueren</p><p>$vorbesitzer</p><p>xy</p></td>
																</tr>
															</table>
															<table width='80%'>
																<tr>
																	<td align='right'><a href='./anzeigebearbeiten.php?id=$aid'>Bearbeiten</a></td>
																</tr>
																<tr>
																	<td align='right'><a href='./anzeigeloeschen.php?id=$aid'>Löschen</a></td>
																</tr>
															</table>
															<br>
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
																	<td><b><p>KM</p><p>EZ</p><p>Leistung</p><p>Getriebe</p><p>Vorbesitzer</p><p>Beobachter</p></b></td>
																	<td><p>$kilometer</p><p>$ezmonat/$ezjahr</p><p>$leistung</p><p>$getriebe</p><p>$vorbesitzer</p><p>xy</p></td>
																</tr>
															</table>
															<table width='80%'>
																<tr>
																	<td align='right';><a href='./anzeigebearbeiten.php?id=$aid'>Bearbeiten</a></td>
																</tr>
																<tr>
																	<td align='right'><a href='./anzeigeloeschen.php?id=$aid'>Löschen</a></td>
																</tr>
															</table>
															<br>
															<hr>";	
										}
									}
			?>
		
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