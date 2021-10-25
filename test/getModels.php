<?php

// connect database
include("connect.php");

$id = $_POST["id"];
$stmt = "";
$stmt = $con->prepare("SELECT * FROM models WHERE brand_id =?");
$stmt->execute([$id]);
$models = $stmt->fetchAll(PDO::FETCH_ASSOC);

if($models == null){
    $jsonModels[] = array("id"=>-1,"name"=>"Sorry! This Brand has no Models yet.");
}
else{
foreach($models as $data){
        $jsonModels[] = $data;
}
}

$allModelData["modelData"] = $jsonModels;

echo json_encode($allModelData); //returns json file

?>