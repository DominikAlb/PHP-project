<div>
    <?php
    require_once(dirname(__DIR__) .  "/DBCredentials.php");
    require_once(dirname(__DIR__) .  "/GET/GetLoginHTML.php");
    $dbCredentials = new DBCredentials();
    $getLoginHTML = new GetLoginHTML($dbCredentials);
    if ($getLoginHTML->ifLoggedIn('name')) {
        ?>
        <div>
            <div>
                Witaj <?php echo $_SESSION['name'] ?>
            </div>
            <a class='Logoff' href='/php-project/php/POST/Logoff.php'>WYLOGUJ</a>
        </div>
        <div>
            <a class="UserMenu" href="/php-project/User/UserPanel.php">MOJE KONTO</a>
        </div>
        <?php
    } else {
        ?>
        <div>
            <a class='Login' href='/php-project/php/POST/Login.php'>ZALOGUJ</a>
        </div>
        <?php
    }
    if ($getLoginHTML->isAdmin()) {
        ?>
        <div>
            <a class="Admin" href="/php-project/Admin/AdminPanel.php">ADMIN</a>
        </div>
        <?php
    }
    ?>
</div>