<?php
    readfile('headerLogout.php');
    include_once 'assets/sql/connect.php';
    include_once 'assets/sessions.php';

    $session_id = $_SESSION['id'];
    $sid = $_GET['sid'];
    

    echo $session_id;
    
    //fetching data from users database
    $sesseion_stmt = $conn->query("SELECT * FROM users WHERE id = $session_id");
    $row_users = $sesseion_stmt->fetch(PDO::FETCH_ASSOC);
    $is_Admin = $row_users['is_Admin'];

    if(isset($_POST['cancelBTN'])) {
    switch ($is_Admin) {
        case "1":
            header("location: admin.php");
            break;

        case "0":
            header("location: loggedIn.php");
        }
    }


    /* $stmt = $conn->query("SELECT * FROM allstories where sid = $sid");
    $user_row = $stmt->fetch(PDO::FETCH_ASSOC);
    $sesseion_stmt = $conn->query("SELECT * FROM allstories WHERE id = $session_id");
    $session_row = $sesseion_stmt->fetch(PDO::FETCH_ASSOC); */

    //fetching data from allstories database
    $stmt = $conn->query("SELECT * FROM allstories where sid = $sid");
    $row_allstories = $stmt->fetch(PDO::FETCH_ASSOC);
    $rname = $row_allstories['rname'];
    $category = $row_allstories['category'];
    $location = $row_allstories['location'];
    $description = $row_allstories['description'];
    $image = $row_allstories['"images"'];


    if(isset($_POST['updateBTN'])) {
        $target_dir = "assets/uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

       if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.";
            echo $target_file;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }


        $sid = $_POST['sid'];
        $rname = $_POST['rname'];
        $category = $_POST['category'];
        $location = $_POST['location'];
        $description = $_POST['description'];
        $image = $_POST['image'];
        
        try{
            $insertform = "UPDATE allstories SET rname='$rname', category='$category', location='$location', description='$description', images='$target_file' WHERE sid=$sid";
    
            $statement = $conn->prepare($insertform);
            $statement->execute();
            
            
            //header("location: loggedIn.php");
            if($statement->rowCount() == 1){
                $result = "<p style='padding: 20px; color: green;'> Story Successfully Saved</p>";
        }
        header("location: loggedIn.php");
    }
        catch(PDOException $ex){
            $result = "<p style='padding: 20px; color: red;'> An error occurred: " .$ex->getMessage(). "</p>";
        } 
    
    }

    
    
    ?>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>story</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>

    <?php if(isset($result)) echo $result; ?>
    <?php if(!empty($signupErr)) echo display_errors($signupErr); ?> 
    
    <form method="post" action="" enctype="multipart/form-data">
            <section class="vh-100 gradient-custom">
                <div class="container-lg py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-info text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <div class="mb-md-5 mt-md-4 pb-5">
                            <h2 class="fw-bold mb-2 text-uppercase">Edit your Story</h2>

                            <input type="hidden" name="sid" value='<?php echo $row_allstories['sid']; ?>'/>
                            <div class="form-outline form-white mb-4">
                                <label class="form-label" for="rname">Name of Restuarant</label>
                                <input type="text" id="typeEmailX" class="form-control form-control-lg" name="rname" value='<?php echo $row_allstories['rname']; ?>'/>
                            </div>

                            <div class="form-outline form-white mb-4">
                                <label class="form-label" for="typePasswordX">Category</label>
                                <input type="text" id="typePasswordX" class="form-control form-control-lg" name="category" value='<?php echo $row_allstories['category']; ?>'/>
                            </div>

                            <div class="form-outline form-white mb-4">
                                <label class="form-label" for="typePasswordX">Location</label>
                                <input type="text" id="typePasswordX" class="form-control form-control-lg" name="location" value='<?php echo $row_allstories['location']; ?>'/>
                            </div>

                            <div>
                                <label for="story">My Story</label><br>
                                <textarea class="form-control" rows="15" id="comment" name="description"><?php echo $row_allstories['description']; ?></textarea><br>
                            </div>
                            <div>
                            <div>
                            <label for="story">Images</label><br>
                                <!-- <input type="file" id="image" name="image" value='<?php echo $row_allstories['"images"']; ?>'/><br><br> -->
                                <input type="file" id="image" name="image" value="'.$image.'"/><br><br>
                            </div> 

                            <button class="btn btn-outline-light btn-lg px-5" type="submit" name="cancelBTN">Cancel</button>
                            <button class="btn btn-outline-light btn-lg px-5" type="submit" name="updateBTN">UPDATE</button>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </section>
        </form>
    </body>
</html>