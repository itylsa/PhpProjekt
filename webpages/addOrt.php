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
            <?php
            if(isset($_POST['plz']) && isset($_POST['ort'])) {
                $ort = $_POST['ort'];
                $plz = $_POST['plz'];
                if($plz == '' || $ort == '') {
                    echo "Sie müssen eine Plz und einen Ort eingeben";
                    ?><button onclick="window.location.href = 'addOrt.php'">Zurück</button><?php
                } else {
                    require_once './database.php';
                    $db = new database();
                    $db->addOrt($plz, $ort);
                    echo "Ort wurde erfolgreich angelegt";
                }
            } else {
                ?>
                <form action="addOrt.php" method="POST">
                    Plz: <input type="text" name="plz" required="true" />
                    Ort: <input type="text" name="ort" required="true" />
                    <input type="submit" value="Ort anlegen" />
                </form>
                <?php
            }
            ?>
        </div>
    </body>
</html>
