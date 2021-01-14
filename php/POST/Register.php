<?php session_start(); ?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="../../css/register.css">
</head>
<body>

<?php
include $_SESSION['DIR'] . '/php-project/Menu.php';
require_once("../../php/DBCredentials.php");
require_once("../../php/GET/GetLoginHTML.php");
require_once("../../php/SQLProxy.php");
// define variables and set to empty values
$success = $emailErr = $phoneErr = $ftErr = $ltErr = $pwdErr = "";
$firstname = $email = $lastname = $phone = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $error = false;
    if (empty($_POST["firstname"])) {
        $ftErr = "Pole nie może być puste";
        $error = true;
    }
    if (empty($_POST["lastname"])) {
        $ltErr = "Pole nie może być puste";
        $error = true;
    }
    if (empty($_POST["password"])) {
        $pwdErr = "Pole nie może być puste";
        $error = true;
    }
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Błędny email";
        $error = true;
    }
    $_POST["phone"] = trim($_POST["phone"]);
    if (!preg_match("/^[0-9]{9}$/",$_POST["phone"]) && !preg_match("/^[+][0-9]{11}$/",$_POST["phone"])) {
        $phoneErr = "Błędny numer";
        $error = true;
    }
    $dbCredentials = new DBCredentials();
    $sqlProxy = new SQLProxy(null, $dbCredentials);
    if (!$error) {
        $sql = "SELECT EMAIL FROM Users WHERE EMAIL = :email OR PHONE = :phone";
        $arr = ["email" => $_POST["email"], "phone" => $_POST["phone"]];
        if($sqlProxy->columnExist($sql, $arr)) {
            $error = true;
            $phoneErr = $emailErr = "Użytkownik już istnieje";
        }
    }
    if ($error) {
        echo "Wszystkie pola są wymagane";

    } else {
        $_POST['password'] = hash("sha512", $_POST['password']);

        $sql = "INSERT INTO Users(Firstname, Lastname, Email, Phone, Password) 
                VALUE (:firstname, :lastname, :email, :phone, :password)";
        $sqlProxy->runQuery($sql, $_POST);

        $success = "Zostałeś zarejestrowany!";
        $dbCredentials = null;
    }
}
?>
    <div>
        <h2>UTWÓRZ KONTO</h2>
    </div>
    <section class='RegisterPanel'>
        <span class='error'>* Pole wymagane</span>
        <form method="post" name='registerForm' role='form' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
            <span class='error'><?php echo $success;?></span>
            <div class='RegisterFields'>
                <h4>IMIĘ:</h4>
                <input name='firstname' value="<?php echo $firstname;?>">
                <span class='error'>* <?php echo $ftErr;?></span>
                <h4>NAZWISKO:</h4>
                <input name='lastname' value="<?php echo $lastname;?>">
                <span class='error'>* <?php echo $ltErr;?></span>
                <h4>EMAIL:</h4>
                <input name='email' type='email' value="<?php echo $email;?>">
                <span class='error'>* <?php echo $emailErr;?></span>
                <h4>HASŁO:</h4>
                <input name='password' type='password' value="<?php echo $password;?>">
                <span class='error'>* <?php echo $pwdErr;?></span>
                <h4>TELEFON:</h4>
                <input name='phone' value="<?php echo $phone;?>">
                <span class='error'>* <?php echo $phoneErr;?></span>
            </div>
            <div class='RegisterButton'>
                <button role='button' type='submit'>UTWÓRZ KONTO</button>
            </div>
        </form>
    </section>
    <section class='Login'>
        <h3>MASZ JUŻ KONTO?</h3>
        <a class='RegisterLink' href='/php-project/php/POST/Login.php?'>ZALOGUJ SIĘ</a>
    </section>
</body>
</html>