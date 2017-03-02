<!DOCTYPE html>
<html lang="de">
<head>
<title>Car&Bike Kleinanzeigen</title>
<link rel="stylesheet" type="text/css" href="./style.css" />
</head>

<body>
<div id="seite">
  <div id="kopfbereich">
    <center>
			<br>
			<h1>Car&Bike Kleinanzeigen</h1>
      <h3>Erfülle Dir noch heute Deinen Traum!</h3>
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
		<p>Willkommen Alex!</p>
		<br>
		<hr>
		<a href="./anzeigen.php" style="text-decoration: none; color: black;">Meine Anzeigen</a>
		<hr>
		<a href="./beobachtungen.php" style="text-decoration: none; color: black;">Meine Beobachtungen</a>
  </div>

  <div id="inhalt">
		<br>
		<center>
			<form action="./suche.php">
				<input type="text" name="suche" size="30" />
				<input type="submit" value="Suchen" />
			</form>
		</center>
		<br>
		<hr>
					<!-- Anzeigen -->
		<br>
		<table width="700px">
			<tr>
				<td align="left" style="font-weight: bold;">VW Golf 7 GTI *Scheckheftgepflegt* *Klimaanlage* *Navi* *1. Hand* *Nur 23T KM*</td>
				<td width="120px"></td>
				<td align="right" width="150px" style="font-weight: bold;">23.900 €</td>
			</tr>
			<tr>
				<td><img src="adphotos/golf.jpg" width="300px"/><p>80331 München</p></td>
				<td><b><p>KM</p><p>EZ</p><p>Leistung in PS</p><p>Getriebe</p><p>Türen</p></b></td>
				<td><p>23.000</p><p>06/2015</p><p>200</p><p>Manuell</p><p>3</p></td>
			</tr>
		</table>
		<br>
		<hr>
		
		<br>
		<table width="700px">
			<tr>
				<td align="left" style="font-weight: bold;">Daelim Daystar Black Plus 125ccm FI</td>
				<td width="120px"></td>
				<td align="right" width="150px" style="font-weight: bold;">2.400 €</td>
			</tr>
			<tr>
				<td><img src="adphotos/daelimdaystar.jpg" width="300px"/><p>10115 Berlin</p></td>
				<td><b><p>KM</p><p>EZ</p><p>Leistung in PS</p><p>Kubik</p><p>Gänge</p><p>Antrieb</p></b></td>
				<td><p>8.000</p><p>06/2015</p><p>13</p><p>125</p><p>5</p><p>Kette</p></td>
			</tr>
		</table>
		<br>
		<hr>
		
		<br>
		<table width="700px">
			<tr>
				<td align="left" style="font-weight: bold;">Moto Guzzi V7 II Stone ABS Neufahrzeug!</td>
				<td width="120px"></td>
				<td align="right" width="150px" style="font-weight: bold;">6.999 €</td>
			</tr>
			<tr>
				<td><img src="./motoguzzistoneii.jpg" width="300px"/><p>50667 Köln</p></td>
				<td><b><p>KM</p><p>EZ</p><p>Leistung in PS</p><p>Kubik</p><p>Gänge</p><p>Antrieb</p></b></td>
				<td><p>0</p><p>10/2016</p><p>48</p><p>749</p><p>6</p><p>Kardan</p></td>
			</tr>
		</table>
		<br>
		<hr>
		
		<br>
		<table width="700px">
			<tr>
				<td align="left" style="font-weight: bold;">VW Bus T1 Oldtimer</td>
				<td width="120px"></td>
				<td align="right" width="150px" style="font-weight: bold;">138.500 €</td>
			</tr>
			<tr>
				<td><img src="./vwbust1.jpg" width="300px"/><p>90402 Nürnberg</p></td>
				<td><b><p>KM</p><p>EZ</p><p>Leistung in PS</p><p>Getriebe</p><p>Türen</p></b></td>
				<td><p>1.000</p><p>01/1960</p><p>30</p><p>Manuell</p><p>5</p></td>
			</tr>
		</table>
		<br>
		<hr>
		
		<br>
		<table width="700px">
			<tr>
				<td align="left" style="font-weight: bold;">Mercedes-Benz G 63 AMG</td>
				<td width="120px"></td>
				<td align="right" width="150px" style="font-weight: bold;">94.900 €</td>
			</tr>
			<tr>
				<td><img src="./g63amg.jpg" width="300px"/><p>79098 Freiburg</p></td>
				<td><b><p>KM</p><p>EZ</p><p>Leistung in PS</p><p>Getriebe</p><p>Türen</p></b></td>
				<td><p>20</p><p>06/2015</p><p>571</p><p>Automatik</p><p>5</p></td>
			</tr>
		</table>
		<br>
		<hr>
		<br>
		
	</div>

  <div id="fussbereich">
    <br>
    <footer>Copyright &copy; <?php $copyrightyear = date("Y"); echo "$copyrightyear";?> Car&Bike Kleinanzeigen. Alle Rechte vorbehalten.</footer>
    <br>
  </div>
</div>
</body>
</html>