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
        <script>
           function selectPlz(val) {
                document.getElementById('ort').value = val.value;
                var e = document.getElementById('plz');
                document.getElementById('plzHidden').value = e.options[e.selectedIndex].text;
            }
            </script>
        <div class="header">
            <?php include 'templates/header.php'; ?>
        </div>
        <div class="nav" >
            <?php include 'templates/navi.php'; ?>
        </div>

        <?php
        require_once 'database.php';
        $db = new database();
        $result = $db->loadUserById($_SESSION['uId']);
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
                            <td> <input type="text" name="street" value="$plz" required> </td>
                        </tr>
                        <tr>
                       <td>Ort:</td><td><input id="ort" readonly="true" type="text" value="<?php echo ($ort); ?>" name="ort" style="background-color: lightgray; pointer-events: none" required /></td>
                                    <td>Plz:</td>
                                    <td style="float: right">
                                        <select id="plz" onchange="selectPlz(this)" >
                                            <?php
                                            echo '<option value="' . $ort . '">' .  $plz . '</option>';
                                            $data = $db->getAllPlaces(); 
                                            while($rs = mysqli_fetch_assoc($data)) {
                                                if($rs['plz'] != $plz){
                                                echo '<option value="' . $rs['ortName'] . '">' . $rs['plz'] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                        <input id="plzHidden" type="hidden" name="plz" value="<?php echo ($plz); ?>" />
                                    </td>
                        </tr>
                        <tr>
                            <td> </td>
                            <td> <input type="submit" name="save" title="Speichern" value="Speichern" class="save button" > </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </body>
</html>

