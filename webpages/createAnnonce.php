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


<?php

$connection = mysqli_connect("localhost","root","","phpproject") or die("blubb");

if ($_POST['create']){
	
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
	
	mysqli_query($connection, "INSERT INTO `annonce` (`hersteller`, `bezeichnung`, `farbe`, `kapazitaet`, `display`, `kamera`, `akku`, `simkarte`, `beschreibung`, `preis`, `preistyp`)
                 VALUES ('$hersteller', '$bezeichnung', '$farbe', '$kapazitaet', '$display', '$kamera', '$akku', '$simkarte', '$beschreibung', '$preis', '$preistyp')");
	
}

?>

<form action='' method='POST'>
<table cellspacing='10'>
    <tr>
        <td>Hersteller</td>
        <td><input type='text' name='hersteller' /></td>
    </tr>
        <tr>
        <td>Bezeichung</td>
        <td><input type='text' name='bezeichnung' /></td>
    </tr>
    <tr>
        <td>Farbe</td>
        <td><input type='text' name='farbe' /></td>
    </tr>
    <tr>
        <td>Kapazit&auml;t</td>
        <td><input type='text' name='kapazitaet' /></td>
    </tr>
    <tr>
        <td>Display</td>
        <td><input type='text' name='display' /></td>
    </tr>
    <tr>
        <td>Kamera</td>
        <td><input type='text' name='kamera' /></td>
    </tr>
    <tr>
        <td>Akku</td>
        <td><input type='text' name='akku' /></td>
    </tr>
    <tr>
        <td>Sim-Format</td>
        <td><select name='simkarte'>
            <option>Nano</option>
            <option>Micro</option>
            <option>Standard</option>
        </select></td>
    </tr>
    <tr>
        <td>Beschreibung</td>
        <td><textarea name='beschreibung'></textarea></td>
    </tr>
    <tr>
        <td>Preis</td>
        <td><input type='text' name='preis' /></td>
    </tr>
    <tr>
        <td>Preistyp</td>
        <td><select name='preistyp'>
            <option>Festpreis</option>
            <option>Verhandlungsbasis</option>
        </select></td>
    </tr>
    <tr>
        <td></td>
        <td><input type='reset' /> <input type='submit' name='create' value='Erstellen' /></td>
    </tr>
    
</table>
</form>



</div>
</body>
</html>







