<?php session_start();

    function addToBasketCart(int $itemID, int $quantity) {

        if (isset($_SESSION["basket"]) && in_array($itemID, $_SESSION["basket"])) {
            $_SESSION["basket"][$itemID] = $_SESSION["basket"][$itemID] + $quantity;
        } else if (!isset($_SESSION["basket"])) {
            $_SESSION["basket"] = [$itemID => $quantity];
        } else {
            $_SESSION["basket"][$itemID] = $quantity;
        }
        if (isset($_SESSION["Quantity"])) {
            $_SESSION["Quantity"] = $_SESSION["Quantity"] + $quantity;
        } else {
            $_SESSION["Quantity"] = $quantity;
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        addToBasketCart($_POST["item"], $_POST["quantity"]);
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
