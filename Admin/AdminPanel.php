<?php session_start();?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="../css/register.css">
</head>
<body>
<?php
require_once("../php/DBCredentials.php");
require_once("../php/SQLProxy.php");
require_once("../php/GET/GetLoginHTML.php");
include $_SESSION['DIR'] . '/php-project/Menu.php';
$success = $emailErr = $phoneErr = $ftErr = $ltErr = $pwdErr = $nameErr = $subcategoryErr = "";
$firstname = $email = $lastname = $phone = $password = $name = $subcategory = "";
$mark = $markErr = $price = $priceErr = $weight = $weightErr = $quantity = $quantityErr = $description = $descriptionErr = "";

$dbCredentials = new DBCredentials();
$sqlProxy = new SQLProxy(null, $dbCredentials);
$getLoginHTML = new GetLoginHTML($dbCredentials);

$sql = "SELECT ID, FIRSTNAME, EMAIL FROM USERS WHERE ID IN (SELECT user_id FROM ADMIN)";
$table1 = showDBTable($sql, null, $sqlProxy, "DeleteAdmin");

$sql = "SELECT ID, NAME, SUBCATEGORY FROM CATEGORY";
$table2 = $getLoginHTML->showDBTable($sql, null);

$sql = "SELECT ID, NAME, PRICE, QUANTITY FROM ITEM";
$table3 = showDBTable($sql, null, $sqlProxy, "DeleteItem");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["show"])) {
        if($_POST["show"] == "Admin") {
            $email = $firstname = $lastname = $password = $phone = "";
            ?>
                <section>
                    <form name='loginForm' role='form' method='post' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <span class='error'><?php echo $success;?></span>
                        <h2>Dodaj Administratora</h2>
                        <div class='LoginFields'>
                            <h3>Imię:</h3>
                            <input name='firstname' value='<?php echo $firstname ?>'>
                            <span class='error'>* <?php echo $ftErr;?></span>
                            <h3>Nazwizko:</h3>
                            <input name='lastname' value='<?php echo $lastname ?>'>
                            <span class='error'>* <?php echo $ltErr;?></span>
                            <h3>Email:</h3>
                            <input type="email" name='email' value='<?php echo $email ?>'>
                            <span class='error'>* <?php echo $emailErr;?></span>
                            <h3>Hasło:</h3>
                            <input type="password" name='password' value='<?php echo $password ?>'>
                            <span class='error'>* <?php echo $pwdErr;?></span>
                            <h3>Telefon:</h3>
                            <input name='phone' value='<?php echo $phone ?>'>
                            <span class='error'>* <?php echo $phoneErr;?></span>
                        </div>
                        <div>
                            <button class='Add' name='Add' value="Admin" role='button' type='submit' >dodaj</button>
                        </div>
                    </form>
                </section>
            <?php
        } elseif ($_POST["show"] == "Item") {
            ?>
            <section>
                <form name='loginForm' role='form' method='post' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
                    <div class='LoginFields'>
                        <span class='error'><?php echo $success;?></span>
                        <h2>Dodaj Przedmiot</h2>
                        <div class='LoginFields'>
                            <h3>Nazwa:</h3>
                            <input name='name' value='<?php echo $name ?>'>
                            <span class='error'>* <?php echo $ftErr;?></span>
                            <h3>Marka:</h3>
                            <input name='mark' value='<?php echo $mark ?>'>
                            <span class='error'>* <?php echo $markErr;?></span>
                            <h3>Cena:</h3>
                            <input name='price' type="number" value='<?php echo $price ?>'>
                            <span class='error'>* <?php echo $priceErr;?></span>
                            <h3>Waga:</h3>
                            <input name='weight' value='<?php echo $weight ?>'>
                            <span class='error'>* <?php echo $weightErr;?></span>
                            <h3>ILOŚĆ:</h3>
                            <input name='quantity' value='<?php echo $quantity ?>'>
                            <span class='error'>* <?php echo $quantityErr;?></span>
                            <h3>Opis przedmiotu:</h3>
                            <textarea name='description' value='<?php echo $description ?>'>OPIS</textarea>
                            <span class='error'>* <?php echo $descriptionErr;?></span>
                            <h3>Kategoria:</h3>
                            <?php
                            $sql = "SELECT ID, NAME FROM CATEGORY";
                            echo $getLoginHTML->showDBSelect($sql, null, "ID", "NAME");
                            ?>
                            <h3>Dodaj zdjęcie:</h3>
                            <input type="file" name="picture">
                        </div>
                        <div>
                            <button class='Add' name='Add' value="Item" role='button' type='submit' >dodaj</button>
                        </div>
                    </div>
                </form>
            </section>
            <?php
        }
    } elseif (isset($_POST["DeleteAdmin"])) {
        $param = ["user_id" => $_POST["DeleteAdmin"]];
        $sql = "DELETE FROM ADMIN WHERE user_id = :user_id";
        $sqlProxy->runQuery($sql, $param);
        $param = ["id" => $_POST["DeleteAdmin"]];
        $sql = "DELETE FROM USERS WHERE id = :id";
        $sqlProxy->runQuery($sql, $param);
        header("Refresh:0");
    } elseif (isset($_POST["DeleteItem"])) {
        $param = ["id" => $_POST["DeleteItem"]];
        $sql = "DELETE FROM ITEM WHERE ID = :id";
        $sqlProxy->runQuery($sql, $param);
        header("Refresh:0");
    } elseif (isset($_POST["Add"]) && $_POST["Add"] == "Admin") {
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
            $arr = ["firstname" => $_POST["firstname"],
                "lastname" => $_POST["lastname"],
                "phone" => $_POST["phone"],
                "password" => $_POST["password"],
                "email" => $_POST["email"]];

            $sql = "INSERT INTO Users(Firstname, Lastname, Email, Phone, Password) 
                VALUE (:firstname, :lastname, :email, :phone, :password)";
            $sqlProxy->runQuery($sql, $arr);

            $sql = "SELECT ID FROM Users WHERE EMAIL = :email";
            $arr = ["email" => $_POST["email"]];
            $msg = $sqlProxy->returnTable($sql, $arr);
            $user_id = $msg[0]["ID"];
            $sql = "INSERT INTO ADMIN (user_id) VALUE (:user_id)";
            $arr = ["user_id" => $user_id];
            $sqlProxy->runQuery($sql, $arr);

            $success = "Admin został dodany!";
            $dbCredentials = null;
            header("Refresh:0");
        }
    } elseif (isset($_POST["Add"]) && $_POST["Add"] == "Item") {
        $error = false;
        if (empty($_POST["name"])) {
            $ftErr = "Pole nie może być puste";
            $error = true;
        }
        if (empty($_POST["mark"])) {
            $ltErr = "Pole nie może być puste";
            $error = true;
        }
        if (empty($_POST["price"])) {
            $pwdErr = "Pole nie może być puste";
            $error = true;
        }
        if (empty($_POST["weight"])) {
            $ftErr = "Pole nie może być puste";
            $error = true;
        }
        if (empty($_POST["quantity"])) {
            $ltErr = "Pole nie może być puste";
            $error = true;
        }
        if (empty($_POST["description"])) {
            $pwdErr = "Pole nie może być puste";
            $error = true;
        }
        if ($error) {
            echo "Wszystkie pola są wymagane";
        } else {
            $sql = "INSERT INTO ITEM(Name, Description, Discount, Mark, Price, 
                 Quantity, SUBCATEGORYID, Weight, Picture) VALUES (:name, :description,
                 :discount, :mark, :price, :quantity, :subcategoryid, :weight, :picture)";
            $params = ["name" => $_POST["name"],
                "description" => $_POST["description"],
                "discount" => 0,
                "mark" => $_POST["mark"],
                "price" => $_POST["price"],
                "quantity" => $_POST["quantity"],
                "subcategoryid" => $_POST["subcategoryid"],
                "weight" => $_POST["weight"],
                "picture" => $_FILES["picture"]["name"]];
            $sqlProxy->runQuery($sql, $params);
            $sql = "SELECT ID FROM ITEM WHERE NAME=:name";
            $params = ["name" => $_POST["name"]];
            $id = $sqlProxy->returnTable($sql, $params)[0]["ID"];
            $getLoginHTML->uploadFile($id);
        }
    }
}

