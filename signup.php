<?php
//readfile('header.php');
include_once 'assets/sql/connect.php';
include_once 'assets/util.php';

if(isset($_POST['homeBtn'])){
  header("location: index.php");
}

if(isset($_POST['submitBTN'])) {

  // initailizing an empty array
  $signupErr = array();

  // setting the required fields in an array
  $requiredFields = array('email', 'username', 'password');

  $signupErr = array_merge($signupErr, empty_field_val($requiredFields));

  // fields with minimum lenght
  $minFieldLenght = array('username' => 5, 'password' => 8);

  $signupErr = array_merge($signupErr, field_min_ln($minFieldLenght));

  $signupErr = array_merge($signupErr, email_val($_POST));

  if(empty($signupErr)) {

    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $is_Admin = 0;
  
    try{
      $sql = "INSERT INTO users (email, username, password, is_Admin) VALUES (:email, :username, :password, :is_Admin) ";
  
      $statement = $conn->prepare($sql);
      $statement->execute(array(':email' => $email, ':username' => $username, ':password' => $hashed_password, ':is_Admin' => $is_Admin));
  
      if($statement->rowCount() == 1){
        $result = "<p style='padding: 20px; color: green;'> Registration Successful</p>";
        header("location: signin.php");
      }
  
    }
    catch (PDOException $ex){
      $result = "<p style='padding: 20px; color: red;'> An error occurred: " .$ex->getMessage(). "</p>";
    }
  }
  else{
    if(count($signupErr) == 1) {
      $result = "<p style='color: red;'> There was 1 error in the form <br>";
    }
    else{
      $result = "<p style='color: red;'> There were " .count($signupErr). " errors in the form <br>";
    }
  }

}



?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Sign Up</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body class="login-body">
    <style>
    .login-body{
    background: url(assets/images/bkpIc.jpg);
    background-repeat: no-repeat;
    background-size: cover ;
    }

    .login-form{
    width: 350px;
    top: 50%;
    left: 50%;
    transform: translate(-50% ,-50%);
    position: absolute;
    color:#fff;
    }
    </style>

        <?php if(isset($result)) echo $result; ?>
        <?php if(!empty($signupErr)) echo display_errors($signupErr); ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <section class="vh-100 gradient-custom">
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div >
                        <div class="card-body p-5 text-center">

                            <div class="mb-md-5 mt-md-4 pb-5 login-form">

                            <h1 class="fw-bold mb-2 text-uppercase">Sign Up</h1>
                            <p class="text-white-50 mb-5">Please enter the fields below</p>

                            <div class="form-outline form-white mb-4">
                                <input type="text" id="typeEmailX" class="form-control form-control-lg" name="username" placeholder="Please Enter Username"/>
                                <label class="form-label" for="typeEmailX"></label>
                            </div>

                            <div class="form-outline form-white mb-4">
                                <input type="email" id="typeEmailX" class="form-control form-control-lg" name="email" placeholder="Please Enter email"/>
                                <label class="form-label" for="typeEmailX"></label>
                            </div>

                            <div class="form-outline form-white mb-4">
                                <input type="password" id="typePasswordX" class="form-control form-control-lg" name="password" placeholder="Please Enter Password"/>
                                <label class="form-label" for="typePasswordX"></label>
                            </div>
                            <button class="btn btn-outline-light btn-lg px-5" type="submit" name="homeBtn">Home</button>
                            <button class="btn btn-outline-light btn-lg px-5" type="submit" name="submitBTN">Sign Up</button><br><br>
                            <p class="mb-0">Already have an account? <a href="signin.php" class="text-white-50 fw-bold">Sign In</a>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </section>
        </form>
    </body>
</html>