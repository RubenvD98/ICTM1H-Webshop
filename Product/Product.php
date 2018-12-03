<?php
include '../functies/dbConfig.php';
include '../Functies/Functie.php';
include '../Functies/Layouts.php';
$id = $_GET['id'];
?>
<!doctype html>
<head>
  <?php includeFiles(); ?>
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
                        <li class="breadcrumb-item active"><a href="Winkelwagen.php">Producten</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
<form action="../Winkelwagen/CartAction.php?action=addToCart&id=<?php echo $id; ?>&aantal=<?php filter_input(INPUT_POST, 'aantal', FILTER_SANITIZE_STRING); ?>" method="post">
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
                        list($artikelNaamArray, $naamMaatArray) = filterenNaam();
                        $artikelNaam = "";
                        foreach ($artikelNaamArray as $key => $artikel) {
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
                                foreach ($beschrijvingArray as $key => $beschrijving) {
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
                    <dl class="param param-feature">
                        <dt>Kleur</dt>
                        <dd>Black and white</dd>
                    </dl>  <!-- item-property-hor .// -->

                    <hr>
                    <div class="row">
                        <div class="col-sm-5">
                            <dl class="param param-inline">
                                <dt>Hoeveelheid: </dt>
                                <dd>
                                    <input type="number" min="1" max="100" class="form-control text-center" value="1" name="aantal">
                                </dd>
                            </dl>  <!-- item-property .// -->
                        </div> <!-- col.// -->
                        <div class="col-sm-7">
                            <dl class="param param-inline">
                                <dt>Maat: </dt>
                                <dd>
                                    <?php
                                    /* De array naamMaat moet worden doorgelopen */
                                    foreach ($naamMaatArray as $productNaam => $maatArray) {
                                        /* Het artikel van de pagina moet worden vergeleken met het artikel dat in de array staat */
                                        if ($productNaam === $artikelNaam) {
                                            /* Nu moet de maatArray worden doorgelopen */
                                            foreach ($maatArray as $key => $maat) {
                                                ?>
                                                <!-- Er worden radiobuttons aangemaakt met daarin de maat-->
                                                <label class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                                    <span class="form-check-label"><?php print($maat); ?></span>
                                                </label>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>

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
  
          <?php
    $uname = filter_input(INPUT_GET, "gebruikersnaam", FILTER_SANITIZE_STRING);
    $psw = filter_input(INPUT_GET, "wachtwoord", FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_GET, "email", FILTER_SANITIZE_STRING);
    $adres = filter_input(INPUT_GET, "adres", FILTER_SANITIZE_STRING);
    $plaats = filter_input(INPUT_GET, "plaats", FILTER_SANITIZE_STRING);
    $postcode = filter_input(INPUT_GET, "postcode", FILTER_SANITIZE_STRING);
    $huisnummer = filter_input(INPUT_GET, "huisnummer", FILTER_SANITIZE_STRING);
    $toevoeging = filter_input(INPUT_GET, "toevoeging", FILTER_SANITIZE_STRING);
    $voornaam=  filter_input(INPUT_GET, "voornaam", FILTER_SANITIZE_STRING);
    $tussenvoegsel = filter_input(INPUT_GET, "tussenvoegsel", FILTER_SANITIZE_STRING);
    $achternaam = filter_input(INPUT_GET, "achternaam", FILTER_SANITIZE_STRING);
    $telefoonnr = filter_input(INPUT_GET, "telefoonnr", FILTER_SANITIZE_STRING);
    
    register($uname, $psw, $email, $adres, $plaats, $postcode, $huisnummer, $toevoeging, $voornaam, $tussenvoegsel, $achternaam, $telefoonnr);
    
    $username = filter_input(INPUT_GET, "uname", FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_GET, "psw", FILTER_SANITIZE_STRING);
    login ($username, $password); 
    

            ?>
    

    <script>
    onclickScript();
    </script>
</body>
</html>
