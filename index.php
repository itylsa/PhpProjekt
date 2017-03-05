<?php

$connection = mysqli_connect("localhost", "root", "goliath", "pinnwand") or die("Couldn't connect to database!");

include "checkcookie.php";


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
					<?php
								$getkategorie = mysqli_query($connection, "SELECT kategorie FROM `kategorien`");
											while ($kategorien = mysqli_fetch_assoc($getkategorie)){
															$kategorie = $kategorien['kategorie'];
															echo "<option>$kategorie</option>";
											}
					?>
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
						<h2>Kleinanzeigen</h2>
						<br>
						<hr width='40%' color='black'>
						<br>
						<h2>Klasse E3FI4</h2>
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
										$preistyp = $ad['preistyp'];
										$preis = $ad['preis'];
										$plz = $ad['plz'];
										$adort = $ad['ort'];
										
										$ortsabfrage = mysqli_query($connection, "SELECT * FROM orte WHERE `plz`='$plz'");
										$resultortsabfrage = mysqli_fetch_assoc($ortsabfrage);
										$adort = $resultortsabfrage['ort'];
							
							
												echo "<br>
															<table width='80%'>
																<tr>
																	<td align='left'><a href='./anzeige.php?id=$aid' style='text-decoration: none; font-weight: bold; color: black;'>$titel</a></td>
																	<td align='right' width='150px' style='font-weight: bold;'>$preis € $preistyp</td>
																</tr>
																<tr>
																	<td><a href='./anzeige.php?id=$aid'><img src='adphotos/$aid/1.jpg' width='300px'/></a><p>$plz $adort</p></td>
																	<td></td>
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
											
									if ($aid == ''){
											
											echo "<br>
														<p>Keine Ergebnisse</p>";
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
		<p>Copyright &copy; <?php $copyrightyear = date("Y"); echo "$copyrightyear";?> Kleinanzeigen. Alle Rechte vorbehalten.<p>
		<br>
  </div>
</footer>
</div>
</body>
</html>
