<?php
include '../Functies/dbConfig.php';
include '../Functies/Functie.php';
include '../Functies/Layouts.php';
?>
<!doctype html>
<head>
    <?php includeFiles(); ?>
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
                    <li class="nav-item active">
                        <a class="nav-link" href="../Categories/Categories.php">Producten<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Contact/Contact.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <form class="form-inline my-2 my-lg-0" action="Categories.php" method="get">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="Zoeken...." name="zoek">
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
                        <li class="breadcrumb-item"><a href="Categories.php">Producten</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kleren</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Tabs voor de categorieën -->
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <h2>Categorieën</h2>
        <a href="Algemeen.php">Algemeen</a>
        <a href="kleren.php">Kleren</a>
        <a href="Mokken.php">Mokken</a>
        <a href="USB.php">USB Sticks</a>
        <a href="pantovels.php">Pantovels</a>
        <a href="Speelgoed.php">Speelgoed</a>
        <a href="VerpakingMateriaal.php">Verpaking Materiaal</a>
    </div>
    <div class="sidenavposition ">
        <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Categorieën</span>
    </div>
    <br><br><br>

    <?php
    /* Dit is de functie die alle producten laat zien met stockgroup id 4 */
    /* De volgende functies zijn te vinden in de map Functies/layout.php */
    categorieën(4);

    /* Modal login Content */
    ModalLogin();

    /* Modal signup Content */
    ModalSignup();

    /* Laat de footer zien */
    Footer();
    ?>

    <script>
<?php
/* De volgende functies zijn te vinden in de map Functies/Functies.php */
navigationBar();
onclickScript();
?>
    </script>
</body>

</html>
