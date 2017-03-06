<!DOCTYPE html>
<!--
Mit dieser Lizens wird Heiko Göhler offiziel zum Mongo erkärt.
Lizenz wird mit z geschrieben. Mongo.
offiziell wird mit 2 l geschrieben...Was kannst du?
-->
<html>
    <head>
        <title>Übersicht</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../styles/style.css">
    </head>
    <body>
        <div class="header">
            <?php include 'templates/header.php'; ?>
        </div>
        <div class="nav" >
            <?php include 'templates/navi.php'; ?>
        </div>
        <?php
        if(!isset($_SESSION['uId'])) {
            header('Location: login.php');
        } else {
            ?>
            <div class="content" >
                <h2> test </h2>
				
				<form action=''>
					<input type='text' name='query' placeholder='Suchbegriff' />
					<input type='submit' name='suche' />
				</form>
					
            </div>
            <?php
        }
        ?>
		

	</body>
</html>