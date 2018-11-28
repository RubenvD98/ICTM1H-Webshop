<?php
// initialize shopping cart class
include 'Cart.php';
$cart = new Cart;

// include database configuration file
include '../Functies/dbConfig.php';
if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
    if ($_REQUEST['action'] == 'addToCart' && !empty($_REQUEST['id']) && !empty($_REQUEST['aantal'])) {
        $productID = $_REQUEST['id'];
        $aantal = $_REQUEST['aantal'];
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
    } elseif($_REQUEST['action'] == 'updateCartItem' && !empty($_REQUEST['id'])){
        $itemData = array(
            'rowid' => $_REQUEST['id'],
            'qty' => $_REQUEST['qty']
        );
        $updateItem = $cart->update($itemData);
        echo $updateItem?'ok':'err';die;
    } elseif ($_REQUEST['action'] == 'removeCartItem' && !empty($_REQUEST['id'])) {
        $deleteItem = $cart->remove($_REQUEST['id']);
        header("Location: Winkelwagen.php");
    } elseif ($_REQUEST['action'] == 'placeOrder' && $cart->total_items() > 0 && !empty($_SESSION['sessCustomerID'])) {
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
        header("Location: ../Categories/Categories.php");
    }
} else {
    header("Location: ../Categories/Categories.php");
}
