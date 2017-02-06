<!DOCTYPE html>
<!--
Mit dieser Lizens wird Heiko Göhler offiziel zum Mongo erkärt.
Lizenz wird mit z geschrieben. Mongo.
offiziell wird mit 2 l geschrieben...Was kannst du?
-->
<html>
    <head>
        <title>Übersicht</title>
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
        <?php
        if(!isset($_SESSION['uId'])) {
            header('Location: login.php');
        } else {
            ?>
            <div class="content" >
                <h2> test </h2>
				
				<form action=''>
					<input type='text' name='query' placeholder='Suchbegriff' />
					<input type='submit' name='suche' />
				</form>
					
            </div>
            <?php
        }
        ?>
		

<?php

$connection = mysqli_connect("localhost", "root", "", "phpproject") or die("Couldn't connect to database!");

if ($_GET['suche']){
            $query = $_GET['query'];

            $abfrage = mysqli_query($connection, "SELECT * FROM annonce WHERE Bezeichnung LIKE '%$query%' ORDER BY Preis ASC");

            while($ad = mysqli_fetch_assoc($abfrage)){
                $hersteller = $ad['hersteller'];
				$bezeichnung = $ad['bezeichnung'];
				$farbe = $ad['farbe'];
				$kapazitaet = $ad['kapazitaet'];
				$display = $ad['display'];
				$kamera = $ad['kamera'];
				$akku = $ad['akku'];
				$simkarte = $ad['simkarte'];
				$beschreibung = $ad['beschreibung'];
				$preis = $ad['preis'];
				$preistyp = $ad['preistyp'];
				

                echo "<br>
                <table width='80%'>
                    <tr>
                        <td align='left'><a href='./overview.php?id=$aid' style='text-decoration: none; font-weight: bold; color: black;'>$hersteller $bezeichnung</a></td>
                        <td width='120px'></td>
                        <td align='right' width='150px' style='font-weight: bold;'>$preis € $preistyp</td>
                    </tr>
                    <tr>
                        <td><a href='./overview.php?id=$aid'><img src='adphotos/$aid/1.jpg' width='300px'/></a></td>
                        <td><b><p>Farbe</p><p>Kapazitaet</p><p>Display</p><p>Kamera</p></b></td>
                        <td><p>$farbe</p><p>$kapazitaet</p><p>$display</p><p>$akku</p></td>
                    </tr>
                </table>
                <br>
                <hr>";
                }
}

?>

	</body>
</html>