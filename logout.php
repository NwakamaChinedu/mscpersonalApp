<?php
session_start();
// Your code goes here
session_destroy();
header("location: index.php");
?>