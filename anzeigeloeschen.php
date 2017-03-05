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
# Alle restlichen Daten auslesen und in Datenbank speichern

if ($_POST['abbrechen']){
    header("Location: anzeigen.php");
}
if ($_POST['loeschen']){
	$caid = $_POST['caid'];
	$cuid = $_POST['cuid'];
    mysqli_query($connection, "DELETE FROM `anzeigen` WHERE `aid`='$caid' AND `uid`='$cuid'");
    exec("rm -rf /var/www/html/schule/adphotos/$caid/");

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
                <h3>Möchten Sie die Anzeige "<?php echo $titel; ?>" mit folgenden Daten wirklich löschen?</h3>
                <br>
				<table cellspacing="10">
					<?php
					
						
						echo "	<tr>
											<td>Titel </td>
											<td>$titel</td>
										</tr>
										<tr>
											<td>Kategorie </td>
											<td>$kategorie</td>
										</tr>";
													
													
													
										echo "<tr>
														<td style='vertical-align: top;'>Beschreibung </td>
														<td>";
                                                        echo nl2br($beschreibung);
                                                        
                                        echo "</td>
													</tr>
													<tr>
														<td style='vertical-align: top;'>Titelfoto</td>
														<td><img src='adphotos/$uaid/1.jpg' width='400px'></td>
													</tr>
													<tr>
														<td>Preis (in Euro)</td>
														<td>$preis $preistyp</td>
													</tr>";
													
										echo "<input type='hidden' name='caid' value='$uaid' />
											  <input type='hidden' name='cuid' value='$uid' />";
													
										echo "<tr>
												<td style='text-align: right;'><input type='submit' value='Abbrechen' name='abbrechen'/></td>
												<td><input type='submit' value='Löschen' name='loeschen' style='color: red;'/></td>
											</tr>";
										
					
					?>
				</table>
			</form>
		</center>
		<br>
    <br>
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
