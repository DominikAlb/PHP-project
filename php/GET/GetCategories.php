<?php
    require_once($_SESSION['DIR'] . "/php-project/php/SQLProxy.php");
    require_once($_SESSION['DIR'] . "/php-project/php/DBCredentials.php");
?>

<div>
    <div class="Categories">
        <button>KATEGORIE</button>
        <div class="CategoryButton">
            <div class="Grass Seeds">
                <a class="SeedsLink GrassLink" href="/php-project/Categories/Grass/Grass.php">
                    NASIONA TRAWY
                    <div class="Subcategories">
                        <ul>
                            <a href="/php-project/Categories/Grass/Grass.php?Show='Trawy zdobne'"><li>Trawy Ozdobne</li></a>
                            <a href="/php-project/Categories/Grass/Grass.php?Show='Trawy Sportowe'"><li>Trawy Sportowe</li></a>
                        </ul>
                    </div>
                </a>
            </div>
            <div class="Flowerpots">
                <a class="FlowerpotsLink" href="/php-project/Categories/Flowerpots/Flowerpots.php">
                    DONICZKI
                    <div class="Subcategories">
                        <ul>
                            <li>Doniczki Domowe</li>
                            <li>Doniczki Wiszące</li>
                        </ul>
                    </div>
                </a>
            </div>
            <div class="Fertilizers">
                <a class="FertilizersLink" href="/php-project/Categories/Fertilizers/Fertilizers.php">
                    NAWOZY
                    <div class="Subcategories">
                        <ul>
                            <li>Nawozy Ogrodnicze</li>
                            <li>Nawozy Do Trawy</li>
                        </ul>
                    </div>
                </a>
            </div>
            <div class="PestControl">
                <a class="PestControlLink" href="/php-project/Categories/PestControl/PestControl.php">
                    ŚRODKI OCHRONY ROŚLIN
                    <div class="Subcategories">
                        <ul>
                            <li>Środki chwastobójcze</li>
                            <li>Środki Owadobójcze</li>
                        </ul>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>