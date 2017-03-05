<?php

if ($_COOKIE['c_user'] && $_COOKIE['c_salt']){
    $cuser = mysqli_real_escape_string($connection, $_COOKIE['c_user']);
    $csalt = mysqli_real_escape_string($connection, $_COOKIE['c_salt']);
    $ccresult = mysqli_query($connection, "SELECT * FROM `benutzer` WHERE `salt`='$csalt'");
    $ccfetcharray = mysqli_fetch_assoc($ccresult);
    $vorname = $ccfetcharray['name'];
    $nachname = $ccfetcharray['lname'];
    $email = $ccfetcharray['email'];
    $strundhn = $ccfetcharray['strundhn'];
    $plz = $ccfetcharray['plz'];
    $ccortresult = mysqli_query($connection, "SELECT * FROM `orte` WHERE `plz`='$plz'");
    $ccortarray = mysqli_fetch_assoc($ccortresult);
    $ort = $ccortarray['ort'];
    $passwort = $ccfetcharray['password'];
    $uid = $ccfetcharray['id'];

}

?>