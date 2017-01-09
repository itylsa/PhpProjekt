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
        $fName = $_POST['vorname'];
        $lName = $_POST['nachname'];
        $ort = $_POST['ort'];
        $strasse = $_POST['strasse'];
        $hausnummer = $_POST['hausnummer'];


        if($email != "" && $pwd != "" && $fName != "" && $lName != "" && $ort != "" && $strasse != "" && $hausnummer != "") {
            $strasse = $strasse . " " . $hausnummer;
            $db = new database();
            $valid = $db->createUser($email, $pwd, $fName, $lName, $ort, $strasse);
            if($valid) {
                echo "Benutzer wurde erfolgreich angelegt";
            } else {
                echo "Benutzer konnte nicht angelegt werden, Email bereits vorhanden";
            }
        } else {
            echo "Bitte alle Felder ausfüllen";
        }
        ?>
    </body>
</html>