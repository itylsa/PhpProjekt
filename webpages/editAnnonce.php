<?php

$connection = mysqli_connect("localhost", "root", "", "phpproject") or die("Couldn't connect to database!");

$aid = $_GET['aid'];		# Seitenaufruf muss so passieren: http://localhost/editAnnonce.php?aid=12 damits funktioniert. 12 ist die Anzeigenid in der Datenbank.

$arrayresult = mysqli_query($connection, "SELECT * FROM `annonce` WHERE `aid`='$uaid'");
$fetcharray = mysqli_fetch_assoc($arrayresult);

	$hersteller = $fetcharray['hersteller'];
	$bezeichnung = $fetcharray['bezeichnung'];
	$farbe = $fetcharray['farbe'];
	$kapazitaet = $fetcharray['kapazitaet'];
	$display = $fetcharray['display'];
	$kamera = $fetcharray['kamera'];
	$akku = $fetcharray['akku'];
	$simkarte = $fetcharray['simkarte'];
	$beschreibung = $fetcharray['beschreibung'];
	$preis = $fetcharray['preis'];
	$preistyp = $fetcharray['preistyp'];

if ($_POST['update']){
	
	$hersteller = $_POST['hersteller'];
	$bezeichnung = $_POST['bezeichnung'];
	$farbe = $_POST['farbe'];
	$kapazitaet = $_POST['kapazitaet'];
	$display = $_POST['display'];
	$kamera = $_POST['kamera'];
	$akku = $_POST['akku'];
	$simkarte = $_POST['simkarte'];
	$beschreibung = $_POST['beschreibung'];
	$preis = $_POST['preis'];
	$preistyp = $_POST['preistyp'];
	
	
	mysqli_query($connection, "UPDATE `annonce` SET `hersteller`='$hersteller',`bezeichnung`='$bezeichnung',`farbe`='$farbe',`kapazitaet`='$kapazitaet',`display`='$display',`kamera`='$kamera',`akku`='$akku',
        `simkarte`='$simkarte',`beschreibung`='$beschreibung',`preis`='$preis',`preistyp`='$preistyp' WHERE `aid`='$aid'");
	
}


?>


<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Make annonces great again!</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <link rel="stylesheet" href="../styles/style.css">
    </head>
    <body>
        <div class="header">
            <?php include 'templates/header.php'; ?>
        </div>
        <div class="nav" >
            <?php include 'templates/navi.php'; ?>          
        </div>
        <div class="content" >
            <h2> test </h2>
	
		<br>
		<hr>
		

			<form action="" method="post" enctype="multipart/form-data">
				<table cellspacing="10">
					<?php
					
						
						echo "<tr>
								<td>Hersteller</td>
								<td><input type='text' name='hersteller' placeholder='$hersteller'/></td>
							  </tr>
							  <tr>
								<td>Bezeichnung</td>
								<td><input type='text' name='bezeichnung' placeholder='$bezeichnung'/>
							  </tr>
							  <tr>
								<td>Farbe</td>
								<td><input type='text' name='farbe' placeholder='$farbe' /></td>
							  </tr>
							  <tr>
								<td>Kapazit&auml;t</td>
								<td><input type='text' name='kapazitaet' placeholder='$kapazitaet'/></td>
							  </tr>
							  <tr>
								<td>Display</td>
								<td><input type='text' name='display' placeholder='$display'/></td>
							  </tr>
							  <tr>
								<td>Kamera</td>
								<td><input type='text' name='kamera' placeholder='$kamera'/></td>
							  </tr>
							  <tr>
								<td>Akku</td>
								<td><input type='text' name='akku' placeholder='$akku'/></td>
							  </tr>
							  <tr>
								<td>Sim-Format</td>
								<td><select name='simkarte'>";
								
								if ($simkarte == "Nano"){
									echo "<option selected>Nano</option>
										  <option>Micro</option>
										  <option>Standard</option>";
								}
								if ($simkarte == "Micro"){
									echo "<option>Nano</option>
										  <option selected>Micro</option>
										  <option>Standard</option>";
								}
								if ($simkarte == "Standard"){
									echo "<option>Nano</option>
										  <option>Micro</option>
										  <option selected>Standard</option>";
								}
								
									echo "
								</select></td>
							  </tr>
							  <tr>
								<td>Beschreibung</td>
								<td><textarea name='beschreibung'>";
								echo nl2br($beschreibung);
								echo "</textarea></td>
							  </tr>
							  <tr>
								<td>Preis</td>
								<td><input type='text' name='preis' placeholder='$preis'/></td>
							  </tr>
							  <tr>
								<td>Preistyp</td>
								<td><select name='preistyp'>";
									
								if ($preistyp == "Festpreis"){
									echo "<option selected>Festpreis</option>
										  <option>Verhandlungsbasis</option>";
								}
								if ($preistyp == "Verhandlungsbasis"){
									echo "<option>Festpreis</option>
										  <option selected>Verhandlungsbasis</option>";
								}
									
									
								echo "</select></td>
							  </tr>
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
</footer>
</div>
</body>
</html>