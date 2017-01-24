<?php
if(isset($_SESSION['uId'])) {
    header('Location: overview.php');
} else {
    ?>
    <div id="loginWrapper">
        <div id="loginInnerWrapper">
            <h1>Loginseite</h1>
            <div id="loginHeaderWrapper">
                <h2 id="loginHead" onclick="showLogin()">Einloggen</h2>
                <h2 id="registerHead" onclick="showRegister()">Registrieren</h2>
            </div>
            <form id="loginForm" method="POST">
                <table>
                    <tr>
                        <td>Email:</td><td><input id="loginEmail" type="email" name="loginEmail" required /><br></td>
                    </tr>
                    <tr>
                        <td>Passwort:</td><td><input type="password" name="loginPassword" required /><br></td>
                    </tr>
                    <tr>
                        <td colspan="1"><input type="submit" value="Login" /></td>
                        <td colspan="2"><input type="button" value="Passwort vergessen" onclick="window.location.href = 'forgotPassword.php'" /></td>
                    </tr>
                </table>
            </form>
            <form id="registerForm" method="POST">
                <table>
                    <tr>
                        <td>Email:</td><td colspan="3"><input id="registerEmail" type="email" name="email" size="50" required /></td>
                    </tr>
                    <tr>
                        <td>Kennwort:</td><td colspan="3"><input type="password" name="password" size="50" required  /></td>
                    </tr>
                    <tr>
                        <td>Vorname:</td><td colspan="3"><input type="text" name="vorname" pattern="[a-zA-Z]{1,20}" title="Buchstaben, 1-20" size="50" required /></td>
                    </tr>
                    <tr>
                        <td>Nachname:</td><td colspan="3"><input type="text" name="nachname" pattern="[a-zA-Z]{1,20}" title="Buchstaben, 1-20" size="50" required /></td>
                    </tr>
                    <tr>
                        <td>Straße:</td><td><input type="text" name="strasse" pattern="[a-zA-Z]{1,40}" title="Buchstaben, 1-40" required /></td>
                        <td>Nr:</td><td><input type="text" name="hausnummer" pattern="[0-9]{1,4}" title="Zahlen, 1-4" required /></td>
                    </tr>
                    <tr>
                        <td>Ort:</td><td><input id="ort" readonly="true" type="text" name="ort" class="deactivated" required /></td>
                        <td>Plz:</td>
                        <td>
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
    <div class="content">
        <?php
        require_once './messagePage.php';
        $m = new messagePage();
        if(isset($_POST['loginEmail']) && isset($_POST['loginPassword'])) {
            require_once('database.php');
            $email = $_POST['loginEmail'];
            $pwd = $_POST['loginPassword'];
            $db = new database();
            $valid = $db->login($email, $pwd);
            if($valid) {
                echo "<script>window.location.href = 'overview.php'</script>";
            } else {
                echo "<div class='content'>";
                echo $m->showErrorMessage('Account nicht vorhanden oder Passwort falsch');
                echo "</div>";
            }
        } else if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['vorname']) && isset($_POST['nachname']) &&
                isset($_POST['ort']) && isset($_POST['plz']) && isset($_POST['strasse']) && isset($_POST['hausnummer'])) {
            require_once('database.php');
            $email = $_POST['email'];
            $pwd = $_POST['password'];
            $fName = $_POST['vorname'];
            $lName = $_POST['nachname'];
            $ort = $_POST['ort'];
            $plz = $_POST['plz'];
            $strasse = $_POST['strasse'];
            $hausnummer = $_POST['hausnummer'];

            if($email != "" && $pwd != "" && $fName != "" && $lName != "" && $ort != "" && $plz != "" && $strasse != "" && $hausnummer != "") {
                $strasse = $strasse . " " . $hausnummer;
                $db = new database();
                $exists = $db->checkIfEmailExists($email);
                if(!$exists) {
                    $oId = $db->loadOrtByPlzOrt($plz, $ort);
                    $valid = $db->createUser($email, $pwd, $fName, $lName, $oId, $strasse);
                    if($valid) {
                        echo $m->showInfoMessage('Benutzer wurde erfolgreich angelegt');
                    } else {
                        echo $m->showErrorMessage('Benutzer konnte nicht angelegt werden');
                    }
                } else {
                    echo $m->showErrorMessage('Email ist bereits vorhanden');
                }
            } else {
                echo $m->showErrorMessage('Bitte alle Felder ausfüllen');
            }
        }
        ?></div><?php
}
?>