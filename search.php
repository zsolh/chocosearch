<?php

    if(isset($_POST['searchtext']) ){
        $serchText = $_POST['searchtext'];

        $dbCon = mysqli_connect('localhost', 'root', '', 'chocoshop');
        mysqli_query($dbCon, "SET NAMES utf8");

        $sql = "SELECT product.name, category.name AS category, product.brand, product.country, product.weight, product.price
        FROM product INNER JOIN category ON product.category=category.id
        WHERE category.name LIKE '%$searchText%'
        OR product.name LIKE '%$searchText%'
        OR product.brand LIKE '%$searchText%'
        OR product.country LIKE '%$searchText%'
        ORDER BY product.price ASC, product.name ASC
        ";
        $sqlResult = mysqli_query($dbCon, $sql);

        $resultArray = array();

        while($productData = mysqli_fetch_assoc($sqlResult)) {

            $resultArray[] = $productData;
        }

        echo json_encode($resultArray);
    }

?>