<?php
header('Content-Type: application/json');
$aResult;
session_start();
if(isset($_SESSION['uId']) && $_SESSION['uId'] != '') {
    $aResult = file_get_contents('../webpages/templates/naviLogged.php');
} else {
    $aResult = file_get_contents('../webpages/templates/navi.php');
}
echo json_encode($aResult);