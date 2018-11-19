<?php
// Ophalen van de artikel namen
function WaardesOphalen() {
    $db = "mysql:host=localhost;dbname=wideworldimporters;port=3306";
    $user = "root";
    $pass = "";
    $pdo = new PDO($db, $user, $pass);
    $Querry = $pdo->prepare("SELECT * FROM stockitems");
    $Querry->execute();
    $Array = array();
    $beschrijvingArray = array();
    $prijsArray = array();
    while ($row = $Querry->fetch()) {
        $Product = $row["StockItemName"];
        $id = $row["StockItemID"];
        $prijs = $row["RecommendedRetailPrice"];
        $beschrijving = $row["SearchDetails"];
        $beschrijvingArray [$id] = $beschrijving;
        $Array[$id] = $Product;
        $prijsArray[$id] = $prijs;
    }
    return array($beschrijvingArray, $Array, $prijsArray);
}

function filterenNaam() {
    $woordLengte = 0;
    list($beschrijvingArray, $artikelArray, $prijsArray) = WaardesOphalen();
    $filterMaatArray = array();
    $maten = array("3XS", "2XS", "XS", "S", "M", "L", "XL", "XXL", "3XL", "4XL", "5XL", "6XL", "7XL");
    foreach ($artikelArray as $id => $product) {
        $woordLengte = strlen($product);
        if (in_array(substr($product, $woordLengte - 3), $maten)) {
            $product = substr($product, 0, -3);
            if (in_array($product, $filterMaatArray) == false) {
                $filterMaatArray[$id] = $product;
            }
        } else {
            if (in_array(substr($product, $woordLengte - 2), $maten)) {
                $product = substr($product, 0, -2);
                if (in_array($product, $filterMaatArray) == false) {
                    $filterMaatArray[$id] = $product;
                }
            } else {
                if (in_array(substr($product, $woordLengte - 1), $maten)) {
                    $product = substr($product, 0, -1);
                    if (in_array($product, $filterMaatArray) == false) {
                        $filterMaatArray[$id] = $product;
                    }
                } else {
                    $filterMaatArray[$id] = $product;
                }
            }
        }
    }
    $kleurArray = array("(White)", "(Black)", "(Green)", "(Gray)");
    $filterArray = array();
    foreach ($filterMaatArray as $id => $product) {
        $product = str_replace($kleurArray, "", $product);
        if (in_array($product, $filterArray) == false) {
            $filterArray[$id] = $product;
        }
    }
    return $filterArray;
}

function filterenBeschrijving() {
    list($beschrijvingArray, $artikelArray, $prijsArray) = WaardesOphalen();

    $kleurArray = array("(White)", "(Black)", "(Green)", "(Gray)");
    $maten = array("3XS", "2XS", "XS", "S", "M", "L", "XL", "XXL", "3XL", "4XL", "5XL", "6XL", "7XL");
    $beschrijvingLengte = 0;
    $filterMaatArray = array();

    foreach ($beschrijvingArray as $id => $beschrijving) {
        $beschrijvingLengte = strlen($beschrijving);
        foreach ($maten as $key => $maat) {
            if(substr($beschrijving, ($beschrijvingLengte - 3)) == $maat){
                $beschrijving = substr($beschrijving, 0, -3);
                if(in_array($beschrijving, $filterMaatArray == FALSE)){
                    $filterMaatArray[$id] = $beschrijving;
                }
            }
        }
    }
        $filterArray = array();
    
        foreach ($filterMaatArray as $id => $beschrijving) {
            $beschrijving = str_replace($kleurArray, "", $beschrijving);
            if (in_array($beschrijving, $filterArray) == false) {
                $filterArray[$id] = $beschrijving;
            }
        }
    
    return $filterMaatArray;
}

function artikelenSite() {
    list($beschrijvingArray, $artikelArray, $prijsArray) = WaardesOphalen();
    $filterNaamArray = filterenNaam();
    $filterBeschrijvingArray = filterenBeschrijving();
    foreach ($filterNaamArray as $id => $product) {
        ?>
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card">
                <img class="card-img-top" src="https://dummyimage.com/600x400/55595c/fff" alt="Card image cap">
                <div class="card-body">
                    <h4 class="card-title"><a href="product.html" title="View Product"><?php print($product) ?></a></h4>
                    <?php
                    foreach ($filterBeschrijvingArray as $key => $beschrijving) {
                        if ($id == $key) {
                            ?>  <p class="card-text"><?php print($beschrijving); ?></p> <?php
                            }
                        }
                        ?>
                    <div class="row">
                        <div class="col">
                            <?php
                            foreach ($prijsArray as $key => $prijs) {
                                if ($id == $key) {
                                    ?>
                                    <p class="btn btn-danger btn-block"> <?php print($prijs); ?></p>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <div class="col">
                            <a href="#" class="btn btn-success btn-block">Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}

function zoeken($zoekopdracht) {
    list($beschrijvingArray, $artikelArray, $prijsArray) = WaardesOphalen();
    $zoekopdrachtArray = array();
    $zoekopdracht = strtolower($zoekopdracht);
    $filterNaamArray = filterenNaam();
    $filterBeschrijvingArray = filterenBeschrijving();

    if (empty($zoekopdracht)) {
        artikelenSite();
    } elseif (empty($zoekopdracht) == false) {
        foreach ($filterNaamArray as $id => $artikel) {
            $artikel = strtolower($artikel);
            if (strpos($artikel, $zoekopdracht) !== FALSE) {
                $zoekopdrachtArray[$id] = $artikel;
            }
        }

        foreach ($zoekopdrachtArray as $id => $product) {
            ?>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card">
                    <img class="card-img-top" src="https://dummyimage.com/600x400/55595c/fff" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title"><a href="product.html" title="View Product"><?php
                                foreach ($filterNaamArray as $key => $artikel) {
                                    if ($id == $key) {
                                        print($artikel);
                                    }
                                }
                                ?></a></h4>
                        <?php
                        foreach ($filterBeschrijvingArray as $key => $beschrijving) {
                            if ($id == $key) {
                                ?>  <p class="card-text"><?php print($beschrijving); ?></p> <?php
                                    }
                                }
                                ?>
                        <div class="row">
                            <div class="col">
                                <?php
                                foreach ($prijsArray as $key => $prijs) {
                                    if ($id == $key) {
                                        ?>
                                        <p class="btn btn-danger btn-block"> <?php print($prijs); ?></p>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                            <div class="col">
                                <a href="#" class="btn btn-success btn-block">Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    } else {
        print("Geen zoekresultaten gevonden!");
    }
}


// Catogorie selectie
//function CAlgemeen($value='')
//{
//  select * from stockItems as SISG
//  where stockItemID in (select stockItemID
//                        From stockitemstockgroups
//                        where stockGroupID = (select stockGroupID
//                                              from stockgroups
//                                              where stockGroupID = 1, 4, 5, 6,))
//}

function CKleren($value='')
{
  // code...
}

function CMokken($value='')
{
  // code...
}

function CUSB($value='')
{
  // code...
}

function CPantovels($value='')
{
  // code...
}

function CSpeelgoed($value='')
{
  // code...
}

function CVerpakingMateriaal($value='')
{
  // code...
}
