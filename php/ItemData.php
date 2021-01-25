<?php


class ItemData {
    function showItemData($data): string {
        $str = "";
        foreach ($data as $col) {
            $str = $str . "<div class='Owl-Stage'>
                            <div class='Item-Inner'>
                                <div class='box-image'>
                                    <a>
                                        <img src= 'http://localhost/php-project/Items/". $col["ID"] . "/" . $col["Picture"] . "' alt='Image' height='120' width='120'/>
                                    </a>
                                </div>
                                <div class='box-info'>
                                    <h3>" . $col["Name"] . "</h3>
                                    <div class='price-box'> Już od " . $col["Price"] . "</div>    
                                    <div class='bottom-action'> 
                                        <form name='AddToBasket' role='form' method='post' action=" . htmlspecialchars($_SERVER["PHP_SELF"]) . " />
                                        <div class='Button'>
                                            <input name='item' value='$col[ID]' style='display: none'>
                                            <input name='quantity' value='1' style='display: none'>
                                            <input name='price' value='$col[Price]' style='display: none'>
                                            <button role='button' type='submit'>Dodaj do koszyka</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                         </div>";

        }
        return $str;
    }

    function addToBasketCart(int $itemID, int $quantity, int $price=0) {

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
        if (isset($_SESSION["price"])) {
            $_SESSION["price"] = $_SESSION["price"] + $price;
        } else {
            $_SESSION["price"] = $price;
        }

    }

    function removeFromBasketCart(int $itemID, int $quantity=1, int $price=0) {

        $_SESSION["basket"][$itemID] = 0;
        $_SESSION["Quantity"] = $_SESSION["Quantity"] - $quantity;
        $_SESSION["price"] = $_SESSION["price"] - $price;

    }
}