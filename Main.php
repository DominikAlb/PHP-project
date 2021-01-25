<?php session_start();

    $_SESSION['DIR'] = dirname(__DIR__);
    require_once(dirname(__DIR__)."/php-project/php/ItemData.php");
    $itemData = new ItemData();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $itemData->addToBasketCart($_POST["item"], $_POST["quantity"], $_POST["price"]);

    }
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/basket.css">
        <link rel="stylesheet" href="css/Items.css">
        <link rel="stylesheet" href="css/categories.css">
        <meta charset="utf-8">
        <title>TITLE</title>
    </head>
    <body>

        <?php include 'Menu.php'; ?>
        <?php include 'php/POST/Items.php'; ?>
    </body>
</html>
