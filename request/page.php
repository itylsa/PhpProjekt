<?php
header('Content-Type: application/json');
$aResult;
session_start();
if(isset($_SESSION['page']) && $_SESSION['page'] != '') {
    
} else {
    $aResult = file_get_contents('../webpages/login.php');
}
echo json_encode($aResult);