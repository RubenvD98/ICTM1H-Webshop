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
        $query = $db->query("SELECT * FROM stockitems WHERE StockItemID = " . $productID);
        $row = $query->fetch_assoc();
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
    } elseif ($_GET['action'] == 'placeOrder' && $cart->total_items() > 0 && !empty($_SESSION['sessCustomerID'])) {
        // insert order details into database
        $insertOrder = $db->query("INSERT INTO orders (CustomerID, OrderDate,) VALUES ('" . $_SESSION['sessCustomerID'] . "', '" . $cart->total() . "', '" . date("Y-m-d H:i:s") . "', '" . date("Y-m-d H:i:s") . "')");

        if ($insertOrder) {
            $orderID = $db->insert_id;
            $sql = '';
            // get cart items
            $cartItems = $cart->contents();
            foreach ($cartItems as $item) {
                $sql .= "INSERT INTO orderlines (OrderID, StockItemID, Quantity) VALUES ('" . $orderID . "', '" . $item['StockItemID'] . "', '" . $item['qty'] . "');";
            }
            // insert order items into database
            $insertOrderItems = $db->multi_query($sql);

            if ($insertOrderItems) {
                $cart->destroy();
                header("Location: ../Betalen/orderSuccess.php?id=$orderID");
            } else {
                header("Location: ../Betalen/Betalen.php");
            }
        } else {
            header("Location: ../Betalen/Betalen.php");
        }
    } else {
   //     header("Location: ../Categories/Categories.php");
    }
} else {
 //   header("Location: ../Categories/Categories.php");
}
