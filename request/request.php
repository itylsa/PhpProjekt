<?php

header('Content-Type: application/json');
$aResult;
require_once '../webpages/database.php';
if(isset($_POST['functionname']) && isset($_POST['arguments'])) {
    $db = new database();
    switch($_POST['functionname']) {
        case 'login':
            $aResult = $db->login($_POST['arguments']);
        case 'create':
            $aResult = $db->createUser($_POST['arguments']);
        case 'getPlaces':
            $aResult = $db->getAllPlaces();
    }
}
echo json_encode($aResult);
?>
