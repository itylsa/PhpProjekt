<?php

header('Content-Type: application/json');
$aResult;
session_start();
if(isset($_SESSION['uId']) && $_SESSION['uId'] != '') {
    $aResult = file_get_contents('../webpages/overview.php');
    $aResult = $aResult . file_get_contents('../webpages/userEditView.php');
    $aResult = $aResult . file_get_contents('../webpages/addPlace.php');
} else {
    $aResult = file_get_contents('../webpages/login.php');
    $aResult = $aResult . file_get_contents('../webpages/addPlace.php');
    $aResult = $aResult . file_get_contents('../webpages/forgotPassword.php');
}
echo json_encode($aResult);
