<?php

function ophalenArtikelen() {
    $db = "mysql:host=localhost;dbname=wideworldimporters;port=3306";
    $user = "root";
    $pass = "";
    $pdo = new PDO($db, $user, $pass);
    $Querry = $pdo->prepare("SELECT * FROM stockitems");
    $Querry->execute();
    $array = array();
    $beschrijvingArray = array();
    while ($row = $Querry->fetch()) {
        $artikel = $row["StockItemName"];
        $id = $row["StockItemID"];
        $array[$id] = $artikel;
    }
    return $array;
}

function ophalenBeschrijving() {
    $db = "mysql:host=localhost;dbname=wideworldimporters;port=3306";
    $user = "root";
    $pass = "";
    $pdo = new PDO($db, $user, $pass);
    $Querry = $pdo->prepare("SELECT * FROM stockitems");
    $Querry->execute();
    $array = array();
    while ($row = $Querry->fetch()) {
        $id = $row["StockItemID"];
        $beschrijving = $row["SearchDetails"];
        $array[$id] = $beschrijving;
    }
    return $array;
}

function ophalenPrijs() {
    $db = "mysql:host=localhost;dbname=wideworldimporters;port=3306";
    $user = "root";
    $pass = "";
    $pdo = new PDO($db, $user, $pass);
    $Querry = $pdo->prepare("SELECT * FROM stockitems");
    $Querry->execute();
    $array = array();
    while ($row = $Querry->fetch()) {
        $id = $row["StockItemID"];
        $prijs = $row["RecommendedRetailPrice"];
        $array[$id] = $prijs;
    }
    return $array;
}

function artikelenSite() {
    $artikelArray = ophalenArtikelen();
    $beschrijvingArray = ophalenBeschrijving();
    $prijsArray = ophalenPrijs();

    foreach ($artikelArray as $id => $artikelnaam) {
        ?>
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card">
                <img class="card-img-top" src="https://dummyimage.com/600x400/55595c/fff" alt="Card image cap">
                <div class="card-body">
                    <h4 class="card-title"><a href="product.html" title="View Product"><?php print($artikelnaam) ?></a></h4>
                    <?php
                    foreach ($beschrijvingArray as $key => $beschrijving) {
                        if ($id == $key) {
                            ?>  <p class="card-text"><?php print($beschrijving); ?></p> <?php
                            }
                        }
                        ?>
                    <div class="row">
                        <div class="col">
                            <?php
                            foreach ($prijsArray as $key2 => $prijs) {
                                if ($id == $key2) {
                                    ?><p class="btn btn-danger btn-block">€ <?php print($prijs); ?></p><?php
                                }
                            }
                            ?>
                        </div>
                        <div class="col">
                            <a href="#" class="btn btn-success btn-block">+</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}

// Zoek functie
function zoeken($zoekopdracht) {
    $AlleProductenarray = ophalenArtikelen();
    $zoekArray = array();
    $beschrijvingArray = ophalenBeschrijving();
    $prijsArray = ophalenPrijs();
    $db = "mysql:host=localhost;dbname=wideworldimporters;port=3306";
    $user = "root";
    $pass = "";
    $pdo = new PDO($db, $user, $pass);

    $query = $pdo->prepare("SELECT * FROM stockitems WHERE StockItemName LIKE '%$zoekopdracht%'");
    $query->execute();
    $array = array();

    while ($row = $query->fetch()) {
        $zoekResulataten = $row["StockItemName"];
        $id = $row["StockItemID"];
        $array[$id] = $zoekResulataten;
    }

    if (empty($zoekopdracht)) {
        artikelenSite();
    }
    elseif (empty($array) == false) {
        foreach ($array as $id => $product) {
            ?>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card">
                    <img class="card-img-top" src="https://dummyimage.com/600x400/55595c/fff" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title"><a href="product.html" title="View Product"><?php print($product) ?></a></h4>
                        <?php
                        foreach ($beschrijvingArray as $key => $beschrijving) {
                            if ($id == $key) {
                                ?>  <p class="card-text"><?php print($beschrijving); ?></p> <?php
                                }
                            }
                            ?>
                        <div class="row">
                            <div class="col">
                                <?php
                                foreach ($prijsArray as $key2 => $prijs) {
                                    if ($id == $key2) {
                                        ?><p class="btn btn-danger btn-block">€ <?php print($prijs); ?></p><?php
                                    }
                                }
                                ?>
                            </div>
                            <div class="col">
                                <a href="#" class="btn btn-success btn-block">+</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    else {
        print("Geen zoekresultaten gevonden!");
    }
}
