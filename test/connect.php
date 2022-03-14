<?php
$database_username = 'root';
$database_password = '';

try {
    $con = new PDO( 'mysql:host=localhost;dbname=bigfoot', $database_username, $database_password);
}
catch(PDOException $e)
{
    echo "connection Failed:" . $e -> getMessage();
}
?>
