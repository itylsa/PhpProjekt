<?php

$connection = mysqli_connect("localhost", "root", "goliath", "pinnwand") or die("Couldn't connect to database!");

include "checkcookie.php";

mysqli_query($connection, "UPDATE `pinnwand` SET `salt`='offline' WHERE `id`='$uid'");
header('Location: http://dakochmachine.goip.de/schule/');

?>