<?php
// initialize shopping cart class
include 'Cart.php';
$cart = new Cart;

// include database configuration file
include '../Functies/dbConfig.php';
if (isset($_GET['action']) && !empty($_GET['action'])) {
    if ($_GET['action'] == 'addToCart' && !empty($_GET['id']) && !empty($_GET['aantal'])) {
        $productID = $_GET['id'];
        $aantal = $_GET['aantal'];
        // get product details
        $query = $pdo->prepare("SELECT * FROM stockitems WHERE StockItemID = ?");
        $query->execute(array($productID));
        $row = $query->fetch();
        $itemData = array( //de volgende items worden in een array gezet voor de winkelwagen: StockItemID, StockItemName, RecommendedRetailPrice en aatal
            'id' => $row['StockItemID'],
            'name' => $row['StockItemName'],
            'price' => $row['RecommendedRetailPrice'],
            'qty' => $aantal
        );

        $insertItem = $cart->insert($itemData);
        $redirectLoc = $insertItem ?  'Winkelwagen.php' : '../Categories/Categories.php';
        header("Location: " . $redirectLoc);
    } elseif($_GET['action'] == 'updateCartItem' && !empty($_GET['id'])){
        $itemData = array(
            'rowid' => $_GET['id'],
            'qty' => $_GET['qty']
        );
        $updateItem = $cart->update($itemData);
        echo $updateItem?'ok':'err';die;
    } elseif ($_GET['action'] == 'removeCartItem' && !empty($_GET['id'])) {
        $deleteItem = $cart->remove($_GET['id']);
        header("Location: Winkelwagen.php");
    } else {
        header("Location: ../Categories/Categories.php");
    }
} else {
    header("Location: ../Categories/Categories.php");
}
