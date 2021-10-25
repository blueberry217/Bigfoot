<?php

// connect database
include("connect.php");

// variabelen declareren
$row = 1;
$bId = 250;
$mId = 500;
$sId = 500;

// csv bestand inladen
if (($handle = fopen("bigfoot.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, "%")) !== FALSE)
    {
        // pakt alle rijen van het csv bestand
        if($row > 1)
        {
            // selecteert tabel brands
            if($data[0])
            {
                // data ophalen
                $bName = $data[0];
                $queryCheckBrand = "SELECT * FROM product_table WHERE  brand_name =:b_name";
                $runQuery = $con->prepare($queryCheckBrand);
                $runQuery->bindParam(':b_name', $bName, PDO::PARAM_STR,255);
                $result = $runQuery->execute();
              
                // controleer of de variabele niet leeg is
                if (!empty($result) ){
                    $count = $runQuery->rowCount();
                    // tel de arrays op
                    if($count = 0)
                    {
                        $queryBrands = "INSERT INTO product_table (id,brand_name) VALUES (:id,:brand_name)";
                        $runQuery = $con->prepare($queryBrands);
                        $result = $runQuery->execute( array( ':id'=>$bId, ':brand_name'=>$b_Name) );

                        if (empty($result) ){

                            echo "error";

                        }

                     // verhoogt de waarde
                        
                      $bId++;
                    }
                }

                // selecteert tabel models
                if($data[1] ){
                    $mName = $data[1];
                    $queryCheckModel = "SELECT * FROM models WHERE name =:mname";
                    $runQuery = $con->prepare($queryCheckModel);
                    $runQuery->bindParam(':mname', $mName, PDO::PARAM_STR,255);
                    $result = $runQuery->execute();

                    if (!empty($result) ){
                        $count = $runQuery->rowCount();
                        if($count = 0)
                        {
                            $queryModels = "INSERT INTO models (id,brand_id,name) VALUES (:id,:brand_id,:name)";
                            $runQuery = $con->prepare($queryModels);
                            $result = $runQuery->execute( array( ':id'=>$mId,':brand_id'=> $bId ,':name'=>$mName) );

                            if (empty($result) ){

                                echo "error";

                            }
                            
                            $mId++;
                        }
                    }

                    // selecteert tabel sizes
                    if($data[2] )
                    {
                        $sName = $data[2];
                        $queryCheckSize = "SELECT * FROM sizes WHERE name =:sname";
                        $runQuery = $con->prepare($queryCheckSize);
                        $runQuery->bindParam(':sname', $sName, PDO::PARAM_STR,255);
                        $result = $runQuery->execute(); 

                        if (!empty($result) )
                        {
                            $count = $runQuery->rowCount();
                            if($count = 0)
                            {
                                $querySizes = "INSERT INTO sizes (id,brand_id,model_id,name) VALUES (:id,:brand_id,:model_id,:name)";
                                $runQuery = $con->prepare($querySizes);
                                $result = $runQuery->execute( array( ':id'=>$sId,':brand_id'=> $bId,':model_id'=>$mId ,':name'=>$sName) );

                                if (empty($result) ){

                                    echo "error";

                                }

                              $sId++;
                            }
                        }
                    }
                }
            }
         }
        $row++;
     }
    // sluit het bestand
    fclose($handle);

    echo "Data has been succesfully imported !";

    echo "<br>";
    echo "Imported rows $row";
    echo "<br>";

   echo "$sizes";

 }
?>

