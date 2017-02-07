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
        <link rel="stylesheet" href="../css/style.css">
        <script src="../js/core.js"></script>
        <script src="../js/scripts.js"></script>
    </head>
    <body>
        <div id="pageWrapper">
            <div id="navBar" style="display: block; left: -150px;">
            </div>
            <div id="headerBar">
                <span>
                    <image id="menuButton" class="rotate" src="../pictures/2000px-Chevron_right_font_awesome.svg.png" />
                </span>
                <h1 id="header"> ANNONCIATOR </h1>
                <span id="loggedInfo">asd</span>
            </div>
            <div id="contentWrapper">
                <div id="content">
                </div>
                <div id="errorBoxWrapper" class="boxWrapper">
                    <input id="errorBoxCloser" class="boxCloser" type="image" onclick="closeErrorBox()" src="../pictures/disc_kpackage_cd_package_cd_disk_packaging.png" value=""/>
                    <div id="errorBox" class="box">
                    </div>
                </div>
                <div id="successBoxWrapper" class="boxWrapper">
                    <input id="successBoxCloser" class="boxCloser" type="image" onclick="closeSuccessBox()" src="../pictures/disc_kpackage_cd_package_cd_disk_packaging.png" value=""/>
                    <div id="successBox" class="box">
                    </div>
                </div>
                <div id="infoBoxWrapper" class="boxWrapper">
                    <input id="infoBoxCloser" class="boxCloser" type="image" onclick="closeInfoBox()" src="../pictures/disc_kpackage_cd_package_cd_disk_packaging.png" value=""/>
                    <div id="infoBox" class="box">
                    </div>
                </div>
                <div id="newPlaceBoxWrapper" class="boxWrapper">
                    <input id="newPlaceBoxCloser" class="boxCloser" type="image" onclick="closeInfoBox()" src="../pictures/disc_kpackage_cd_package_cd_disk_packaging.png" value=""/>
                    <div id="newPlaceBox" class="box">
                        <form id="addPlaceForm" onsubmit="addPlace('addPlaceForm'); event.preventDefault()" novalidate method="POST">
                            <table>
                                <tr>
                                    <td>Plz:</td><td><input type="text" id="plz" min="5" max="5" pattern="^[0-9]+$" title="Nur Zahlen" required /></td>
                                </tr>
                                <tr>
                                    <td><td><div class="errorMessage" id="plzError"></div></td></td>
                                </tr>
                                <tr>
                                    <td>Ort:</td><td><input type="text" id="place" min="2" max="40" pattern="^[A-Z][a-z]+$" title="Nur Buchstaben. Groß anfangen" required /></td>
                                </tr>
                                <tr>
                                    <td><td><div class="errorMessage" id="placeError"></div></td></td>
                                </tr>
                                <tr>
                                    <td></td><td><input type="submit" value="Anlegen" /></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
