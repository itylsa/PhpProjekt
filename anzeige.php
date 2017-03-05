<?php

$connection = mysqli_connect("localhost", "root", "goliath", "pinnwand") or die("Couldn't connect to database!");

include "checkcookie.php";

$id = $_GET['id'];


if ($_POST['beobachten']){
	$caid = $_POST['caid'];
	$uaid = $_POST['uaid'];
	$datum = date("d.m.Y");
	$check = mysqli_query($connection, "SELECT count(bid) AS anzahl FROM `beobachtungen` WHERE `aid`='$caid' AND `uid`='$uaid'");
	$check2 = mysqli_fetch_assoc($check);
	if ($check2['anzahl'] == "0"){
		mysqli_query($connection, "INSERT INTO `beobachtungen` (`aid`, `uid`, `datum`) VALUES ('$caid', '$uid', '$datum')");
	}
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
			echo '<a href="./login.php" style="text-decoration: none; color: black;">Einloggen</a>
						<hr>
						<a href="./registrieren.php" style="text-decoration: none; color: black;">Registrieren</a>';
		}
		?>
	
  </div>

  <div id="inhalt">
		<br>
		<center>
		<br>
		<hr>
		
		
		<?php

						$abfrage = mysqli_query($connection, "SELECT * FROM anzeigen WHERE `aid`='$id'");
										
						while($ad = mysqli_fetch_assoc($abfrage)){
										$aid = $ad['aid'];
										$uaid = $ad['uid'];
										$kontakt = $ad['name'];
										$titel = $ad['titel'];
										$kategorie = $ad['kategorie'];
										$preistyp = $ad['preistyp'];
										$preis = $ad['preis'];
										$plz = $ad['plz'];
										$beschreibung = $ad['beschreibung'];
										$datum = $ad['datum'];
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
																	<td align='left' style='font-weight: bold;'><h2>$titel</h2></td>
																</tr>
																</tr>
																	<td width='120px'></td>
																	<td align='right' width='150px' style='font-weight: bold;'>$preis € $preistyp</td>
																</tr>
																<tr>
																	<td><img src='adphotos/$aid/1.jpg' width='400px'/><p>$plz $adort</p></td>
																	<td style='vertical-align: top; text-align: right;'><br>Erstellt von $kontakt<br>Beobachter: $beobachter";
																	
																	if ($uaid != $uid){
																		echo "<br><br><form action='' method='post'><input type='hidden' name='caid' value='$aid' /><input type='hidden' name='uaid' value='$uaid' /><input type='submit' name='beobachten' value='Jetzt beobachten'/></form>";
																	}
												echo "</td>
														</tr>
															</table>
															<br>
															<table width='70%' cellspacing='10'>
																<tr>
																	<td style='font-weight: bold;'>Beschreibung</td>
																</tr>
																<tr>
																	<td><hr></td>
																</tr>
																<tr>
																	<td>";
																				echo nl2br($beschreibung);
												echo "</td>
																</tr>
																<tr>
																	<td><hr></td>
																</tr>
															</table>
															<br>
															<p>Erstellt am $datum</p>
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
