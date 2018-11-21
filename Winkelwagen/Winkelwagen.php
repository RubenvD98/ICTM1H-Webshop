<?php
include '../Functies/dbConfig.php';
include '../Functies/Functie.php';
include 'Cart.php';
$cart = new Cart;
?>
<!doctype html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="../js/jqeury-3.3.1.slim.min.js"></script>
    <script src="../js/umd/popper.min.js"></script>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/Model.css">
    <script src="../js/bootstrap.min.js"></script>
    <script>
        function updateCartItem(obj, id) {
            $.get("CartAction.php", {action: "updateCartItem", id: id, qty: obj.value}, function (data) {
                if (data == 'ok') {
                    location.reload();
                } else {
                    alert('Cart update failed, please try again.');
                }
            });
        }
    </script>
    <style>
        input[type="number"]{width: 20%;}
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
                    <li class="nav-item">
                        <a class="nav-link" href="../Contact/Contact.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <form class="form-inline my-2 my-lg-0" action="Categories.php" method="get">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="Zoeken...." name="zoek">
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
                            <a class="btn btn-success btn-sm ml-3" href="Winkelwagen.php">
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
                        <li class="breadcrumb-item active" aria-current="page">Winkelwagen</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- The Modal login -->
    <div id="login" class="modal">
        <span onclick="document.getElementById('login').style.display = 'none'" class="close-model" title="Close Modal login">&times;</span>

        <!-- Modal login Content -->
        <form class="modal-border modal-content animate" action="/action_page.php">
            <div class="imgcontainer">
                <img src="../IMG/avatar.png" alt="Avatar" class="avatar">
            </div>

            <div class="container-login">
                <label for="uname"><b>Gebruikersnaam</b></label>
                <input class="login" type="text" placeholder="Gebruikersnaam" name="uname" required>

                <label for="psw"><b>Wachtwoord</b></label>
                <input class="login" type="password" placeholder="Wachtwoord" name="psw" required>

                <button class="btn btn-success loginbtn" type="submit">Inloggen</button>
                <label>
                    <input type="checkbox" checked="checked" name="remember"> Onthouden
                </label>
            </div>

            <div class="container-login" style="background-color:#f1f1f1">
                <button type="button" class="btn btn-danger" onclick="document.getElementById('login').style.display = 'none'">Annuleren</button>
                <span class="psw"><a href="#">Wachtwoord vergeten?</a></span>
            </div>
        </form>
    </div>
    <!-- The Modal signup -->
    <div id="signup" class="modal">
        <span onclick="document.getElementById('signup').style.display = 'none'" class="close-model" title="Close Modal signup">&times;</span>

        <form class="modal-content model-border animate" action="/action_page.php">
            <div class="container-login">
                <h1>Registeren</h1>
                <p>Please fill in this form to create an account.</p>
                <hr>
                <label for="gebruikersnaam"><b>Gebruikersnaam</b></label>
                <input class="signup" type="text" placeholder="Gebruikersnaam" name="gebruikersnaam" required>

                <label for="email"><b>Email</b></label>
                <input class="signup" type="text" placeholder="Email" name="email" required>

                <label for="wachtwoord"><b>Wachtwoord</b></label>
                <input class="signup" type="password" placeholder="Wacthwoord" name="wachtwoord" required>

                <label for="wachtwoord-repeat"><b>Herhaal Wachtwoord</b></label>
                <input class="signup" type="password" placeholder="Herhaal Wachtwoord" name="wachtwoord-repeat" required>

                <label>
                    <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Onthouden
                </label>

                <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

                <div class="btn-group">
                    <button class="btn btn-danger" type="button" onclick="document.getElementById('signup').style.display = 'none'">Annuleren</button>
                    <button class="btn btn-success" type="submit">Registreren</button>
                </div>
            </div>
        </form>
    </div>

    <!-- winkel mandje -->
    <div class="container">
        <h1>Winkel mandje</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Prijs</th>
                    <th>Aantal</th>
                    <th>Subtotaal</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $aantalItems = 0;
                if ($cart->total_items() > 0) {
                    //get cart items from session
                    $cartItems = $cart->contents();
                    foreach ($cartItems as $item) {
                        ?>
                        <tr>
                            <td><?php echo $item["name"]; ?></td>
                            <td><?php echo '€' . $item["price"]; ?></td>
                            <td><input type="number" class="form-control text-center" value="<?php echo $item["qty"]; ?>" onchange="updateCartItem(this, '<?php echo $item["rowid"]; ?>')"></td>
                            <td><?php echo '€' . $item["subtotal"]; ?></td>
                            <td>
                                <a href="CartAction.php?action=removeCartItem&id=<?php echo $item["rowid"]; ?>" class="btn btn-danger btn-block">Verwijderen</a>
                            </td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr><td colspan="5"><p>Winkelwagen is leeg.....</p></td>
<?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td><a href="../Categories/Categories.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i>Veder winkelen</a></td>
                    <td colspan="2"></td>
<?php if ($cart->total_items() > 0) { ?>
                        <td class="text-center"><strong>Total <?php echo '€' . $cart->total(); ?></strong></td>
                        <td><a href="../Betalen/Betalen.php" class="btn btn-success btn-block">Checkout <i class="glyphicon glyphicon-menu-right"></i></a></td>
<?php } ?>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Footer -->
    <footer class="text-light bg-dark" id="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-lg-4 col-xl-3">
                    <h5>About</h5>
                    <hr class="bg-white mb-2 mt-0 d-inline-block mx-auto w-25">
                    <p class="mb-0">
                        Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression.
                    </p>
                </div>

                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto">
                    <h5>Informations</h5>
                    <hr class="bg-white mb-2 mt-0 d-inline-block mx-auto w-25">
                    <ul class="list-unstyled">
                        <li><a href="">Link 1</a></li>
                        <li><a href="">Link 2</a></li>
                        <li><a href="">Link 3</a></li>
                        <li><a href="">Link 4</a></li>
                    </ul>
                </div>

                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto">
                    <h5>Others links</h5>
                    <hr class="bg-white mb-2 mt-0 d-inline-block mx-auto w-25">
                    <ul class="list-unstyled">
                        <li><a href="">Link 1</a></li>
                        <li><a href="">Link 2</a></li>
                        <li><a href="">Link 3</a></li>
                        <li><a href="">Link 4</a></li>
                    </ul>
                </div>

                <div class="col-md-4 col-lg-3 col-xl-3">
                    <h5>Contact</h5>
                    <hr class="bg-white mb-2 mt-0 d-inline-block mx-auto w-25">
                    <ul class="list-unstyled">
                        <li><i class="fa fa-home mr-2"></i> My company</li>
                        <li><i class="fa fa-envelope mr-2"></i> email@example.com</li>
                        <li><i class="fa fa-phone mr-2"></i> + 33 12 14 15 16</li>
                        <li><i class="fa fa-print mr-2"></i> + 33 12 14 15 16</li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script>

        // Get the modal
        var modal = document.getElementById('login');
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

</body>

</html>
