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
function filterenZonderOpslaan($array){
    $beschikbareMaten = array("3XS", "XXS", "XS", "S", "M", "L", "XL", "XXL", "3XL", "4XL", "5XL", "6XL", "7XL");
    $beschikbareKleuren = array("(White)", "(Black)", "(Green)", "(Gray)", "(Light Brown)", "(Blue)", "(Brown)", "(Yellow)");
    $filterArray = array();

    foreach ($array as $id => $product) {
        //maat
        if (in_array(substr($product, - 3), $beschikbareMaten)) {
            $product = substr($product, 0, -3);
            //print ("succes3 $product <br>");
        } elseif (in_array(substr($product, - 2), $beschikbareMaten)) {
            $product = substr($product, 0, -2);
            //print("succes2 $product <br>");
        } elseif (in_array(substr($product, - 1), $beschikbareMaten)) {
            $product = substr($product, 0, -1);
            //print "false $product <br>";
        }
        //kleur
        foreach ($beschikbareKleuren as $key => $kleur) {
            if (strpos($product, $kleur) !== FALSE) {
                $product = str_replace($kleur, "", $product);
            }
        }
        if(in_array($product, $filterArray) === FALSE){
            $filterArray[$id] = $product;
        }
}
    return $filterArray;
}
function beschrijving() {
    list($beschrijvingArray, $artikelArray, $prijsArray) = WaardesOphalen();
    $beschikbareMaten = array("3XS", "XXS", "XS", "S", "M", "L", "XL", "XXL", "3XL", "4XL", "5XL", "6XL", "7XL");
    $beschrijvingFilter = array();
    $beschikbareKleuren = array("(White)", "(Black)", "(Green)", "(Gray)", "(Light Brown)", "(Blue)", "(Brown)", "(Yellow)");
    foreach ($beschrijvingArray as $key => $beschrijving) {
        // Maat
        $beschrijving = trim($beschrijving);
        if (in_array(substr($beschrijving, -3), $beschikbareMaten)) {
            $beschrijving = substr($beschrijving, 0, -3);
        } elseif (in_array(substr($beschrijving, -2), $beschikbareMaten)) {
            $beschrijving = substr($beschrijving, 0, -2);
        } elseif (in_array(substr($beschrijving, -1), $beschikbareMaten)) {
            $beschrijving = substr($beschrijving, 0, -1);
        }

        // Kleur
        foreach($beschikbareKleuren as $kleur){
            if(strpos($beschrijving, $kleur) !== FALSE) {
                $beschrijving = str_replace($kleur, "", $beschrijving);
            }
        }

        $beschrijvingFilter[$key] = $beschrijving;
    }
    return $beschrijvingFilter;
}
function filterenNaam() {
    list($beschrijvingArray, $artikelArray, $prijsArray) = WaardesOphalen();
    $beschikbareMaten = array("3XS", "XXS", "XS", "S", "M", "L", "XL", "XXL", "3XL", "4XL", "5XL", "6XL", "7XL");
    $productMaat = ""; // Hier wordt de maat in opgeslagen
    $beschikbareKleuren = array("(White)", "(Black)", "(Green)", "(Gray)", "(Light Brown)", "(Blue)", "(Brown)", "(Yellow)");
    $productKleur = ""; // Hier wordt de kleur in opgeslagen
    $vorigProduct = ""; // Hier wordt het product uiteindelijk in opgeslagen
    $productKleuren = array(); // Hier worden de kleuren per product opgeslagen
    $productMaten = array(); // Hier worden de maten per product opgeslagen
    $naamMaatArray = array(); // Hier worden de maatArrays per product opgeslagen
    $naamKleurArray = array(); // Hier worden de KleurArrays per product opgeslagen
    $productnamen = array(); // Hier worden de productnamen opgeslagen
    foreach ($artikelArray as $id => $product) {
        //maat
        if (in_array(substr($product, - 3), $beschikbareMaten)) {
            $productMaat = substr($product, -3);
            $product = substr($product, 0, -3);
            //print ("succes3 $product <br>");
        } elseif (in_array(substr($product, - 2), $beschikbareMaten)) {
            $productMaat = substr($product, -2);
            $product = substr($product, 0, -2);
            //print("succes2 $product <br>");
        } elseif (in_array(substr($product, - 1), $beschikbareMaten)) {
            $productMaat = substr($product, -1);
            $product = substr($product, 0, -1);
            //print "false $product <br>";
        }
        //kleur
        foreach ($beschikbareKleuren as $key => $kleur) {
            if (strpos($product, $kleur) !== FALSE) {
                $productKleur = $kleur;
                $product = str_replace($kleur, "", $product);
            }
        }
        if ($product === $vorigProduct) {
            if (in_array($productKleur, $productKleuren) === FALSE) {
                $productKleuren[$id] = $productKleur;
            }
            if (in_array($productMaat, $productMaten) === FALSE) {
                $productMaten[$id] = $productMaat;
            }
        } else {
            unset($productKleuren);
            unset($productMaten);
            if (empty($productKleuren) || empty($productMaten)) {
                $productKleuren[$id] = $productKleur;
                $productMaten[$id] = $productMaat;
            }
        }
        $naamKleurArray[$product] = $productKleuren;
        $naamMaatArray[$product] = $productMaten;
        if (in_array($product, $productnamen) === FALSE) {
            $productnamen[$id] = $product;
        }
        $vorigProduct = $product;
    }
    //return array($productNamen, $naamMaatArray, $naamKleurArray);
    return array($productnamen, $naamMaatArray, $naamKleurArray);
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
    $beschrijvingFilterArray = beschrijving();

    foreach ($filterNaamArray as $id => $product) {
        ?>
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card">
                <img class="card-img-top" src="../IMG/chocolade.jpg" alt="Card image cap">
                <div class="card-body">
                    <?php
                    print('<h4 class="card-title"><a href="../Product/Product.php?id=' . $id . '" title="View Product" id="<?php $id ?>"> ' . $product . '</a></h4>');
                    foreach ($beschrijvingFilterArray as $key => $beschrijving) {
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
                            <a class="btn btn-success btn-block" href="../Winkelwagen/CartAction.php?action=addToCart&id=<?php echo $id; ?>">Toevoegen</a>
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
    $beschrijvingFilterArray = beschrijving();
    /* De arrays van de functies WaardesOphalen en FilterenNaam worden opgehaald, een aantal worden gebruikt om producten te zoeken. */
    $zoekopdrachtArray = array();  //Wordt gevuld in de loop
    $zoekopdracht = strtolower($zoekopdracht);
    /* De zoekopdracht waaraan de producten worden vergeleken wordt in kleine letters gezet, zodat je deze kunt vergelijken met artikelen */
    if (empty($zoekopdracht)) {
        artikelenSite();
        /* Alle producten worden weergegeven als de waarde van zoekopdracht leeg is */
    } else {
        foreach ($filterNaamArray as $id => $artikel) {
            $artikel = strtolower($artikel);
            /* de artikel moet ook in kleine letters zijn op het te kunnen
             * vergelijken met strpos(). */
            if (strpos($artikel, $zoekopdracht) !== FALSE) {
                /* Hier wordt de zoekopdracht vergeleken met het artikel */
                $zoekopdrachtArray[$id] = $artikel;
            }
            /* Als dit niet het geval is wordt de zoekopdrachtArray gevuld met
             * de id's en artikelnamen van een product zodat alleen de producten
             * in deze array worden weergegeven.
             */
        }
        if (empty($zoekopdrachtArray) === FALSE) {
            /* Er wordt gekeken of de zoekopdrachtenArray leeg is zodat er een
             * foutmelding weergegeven kan worden als er geen zoekresultaten zijn */
            foreach ($zoekopdrachtArray as $id => $product) {
                /* De zoekopdrachten worden doorgelopen en weergegeven op de site */
                ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card">
                        <img class="card-img-top" src="../IMG/chocolade.jpg" alt="Card image cap">
                        <div class="card-body">
                            <?php
                            print('<h4 class="card-title"><a href="../Product/Product.php?id=' . $id . '" title="View Product" id="<?php $id ?>"> ' . $product . '</a></h4>');
                            /* Hier wordt de waarde id aan de knop om naar de productpagina toe te gaan meegegeven om het juiste product in de productpagina
                              weer te geven. */
                            foreach ($filterNaamArray as $key => $artikel) { // De naam wordt weergegeven.
                                if ($id == $key) { // Er moet worden nagegaan of het id van het product gelijk is aan het id van de zoekopdracht zodat de juiste naam wordt weergegeven.
                                    print($artikel);
                                }
                            }
                            ?>
                            </a></h4>
                            <?php
                            foreach ($beschrijvingFilterArray as $key => $beschrijving) { // de beschrijving wordt weergegeven
                                if ($id == $key) { // Er moet worden nagegaan of het id van het product gelijk is aan het id van de zoekopdracht zodat de juiste beschrijving wordt weergegeven.
                                    ?>  <p class="card-text"><?php print($beschrijving); ?></p> <?php
                                }
                            }
                            ?>
                            <div class="row">
                                <div class="col">
                                    <?php
                                    foreach ($prijsArray as $key => $prijs) { // De prijs wordt weergegeven
                                        if ($id == $key) { // Er moet worden nagegaan of het id van het product gelijk is aan het id van de zoekopdracht zodat de juiste prijs wordt weergegeven.
                                            ?>
                                            <p class="btn btn-danger btn-block"> <?php print("€" . $prijs); ?></p>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="col">
                                    <a class="btn btn-success btn-block" href="../Winkelwagen/CartAction.php?action=addToCart&id=<?php echo $id; ?>">Toevoegen</a>
                                    <!-- Hier wordt de waarde id aan de knop om naar de winkelwagen toe te gaan meegegeven om het juiste product in de winkelwagen
                                     te zetten. -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            print("Geen zoekresultaat gevonden"); // Als er geen zoekresultaten zijn wordt dit weergegeven.
        }
    }
}
function onclickScript() {
  ?>
  // Get the modal
  var login = document.getElementById('login');
  var signup = document.getElementById('signup');
  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function (event) {
      if (event.target == login) {
          login.style.display = "none";
      }
      else if (event.target == signup) {
          signup.style.display = "none";
      }
  }
  <?php
}
function navigationBar() {
  ?>
  function openNav() {
      document.getElementById("mySidenav").style.width = "300px";
  }

  function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
  }
  <?php
}
/* Functie voor random nummers */
function randomGen($min, $max, $quantity) {
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
}


function login($username, $password){
                $db = "mysql:host=localhost;dbname=wideworldimporters;port=3306";
                $user = "root";
                $pass = "";
                $pdo = new PDO($db, $user, $pass);
            $query = $pdo->prepare("SELECT * FROM Klantenaccount where Gebruikersnaam != ''");
            $enc_psw = hash('sha256', $password);
            $query->execute();
            $array = array();
    while ($row = $query->fetch()) {
        $gebruikersnaam = $row["Gebruikersnaam"];
        $pass2 = $row["Wachtwoord"];
        $id = $row["KlantenID"];
        if ($username == $gebruikersnaam AND $pass2 == $enc_psw){
                      print ("Je bent ingelogd!");
        }
        else {
        }
    }
    return $array;
}
function register($username, $password, $email, $adres, $plaats, $postcode, $huisnummer, $toevoeging, $voornaam, $tussenvoegsel, $achternaam, $telefoonnr){
                $db = "mysql:host=localhost;dbname=wideworldimporters;port=3306";
                $user = "root";
                $pass = "";
                $pdo = new PDO($db, $user, $pass);
            $enc_psw = hash('sha256', $password);
            $query = $pdo->prepare("INSERT INTO Klantenaccount(Email, Gebruikersnaam, Wachtwoord) VALUES ('$email','$username','$enc_psw')");
            $query->execute();
            $query2 = $pdo->prepare("INSERT INTO Klanten(Voornaam, Tussenvoegsel, Achternaam, Telefoonnr ) VALUES ('$voornaam','$tussenvoegsel','$achternaam', '$telefoonnr')");
            $query2->execute();
            $query3 = $pdo->prepare("INSERT INTO Klantenadres(Adres, Postcode, Plaats, Huisnummer, Toevoeging) VALUES ('$adres','$plaats','$postcode', '$huisnummer', '$toevoeging')");
            $query3->execute();
    }
