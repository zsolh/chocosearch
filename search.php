<?php

    // Szerver oldali kereső adatbázisból
    // 1 karakterláncot kap keresési kifejezésként és a válaszba bele kell tenni azokat a termékeket, melyek tartalmazzák a keresési kifejezést a kategóriában, a névben, a márkában vagy az országban

    // Ez a szkript POST kérésben várja a keresési kifejezést
    if(isset($_POST['searchText'])) {
        $searchText = $_POST['searchText'];

        // Szükség van adatbázis elérésre
        $dbCon = mysqli_connect('localhost', 'root', '', 'chocoshop');
        mysqli_query($dbCon, "SET NAMES utf8");

        // SQL lekérdezés
        $sql = 
        "SELECT product.name, category.name AS category, product.brand, product.country, product.weight, product.price
        FROM product INNER JOIN category ON product.category=category.id
        WHERE category.name LIKE '%$searchText%'
        OR product.name LIKE '%$searchText%'
        OR product.brand LIKE '%$searchText%'
        OR product.country LIKE '%$searchText%'
        ORDER BY product.price ASC, product.name ASC";
        $sqlResult = mysqli_query($dbCon, $sql);

        // Egy adatszerkezetben kell az összes találat, ehhez felveszünk egy tömböt, aminek a tömbelemei asszociatív tömbök lesznek és a termékek adatait tartalmazzák majd
        // 2 dimenziós tömb
        $resultArray = array();

        while($productData = mysqli_fetch_assoc($sqlResult)) {
            // Az adott termék aszociatív tömbjét beszúrjuk a választömbbe
            $resultArray[] = $productData;
        }

        // A ciklus végére az összes találat benne lesz az összetett tömbünkben
        // JSON szintaxisra alakítva kiírjuk, amit válaszként kap meg majd a kérést indító XMLHttpRequest objektum, kliens oldalon
        echo json_encode($resultArray);

    }

?>