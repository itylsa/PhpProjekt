<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
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
            <div style="color: black;">
        <?php
        if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['vorname']) && isset($_POST['nachname']) &&
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
                        echo "Benutzer wurde erfolgreich angelegt";
                    } else {
                        echo "Benutzer konnte nicht angelegt werden";
                    }
                } else {
                    echo "Email ist bereits vorhanden";
                }
            } else {
                echo "Bitte alle Felder ausfüllen";
            }
        } else {
            echo "Bitte alle Felder ausfüllen";
        }
        ?>
            </div>
        <br>
        <input type="button" value="Zurück" onclick="window.location.href = 'login.php'" />
        </div>
    </body>
</html>