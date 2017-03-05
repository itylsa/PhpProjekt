<?php

$connection = mysqli_connect("localhost", "root", "goliath", "kleinanzeigen") or die("Couldn't connect to database!");

include "checkcookie.php";

if ($uid == ''){
    header('Location: http://sandroiv.goip.de/schule/');
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
										$preistyp = $ad['preistyp'];
										$preis = $ad['preis'];
										$plz = $ad['plz'];
										
										$beobachtungsabfrage = mysqli_query($connection, "SELECT count(bid) AS anzahl FROM beobachtungen WHERE `aid`='$aid'");
										$beobachtungen = mysqli_fetch_assoc($beobachtungsabfrage);
										$beobachter = $beobachtungen['anzahl'];
										if ($beobachter == ""){
											$beobachter = "0";
										}
										
										$ortsabfrage = mysqli_query($connection, "SELECT * FROM orte WHERE `plz`='$plz'");
										$resultortsabfrage = mysqli_fetch_assoc($ortsabfrage);
										$adort = $resultortsabfrage['ort'];
							
							

												echo "<br>
															<table width='80%'>
																<tr>
																	<td align='left'><a href='./anzeige.php?id=$aid' style='text-decoration: none; font-weight: bold; color: black;'>$titel</a></td>
																	<td width='120px'></td>
																	<td align='right' width='150px' style='font-weight: bold;'>$preis € $preistyp</td>
																</tr>
																<tr>
																	<td><a href='./anzeige.php?id=$aid'><img src='adphotos/$aid/1.jpg' width='300px'/></a><p>$plz $adort</p></td>
																	<td><b><p>Beobachter:</p></b></td>
																	<td><p>$beobachter</p></td>
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
		<p>Copyright &copy; <?php $copyrightyear = date("Y"); echo "$copyrightyear";?> Kleinanzeigen. Alle Rechte vorbehalten.<p>
		<br>
  </div>
</footer>
</div>
</body>
</html>
