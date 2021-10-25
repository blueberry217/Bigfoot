<?php
include("connect.php");

$bid = $_POST["bid"];
$mid = $_POST["mid"];
$stmt = "";
$stmt = $con->prepare("SELECT * FROM sizes WHERE brand_id =? AND model_id = ?");
$stmt->execute([$bid,$mid]); 
$sizes = $stmt->fetchAll(PDO::FETCH_ASSOC);
if($sizes == null){
    $allSizeData["sizeData"] = array("id"=>-1,"name"=>"Sorry! No Size available for this brand model yet.");
}
else{
foreach($sizes as $data){

        $allSizeData["sizeData"] = $data; 
}
}

echo json_encode($allSizeData); //returns json file  
?>