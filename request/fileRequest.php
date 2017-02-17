<?php

header('Content-Type: application/json');
$aResult;
require_once '../webpages/database.php';
if(isset($_POST['functionname'])) {
    $db = new database();
    switch($_POST['functionname']) {
        case 'createAnnonce':
            $aResult = $db->createAnnonce($_POST['title'], $_POST['text'], $_POST['category'], $_FILES['pics']);
            break;
    }
}
echo json_encode($aResult);
?>
