<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Passwort vergessen</title>
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
        <div class="content">
            <?php
            if(isset($_POST['email']) && isset($_POST['password'])) {
                $email = $_POST['email'];
                $password = $_POST['password'];
                require_once './database.php';
                $db = new database();
                $success = $db->newPassword($email, $password);
                require_once './messagePage.php';
                $m = new messagePage();
                if($success) {
                    echo $m->showInfoMessage('Passwort erfolgreich geändert');
                } else {
                    echo $m->showErrorMessage('Passwort konnte nicht geändert werden. Falsche Email');
                }
                ?>
                <br><input type="button" value="Zurück zum Login" onclick="window.location.href = 'login.php'" />
                <?php
            } else {
                ?>
                <form action="forgotPassword.php" method="POST">
                    Email: <input type="email" required="true" name="email" /><br>
                    Neues Passwort: <input type="password" required="true" name="password" /><br>
                    <input type="submit" value="Neues Passwort anfordern" />
                </form>
            </div>
            <?php
        }
        ?>
    </body>
</html>
