<?php
// include database configuration file
include '../Functies/dbConfig.php';

// initializ shopping cart class
include '../Winkelwagen/Cart.php';
$cart = new Cart;

// als winkelwagen leeg is ga je terug naar produten pagina
if ($cart->total_items() <= 0) {
    header("Location: ../Categories/Categories.php");
}

include '../Functies/Functie.php';
include '../Functies/Layouts.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Checkout - PHP Shopping Cart Tutorial</title>
        <?php includeFiles(); ?>
        <style>
            .ideal {
                width: 40%;
                height: 40%;
                margin-left: 30px;
            }
        </style>
    </head>
    <body>
        <div class="container text-center">
            <img src="../IMG/Ideal.png" class="ideal">
            <h2>Belangrijk:</h2>
            <p>Sluit na de iDeal betaling de webwinkel <strong>niet</strong> af en accepteer de melding om verder te gaan.</p>
            <p>De betaling zal verlopen via Wide World Importers.</p>
            <h2>Bedrag totaal: <?php echo '€' . $cart->total(); ?></h2>
            <form>
                <h2>Kies uw bank:</h2>
                <div class="form-group">
                    <select class="form-control" id="bank">
                        <option>ABN AMRO</option>
                        <option>ASN BANK</option>
                        <option>bunq</option>
                        <option>ING</option>
                        <option>Knab</option>
                        <option>Moneyou</option>
                        <option selected>Rabobank</option>
                        <option>RegioBank</option>
                        <option>SNS</option>
                        <option>Triodos Bank</option>
                        <option>Van Lanschot</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn btn-secondary">Betalen</button>
                    <a role="button" class="btn btn-secondary" href="../Winkelwagen/Winkelwagen.php">Annuleren</a>
                </div>
            </form>
        </div>
    </body>
</html>
