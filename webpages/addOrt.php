<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ort anlegen</title>
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
        <div class="content">
            <form action="addOrt.php" method="POST">
                Plz: <input type="text" name="plz" required="true" pattern="[0-9]{5}" title="Muss aus genau 5 Zahlen bestehen" /><br>
                Ort: <input type="text" name="ort" required="true" pattern="[a-zA-Z]{1,30}" title="Muss aus bis zu 30 Buchstaben bestehen" /><br>
                <input type="submit" value="Ort anlegen" />
            </form>
            <?php
            if(isset($_POST['plz']) && isset($_POST['ort'])) {
                $ort = $_POST['ort'];
                $plz = $_POST['plz'];
                require_once './database.php';
                $db = new database();
                require_once './messagePage.php';
                $valid = $db->addOrt($plz, $ort);
                $m = new messagePage();
                if($valid) {
                    echo $m->showInfoMessage('Ort wurde erfolgreich angelegt');
                } else {
                    echo $m->showErrorMessage('Ort ist schon vorhanden');
                }
            }
            ?>
        </div>
    </body>
</html>
