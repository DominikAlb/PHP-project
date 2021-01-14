<?php

require_once(dirname(__DIR__) . "/php-project/php/DBCredentials.php");
require_once(dirname(__DIR__) . "/php-project/php/SQLProxy.php");

$dbCredentials = new DBCredentials();
$sqlProxy = new SQLProxy(null, $dbCredentials);

?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="http://localhost/php-project/css/basket.css">
        <link rel="stylesheet" href="http://localhost/php-project/css/Items.css">
        <link rel="stylesheet" href="http://localhost/php-project/css/categories.css">
        <link rel="stylesheet" href="http://localhost/php-project/css/menu.css">
        <meta charset="utf-8">
        <title>TITLE</title>
    </head>
    <body>
        <div class="Menu">
            <div class="Main">
                <div>
                    <a class="Account" href="http://localhost/php-project/Main.php">Strona Główna</a>
                </div>
                <?php include $_SESSION['DIR'] . '/php-project/php/GET/GetCategories.php'; ?>
                <div class="Account">
                    <?php include $_SESSION['DIR'] . '/php-project/php/GET/GetAccountData.php'; ?>
                </div>

                <div class="BasketItems">
                    <div>
                        <div class="Account BasketMenu">
                            <div class="Basket">
                                <img src="http://localhost/php-project/images/koszyk.svg" alt="basket">
                            </div>
                            <div class="Cart Quantity" data-role="cart-quantity"><?php if(isset($_SESSION["Quantity"])) { echo $_SESSION["Quantity"]; } else echo 0; ?></div>
                        </div>
                    </div>
                    <section class="BasketSection">
                        <div class="Box">
                            <?php if(isset($_SESSION["basket"])) { ?>
                            <div class="BoxBucket">
                                <ul>
                                    <?php
                                    $sql = "SELECT * FROM item WHERE ID = :id";
                                    foreach ($_SESSION["basket"] as $key => $value) {
                                        $arr = ["id" => $key];
                                        $item = $sqlProxy->returnTable($sql, $arr)[0];
                                        ?>
                                        <li class="BasketItem">
                                            <a href=<?php echo "http://localhost/php-project/Items/". $item["ID"] . "/" . "item.php" ?>>
                                                <img src=<?php echo "http://localhost/php-project/Items/". $item["ID"] . "/" . $item["Picture"] ?> />
                                            </a>
                                            <div class="ItemPrice">
                                                <span class="Price"><?php echo $item["Price"] ?></span>
                                            </div>
                                            <div class="QuantityBox">
                                                <span>
                                                    Ilość
                                                </span>
                                                <span class="ItemQuantity">
                                                    <?php echo $value ?>
                                                </span>
                                            </div>
                                            <div class="ItemActions">
                                                <a href=<?php echo "http://localhost/php-project/POST/Remove.php?id=$item[ID]" ?>  title="Usuń ten produkt"
                                                data-confirm="Czy na pewno chcesz usunąć ten produkt z koszyka?" class="RemoveItem">Usuń</a>
                                            </div>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                            <div class="Summary">
                                <h3>Łączna kwota w koszyku: <?php if(isset($_SESSION["price"])) echo $_SESSION["price"]; else echo 0;?></h3>
                            </div>
                            <div class="BoxButtons">
                                <form name='AddToBasket' role='form' method='post' action="htmlspecialchars($_SERVER["PHP_SELF"])" />
                                <div class='Button'>
                                    <button name="CheckBucket" >Zobacz Koszyk</button>
                                </div>
                                </form>
                                <form name='AddToBasket' role='form' method='post' action="htmlspecialchars($_SERVER["PHP_SELF"])" />
                                <div class='Button'>
                                    <button name="CheckBucket">Zamawiam</button>
                                </div>
                                </form>
                            </div>
                            <?php }; ?>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </body>
</html>
