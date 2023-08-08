<?php
include_once 'assets/sql/connect.php';

$sid = $_GET['sid'];
$sid = $_GET['sid']; // get the value of the 'sid' parameter from the URL
$sid = urldecode($sid); // decode the URL-encoded string
$sid = str_replace("<", "", $sid);


$delquery = "DELETE FROM allstories where sid = $sid";
    $delstatement = $conn->prepare($delquery);
    $delstatement->execute();
    header("location: loggedIn.php");
?>
