<?php

// connect database
include("connect.php");

$stmt = $con->prepare("SELECT * FROM brands ");
$stmt->execute(); 
$brands = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($brands as $data){
    $jsonBrands[] = $data;
}

$allBrandData["brandData"] =   $jsonBrands;

echo json_encode($allBrandData); //returns json file

?>