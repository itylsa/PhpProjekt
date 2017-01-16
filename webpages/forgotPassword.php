<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        if(isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            require_once './database.php';
            $db = new database();
            $success = $db->newPassword($email, $password);
            if($success) {
                echo "<h1 style='color: blue;'>Passwort erfolgreich geändert</h1>";
            } else {
                echo "<h1 style='color: red;'>Passwort konnte nicht geändert werden. Falsche Email?</h1>";
            }
            ?>
            <br><input type="button" value="Zurück zum Login" onclick="window.location.href = 'login.html'" />
            <?php
        } else {
            ?>
            <form action="forgotPassword.php" method="POST">
                Email: <input type="email" required="true" name="email" /><br>
                Neues Passwort: <input type="password" required="true" name="password" /><br>
                <input type="submit" value="Neues Passwort anfordern" />
            </form>
            <?php
        }
        ?>
    </body>
</html>
