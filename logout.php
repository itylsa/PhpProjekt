<?php

$connection = mysqli_connect("localhost", "root", "goliath", "kleinanzeigen") or die("Couldn't connect to database!");

include "checkcookie.php";

mysqli_query($connection, "UPDATE `benutzer` SET `salt`='offline' WHERE `id`='$uid'");
header('Location: http://sandroiv.goip.de/schule/');

?>
