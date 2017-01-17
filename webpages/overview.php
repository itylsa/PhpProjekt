<!DOCTYPE html>
<!--
Mit dieser Lizens wird Heiko Göhler offiziel zum Mongo erkärt.

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
        if(!isset($_SESSION['uid'])) {
            header('Location: login.php');
        } else {
            ?>
            <div class="content" >
                <h2> test </h2>
            </div>
            <?php
        }
        ?>
    </body>
</html>
