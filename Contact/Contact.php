<?php
include '../Functies/Functie.php';
include '../Functies/dbConfig.php';
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
                        <a class="nav-link" href="../Categories/Categories.php">Producten</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="../Contact/Contact.php">Contact<span class="sr-only">(current)</span></a>
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
                            <a class="btn btn-success btn-sm ml-3" href="../Categories/Winkelwagen.php">
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
                        <li class="breadcrumb-item active" aria-current="page">Category</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section id="contact">
        <div class="container">
            <div class="well-sm">
                <h3><strong>Neem Contact Op</strong></h3>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d3736489.7218514383!2d90.21589792292741!3d23.857125486636733!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1506502314230" width="100%" height="315" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>

                <div class="col-md-5">
                    <h4><strong>Contactformulier</strong></h4>
                    <form>
                        <div class="form-group">
                            <input type="text" class="form-control" name="" value="" placeholder="Naam">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="" value="" placeholder="E-mail">
                        </div>
                        <div class="form-group">
                            <input type="tel" class="form-control" name="" value="" placeholder="Telefoon nummer">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="" rows="4" placeholder="Vraag"></textarea>
                        </div>
                        <button class="btn btn-default" type="submit" name="button">
                            <i class="fa fa-paper-plane-o" aria-hidden="true"></i> Verzenden
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php
    /* De volgende functies zijn te vinden in de map Functies/layout.php */
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
onclickScript();
?>
    </script>

</body>

</html>
