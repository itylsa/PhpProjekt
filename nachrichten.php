<?php

$connection = mysqli_connect("localhost", "root", "goliath", "pinnwand") or die("Couldn't connect to database!");

include "checkcookie.php";

if ($uid == ''){
    header('Location: http://dakochmachine.goip.de/schule/');
}

if ($_POST['sendnachricht']){
	$scid = $_POST['cid'];
	$svid = $_POST['vid'];
	$skid = $_POST['kid'];
	$sendnachricht = $_POST['nachricht'];
	$verfasser = $_POST['verfasser'];
	$sdatum = $_POST['datum'];
	$suhrzeit = date("H:i");
	if ($sendnachricht != ''){
		mysqli_query($connection, "INSERT INTO `nachrichten` (`cid`, `vid`, `kid`, `nachricht`, `verfasser`, `datum`, `uhrzeit`) VALUES ('$scid', '$svid', '$skid', '$sendnachricht', '$verfasser', '$sdatum', '$suhrzeit')");
	}
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
		<h2>Nachrichten</h2>
		<br>
		<hr>
		
		
		
		<?php
			
						$cid = $_GET['cid'];
						$abfrage = mysqli_query($connection, "SELECT * FROM chat WHERE `cid`='$cid'");
										
						$chat = mysqli_fetch_assoc($abfrage);
						$cid = $chat['cid'];
						$vid = $chat['vid'];
						$vname = $chat['vname'];
						$kid = $chat['kid'];
						$kname = $chat['kname'];
										
						echo "<br>";
										
						if ($vid == $uid){
							echo "<h3 style='font-weight: bold;'>Kontakt mit Käufer $kname</h3><br>";
						} else {
							echo "<h3 style='font-weight: bold;'>Kontakt mit Verkäufer $vname</h3><br>";
						}
							
							
						$nachrichtenabfrage = mysqli_query($connection, "SELECT * FROM nachrichten WHERE `cid`='$cid'");
						
						while($nachrichten = mysqli_fetch_assoc($nachrichtenabfrage)){
							$nnid = $nachrichten['nid'];
							$ncid = $nachrichten['cid'];
							$nvid = $nachrichten['vid'];
							$nkid = $nachrichten['kid'];
							$nachricht = $nachrichten['nachricht'];
							$nverfasser = $nachrichten['verfasser'];
							$datum = $nachrichten['datum'];
							$uhrzeit = $nachrichten['uhrzeit'];
							
							if ($nverfasser == $uid){
								echo "<table width='80%' cellspacing='10'>
												<tr>
													<td width='40%'></td>
													<td align='center' width='20%'>$datum<br>$uhrzeit</td>
													<td width='40%' bgcolor='lightblue'>";
													echo nl2br($nachricht);
													echo "</td>
												</tr>
											</table>
											<br>";
							} else {
								echo "<table width='80%' cellspacing='10'>
												<tr>
													<td width='40%' bgcolor='lightblue'>";
													echo nl2br($nachricht);
													echo "</td>
													<td align='center' width='20%'>$datum<br>$uhrzeit</td>
													<td width='40%'></td>
												</tr>
											</table>
											<br>";
							}
						}
										
			?>
		
		<!--<br>
		<br>
		<a href="javascript: window.location.reload()" style="text-decoration: none; color: green;">Aktualisieren</a> -->
		<br>
		<br>
		<hr>
		<br>
		<form action="" method="post">
		<input type="hidden" name="cid" value="<?php echo $cid; ?>" />
		<input type="hidden" name="vid" value="<?php echo $vid; ?>" />
		<input type="hidden" name="kid" value="<?php echo $kid; ?>" />
		<textarea name="nachricht" cols="50" rows="8"></textarea>
		<input type="hidden" name="verfasser" value="<?php echo $uid; ?>" />
		<input type="hidden" name="datum" value="<?php echo date("d.m.Y"); ?>" />
		<br>
		<br>
		<input type="submit" name="sendnachricht" value="Senden" />
		</form>
		<br>
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