<?php session_start();
include 'functions.php';?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <a href="winkelwagen.php">Ga naar de winkelwagen</a> <Br>
       
        <form action="index.php" method="GET">
            Zoek <input type="text" name="Zoek">
            <button type="submit">Zoek!</button>
        </form>
        
        <?php
        $db = "mysql:host=localhost;dbname=wideworldimporters;port=3306";
        $user = "root";
        $pass = "";
        $pdo = new PDO($db, $user, $pass);
        
        $naam="l;kafda";
        $_SESSION["naam"] = $naam;
        
        //zoeken
        $productnaam = FILTER_INPUT(INPUT_GET, "Zoek", FILTER_SANITIZE_STRING);

        
        //ophalen
        if(empty($productnaam)){
        $productenOphalen =  $pdo->prepare("SELECT* FROM stockitems");
        $productenOphalen->execute();
        
        //USB food flash drive
        $UsbfoodFlashDriveQuerry = $pdo->prepare("SELECT * FROM stockitems WHERE StockItemName LIKE '%USB food flash drive%'");
        $UsbfoodFlashDriveQuerry->execute();
        $UsbfoodFlashDriveArray = array();
        while($row = $UsbfoodFlashDriveQuerry->fetch()){
            $UsbfoodFlashDrive = $row["StockItemName"];
            $UsbfoodFlashDriveArray[] = $UsbfoodFlashDrive;
        }
        print("USB food flash drive <br>");
        
        //DBA joke mug
        $DbaJokeMugQuerry = $pdo->prepare("SELECT * FROM stockitems WHERE StockItemName LIKE '%USB food flash drive%'");
        $DbaJokeMugQuerry->execute();
        $DbaJokeMugArray = array();
        while($row = $DbaJokeMugQuerry->fetch()){
            $DbaJokeMug = $row["StockItemName"];
            $DbaJokeMugArray[] = $DbaJokeMug;
        }
        print("DBA joke mug <br>");

        //Developer joke mug
        $DeveloperJokeMugQuerry = $pdo->prepare("SELECT * FROM stockitems WHERE StockItemName LIKE '%Developer joke mug%'"); 
        $DeveloperJokeMugQuerry->execute();
        $DeveloperJokeMugArray = array();
        while($row = $DeveloperJokeMugQuerry->fetch()){
            $DeveloperJokeMug = $row["StockItemName"];
            $DeveloperJokeMugArray[] = $DeveloperJokeMug;
        }
        print("Developer joke mug <br>");
       
        //IT joke mug
        $ItJokeMugQuerry = $pdo->prepare("SELECT * FROM stockitems WHERE StockItemName LIKE '%IT joke mug%'");
        $ItJokeMugQuerry->execute();
        $ItJokeMugArray = array();
        while($row = $ItJokeMugQuerry->fetch()){
            $ItJokeMug = $row["StockItemName"];
            $ItJokeMugArray[] = $ItJokeMug;
        }
        print("IT joke mug <br>");
        
        //RC toy sedan car with remote control 
        $RcToySedanCarWithRemoteControlQuerry =  $pdo->prepare("SELECT * FROM stockitems WHERE StockItemName LIKE '%IT joke mug%'");
        $RcToySedanCarWithRemoteControlQuerry->execute();
        $RcToySedanCarWithRemoteControlArray = array();
        while($row = $RcToySedanCarWithRemoteControlQuerry->fetch()){
            $RcToySedanCarWithRemoteControl = $row["StockItemName"];
            $RcToySedanCarWithRemoteControlArray[] = $RcToySedanCarWithRemoteControl;
        }
        print("RC toy sedan car with remote control <br>");
        
        //RC vintage American toy coupe with remote control 
        $RcVintageAmericanToyCoupeWithRemoteControlQuerry =  $pdo->prepare("SELECT * FROM stockitems WHERE StockItemName LIKE '%RC vintage American toy coupe with remote control%'");
        $RcVintageAmericanToyCoupeWithRemoteControlQuerry->execute();
        $RcVintageAmericanToyCoupeWithRemoteControlArray = array();
        while($row = $RcVintageAmericanToyCoupeWithRemoteControlQuerry->fetch()){
            $RcVintageAmericanToyCoupeWithRemoteControl = $row["StockItemName"];
            $RcVintageAmericanToyCoupeWithRemoteControlArray[] = $RcToySedanCarWithRemoteControl;
        }
        print("RC vintage American toy coupe with remote control <br>");
        
        //RC big wheel monster truck with remote control
        print("RC big wheel monster truck with remote control <br>");
        
        //Ride on toy sedan car
        $RideOnToySedanCarQuerry = $pdo->prepare("SELECT * FROM stockitems WHERE StockItemName LIKE '%Ride on toy sedan car%'");
        $RideOnToySedanCarQuerry->execute();
        $RideOnToySedanCarArray = array();
        while($row = $RideOnToySedanCarQuerry->fetch()){
            $RideOnToySedanCar = $row["StockItemName"];
            $RideOnToySedanCarArray[] = $RideOnToySedanCar;
        }
        print("Ride on toy sedan car <br>");
        
        //Ride on vintage American toy coupe 
        $RideOnVintageAmericanToyCoupeQuerry = $pdo->prepare("SELECT * FROM stockitems WHERE StockItemName LIKE '%Ride on vintage American toy coupe%'"); 
        $RideOnVintageAmericanToyCoupeQuerry->execute();
        $RideOnVintageAmericanToyCoupeArray = array();
        while($row = $RideOnVintageAmericanToyCoupeQuerry->fetch()){
            $RideOnVintageAmericanToyCoupe = $row["StockItemName"];
            $RideOnToySedanCarArray[] = $RideOnVintageAmericanToyCoupe ;
        }
        print("Ride on vintage American toy coupe <br>");
        
        //Ride on big wheel monster truck
        print("Ride on big wheel monster truck <br>");
        
        //"The Gu" red shirt XML tag t-shirt 
        $TheGuRedShirtXmlTagQuerry = $pdo->prepare("SELECT * FROM stockitems WHERE StockItemName LIKE '%\"The Gu\" red shirt XML tag t-shirt%'");
        $TheGuRedShirtXmlTagQuerry->execute();
        $TheGuRedShirtXmlTagArray = array();
        while($row = $TheGuRedShirtXmlTagQuerry->fetch()){
            $TheGuRedShirtXmlTag = $row["StockItemName"];
            $TheGuRedShirtXmlTagArray[] = $TheGuRedShirtXmlTag;
        }
        print('"The Gu" red shirt XML tag t-shirt <br>');
        
        //Alien officer hoodie 
        $AlienOfficerHoodieQuerry = $pdo->prepare("SELECT * FROM stockitems WHERE StockItemName LIKE '%Alien officer hoodie%'");
        $AlienOfficerHoodieQuerry->execute();
        $AlienOfficerHoodieArray = array();
        while($row = $AlienOfficerHoodieQuerry->fetch()){
            $AlienOfficerHoodie = $row["StockItemName"];
            $AlienOfficerHoodieArray[] = $AlienOfficerHoodie;
        }
        print("Alien officer hoodie <Br>");
        
        //Superhero action jacket
        $SuperheroActionJacketQuerry =  $pdo->prepare("SELECT * FROM stockitems WHERE StockItemName LIKE '%Superhero action jacket%'");
        $SuperheroActionJacketQuerry->execute();
        $SuperheroActionJacketArray = array();
        while($row = $SuperheroActionJacketQuerry->fetch()){
            $SuperheroActionJacket = $row["StockItemName"];
            $SuperheroActionJacketArray[] = $SuperheroActionJacket;
        }
        print("Superhero action jacket <br>");
        
        //Dinosaur battery-powered slippers 
        $DinosaurBatteryPoweredSlippersQuerry =  $pdo->prepare("SELECT * FROM stockitems WHERE StockItemName LIKE '%Dinosaur battery-powered slippers%'");
        $DinosaurBatteryPoweredSlippersQuerry->execute();
        $DinosaurBatteryPoweredSlippersArray = array();
        while($row = $DinosaurBatteryPoweredSlippersQuerry->fetch()){
            $DinosaurBatteryPoweredSlippers = $row["StockItemName"];
            $DinosaurBatteryPoweredSlippersArray[] = $DinosaurBatteryPoweredSlippers;
        }
        print("Dinosaur battery-powered slippers <br>");
        
        //Ogre battery-powered slippers 
        $OgreBatteryPoweredSlippersQuerry = $pdo->prepare("SELECT * FROM stockitems WHERE StockItemName LIKE '%Ogre battery-powered slippers%'");
        $OgreBatteryPoweredSlippersQuerry->execute();
        $OgreBatteryPoweredSlippersArray = array();
        while($row = $OgreBatteryPoweredSlippersQuerry->fetch()){
            $OgreBatteryPoweredSlippers = $row["StockItemName"];
            $OgreBatteryPoweredSlippersArray[] = $OgreBatteryPoweredSlippers;
        }
        print("Ogre battery-powered slippers <br>");
        
        //Plush shark slippers
        $PlushSharkSlippersQuerry = $pdo->prepare("SELECT * FROM stockitems WHERE StockItemName LIKE '%Plush shark slippers%'");
        $PlushSharkSlippersQuerry->execute();
        $PlushSharkSlippersArray = array();
        while($row = $PlushSharkSlippersQuerry->fetch()){
            $PlushSharkSlippers = $row["StockItemName"];
            $PlushSharkSlippersArray[] = $PlushSharkSlippers;
        }
        print("Plush shark slippers <br>");
        
        //Furry gorilla with big eyes slippers
        $FurryGorillaWithBigEyesSlippersQuerry = $pdo->prepare("SELECT * FROM stockitems WHERE StockItemName LIKE '%Furry gorilla with big eyes slippers%'");
        $FurryGorillaWithBigEyesSlippersQuerry->execute();
        $FurryGorillaWithBigEyesSlippersArray = array();
        while($row = $FurryGorillaWithBigEyesSlippersQuerry->fetch()){
            $FurryGorillaWithBigEyesSlippers = $row["StockItemName"];
            $FurryGorillaWithBigEyesSlippersArray[] = $FurryGorillaWithBigEyesSlippers;
        }
        print("Furry gorilla with big eyes slippers <br>");
        
        //Animal with big feet slippers 
        $AnimalWithBigFeetSlippersQuerry = $pdo->prepare("SELECT * FROM stockitems WHERE StockItemName LIKE '%Animal with big feet slippers%'");
        $AnimalWithBigFeetSlippersQuerry->execute();
        $AnimalWithBigFeetSlippersArray = array();
        while($row = $AnimalWithBigFeetSlippersQuerry->fetch()){
            $AnimalWithBigFeetSlippers = $row["StockItemName"];
            $AnimalWithBigFeetSlippersArray[] = $AnimalWithBigFeetSlippers;
        }
        print("Animal with big feet slippers <br>");
        
        //Furry animal socks 
        $FurryAnimalSocksQuerry = $pdo->prepare("SELECT * FROM stockitems WHERE StockItemName LIKE '%Furry animal socks%'");
        $FurryAnimalSocksQuerry->execute();
        $FurryAnimalSocksArray = array();
        while($row = $FurryAnimalSocksQuerry->fetch()){
            $FurryAnimalSocks = $row["StockItemName"];
            $FurryAnimalSocksArray[] = $FurryAnimalSocks;
        }
        print"Furry animal socks <br>";
        
        //Halloween zombie mask 
        $HalloweenZombieMaskQuerry = $pdo->prepare("SELECT * FROM stockitems WHERE StockItemName LIKE '%Halloween zombie mask%'");
        $HalloweenZombieMaskQuerry->execute();
        $HalloweenZombieMaskArray = array();
        while($row = $HalloweenZombieMaskQuerry->fetch()){
            $HalloweenZombieMask = $row["StockItemName"];
            $HalloweenZombieMaskArray[] = $HalloweenZombieMask;
        }
        print"Halloween zombie mask <br>";
        
        //Halloween skull mask
        $HalloweenSkullMaskQuerry = $pdo->prepare("SELECT * FROM stockitems WHERE StockItemName LIKE '%Halloween skull mask%'");
        $HalloweenSkullMaskQuerry->execute();
        $HalloweenSkullMaskArray = array();
        while($row = $HalloweenSkullMaskQuerry->fetch()){
            $HalloweenSkullMask = $row["StockItemName"];
            $HalloweenSkullMaskArray[] = $HalloweenSkullMask;
        }
        print("Halloween skull mask <br>");
        
        //Pack of 12 action figures
        $PackOf12ActionFiguresQuerry = $pdo->prepare("SELECT * FROM stockitems WHERE StockItemName LIKE '%Pack of 12 action figures%'");
        $PackOf12ActionFiguresQuerry->execute();
        $PackOf12ActionFiguresArray = array();
        while($row = $PackOf12ActionFiguresQuerry->fetch()){
            $PackOf12ActionFigures = $row["StockItemName"];
            $PackOf12ActionFiguresArray[] = $PackOf12ActionFigures;
        }
        print("Pack of 12 action figures <br>");
        
        //bubblewrap roll 
        $BubblewrapQuerry = $pdo->prepare("SELECT * FROM stockitems WHERE StockItemName LIKE '%Bubblewrap roll%'");
        $BubblewrapQuerry->execute();
        $BubblewrapArray = array();
        while($row = $BubblewrapQuerry->fetch()){
            $Bubblewrap = $row["StockItemName"];
            $BubblewrapArray[] = $Bubblewrap;
        }
        print("Bubblewrap roll <br>");
        
        //10 mm Double sided bubble wrap 
        $TenmmDoubleSidedBubblewrapQuerry = $pdo->prepare("SELECT * FROM stockitems WHERE StockItemName LIKE '%10 mm Double sided bubble wrap%'");
        $TenmmDoubleSidedBubblewrapQuerry->execute();
        $TenmmDoubleSidedBubblewrapArray = array();
        while($row = $TenmmDoubleSidedBubblewrapQuerry->fetch()){
            $TenmmDoubleSidedBubblewrap = $row["StockItemName"];
            $TenmmDoubleSidedBubblewrapArray[] = $TenmmDoubleSidedBubblewrap;
        }
        print("10 mm Double sided bubble wrap <br>");
        
        //20 mm Double sided bubble wrap
        $TwentymmDoubleSidedBubblewrapQuerry = $pdo->prepare("SELECT * FROM stockitems WHERE StockItemName LIKE '%20 mm Double sided bubble wrap%'");
        $TwentymmDoubleSidedBubblewrapQuerry->execute();
        $TwentymmDoubleSidedBubblewrapArray = array();
        while($row = $TwentymmDoubleSidedBubblewrapQuerry->fetch()){
            $TwentymmDoubleSidedBubblewrap = $row["StockItemName"];
            $TwentymmDoubleSidedBubblewrapArray[] = $TwentymmDoubleSidedBubblewrap;
        }
        print("20 mm Double sided bubble wrap <br>");
        
        //32 mm Double sided bubble wrap
        $ThirtymmDoubleSidedBubblewrapQuerry = $pdo->prepare("SELECT * FROM stockitems WHERE StockItemName LIKE '%32 mm Double sided bubble wrap%'");
        $ThirtymmDoubleSidedBubblewrapQuerry->execute();
        $ThirtymmDoubleSidedBubblewrapArray = array();
        while($row = $ThirtymmDoubleSidedBubblewrapQuerry->fetch()){
            $ThirtymmDoubleSidedBubblewrap = $row["StockItemName"];
            $ThirtymmDoubleSidedBubblewrapArray[] = $ThirtymmDoubleSidedBubblewrap;
        }
        print("32 mm Double sided bubble wrap <br>");
        
        //10 mm Anti static bubble wrap
        $TenMmAntiStaticBubblewrapQuerry = $pdo->prepare("SELECT * FROM stockitems WHERE StockItemName LIKE '%10 mm Anti static bubble wrap%'");
        $TenMmAntiStaticBubblewrapQuerry->execute();
        $TenMmAntiStaticBubblewrapArray = array();
        while($row = $TenMmAntiStaticBubblewrapQuerry->fetch()){
            $TenMmAntiStaticBubblewrap = $row["StockItemName"];
            $TenMmAntiStaticBubblewrapArray [] = $TenMmAntiStaticBubblewrap;
        }
        print("10 mm Anti static bubble wrap <br>");
        
        //20 mm Anti static bubble wrap 
        $TwentyMmAntiStaticBubbleWrapQuerry = $pdo->prepare("SELECT * FROM stockitems WHERE StockItemName LIKE '%20 mm Anti static bubble wrap%'");    
        $TwentyMmAntiStaticBubbleWrapQuerry->execute();
        $TwentyMmAntiStaticBubbleWrapArray = array();
        while($row = $TwentyMmAntiStaticBubbleWrapQuerry->fetch()){
            $TwentyMmAntiStaticBubbleWrap = $row["StockItemName"];
            $TwentyMmAntiStaticBubbleWrapArray[] = $TwentyMmAntiStaticBubbleWrap;
        }
        print("20 mm Anti static bubble wrap <br>");
        
        //32 mm Anti static bubble wrap
        $ThirtyMmAntiStaticBubblewrapQuerry =  $pdo->prepare("SELECT * FROM stockitems WHERE StockItemName LIKE '%32 mm Anti static bubble wrap%'");
        $ThirtyMmAntiStaticBubblewrapQuerry->execute();
        $ThirtyMmAntiStaticBubblewrapArray = array();
        while($row = $ThirtyMmAntiStaticBubblewrapQuerry->fetch()){
            $ThirtyMmAntiStaticBubblewrap = $row["StockItemName"];
            $ThirtyMmAntiStaticBubblewrapArray[] = $ThirtyMmAntiStaticBubblewrap;
        }
        print("32 mm Anti static bubble wrap <br>");
        
        //Bubblewrap dispenser 1,5M
        $BubblewrapDispenserQuerry = $pdo->prepare("SELECT * FROM stockitems WHERE StockItemName LIKE '%Bubblewrap dispenser%'");
        $BubblewrapDispenserQuerry->execute();
        $BubblewrapDispenserArray = array();
        while($row = $BubblewrapDispenserQuerry->fetch()){
            $BubblewrapDispenser = $row["StockItemName"];
            $BubblewrapDispenserArray[]=$BubblewrapDispenser;
        }
        print("Bubblewrap dispenser 1,5M <br>");
        
        //Shipping carton
        $ShippingCartonQuerry = $pdo->prepare("SELECT * FROM stockitems WHERE StockItemName LIKE '%Shipping carton%'");
        $ShippingCartonQuerry->execute();
        $ShippingCartonArray = array();
        while($row = $ShippingCartonQuerry->fetch()){
            $ShippingCarton = $row["StockItemName"];
            $ShippingCartonArray[] = $ShippingCarton;
        }
        print("Shipping carton <br>");
        
        //Express post box 5kg
        print("Express post box 5kg");
        
        //3 kg Courier post bag
        print("3 kg Courier post bag");
        
        //Clear packaging tape
        $ClearPackagingTapeQuerry = $pdo->prepare("SELECT * FROM stockitems WHERE StockItemName LIKE '%Clear packaging tape%'");
        $ClearPackagingTapeQuerry->execute();
        $ClearPackagingTapeArray = array();
        while($row = $ClearPackagingTapeQuerry->fetch()){
            $ClearPackagingTape = $row["StockItemName"];
            $ClearPackagingTapeArray[] = $ClearPackagingTape;
        }
        print("Clear packaging tape <br>");
        
        //Black and orange fragile despatch tape 
        $BlackAndOrangeFragileDespatchTapeQuerry = $pdo->prepare("SELECT * FROM stockitems WHERE StockItemName LIKE '%Black and orange fragile despatch tape%'");
        $BlackAndOrangeFragileDespatchTapeQuerry->execute();
        $BlackAndOrangeFragileDespatchTapeArray = array();
        while($row = $BlackAndOrangeFragileDespatchTapeQuerry->fetch()){
            $BlackAndOrangeFragileDespatchTape = $row["StockItemName"];
            $BlackAndOrangeFragileDespatchTapeArray[] = $BlackAndOrangeFragileDespatchTape;
        }
        print("Black and orange fragile despatch tape <br>");
        
        //Black and orange glass with care despatch tape 
        $BlackAndOrangeGlassWithCareDespatchQuerry = $pdo->prepare("SELECT * FROM stockitems WHERE StockItemName LIKE '%Black and orange glass with care despatch tape%'");
        $BlackAndOrangeGlassWithCareDespatchQuerry->execute();
        $BlackAndOrangeGlassWithCareDespatchArray  = array();
        while($row = $BlackAndOrangeGlassWithCareDespatchQuerry->fetch()){
            $BlackAndOrangeGlassWithCareDespatch = $row["StockItemName"];
            $BlackAndOrangeGlassWithCareDespatchArray[] = $BlackAndOrangeGlassWithCareDespatch;
        }
        print("Black and orange glass with care despatch tape <br>");
        
        //Black and orange handle with care despatch tape 
        $BlackAndOrangeHandleWithCareDespatchTapeQuerry = $pdo->prepare("SELECT * FROM stockitems WHERE StockItemName LIKE '%Black and orange handle with care despatch tape%'");
        $BlackAndOrangeHandleWithCareDespatchTapeQuerry->execute();
        $BlackAndOrangeHandleWithCareDespatchTapeArray = array();
        while($row = $BlackAndOrangeHandleWithCareDespatchTapeQuerry->fetch()){
            $BlackAndOrangeHandleWithCareDespatchTape = $row["StockItemName"];
            $BlackAndOrangeHandleWithCareDespatchTapeArray[] = $BlackAndOrangeHandleWithCareDespatchTape;
        }
        print("Black and orange handle with care despatch tape <br>");
        
        //Black and orange this way up despatch tape
        $BlackAndOrangeThisWayUpDespatchTapeQuerry = $pdo->prepare("SELECT * FROM stockitems WHERE StockItemName LIKE '%Black and orange this way up despatch tape%'");
        $BlackAndOrangeThisWayUpDespatchTapeQuerry->execute();
        $BlackAndOrangeThisWayUpDespatchTapeArray = array();
        while($row = $BlackAndOrangeThisWayUpDespatchTapeQuerry->fetch()){
            $BlackAndOrangeThisWayUpDespatchTape = $row["StockItemName"];
            $BlackAndOrangeThisWayUpDespatchTapeArray[] = $BlackAndOrangeThisWayUpDespatchTape;
        }
        
        //Black and yellow heavy despatch tape
        $BlackAndYellowHeavyDespatchTapeQuerry = $pdo->prepare("SELECT * FROM stockitems WHERE StockItemName LIKE '%Black and yellow heavy despatch tape%'");
        $BlackAndYellowHeavyDespatchTapeQuerry->execute();
        $BlackAndYellowHeavyDespatchTapeArray = array();
        while($row = $BlackAndYellowHeavyDespatchTapeQuerry->fetch()){
            $BlackAndYellowHeavyDespatchTape = $row["StockItemName"];
            $BlackAndYellowHeavyDespatchTapeArray[] = $BlackAndYellowHeavyDespatchTape;
        }
        print("Black and yellow heavy despatch tape <br>");
        
        //Red and white urgent despatch tape
        print("Red and white urgent despatch tape <br>");
        
        //Red and white urgent heavy despatch tape 
        print("Red and white urgent heavy despatch tape <br>");
        
        //Tape dispenser
        $TapeDispenserQuerry =  $pdo->prepare("SELECT * FROM stockitems WHERE StockItemName LIKE '%Tape dispenser%'");
        $TapeDispenserQuerry->execute();
        $TapeDispenserArray = array();
        while($row = $TapeDispenserQuerry->fetch()){
            $TapeDispenser = $row["StockItemName"];
            $TapeDispenserArray[] = $TapeDispenser;
        }
        print("Tape dispenser <br>");
        
        //Permanent Marker
        $PermanentMarkerQuerry = $pdo->prepare("SELECT * FROM stockitems WHERE StockItemName LIKE '%Permanent Marker%'");
        $PermanentMarkerQuerry->execute();
        $PermanentMarkerArray = array();
        while($row = $PermanentMarkerQuerry->fetch()){
            $PermanentMarker = $row["StockItemName"];
            $PermanentMarkerArray[] = $PermanentMarker;
        }
        print("Permanent Marker <br>");
        
        //Packing knife with metal insert blade 
        $PackingKnifeWithMetalInsertBladeQuerry = $pdo->prepare("SELECT * FROM stockitems WHERE StockItemName LIKE '%Packing knife with metal insert blade%'");
        $PackingKnifeWithMetalInsertBladeQuerry->execute();
        $PackingKnifeWithMetalInsertBladeArray = array();
        while($row = $PackingKnifeWithMetalInsertBladeQuerry->fetch()){
            $PackingKnifeWithMetalInsertBlade = $row["StockItemName"];
            $PackingKnifeWithMetalInsertBladeArray[] = $PackingKnifeWithMetalInsertBlade; 
        }
        print("Packing knife with metal insert blade <br>");
        
        //Small 9mm replacement blades 
        print("Small 9mm replacement blades <br>");
        
        //Large replacement blades 
        print("Large replacement blades <br>");
        
        //Air cushion film 
        $AirCushionFilmQuerry = $pdo->prepare("SELECT * FROM stockitems WHERE StockItemName LIKE '%Air cushion film%'");
        $AirCushionFilmQuerry->execute();
        $AirCushionFilmArray = array();
        while($row = $AirCushionFilmQuerry->fetch()){
            $AirCushionFilm = $row["StockItemName"];
            $AirCushionFilmArray[] = $AirCushionFilm;
        }
        print("Air cushion film <br>");
        
        //Air cushion machine
        print("Air cushion machine <br>");
         
        //Void fill bag
        $VoidFillBagQuerry = $pdo->prepare("SELECT * FROM stockitems WHERE StockItemName LIKE '%Void fill% %L bag%'");
        $VoidFillBagQuerry->execute();
        $VoidFillBagArray = array();
        while($row = $VoidFillBagQuerry->fetch()){
            $VoidFillBag = $row["StockItemName"];
            $VoidFillBagArray[] = $VoidFillBag;
        }
        print("Void fill bag <br>");
        
        //Novelty chilli chocolates
        $NoveltyChilliChocolatesQuerry = $pdo->prepare("SELECT * FROM stockitems WHERE StockItemName LIKE '%Novelty chilli chocolates%'");
        $NoveltyChilliChocolatesQuerry->execute();
        $NoveltyChilliChocolatesArray = array();
        while($row = $NoveltyChilliChocolatesQuerry->fetch()){
            $NoveltyChilliChocolates = $row["StockItemName"];
            $NoveltyChilliChocolatesArray[] = $NoveltyChilliChocolates;
        }
        print("Novelty chilli chocolates <br>");
        
        //Chocolate beetles 
        print("Chocolate beetles <br>");
        
        //Chocolate echidnas
        print("Chocolate echidnas <br>");
        
        //Chocolate frogs 
        print("Chocolate frogs <br>");
        
        //Chocolate sharks
        print("Chocolate sharks <br>");
        
        //White chocolate snow balls
        print("White chocolate snow balls <br>");
        
        //White chocolate moon rocks
        print("White chocolate moon rocks <br>");
        } else {
            $querry = $pdo->prepare("SELECT * FROM stockitems WHERE StockItemName LIKE '%$productnaam%'");
            $querry->execute();
            $array = array();
            while($row = $querry->fetch()){
                $product = $row["StockItemName"];
                print("$product <br>");
            }
            
        }
        
        
        
        

        
       /* while ($row = $productenOphalen->fetch()){
            $productnaam = $row["StockItemName"] ;
            print($productnaam . "<br>");
        }*/
    
                
        
       
        ?>
    </body>
</html>
