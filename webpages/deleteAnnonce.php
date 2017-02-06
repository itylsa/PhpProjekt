<?php
$connection = mysqli_connect("localhost", "root", "", "phpproject") or die("Couldn't connect to database!");

$aid = $_GET['aid']; # Seitenaufruf muss so passieren: http://localhost/deleteAnnonce.php?aid=12 damits funktioniert.

# Anzeige wird hier einfach gelöscht egal ob man Besitzer der Annonce ist oder nicht
mysqli_query($connection, "DELETE FROM `anzeigen` WHERE `aid`='$caid' AND `uid`='$cuid'");

?>