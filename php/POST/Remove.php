<?php
session_start();
    require_once(dirname(__DIR__)."/../../php-project/php/ItemData.php");
    $itemData = new ItemData();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $itemData->removeFromBasketCart($_POST["ID"], $_SESSION["basket"][$_POST["ID"]], $_SESSION["basket"][$_POST["ID"]] * $_POST["price"]);
        unset($_SESSION["basket"][$_POST["ID"]]);
        header( "Location: http://localhost/php-project/Main.php" );
    }