function showDBTable($sql, $params, SQLProxy $sqlProxy, $buttonName): string {
    $arr = $sqlProxy->returnTable($sql, $params);
    $str = "<ul>";
    try {
        foreach ($arr as $col) {
            $str = $str . "<li>";
            $temp = "";
            foreach ($col as $key => $value) {
                $temp = $temp . $key . ": " . $value . "\n";
            }
            $str = $str . $temp;
            $str = $str . "<button class='Delete' name='$buttonName' value='$col[ID]'" .
             htmlspecialchars($_SERVER["PHP_SELF"]) . " role='button' type='submit'>usuń</button></li>";
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    return $str . "</ul>";
}

?>

<section class='AdminPanel'>
    <h2>PANEL ADMINISTRATORA</h2>
    <div class="GetBack">
        <a href="../Main.php">Powrót</a>
    </div>
    <div>
        <div>
            <div class="AdminTable Table">
                <form name='loginForm' role='form' method='post' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <div class='LoginFields'>
                        <h3>Administratorzy</h3>
                        <button class='Add' name='show' value="Admin" role='button' type='submit' >dodaj</button>
                        <?php echo $table1; ?>
                    </div>
                </form>
            </div>
        </div>
        <div>
            <div class="CategoryTable Table">
                <form name='loginForm' role='form' method='post' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <div class='LoginFields'>
                        <h3>Kategorie</h3>
                        <?php echo $table2; ?>
                    </div>
                </form>
            </div>
        </div>
        <div>
            <div class="ItemTable Table">
                <form name='loginForm' role='form' method='post' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <div class='LoginFields'>
                        <h3>Przedmioty</h3>
                        <button class='Add' name='show' value="Item" role='button' type='submit' >dodaj</button>
                        <?php echo $table3; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
</body>
</html>