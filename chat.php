<?php

$connection = mysqli_connect("localhost", "root", "goliath", "pinnwand") or die("Couldn't connect to database!");

include "checkcookie.php";

if ($uid == ''){
    header('Location: http://dakochmachine.goip.de/schule/');
}


if ($_POST['loeschen']){
	$cid = $_POST['cid'];
	mysqli_query($connection, "DELETE FROM `chat` WHERE `cid`='$cid'");
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
		<h2>Kontaktieren Sie den Käufer/Verkäufer</h2>
		<br>
		<hr>
		
		
		<?php
			

						$abfrage = mysqli_query($connection, "SELECT * FROM chat WHERE `kid`='$uid' OR `vid`='$uid'");
										
						while($chat = mysqli_fetch_assoc($abfrage)){
										$cid = $chat['cid'];
										$vid = $chat['vid'];
										$vname = $chat['vname'];
										$kid = $chat['kid'];
										$kname = $chat['kname'];
										
										
										$nachrichtenabfrage = mysqli_query($connection, "SELECT * FROM nachrichten WHERE `cid`='$cid' ORDER BY `nid` DESC LIMIT 1");
										$nachrichten = mysqli_fetch_assoc($nachrichtenabfrage);
										$ncid = $nachrichten['cid'];
										$nvid = $nachrichten['vid'];
										$nkid = $nachrichten['kid'];
										$nachricht = $nachrichten['nachricht'];
										$datum = $nachrichten['datum'];
										$uhrzeit = $nachrichten['uhrzeit'];
							
										
												echo "<br>
															<table width='80%'>
																<tr>
																	<td align='left'><a href='./nachrichten.php?cid=$cid' style='text-decoration: none; font-weight: bold; color: black;'>";
																	
																	if ($vid == $uid){
																		echo "$kname";
																	} else {
																		echo "$vname";
																	}
																	
												echo "</a></td>
																	<td width='120px'></td>
																	<td align='right' width='150px' style='font-weight: bold;'>$datum<br>$uhrzeit</td>
																</tr>
																<tr>
																	<td style='font-style: italic;'>$nachricht</td>
																</tr>
															</table>
															<table width='80%'>
																<tr>
																	<td align='right'><form action='' method='post'><input type='hidden' name='cid' value='$cid' /><input type='submit' name='loeschen' value='Löschen' /></form></td>
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
		<p>Copyright &copy; <?php $copyrightyear = date("Y"); echo "$copyrightyear";?> Car&Bike Kleinanzeigen. Alle Rechte vorbehalten.<p>
		<br>
  </div>
</footer>
</div>
</body>
</html>