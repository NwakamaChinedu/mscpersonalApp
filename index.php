<?php

/* Reference

www.w3schools.com. (n.d.). Bootstrap Carousel. [online] 
Available at: https://www.w3schools.com/bootstrap/bootstrap_carousel.asp [Accessed 30 Mar. 2023]. */

readfile('header.php');
include_once 'assets/sql/connect.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Index</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
</head>
<body>

<!-- Carousel -->
<div id="demo" class="carousel slide" data-bs-ride="carousel">

  <!-- Indicators/dots -->
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="3"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="4"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="5"></button>
  </div>
  
  <!-- The slideshow/carousel -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="assets/images/picture.jpg" alt="Los Angeles" class="d-block" width="1668" height="900">
    </div>
    <div class="carousel-item">
      <img src="assets/images/picture1.jpg" alt="Chicago" class="d-block" width="1668" height="900">
    </div>
    <div class="carousel-item">
      <img src="assets/images/picture2.jpg" alt="New York" class="d-block" width="1668" height="900">
    </div>
    <div class="carousel-item">
      <img src="assets/images/picture3.jpg" alt="New York" class="d-block" width="1668" height="900">
    </div>
    <div class="carousel-item">
      <img src="assets/images/picture4.jpg" alt="New York" class="d-block" width="1668" height="900">
    </div>
    <div class="carousel-item">
      <img src="assets/images/picture5.jpg" alt="New York" class="d-block" width="1668" height="900">
    </div>
  </div>
  
  <!-- Left and right controls/icons -->
  <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</body>
<?php
  readfile('footer.php');
?>
</html>