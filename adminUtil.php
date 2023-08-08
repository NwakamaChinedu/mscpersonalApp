<?php
include_once 'assets/sql/connect.php';

$id = $_GET['sid'];


$delquery = "DELETE FROM stories_tb where sid = $id";
    $delstatement = $conn->prepare($delquery);
    $delstatement->execute();
    header("location: admin.php");
?>