<?php
session_start();
require_once("../php/DBCredentials.php");
require_once("../php/GET/GetLoginHTML.php");
require_once("../php/SQLProxy.php");
include $_SESSION['DIR'] . '/php-project/Menu.php';
$street = $postcode = $city = $home = $Error = "";
$oldpwd = $newpwd = $confirmpwd = "";
$id = "";

$dbCredentials = new DBCredentials();
$getLoginHTML = new GetLoginHTML($dbCredentials);
$sqlProxy = new SQLProxy(null, $dbCredentials);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST)) {
        $sql = "SELECT * FROM USERS WHERE EMAIL = :email";
        $params = ["email" => $_SESSION["name"]];
        $id = $sqlProxy->returnTable($sql, $params)[0]["ID"];
        if (isset($_POST["ChangeMainData"])) {
            ?>
            <h2>Aktualny adres</h2>
            <?php
            $sql = "SELECT address FROM Useraddress WHERE UserID = :userid";
            $params = ["userid" => $id];
            echo $getLoginHTML->showDBTable($sql, $params);
            ?>
            <h2>Dodaj adres</h2>
            <section class="ShowMainData">
                <form name='EditAddress' role='form' method='post' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" />
                    <div class='RegisterFields'>
                        <h4>Kod pocztowy: </h4>
                        <input name='postcode' value="<?php echo $postcode;?>">
                        <span class="Error">*</span>
                        <h4>Miasto:</h4>
                        <input name='city' value="<?php echo $city;?>">
                        <span class="Error">*</span>
                        <h4>Ulica:</h4>
                        <input name='street' value="<?php echo $street;?>">
                        <span class="Error">*</span>
                        <h4>Numer mieszkania:</h4>
                        <input name='home' value="<?php echo $home;?>">
                        <span class="Error">*</span>
                    </div>
                    <div class='RegisterButton'>
                        <button name="EditAddress" role='button' type='submit'>Dodaj adres</button>
                    </div>
                </form>
            </section>
            <h2>Zmień hasło</h2>
            <section class="ShowMainData">
                <form name='EditPassword' role='form' method='post' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" />
                    <div class='RegisterFields'>
                        <h4>Stare hasło:</h4>
                        <input name='actualpwd' type='password' value="<?php echo $oldpwd;?>">
                        <span class="Error">*</span>
                        <h4>Nowe hasło:</h4>
                        <input name='newpwd' type='password' value="<?php echo $newpwd;?>">
                        <span class="Error">*</span>
                        <h4>Powtórz nowe hasło:</h4>
                        <input name='confirmpwd' type='password' type='email' value="<?php echo $confirmpwd;?>">
                        <span class="Error">*</span>
                    </div>
                    <div class='RegisterButton'>
                        <button name="EditPassword" role='button' type='submit'>Zmień hasło</button>
                    </div>
                </form>
            </section>
            <?php
        } elseif (isset($_POST["ChangeAdditionalData"])) {
            ?>
            <section class="ShowMainData">
                <form name='EditEducation' role='form' method='post' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" />
                    <div class='RegisterFields'>
                        <h4>Poziom edukacji: <?php
                            $sql = "SELECT EDUCATION FROM EDUCATION WHERE ID IN (SELECT EDUCATIONID FROM USEREDUCATION WHERE userid = :userid)";
                            $params = ["userid" => $id];
                            print_r($sqlProxy->returnTable($sql, $params)[0]["EDUCATION"]);
                            ?></h4>
                        <?php
                        $sql = "SELECT ID, EDUCATION FROM EDUCATION";
                        echo $getLoginHTML->showDBSelect($sql, null, "ID", "EDUCATION");
                        ?>
                    </div>                                                                                    
                    <div class='RegisterButton'>
                        <button name="EditEducation" role='button' type='submit'>Zmień ustawienia</button>
                    </div>
                </form>
            </section>
            <section class="ShowMainData">
                <form name='EditInterests' role='form' method='post' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" />
                <div class='RegisterFields'>
                    <h4>Zainteresowania: <?php
                        $sql = "SELECT INTEREST FROM INTERESTS WHERE ID IN (SELECT INTERESTID FROM USERINTERESTS WHERE userid = :userid)";
                        $params = ["userid" => $id];
                        $str = "";
                        $arr = $sqlProxy->returnTable($sql, $params);
                        foreach ($arr as $col) $str = $str . $col["INTEREST"] . ", ";
                        $str = substr($str, 0, strlen($str)-2);
                        print_r($str);
                        ?></h4>
                    <?php
                    $sql = "SELECT ID, INTEREST FROM INTERESTS";
                    echo $getLoginHTML->showDBSelect($sql, null, "ID", "INTEREST", "multiselect");
                    ?>
                </div>
                <div class='RegisterButton'>
                    <button name="EditInterests" role='button' type='submit'>Zmień preferencje</button>
                </div>
                </form>
            </section>
            <?php
        } elseif (isset($_POST["EditAddress"])) {
            $err = false;
            if (preg_match("/^[0-9]{2}[-]{1}[0-9]{3}$/",$_POST["postcode"]) || preg_match("/^[0-9]{5}$/",$_POST["postcode"])) {
                $address = $_POST["street"] . " " . $_POST["home"] . " " . $_POST["postcode"] . " " . $_POST["city"];
                $sql = "INSERT INTO USERADDRESS (address, userid)
                    VALUES (:address, :userid) ON DUPLICATE KEY UPDATE userID=:userid";
                $params = ["userid" => $id, "address" => $address];
                $sqlProxy->runQuery($sql, $params);
            } else {
                $Error = "Błąd: błędny kod pocztowy";
            }
        } elseif (isset($_POST["EditPassword"])) {
            if ($_POST['newpwd'] == $_POST['confirmpwd']) {
                $sql = "SELECT PASSWORD FROM USERS WHERE EMAIL = :email";
                $params = ["email" => $_SESSION["name"]];
                $arr = $sqlProxy->returnTable($sql, $params);
                $_POST["actualpwd"] = hash("sha512", $_POST['actualpwd']);
                if ($arr[0]["PASSWORD"] == $_POST["actualpwd"]) {
                    $_POST['newpwd'] = hash("sha512", $_POST['newpwd']);
                    $sql = "UPDATE USERS SET password = :password WHERE ID = :id";
                    $params = ["id" => $id, "password" => $_POST["newpwd"]];
                    $sqlProxy->runQuery($sql, $params);
                } else {
                    $Error = "Błąd: Hasło nieprawidłowe";
                }
            } else {
                $Error = "Błąd: Hasła nie są identyczne";
            }

        } elseif (isset($_POST["EditEducation"])) {
            $sql = "INSERT INTO USEREDUCATION (educationid, userid)
                    VALUES (:education, :userid) ON DUPLICATE KEY UPDATE userID=:userid";
            $params = ["userid" => $id, "education" => $_POST["subcategoryid"]];
            $sqlProxy->runQuery($sql, $params);
        } elseif (isset($_POST["EditInterests"])) {
            $sql = "DELETE FROM USERINTERESTS WHERE userID = :userid";
            $params = ["userid" => $id];
            $sqlProxy->runQuery($sql, $params);
            foreach ($_POST["subcategoryid"] as $col) {
                $sql = "INSERT INTO USERINTERESTS(interestid, userid) VALUES (:interest, :userid)";
                $params = ["userid" => $id, "interest" => $col];
                $sqlProxy->runQuery($sql, $params);
            }
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/menu.css">
    <meta charset="utf-8">
    <title>TITLE</title>
</head>
<body>
    <section class="UserDetails">
        <div class="GetBack">
            <a href="../Main.php">Powrót</a>
        </div>
        <div>
            <h2>Panel użytkownika</h2>
            <?php echo $Error; ?>
            <div>
                <h3>Twoje dane</h3>
                <h4>Informacje o Tobie i Twoim koncie</h4>
                <div>
                    <form name='ChangeMainData' role='form' method='post' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" />
                        <div class='Button Change'>
                            <button name="ChangeMainData" value="true" >Zmień</button>
                        </div>
                    </form>
                </div>
            </div>
            <div>
                <h3>Informacje dodatkowe</h3>
                <h4>Twoje preferencje</h4>
                <div>
                    <form name='ChangeAdditionalData' role='form' method='post' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" />
                        <div class='Button Change'>
                            <button name="ChangeAdditionalData" value="true" >Zmień</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>