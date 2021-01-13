<?php
    require_once(dirname(__FILE__) . "/../SQLProxy.php");
    require_once(dirname(__FILE__) . "/../DBCredentials.php");


?>

<div>
    <div class="Categories">
        <button>KATEGORIE</button>
        <div class="CategoryButton">
            <div class="Grass Seeds">
                <a class="SeedsLink GrassLink" href="/php-project/Categories/Grass/Grass.php">
                    <svg class="CategoryPicture">
                        <img src="Categories/Grass/seeds-menu.jpg" class="CategoryImage"></img>
                    </svg>
                    NASIONA TRAWY
                    <div class="Subcategories">
                        <ul>
                            <li>Trawy Ozdobne</li>
                            <li>Trawy Sportowe</li>
                        </ul>
                    </div>
                </a>
            </div>
            <div class="Flowerpots">
                <a class="FlowerpotsLink" href="/php-project/Categories/Flowerpots/Flowerpots.php">
                    <svg class="CategoryPicture">
                        <img src="Categories/Flowerpots/flowerpot-menu.jpg" class="CategoryImage">
                    </svg>
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
                    <svg class="CategoryPicture">
                        <img src="Categories/Fertilizers/fertilizers-menu.jpg" class="CategoryImage">
                    </svg>
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
                    <svg class="CategoryPicture">
                        <img src="Categories/PestControl/pestcontrol-menu.jpg" class="CategoryImage">
                    </svg>
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