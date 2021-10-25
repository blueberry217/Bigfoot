<?php
$database_username = 'root';
$database_password = 'xainnaxa';

try {
    $con = new PDO( 'mysql:host=localhost;dbname=pruebas', $database_username, $database_password);
}
catch(PDOException $e)
{
    echo "connection Failed:" . $e -> getMessage();
}
?>