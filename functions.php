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
        $id = $row["StockItemID"];       
        $Array[$id] = $Product;
    }
    return $Array;
} 

function ophalenArtikelen(){
    $db = "mysql:host=localhost;dbname=wideworldimporters;port=3306";
    $user = "root";
    $pass = "";
    $pdo = new PDO($db, $user, $pass);
    $Querry = $pdo->prepare("SELECT * FROM stockitems");
    $Querry->execute();
    $array = array();
    $beschrijvingArray = array();
    while($row = $Querry->fetch()){
        $artikel = $row["StockItemName"];
        $id = $row["StockItemID"];
        $array[$id] = $artikel;

    }
    return $array;
}

function ophalenBeschrijving(){
    $db = "mysql:host=localhost;dbname=wideworldimporters;port=3306";
    $user = "root";
    $pass = "";
    $pdo = new PDO($db, $user, $pass);
    $Querry = $pdo->prepare("SELECT * FROM stockitems");
    $Querry->execute();
    $array = array();
    while($row = $Querry->fetch()){
        $id = $row["StockItemID"];
        $beschrijving = $row["SearchDetails"];
        $array[$id] = $beschrijving;
    }
    return $array;
}

function artikelenSite(){
    $artikelArray = ophalenArtikelen();
    $beschrijvingArray = ophalenBeschrijving();
    
    foreach ($artikelArray as $id => $artikelnaam) {
        ?>
            <div class="col-12 col-md-6 col-lg-4">
                        <div class="card">
                            <img class="card-img-top" src="https://dummyimage.com/600x400/55595c/fff" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title"><a href="product.html" title="View Product"><?php print($artikelnaam) ?></a></h4>
                                <?php foreach ($beschrijvingArray as $key => $beschrijving) {
                                           if($id==$key){
                                               ?>  <p class="card-text"><?php print($beschrijving); ?></p> <?php
                                           }
                                        }?>
                             <div class="row">
                             <div class="col">
                                <p class="btn btn-danger btn-block">99.00 $</p>
                            </div>
                            <div class="col">
                                <a href="#" class="btn btn-success btn-block">Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
            
    }
}

function filteren(){
    $maten = array();
    $maten[] = "3XS";
    $maten[] = "XXS";
    $maten[] = "XS";
    $maten[] = "S";
    $maten[] = "M";
    $maten[] = "L";
    $maten[] = "XL";
    $maten[] = "XXL";
    $maten[] = "3XL";
    $maten[] = "4XL";
    $maten[] = "5XL";
    $maten[] = "6XL";
    $maten[] = "7XL";


    $array = ophalenArtikelen();
    $woordLengte = 0;
    $productenArray = array();
    
    foreach ($array as $key => $product) {
        $woordLengte = strlen($product);
            if(in_array(substr($product, $woordLengte-3), $maten)){
                $product = substr($product, 0, -3);
                if(in_array($product, $productenArray)==false){
                    $productenArray[] = $product;
                    print($product . "<br>");
                }
            } else {
                if(in_array(substr($product, $woordLengte-2), $maten)){
                    $product = substr($product, 0, -2);
                    if(in_array($product, $productenArray)==false){
                        $productenArray[] = $product;
                        print($product . "<br>");
                    }
                } else{
                    if(in_array(substr($product, $woordLengte-1), $maten)){
                        $product = substr($product, 0, -1);
                        if(in_array($product, $productenArray)==false){
                            $productenArray[] = $product;
                            print($product . "<br>");
                            }
                    } else {
                        $productenArray[] = $product;
                        print($product . "<br>");
                    }
                }
            }
        }
    }
    
    function zoeken($zoekopdracht){
         $array = ophalenArtikelen();
         if(empty($zoekopdracht)){
             
         }
    }

