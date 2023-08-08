
<?php
    if (isset($_SESSION)) {
        readfile('header.php');
    }
    else{
        readfile('headerLogout.php');
    }

    
    include_once 'assets/sql/connect.php';
    //include_once 'assets/sessions.php';

    $id = $_GET['sid'];

    $query = "SELECT * FROM allstories where sid = $id";
    $statement = $conn->prepare($query);
    $statement->execute();
    $row = $statement->fetch(PDO::FETCH_ASSOC);

    //$result = $statement->fetchAll();
    


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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <div class="container-lg py-5 h-100">
            <div class="">
                <div class="col-md-12">
                    <h3 
                        class="text-center text-uppercase">Welcome to <?php echo $row["rname"]?>
                    </h3>
                </div><br><br>
                <div class="row">
                    <div class="">
                    <img src= <?php echo $row["images"] ?> alt="Your Image" class="img-fluid" width="1500" height="500">
                    </div>
                </div><br><br>
                <div class="">
                    <div class="">
                        <h2 class="text-center text-uppercase">Story</h2>
                        <p class="text-center text-uppercase"><?php echo $row["description"] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
