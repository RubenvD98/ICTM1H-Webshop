<?php
// include database configuration file
include '../Functies/dbConfig.php';

// initializ shopping cart class
include '../Winkelwagen/Cart.php';
$cart = new Cart;

// redirect to home if cart is empty
if($cart->total_items() <= 0){
    header("Location: ../Categories/Categories.php");
}

// set customer ID in session
$_SESSION['sessCustomerID'] = 1;

// get customer details by session customer ID
$query = $db->query("SELECT * FROM klanten WHERE klantenid = ".$_SESSION['sessCustomerID']);
$custRow = $query->fetch_assoc();

include '../Functies/Functie.php';
include '../Functies/Layouts.php';
?>
<!DOCTYPE html>
<html>
<head>
  <?php includeFiles(); ?>
    <style>
    footer {
        position:absolute;
        bottom:0;
        width:100%;
        height: 170px;   /* Height of the footer */
    }
    .containerorder{
      position: static;
      width: 100%;
      padding: 50px;
    }
    .table{
      position: static;
      width: 65%;
      float: left;
    }
    .shipAddr{
      position: static;
      width: 30%;
      float: left;
      margin-left: 30px;
    }
    .orderBtn {
      float: right;
      }
      .footBtn{
        width: 97%;
        float: left;
      }
    </style>
    <script>
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
                          <a class="btn btn-success btn-sm ml-3" href="../Winkelwagen/Winkelwagen.php">
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
                    <li class="breadcrumb-item"><a href="../Winkelwagen/Winkelwagen.php">Winkelwagen</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Betalen</a></li>
                  </ol>
              </nav>
          </div>
      </div>
  </div>
  <div class="container-fluid">
    <div class="containerorder">
        <h1>Bestelling Overzicht</h1>
        <table class="table">
        <thead>
            <tr>
              <th>Product</th>
              <th>Prijs</th>
              <th>Aantal</th>
              <th>Subtotaal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if($cart->total_items() > 0){
                //get cart items from session
                $cartItems = $cart->contents();
                foreach($cartItems as $item){
            ?>
            <tr>
                <td><?php echo $item["name"]; ?></td>
                <td><?php echo '€'.$item["price"]; ?></td>
                <td><?php echo $item["qty"]; ?></td>
                <td><?php echo '€'.$item["subtotal"]; ?></td>
            </tr>
            <?php } }else{ ?>
            <tr><td colspan="4"><p>Winkelwagen is leeg.....</p></td>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2"></td>
                <?php if($cart->total_items() > 0){ ?>
                  <td class="text-right"><strong>Totaal:</strong></td>
                  <td class="text-left"><strong><?php echo '€'.$cart->total(); ?></strong></td>
                <?php } ?>
            </tr>
        </tfoot>
        </table>
          <div class="shipAddr">
            <form class="form-horizontal" action="Betalen.php" method="post">
              <label><strong>Naam:</label>
              <div class="form-row">
                <div class="form-group col-md-8">
                  <input type="text" class="form-control" id="voornaam" name="voornaam" placeholder="Voornaam" required>
                </div>
                <div class="form-group col-md-4">
                  <input type="text" class="form-control" id="tussenvoegsel" name="tussenvoegsel" placeholder="Tussenvoegsel">
                </div>
              </div>
              <div class="form-group">
                  <input type="text" class="form-control" id="achternaam" name="achternaam" placeholder="Achternaam" required>
              </div>
              <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
              </div>
              <div class="form-group">
                <label for="telefoonnr">Telefoon nummer:</label>
                <input type="tel" class="form-control" id="telefoonnr" name="telefoonnr" placeholder="Telefoon nummer">
              </div>
              <div>
                <label>Adress:</strong></label>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" id="postcode" name="postcode" placeholder="Postcode" required>
                </div>
                <div class="form-group col-md-3">
                  <input type="text" class="form-control" id="huisnummer" name="huisnummer" placeholder="Huisnummer" required>
                </div>
                <div class="form-group col-md-3">
                  <input type="text" class="form-control" id="toevoeging" name="toevoeging" placeholder="Toevoeging">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" id="adres" name="adres" placeholder="Adres" required>
                </div>
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" id="plaats" name="plaats" placeholder="Plaats" required>
                </div>
              </div>
              <button type="submit" href="Betalen.php" class="btn btn-success orderBtn">Afrekenen<i class="glyphicon glyphicon-menu-right"></i></a>
            </form>
          </div>
        <div class="footBtn">
          <a href="../Categories/Categories.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i>Veder Winkelen</a>
        </div>
    </div>
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
