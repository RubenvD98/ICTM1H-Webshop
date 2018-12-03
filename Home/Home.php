<?php
include '../Functies/dbConfig.php';
include '../Functies/Functie.php';
include '../Functies/Layouts.php';
?>
<!doctype html>
<head>
  <?php includeFiles(); ?>
    <style>
    footer {
        position:absolute;
        bottom:0;
        width:100%;
        height: 170px;   /* Height of the footer */
    }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark ">
        <div class="container-fluid">
            <a class="navbar-brand" href="../Home/Home.php">World Wide Imports</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarsExampleDefault">
                <ul class="navbar-nav mt-auto">
                    <div class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="../Home/Home.php">Home<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../Categories/Categories.php">Producten</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../Contact/Contact.php">Contact</a>
                        </li>
                        <li class="nav-item">
                            <form class="form-inline my-2 my-lg-0" action="../Categories/Categories.php" method="get">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="Search..." name="zoek">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-secondary btn-number">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </li>
                        <li class="nav-item">
                            <form class="form-inline my-2 my-lg-0">
                                <a class="btn btn-success btn-sm ml-3" href="../Winkelwagen/Winkelwagen.php">
                                    <i class="fa fa-shopping-cart"></i>Winkelwagen<span class="badge badge-light"></span>
                                </a>
                            </form>
                        </li>
                        <!-- Button to open the modal login form -->
                        <li class="nav-item">
                            <form class="form-inline my-2 my-lg-0">
                                <div class="btn-group ml-3">
                                    <button type="button" class="btn btn-default btn-sm" onclick="document.getElementById('login').style.display = 'block'">Inloggen</button>
                                    <button type="button" class="btn btn-default btn-sm" onclick="document.getElementById('signup').style.display = 'block'">Registeren</button>
                                </div>
                            </form>
                        </li>
                    </div>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Home</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <!-- Het laten zien van de producten -->
        <div class="row">
            <?php
            // Functie die er voor zorgt dat 3 verschillende prodcuten worden laten zien op home pagina
            $getallen = randomGen(1, 227, 3);
            $query = $db->query("SELECT * FROM stockItems WHERE stockItemID in ($getallen[0], $getallen[1], $getallen[2]) ORDER BY StockItemID");
            if ($query->num_rows > 0) {
                while ($row = $query->fetch_assoc()) {
                    ?>
                      <div class="col-12 col-md-6 col-lg-4">
                          <div class="card">
                            <form action="../Winkelwagen/CartAction.php?action=addToCart&id=<?php echo $row["StockItemID"]; ?>&aantal=1" method="post">
                              <img class="card-img-top" src="../IMG/chocolade.jpg" alt="Card image cap">
                              <div class="card-body">
                                  <h4 class="card-title"><a href="../Product/Product.php?id=<?php echo $row["StockItemID"]; ?>" title="View Product"><?php echo $row["StockItemName"]; ?></a></h4>
                                  <p class="card-text"><?php echo $row["SearchDetails"]; ?></p>
                                  <div class="row">
                                      <div class="col">
                                          <p class="btn btn-danger btn-block"><?php echo '€' . $row["RecommendedRetailPrice"]; ?></p>
                                      </div>
                                      <div class="col">
                                          <input type="submit" name="Toevoegen" value="Toevoegen" class="btn btn-success btn-block">
                                      </div>
                                  </div>
                              </div>
                            </form>
                          </div>
                      </div>
                <?php }
            }
            else {
                ?>}
                <p>Geen zoekresultaten gevonden!</p>
<?php } ?>
        </div>
        <br>
    </div>


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
