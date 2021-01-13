<?php session_start();?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="../../css/register.css">
</head>
<body>
<?php
    require_once("../../php/DBCredentials.php");
    require_once("../../php/GET/GetLoginHTML.php");
    // define variables and set to empty values
    $error = $email = $password = $errorMsg = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $error = false;
        if (empty($_POST["email"])) {
            $ftErr = "Pole nie może być puste";
            $error = true;
        }
        if (empty($_POST["password"])) {
            $ltErr = "Pole nie może być puste";
            $error = true;
        }
        if (!$error) {
            $dbCredentials = new DBCredentials();
            $getLoginHTML = new GetLoginHTML($dbCredentials);
            $_POST['password'] = hash("sha512", $_POST['password']);
            $errorMsg = $getLoginHTML->login($_POST['email'], $_POST['password']);
            if (strcmp($errorMsg, "")) {
                $error = true;
            } else {
                header( "Location: http://localhost/php-project/Main.php" );
            }
        }
    }
?>
    <section class='LoginPanel'>
        <h2>ZALOGUJ SIĘ</h2>
        <form name='loginForm' role='form' method='post' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class='LoginFields'>
                <h4>EMAIL:</h4>
                <input type="email" name='email' value="<?php echo $email;?>">
                <h4>HASŁO:</h4>
                <input type="password" name='password' value="<?php echo $password;?>">
                <section class="error"><?php echo $errorMsg;?></section>
            </div>
            <div class='LoginButton'>
                <button role='button' type='submit'>ZALOGUJ SIĘ</button>
            </div>
        </form>
    </section>
    <section class='Register'>
        <h3>NIE MASZ KONTA?</h3>
        <a class='RegisterLink' href='/php-project/php/POST/Register.php?'>ZAREJESTRUJ SIĘ</a>
    </section>
</body>
</html>