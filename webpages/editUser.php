<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once('database.php');
        session_start();
        $db = new database();
        $email = $_POST['email'];
        $pw = $_POST['pw'];
        $fistName= $_POST['fistName'];
        $lastName= $_POST['lastName'];
        $street= $_POST['street'];
        $ort= $_POST['ort'];
        $plz= $_POST['plz'];
      
        $valid = $db->editUser($email, $pw, $fistName, $lastName, $street, $ort, $plz , $_SESSION['uId']);
        if($valid === TRUE){
           $_SESSION['userEditSuccesMessage']='Speichern erfolgreich!';
        }else{
           $_SESSION['userEditSuccesMessage']=$valid; 
        }
            header('Location: userEditView.php');
            ?>
        
    </body>
</html>
