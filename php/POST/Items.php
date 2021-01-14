<?php
    require_once("php/DBCredentials.php");
    require_once("php/SQLProxy.php");
    require_once("php/ItemData.php");
    $dbCredentials = new DBCredentials();
    $sqlProxy = new SQLProxy(null, $dbCredentials);
    $itemData = new ItemData();

    $sql = "SELECT * FROM Item WHERE SubCategoryID IN (SELECT ID FROM Category WHERE Name = 'NAWOZY') LIMIT 3";
    $data = $sqlProxy->returnTable($sql, null);


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
                    <h2>Najlepsze produkty</h2>
                    <img src="http://localhost/php-project/Categories/Fertilizers/nawozy.png" alt='Image'/>
                    <div class="Slider">
                        <?php
                            echo $itemData->showItemData($data);
                        ?>
                    </div>
                </div>
                <div class="Space"></div>
                <div class="Category-Name">
                    <h2>Wszystkie produkty</h2>
                    <img src="http://localhost/php-project/Categories/Fertilizers/nawozy.png" alt='Image'/>
                    <div class="Slider">
                        <?php
                        $sql = "SELECT * FROM Item";
                        $data = $sqlProxy->returnTable($sql, null);
                        echo $itemData->showItemData($data);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
