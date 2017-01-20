<h3>Navigation</h3>
<nav>
    <ul>
        <?php
        session_start();
        if(isset($_SESSION['uId'])) {
            ?>
            <li><a href="userEditView.php">Account</a></li>
            <li><a href="createAnnonce.php">Annonce erstellen</a></li>
            <li><a href="overview.php">Übersicht</a></li>
            <li><a href="logout.php">Logout</a></li>
            <?php
        } else {
            ?>
            <li><a href="login.php">Login</a></li>
            <?php
        }
        ?>
    </ul>
</nav>

