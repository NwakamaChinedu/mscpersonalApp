<?php
$username = "root";
$dsn = 'mysql:host=localhost; dbname=cmm007';
$password = '';

// create connection
try{
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected to the cmm007 database";
}catch (PDOException $ex){
    echo "connection failed ".$ex->getMessage();
}
?>
