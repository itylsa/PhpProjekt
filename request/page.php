<?php
header('Content-Type: application/json');
$aResult;
session_start();
if(isset($_SESSION['uId']) && $_SESSION['uId'] != '') {
    
} else {
    $aResult = file_get_contents('../webpages/login.php');
    $aResult = $aResult . file_get_contents('../webpages/addPlace.php');
}
echo json_encode($aResult);