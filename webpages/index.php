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
        <link rel="stylesheet" href="../css/styleLess600px.css">
        <link rel="stylesheet" href="../css/styleMore600px.css">
        <script src="../js/core.js"></script>
        <script src="../js/scripts.js"></script>
    </head>
    <body>
        <input type="button" onclick="checkUserExists()" value="click" />
        <div id="pageWrapper">
            <div id="navBar">
            </div>
            <div id="headerBar">
                <h1 id="header"> ANNONCIATOR </h1>
            </div>
            <div id="contentWrapper">
                <div id="content">
                </div>
                <div id="errorBoxWrapper">
                    <input id="errorBoxCloser" type="image" onclick="closeErrorBox()" src="../pictures/disc_kpackage_cd_package_cd_disk_packaging.png" value=""/>
                    <div id="errorBox">
                    </div>
                </div>
                <div id="successBoxWrapper">
                    <input id="successBoxCloser" type="image" onclick="closeSuccessBox()" src="../pictures/disc_kpackage_cd_package_cd_disk_packaging.png" value=""/>
                    <div id="successBox">
                    </div>
                </div>
                <div id="infoBoxWrapper">
                    <input id="infoBoxCloser" type="image" onclick="closeInfoBox()" src="../pictures/disc_kpackage_cd_package_cd_disk_packaging.png" value=""/>
                    <div id="infoBox">
                    </div>
                </div>
            </div>
            <script>
                getPageContent();
            </script>
        </div>
    </body>
</html>
