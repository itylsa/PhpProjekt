<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../styles/style.css">
        <link rel="stylesheet" href="../styles/styleLess500px.css">
        <script src="../scripts/core.js"></script>
        <script>
            function showLogin() {
                $('#loginForm').css({opacity: 0.0, visibility: "visible"}).animate({opacity: 1.0});
                $('#registerForm').css({opacity: 1.0, visibility: "hidden"}).animate({opacity: 0.0});
                document.getElementById('loginHead').style.backgroundColor = 'lightgrey';
                document.getElementById('registerHead').style.backgroundColor = 'transparent';
                document.getElementById('loginEmail').focus();
            }

            function showRegister() {
                $('#registerForm').css({opacity: 0.0, visibility: "visible"}).animate({opacity: 1.0});
                $('#loginForm').css({opacity: 1.0, visibility: "hidden"}).animate({opacity: 0.0});
                document.getElementById('registerHead').style.backgroundColor = 'lightgrey';
                document.getElementById('loginHead').style.backgroundColor = 'transparent';
                document.getElementById('registerEmail').focus();
            }

            function selectPlz(val) {
                document.getElementById('ort').value = val.value;
                var e = document.getElementById('plz');
                document.getElementById('plzHidden').value = e.options[e.selectedIndex].text;
            }
        </script>
    </head>
    <body>
        <div id="pageWrapper">
            <div id="navBar">
                <nav>
                    <h3>Navigation</h3>
                    <ul>
                        <?php
                        session_start();
                        if(isset($_SESSION['uId'])) {
                            ?>
                            <li><a href="userEditView.php">Account</a></li>
                            <li><a href="createAnnonce.php">Annonce erstellen</a></li>
                            <li><a href="overview.php">Übersicht</a></li>
                            <li><a href="addOrt.php">Ort hinzufügen</a></li>
                            <li><a href="logout.php">Logout</a></li>
                            <?php
                        } else {
                            ?>
                            <li><a href="login.php">Login</a></li>
                            <li><a href="addOrt.php">Ort hinzufügen</a></li>
                            <?php
                        }
                        ?>
                    </ul>
                </nav>
            </div>
            <div id="headerBar">
                <h1 id="header"> ANNONCIATOR </h1>
            </div>
            <div id="contentWrapper">
                <?php
                if(isset($_SESSION['page']) && $_SESSION['page'] != '') {

                } else {
                    include 'login.php';
                }
                ?>
            </div>
        </div>
    </body>
</html>
