<?php
    require_once("php/DBCredentials.php");
    require_once("php/SQLProxy.php");

    $dbCredentials = new DBCredentials();
    $sqlProxy = new SQLProxy(null, $dbCredentials);

    $sql = "SELECT * FROM Item WHERE SubCategoryID IN (SELECT ID FROM Category WHERE Name = 'NAWOZY')";
    $data = $sqlProxy->returnTable($sql, null);

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

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>TITLE</title>
    </head>
    <body>
        <div class="Items">
            <div class="wow ProductList">
                <div class="Category-Name">
                    <h2>NAWOZY</h2>
                    <img src="http://localhost/php-project/Categories/Fertilizers/nawozy.png" alt='Image'/>
                    <div class="Slider">
                        <?php
                            echo showItemData($data);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
