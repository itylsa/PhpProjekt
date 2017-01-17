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
        require_once 'database.php';
        $db = new database();
        $uid = $_SESSION['uid'];
        $result = $db->loadUserById($uid);
        $result2 = $db->loadOrtById($result['fsOrt']);
        $fistName = $result['fistName'];
        $lastName = $result['lastName'];
        $eMail = $result['email'];
        $pw = $result['password'];
        $plz = $result2['plz'];
        $location = $result2['ortName'];
        $street = $result['streetNr'];
        ?>
        <div class="content" >
            <form>
                <h2> User bearbeiten: </h2>
                <table >
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Emaul:</td>
                            <td> <input type="email"  name="email" </td>
                        </tr>
                        <tr>
                            <td>Password:</td>
                            <td> <input type="password" name="pw" > </td>
                        </tr>
                        <tr>
                            <td>Vorname:</td>
                            <td> <input type="text" name="fistName"> </td>
                        </tr>
                        <tr>
                            <td>Nachname:</td>
                            <td> <input type="text" name="lastName"> </td>
                        </tr>
                        <tr>
                            <td>Straße:</td>
                            <td> <input type="text" name="street"> </td>
                        </tr>
                        <tr>
                            <td>Nummer:</td>
                            <td> <input type="text" name="streetNr"> </td>
                        </tr>
                        <tr>
                            <td>Ort:</td>
                            <td> <input type="text" name="city"> </td>
                        </tr>
                        <tr>
                            <td>Plz:</td>
                            <td> <input type="text" name="plz"> </td>
                        </tr>
                        <tr>
                            <td> <input type="reset" name="reset" class="reset button">  </td>
                            <td> <input type="submit" name="save" title="Speichern" value="Speichern" class="save button"> </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </body>
</html>
