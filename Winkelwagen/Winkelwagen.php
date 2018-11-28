<?php
include '../Functies/Functie.php';
include '../Functies/Layouts.php';
// initializ shopping cart class
include 'Cart.php';
$cart = new Cart;
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/Model.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        input[type="number"]{width: 45%;}
        footer {
            position:absolute;
            bottom:0;
            width:100%;
            height: 170px;   /* Height of the footer */
        }
        #refresh{
          width: 50%
        }
        #Verwijderen{
          width: 50%
        }
    </style>
    <script>
    function updateCartItem(obj,id){
        $.get("CartAction.php", {action:"updateCartItem", id:id, qty:obj.value}, function(data){
            if(data == 'ok'){
                location.reload();
            }else{
                alert('Cart update failed, please try again.');
            }
        });
    }
    </script>
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
                        <form class="form-inline my-2 my-lg-0" action="../Categories/Categories.php" method="get">
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
                                <button name="inloggen "type="button" class="btn btn-default btn-sm" onclick="document.getElementById('login').style.display = 'block'">Inloggen</button>
                                <button name="registeren" type="button" class="btn btn-default btn-sm" onclick="document.getElementById('signup').style.display = 'block'">Registeren</button>
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

    <!-- winkel mandje -->
    <div class="container">
        <h1>Winkelwagen</h1>
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
                if ($cart->total_items() > 0) {
                    //get cart items from session
                    $cartItems = $cart->contents();
                    foreach ($cartItems as $item) {
                        ?>
                        <tr>
                            <td><?php echo $item["name"]; ?></td>
                            <td><?php echo '€' . $item["price"]; ?></td>
                            <td><input type="number" min="1" max="100" class="form-control text-center" value="<?php echo $item["qty"]; ?>" onchange="updateCartItem(this, '<?php echo $item["rowid"]; ?>')" min="1" max="1000"></td>
                            <td><?php echo '€' . $item["subtotal"]; ?></td>
                            <td>
                              <div class="row">
                                <div class="btn-group btn-block">
                                  <a class="text-white btn btn-danger btn-block" href="CartAction.php?action=removeCartItem&id=<?php echo $item["rowid"]; ?>">Verwijderen</a>
                                </div>
                              </div>
                            </td>
                        </tr>
                    <?php }
                }
                else {
                    ?>
                    <tr><td colspan="5"><p>Winkelwagen is leeg.....</p></td>
                    <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td><a href="../Categories/Categories.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i>Veder winkelen</a></td>
                    <td colspan="1"></td>
                    <?php if ($cart->total_items() > 0) { ?>
                    <td class="text-right"><strong>Totaal:</strong></td>
                    <td class="text-left"><strong><?php echo '€' . $cart->total(); ?></strong></td>
                    <td>
                      <div class="row">
                        <a href="../Betalen/Order.php" class="btn btn-success btn-block" id="Afrekenen">Afrekenen <i class="glyphicon glyphicon-menu-right"></i></a>
                      </div>
                    </td>
                    <?php } ?>
                </tr>
            </tfoot>
        </table>
    </div>
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
