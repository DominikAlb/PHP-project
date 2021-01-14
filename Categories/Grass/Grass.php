<?php session_start();

require_once ($_SESSION['DIR'] . "/php-project/php/ItemData.php");
require_once ($_SESSION['DIR'] . "/php-project/php/SQLProxy.php");
require_once ($_SESSION['DIR'] . "/php-project/php/DBCredentials.php");

$dbCredentials = new DBCredentials();
$sqlProxy = new SQLProxy(null, $dbCredentials);
$items = new ItemData();

$sql = "SELECT * FROM Item WHERE SubCategoryID IN (SELECT ID FROM Category WHERE Name = 'NASIONA TRAWY' OR SUBCATEGORY = 3)";
$data = $sqlProxy->returnTable($sql, null);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $items->addToBasketCart($_POST["item"], $_POST["quantity"], $_POST["price"]);
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>TITLE</title>
</head>
<body>
<?php include $_SESSION['DIR'] . '/php-project/Menu.php'; ?>
    <div>
        Grass
        <?php echo $items->showItemData($data) ?>
    </div>
</body>
</html>