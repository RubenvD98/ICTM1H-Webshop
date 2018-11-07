<?php   
function Artikelfilter($artikelnaam){
    $db = "mysql:host=localhost;dbname=wideworldimporters;port=3306";
    $user = "root";
    $pass = "";
    $pdo = new PDO($db, $user, $pass);
    $Querry = $pdo->prepare("SELECT * FROM stockitems WHERE StockItemName LIKE '%$artikelnaam%'");
    $Querry->execute();
    $Array = array();
    while($row = $Querry->fetch()){
        $Product = $row["StockItemName"];
        $Array[] = $Product;
    }
    print("$artikelnaam <br>");
} 