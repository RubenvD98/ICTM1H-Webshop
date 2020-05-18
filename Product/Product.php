<?php
include '../functies/dbConfig.php';
include '../Functies/Functie.php';
include '../Functies/Layouts.php';
$id = $_GET['id'];
?>
<!doctype html>
<head>
    <?php
    includeFiles();
    list($filterNaamArray, $naamMaatArray, $naamKleurArray) = filterenNaam();
    ?>
    <style>
        input[type="number"]{width: 40%;}
        footer {
            position:absolute;
            bottom:0;
            width:100%;
            height: 170px;   /* Height of the footer */
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="../Home/Home.php">World Wide Imports</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarsExampleDefault">
                <ul class="navbar-nav mt-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../Home/Home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="../Categories/Categories.php">Producten</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Contact/Contact.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <form class="form-inline my-2 my-lg-0" action="../Categories/Categories.php" method="get">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="Search..." name="zoek">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-secondary btn-number">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </li>
                    <li class="nav-item">
                        <form class="form-inline my-2 my-lg-0">
                            <a class="btn btn-success btn-sm ml-3" href="../Winkelwagen/Winkelwagen.php">
                                <i class="fa fa-shopping-cart"></i>Winkelwagen<span class="badge badge-light"></span><span class="sr-only">(current)</span>
                            </a>
                        </form>
                        <!-- Button to open the modal login form -->
                    <li class="nav-item">
                        <form class="form-inline my-2 my-lg-0">
                            <div class="btn-group ml-3">
                                <button type="button" class="btn btn-default btn-sm" onclick="document.getElementById('login').style.display = 'block'">Inloggen</button>
                                <button type="button" class="btn btn-default btn-sm" onclick="document.getElementById('signup').style.display = 'block'">Registeren</button>
                            </div>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../Home/Home.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="../Categories/Categories.php">Producten</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <form action="../Winkelwagen/CartAction.php" method="get">
        <input type="text" name="action" value="addToCart" hidden>
        <div class="card">
            <div class="row">
                <aside class="col-sm-5 border-right">
                    <article class="gallery-wrap">
                        <div class="img-big-wrap">
                            <div> <a href="#"><img src="../IMG/chocolade.jpg"></a></div>
                        </div> <!-- slider-product.// -->
                        <div class="img-small-wrap">
                            <!--<div class="item-gallery"> <img src="https://s9.postimg.org/tupxkvfj3/image.jpg"> </div> -->
                        </div> <!-- slider-nav.// -->
                    </article> <!-- gallery-wrap .end// -->
                </aside>
                <aside class="col-sm-7">
                    <article class="card-body p-5">
                        <h3 class="title mb-3">
                            <?php
                            $artikelNaam = "";
                            foreach ($filterNaamArray as $key => $artikel) {
                                if ($key == $id) {
                                    print($artikel);
                                    $artikelNaam = $artikel;
                                }
                            }
                            ?>
                        </h3>

                        <p class="price-detail-wrap">
                            <span class="price h3 text-warning">
                                <span class="currency">€</span><span class="num">
                                    <?php
                                    //Prijzen bij het gewenste product
                                    list($beschrijvingArray, $artikelArray, $prijsArray) = WaardesOphalen();
                                    foreach ($prijsArray as $key => $prijs) {
                                        if ($id == $key) {
                                            print($prijs);
                                        }
                                    }
                                    ?>
                                </span>
                            </span>
                        </p> <!-- price-detail-wrap .// -->
                        <dl class="item-property">
                            <dt>Beschrijving</dt>
                            <dd><p>
                                    <?php
                                    $fBeschrijvingArray = beschrijving();
                                    foreach ($fBeschrijvingArray as $key => $beschrijving) {
                                        if ($key == $id) {
                                            print($beschrijving);
                                        }
                                    }
                                    ?>
                                </p></dd>
                        </dl>
                        <dl class="param param-feature">
                            <dt>Bezorging</dt>
                            <dd>Nederland</dd>
                        </dl>  <!-- item-property-hor .// -->
                        <!-- item-property-hor .// -->
                        <hr>
                        <div class="row">
                            <div class="col-sm-4">
                                <dl class="param param-inline">
                                    <dt>Hoeveelheid: </dt>
                                    <dd>
                                        <input type="number" min="1" class="form-control text-center" value="1" name="aantal" required >
                                    </dd>
                                </dl>  <!-- item-property .// -->
                            </div> <!-- col.// -->
                            <div class="col-sm-4">
                              <dl class="param param-feature">
                                  <dt>Kleur</dt>
                                  <?php
                                  /* De array naamKleur moet worden doorgelopen */
                                  foreach ($naamKleurArray as $productNaam => $kleurArray) {
                                      /* Het artikel van de pagina moet worden vergeleken met het artikel dat in de array staat */
                                      if ($productNaam === $artikelNaam) {
                                          /* Nu moet de kleurArray worden doorgelopen */
                                          ?> <select name="kleur" class="form-control"> <?php
                                          foreach ($kleurArray as $key => $kleur) {
                                              $kleur = trim(str_replace(")", "", $kleur));
                                              $kleur = trim(str_replace("(", "", $kleur));
                                              if (empty($kleur) === FALSE) {
                                                  ?>
                                                      <!-- Er wordt een select aangemaakt met daarin de beschikbare kleuren voor het product-->

                                                      <option value="<?php print($kleur); ?>"><?php print($kleur); ?></option>

                                                      <?php
                                                  }
                                              }
                                          }
                                      }
                                      ?>
                                  </select>
                              </dl>  <!-- item-property-hor .// -->
                            </div>
                            <div class="col-sm-4">
                                <dl class="param param-inline">
                                    <?php
                                    $aantalMaten = 0;
                                    foreach ($naamMaatArray as $productNaam => $maatArray) {
                                        /* Het artikel van de pagina moet worden vergeleken met het artikel dat in de array staat */

                                        if ($productNaam === $artikelNaam) {
                                            /* Nu moet de maatArray worden doorgelopen */
                                            foreach ($maatArray as $key => $maat) {
                                                $aantalMaten = $aantalMaten + 1;
                                            }
                                        }
                                    }
                                    if ($aantalMaten - 1 !== 0) {
                                        ?>
                                        <dt>Maat: </dt>
                                        <dd>
                                          <select name="id" class="form-control">
                                            <?php
                                            /* De array naamMaat moet worden doorgelopen */
                                            foreach ($naamMaatArray as $productNaam => $maatArray) {
                                                /* Het artikel van de pagina moet worden vergeleken met het artikel dat in de array staat */

                                                if ($productNaam === $artikelNaam) {
                                                    /* Nu moet de maatArray worden doorgelopen */
                                                    foreach ($maatArray as $key => $maat) {
                                                        if (empty($maat) === FALSE) {
                                                            ?>
                                                            <!-- Er worden radiobuttons aangemaakt met daarin de maat-->
                                                            <option value="<?php print $key; ?>"><?php print($maat); ?></option>
                                                            <?php
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                        else {
                                            ?>
                                            <input type="text" name="id" value="<?php print($id); ?>" hidden>
                                            <?php
                                        }
                                        ?>
                                      </select>
                                    </dd>
                                </dl>  <!-- item-property .// -->
                            </div> <!-- col.// -->

                        </div> <!-- row.// -->
                        <hr>
                        <input type="submit" name="Toevoegen" value="Toevoegen" class="btn btn-lg btn-outline-success text-uppercase">
                    </article> <!-- card-body.// -->
                </aside> <!-- col.// -->
            </div> <!-- row.// -->
        </div> <!-- card.// -->
    </form>
    <?php
    /* Modal login Content */
    ModalLogin();

    /* Modal signup Content */
    ModalSignup();

    /* Laat de footer zien */
    Footer();
    ?>

    <script>
    <?php
onclickScript();
     ?>        
    </script>
</body>
</html>
