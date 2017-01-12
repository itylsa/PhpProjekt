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
        require_once('database.php');
        $email = $_POST['email'];
        $pwd = $_POST['password'];
        $db = new database();      
        $valid = $db->login($email, $pwd);
        if($valid) {
            header('Location: overview.php');
        } else {
            header('Location: failedLogin.php');
        }
        ?>
    </body>
</html>
