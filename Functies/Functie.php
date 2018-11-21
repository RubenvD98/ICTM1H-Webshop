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

 function login($uname, $psw)
    {
                $db = "mysql:host=localhost;dbname=wideworldimporters;port=3306";
                $user = "root";
                $pass = "";
                $pdo = new PDO($db, $user, $pass);
            $query = $pdo->prepare("SELECT * FROM klanten");
            $enc_psw = hash('sha256', $psw);
            $query->execute();
            $array = array();
    while ($row = $query->fetch()) {
        $gebruikersnaam = $row["gebruikersnaam"];
        $wachtwoord = $row["gebruikersnaam"];
    }
    return $array;
}

function filterenNaam() {
    /* Variabelen die nodig zijn voor/in de loop */
    $productMaat = ""; //wordt gevuld in de loop
    $productMaten = array();
    list($beschrijvingArray, $artikelArray, $prijsArray) = WaardesOphalen();
    $productNamen = array();
    $productKleuren = array();
    $naamMaatArray = array();
    $naamKleurArray = array();
    $vorigProduct = "";
    $ruwProduct = "";
    $beschikbareKleuren = array("(White)", "(Black)", "(Green)", "(Gray)");
    $beschikbareMaten = array("3XS", "XXS", "XS", "S", "M", "L", "XL", "XXL", "3XL", "4XL", "5XL", "6XL", "7XL");
    /* Voor elk product moet worden nagegaan of er een maat in de naam zit.*/
    foreach ($artikelArray as $id => $product) {
        /* Er moet voor elke kleur worden nagegaan of deze in de variabele $product zit */
        foreach($beschikbareKleuren as $key => $kleur){
            if(strpos($product, $kleur) != FALSE){
                $product = str_replace($kleur, "", $product);
                $productKleuren[] = $kleur;
            }
        }
        /* Er moet worden nagegaan of de laatste 3 letters een maat is en dus in de $beschikbareMaten staat */
        if (in_array(substr($product, - 3), $beschikbareMaten)) {
            /* De laatste 3 letters van het product (de maat) worden opgeslagen in een variabele */
            $productMaat = substr($product, -3);
            /* Het product wordt vervangen door het product zonder de maat */
            $product = substr($product, 0, -3);
            /* Om dubbelingen te voorkomen wordt de $productNamen array doorzocht naar het product, als deze niet in de array staat wordt deze toegevoegd */
            if (in_array($product, $productNamen) == false) {
                $productNamen[$id] = $product;
            }
            /* De maten worden opgeslagen in de array $productMaten */
            if ($product === $vorigProduct){
                if(in_array($productMaat, $productMaten) === FALSE){
                        $productMaten[] = $productMaat;
                }
                    } else { 
                        unset($productMaten);
                        if(empty($productMaten) === TRUE){
                            $productMaten[] = $productMaat;
                        }
                    }
            /* Deze code wordt herhaalt, er wordt alleen gecheckt of de laatste 2 letters in de beschikbareMaten staat. */
        } else {
            if (in_array(substr($product, - 2), $beschikbareMaten)) {
                $productMaat = substr($product, -2);
                $product = substr($product, 0, -2);
                if (in_array($product, $productNamen) == false) {
                    $productNamen[$id] = $product;
                }
                if ($product === $vorigProduct){
                      if(in_array($productMaat, $productMaten) === FALSE){
                        $productMaten[] = $productMaat;
                }
                    } else { 
                        unset($productMaten);
                        if(empty($productMaten) == TRUE){
                            $productMaten[] = $productMaat;
                        }
                    }
                /* Deze code wordt herhaalt, er wordt alleen gecheckt of de laatste letter in de beschikbareMaten staat. */
            } else {
                if (in_array(substr($product, - 1), $beschikbareMaten)) {
                    $productMaat = substr($product, -1);
                    $product = substr($product, 0, -1);
                    if (in_array($product, $productNamen) == false) {
                        $productNamen[$id] = $product;
                    }
                    if ($product === $vorigProduct){
                        if(in_array($productMaat, $productMaten) === FALSE){
                        $productMaten[] = $productMaat;
                }
                    } else { 
                        unset($productMaten);
                        if(empty($productMaten) == TRUE){
                            $productMaten[] = $productMaat;
                        }
                    }
                } else {
                    $productNamen[$id] = $product;
                } 
            }
            }
        $naamMaatArray[$product] = $productMaten;
        $vorigProduct = $product;
        $naamKleurArray[$product] = $productKleuren;
        
    }
    
    return array($productNamen, $naamMaatArray, $naamKleurArray);
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
    list($filterNaamArray, $naamMaatArray) = filterenNaam();
    foreach ($filterNaamArray as $id => $product) {
        ?>
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card">
                <img class="card-img-top" src="https://dummyimage.com/600x400/55595c/fff" alt="Card image cap">
                <div class="card-body">
                     <?php print('<h4 class="card-title"><a href="product.php?id=' . $id . '" title="View Product" id="<?php $id ?>"> ' . $product . '</a></h4>'); ?>
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
    list($filterNaamArray, $naamMaatArray) = filterenNaam();
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
                        foreach ($beschrijvingArray as $key => $beschrijving) {
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
                                        <p class="btn btn-danger btn-block"> <?php print("€" . $prijs); ?></p>
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
