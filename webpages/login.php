<!DOCTYPE html>
<!--
Best License EU
-->
<html>
    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../styles/style.css">
        <script src="../core.js"></script>
        <script>
            function showLogin() {
                $('#loginForm').css({opacity: 0.0, visibility: "visible"}).animate({opacity: 1.0});
                $('#registerForm').css({opacity: 1.0, visibility: "hidden"}).animate({opacity: 0.0});
                document.getElementById('loginHead').style.backgroundColor = 'lightgrey';
                document.getElementById('registerHead').style.backgroundColor = 'white';
                document.getElementById('loginEmail').focus();
            }

            function showRegister() {
                $('#registerForm').css({opacity: 0.0, visibility: "visible"}).animate({opacity: 1.0});
                $('#loginForm').css({opacity: 1.0, visibility: "hidden"}).animate({opacity: 0.0});
                document.getElementById('registerHead').style.backgroundColor = 'lightgrey';
                document.getElementById('loginHead').style.backgroundColor = 'white';
                document.getElementById('registerEmail').focus();
            }

            function selectPlz(val) {
                document.getElementById('ort').value = val.value;
                var e = document.getElementById('plz');
                document.getElementById('plzHidden').value = e.options[e.selectedIndex].text;
            }
        </script>
    </head>
    <body>
        <div class="header">
            <?php include 'templates/header.php'; ?>
        </div>
        <div class="nav" >
            <?php include 'templates/navi.php'; ?>
        </div>
        <?php
        if(isset($_SESSION['uId'])) {
            header('Location: overview.php');
        } else {
            if(isset($_POST['email']) && isset($_POST['password'])) {
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
            } else {
                ?>
                <div style="width: 100%; text-align: center">
                    <div style="width: 410px; position: relative; text-align: center; margin: 10px auto;">
                        <h1>Loginseite</h1>
                        <div style="margin: 10px auto; width: 240px;">
                            <h2 id="loginHead" class="loginHead" onclick="showLogin()">Einloggen</h2>
                            <h2 id="registerHead" class="registerHead" onclick="showRegister()">Registrieren</h2>
                        </div>
                        <form id="loginForm" action="" method="POST" class="loginForm">
                            <table>
                                <tr>
                                    <td>Email:</td><td><input id="loginEmail" type="email" name="email" required /><br></td>
                                </tr>
                                <tr>
                                    <td>Passwort:</td><td><input type="password" name="password" required /><br></td>
                                </tr>
                                <tr>
                                    <td colspan="1" style="text-align: right"><input type="submit" value="Login" /></td>
                                    <td colspan="2" style="text-align: right"><input type="button" value="Passwort vergessen"
                                                                                     onclick="window.location.href = 'forgotPassword.php'" /></td>
                                </tr>
                            </table>
                        </form>
                        <form id="registerForm" action="createUser.php" method="POST" class="registerForm">
                            <table>
                                <tr>
                                    <td>Email:</td><td colspan="3"><input id="registerEmail" type="email" name="email" size="50" required /></td>
                                </tr>
                                <tr>
                                    <td>Kennwort:</td><td colspan="3"><input type="password" name="password" size="50" required  /></td>
                                </tr>
                                <tr>
                                    <td>Vorname:</td><td colspan="3"><input type="text" name="vorname" size="50" required /></td>
                                </tr>
                                <tr>
                                    <td>Nachname:</td><td colspan="3"><input type="text" name="nachname" size="50" required /></td>
                                </tr>
                                <tr>
                                    <td>Straße:</td><td><input type="text" name="strasse" required /></td>
                                    <td>Nr:</td><td><input type="text" name="hausnummer" required /></td>
                                </tr>
                                <tr>
                                    <td>Ort:</td><td><input id="ort" readonly="true" type="text" name="ort" style="background-color: lightgray; pointer-events: none" required /></td>
                                    <td>Plz:</td>
                                    <td style="float: right">
                                        <select id="plz" onchange="selectPlz(this)">
                                            <option value=""></option>
                                            <?php
                                            require_once './database.php';
                                            $db = new database();
                                            $data = $db->getAllPlaces();
                                            while($rs = mysqli_fetch_assoc($data)) {
                                                echo '<option value="' . $rs['ortName'] . '">' . $rs['plz'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                        <input id="plzHidden" type="hidden" name="plz" />
                                    </td>
                                </tr>
                            </table>
                            <input style="float: right;" type="submit" value="Erstellen" />
                        </form>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </body>
</html>
