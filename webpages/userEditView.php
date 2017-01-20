<!DOCTYPE html>
<!--
Baguette au Crossait
-->
<html>
    <head>
        <title>User</title>
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
        if(isset($_SESSION['uid'])) {
            require_once 'database.php';
            $db = new database();
            $result = $db->loadUserById($_SESSION['uid']);
            $fsOrt = $result['fsOrt'];
            $result2 = $db->loadOrtById($fsOrt);
            $fistName = $result['fistName'];
            $lastName = $result['lastName'];
            $eMail = $result['email'];
            $pw = $result['password'];
            $plz = $result2['plz'];
            $ort = $result2['ortName'];
            $street = $result['streetNr'];
            ?>

            <div class="content" >
                <form method="POST" action="editUser.php"  >
                    <h2> User bearbeiten: </h2>
                    <table style="margin: auto;">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Emaul:</td>
                                <td> <input type="email"  name="email" value="<?php echo ($eMail); ?>" required > </td>
                            </tr>
                            <tr>
                                <td>Password:</td>
                                <td> <input type="password" name="pw" value="<?php echo ($pw); ?>" required> </td>
                            </tr>
                            <tr>
                                <td>Vorname:</td>
                                <td> <input type="text" name="fistName" value="<?php echo ($fistName); ?>" required> </td>
                            </tr>
                            <tr>
                                <td>Nachname:</td>
                                <td> <input type="text" name="lastName" value="<?php echo ($lastName); ?>" required> </td>
                            </tr>
                            <tr>
                                <td>Straße:</td>
                                <td> <input type="text" name="street" value="<?php echo ($street); ?>" required> </td>
                            </tr>
                            <tr>
                                <td>Ort:</td>
                                <td> <input type="text" name="ort" value="<?php echo ($ort); ?>" required> </td>
                            </tr>
                            <tr>
                                <td>Plz:</td>
                                <td> <input type="text" name="plz" value="<?php echo ($plz); ?>" required> </td>
                            </tr>
                            <tr>
                                <td> </td>
                                <td> <input type="submit" name="save" title="Speichern" value="Speichern" class="save button" > </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
            <?php
        } else {
            header('Location: login.php');
        }
        ?>
    </body>
</html>

