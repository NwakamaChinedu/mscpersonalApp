<?php
if (isset($_SESSION)) {
    readfile('header.php');
}
else{
    readfile('headerLogout.php');
}

include_once 'assets/sql/connect.php';

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    </head>
    <body>
        <div class="container">
        
        <div class="col-md-12">
                <h3 class="text-center">
                    OUR STORIES
                </h3>
            </div><br><br>
            <div style="margin:auto;max-width:300px">
            <div class="container my-5">
            <form method="post">
            <label  for="search">Search</label>
                <input type="text" id="search" placeholder="by location or category">
            </form>
            </div>
            </div>
            
            <div class="col-md-12">
                <h3 class="text-center"></h3>
            </div>
            <div class="table-responsive">
            
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Restuarant Name</th>
                            <th>Category</th> 
                            <th>Location</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        
                    </tbody>
                </table>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/script.js"></script>
    </body>
    <?php
        readfile('footer.php');
    ?>
</html>