<?php
readfile('headerLogout.php');
include_once 'assets/sql/connect.php';
include_once 'assets/sessions.php';

//$user = 1;

if (!isset($_SESSION['username']) && isset($_SESSION['is_Admin']) == 0) {
    header("location: login.php");
}

$sid = $_SESSION['id'];
$rname = $_POST['rname'];
$category = $_POST['category'];
$location = $_POST['location'];
$story = $_POST['story'];
// $id = $_POST[$sid];
$target_file = "";


if(isset($_POST['cancelBTN'])){
    header("location: loggedIn.php");
}

// upload image begin

if (isset($_POST['submitBTN'])) {
    $target_dir = "assets/uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if (isset($_POST["submitBTN"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    /* if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    } */

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else { 

        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        /* if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.";
            echo $target_file;
        } else {
            echo "Sorry, there was an error uploading your file.";
        } */
    }
}

// upload image end

if(isset($_POST['submitBTN'])) {
    try{
        /* $insertform = "INSERT INTO stories_tb (rname, category, location, description, images, id)
                        VALUES(:rname, :category, :location, :story, :target_file, :sid)"; */
        
        $insertform = "INSERT INTO allstories (rname, category, location, description, images, id)
        VALUES(:rname, :category, :location, :story, :target_file, :sid)";

        $statement = $conn->prepare($insertform);
        $statement->execute(array(':rname' => $rname, ':category' => $category, ':location' => $location, ':story' => $story, ':target_file' => $target_file, ':sid' => $sid));
        header("location: loggedIn.php");
        if($statement->rowCount() == 1){
            $result = "<p style='padding: 20px; color: green;'> Story Successfully Saved</p>";
    }
}
    catch(PDOException $ex){
        $result = "<p style='padding: 20px; color: red;'> An error occurred: " .$ex->getMessage(). "</p>";
    } 

}

?>

<!DOCTYPE html>
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
            <?php echo $id ?>
            <section class="vh-100 gradient-custom">
                <div class="container-lg py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-info text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <div class="mb-md-5 mt-md-4 pb-5">

                            <h2 class="fw-bold mb-2 text-uppercase">Tell A Story Of A Restuarant</h2>

                            <div class="form-outline form-white mb-4">
                                <label class="form-label" for="rname">Name of Restuarant</label>
                                <input type="text" id="typeEmailX" class="form-control form-control-lg" name="rname" placeholder="e.g. Cosmos, The Albyn, The Globe Inn"/>
                            </div>

                            <div class="form-outline form-white mb-4">
                                <label class="form-label" for="typePasswordX">Category</label>
                                <input type="text" id="typePasswordX" class="form-control form-control-lg" name="category" placeholder="e.g. family style, fast casual, cafeteria"/>
                            </div>

                            <div class="form-outline form-white mb-4">
                                <label class="form-label" for="typePasswordX">Location</label>
                                <input type="text" id="typePasswordX" class="form-control form-control-lg" name="location" placeholder=" e.g. Aberdeen, Glasgow, Dundee "/>
                            </div>

                            <div>
                                <label for="story">My Story</label><br>
                                <textarea class="form-control" rows="15" id="comment" name="story"></textarea><br>
                            </div>
                            <div>
                            <label for="story">Images</label><br>
                                <input type="file" id="image" name="image"><br><br>
                            </div>

                            <button class="btn btn-outline-light btn-lg px-5" type="submit" name="cancelBTN">Cancel</button>
                            <button class="btn btn-outline-light btn-lg px-5" type="submit" name="submitBTN">Submit</button>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </section>
        </body>
    </form>
</html>