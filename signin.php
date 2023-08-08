<?php
/* Reference:
Code reuse from general coursework cmm004, Group G. */

// initialize a session or read a session
include_once 'assets/util.php';
include_once 'assets/sql/connect.php';
include_once 'assets/sessions.php';

//check session data if user is logged on

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: logout.php");
    exit;
}

if(isset($_POST['homeBtn'])){
  header("location: index.php");
}


//set the variables as empty initially.
$username = $password = $is_Admin =  "";
$usernameerror = $passworderror = $loginerror = $is_Adminerror = "";
$loggedInUser = $_POST['username'];
      $password = $_POST['password'];
//check if the method is post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //sanitize email 
    if (empty(trim($_POST["username"]))) {
        $usernameerror = "Please enter a username.";
    } else {
        $email = trim($_POST["username"]);
    }
    //verify password field
    if (empty(trim($_POST["password"]))) {
        $passworderror = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }
    // if(empty(trim($_POST["role"]))){
    //     $is_Adminerror = "Please select a role buddy";
    // }

    if (empty($usernameerror) && empty($passworderror)) {
        //check the database for the user credentials 
        $sql = "SELECT * FROM users WHERE username = :username";
        if ($stmt = $conn->prepare($sql)) {
            //I will attach the value :email to a parameter
            //$stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $stmt->execute(array(':username' => $loggedInUser));
            //$row = $stmt->fetch();
            //I will set the parameter below
            //$param_email = trim($_POST["email"]);

            //since i have all the parameters, i'll execute the statement.
            if ($stmt->execute()) {
                //used the two echos below for debugging.
                //echo "prepare sql";
                if ($stmt->rowCount() == 1) {
                    //if a user exists retrieve the details and verify them.
                    //s  echo "found user";
                    if ($row = $stmt->fetch()) {
                        //retrieve the details from the row in the DB
                        $id = $row["id"];
                        $username = $row["username"];
                        $is_Admin = $row["is_Admin"];
                        $hashed_password = $row["password"];

                        if (password_verify($password, $hashed_password)) {
                            //the above code compares the password entered with the hashed one in DB
                            //if it's the same, store the following in a session.

                            // session_start(); session already started

                            $_SESSION['id'] = $id;
                            $_SESSION['username'] = $username;
                            $_SESSION['is_Admin'] = $is_Admin;
                            switch ($is_Admin) {
                              case "1":
                                  header("location: admin.php");
                                  break;

                              case "0":
                                  header("location: loggedIn.php");
                              }
                        }
                        //if the credentials are wrong display an error
                        else {
                            $loginerror = "Invalid email or password.";
                        }
                    }
                }
                //if you cant find a user, echo the error below.
                else {
                    $loginerror = "this username does not exist.";
                }
            } else {
                echo "Login Failed. Contact Admin";
            }
            //now i'll close the statament
            unset($stmt);
        }
    }
    //close the connection. Phew!
    unset($pdo);
}

?>

<!--Bootstrap was used mostly to style this application-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    
    
    
    
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
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <?php if (!empty($loginerror)) {
                echo '<div class="alert alert-danger">' . $loginerror . '</div>';
            } ?>
            <section class="vh-100 gradient-custom">
              
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div >
                        <div class="card-body p-5 text-center">

                            <div class="login-form">

                            <h1 class="fw-bold mb-2 text-uppercase">Login</h1>
                            <p class="text-white-50 mb-5">Please enter your login and password!</p>

                            <div class="form-outline form-white mb-4">
                                <input type="username" id="typeEmailX" class="form-control form-control-lg <?php echo (!empty($usernameerror)) ? 'is-invalid' : ''; ?>" name="username" placeholder="Enter Username"/>
                                <span class="invalid-feedback"><?php echo $usernameerror; ?> </span>
                            </div>

                            <div class="form-outline form-white mb-4">
                                <input type="password" id="typePasswordX" class="form-control form-control-lg <?php echo (!empty($passworderror)) ? 'is-invalid' : ''; ?>" name="password" placeholder="Enter Password"/>
                                <span class="invalid-feedback"><?php echo $passworderror; ?> </span>
                            </div>

                            <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!"></a></p>
                            <button class="btn btn-outline-light btn-lg px-5" type="submit" name="loginBtn">Login</button>
                            <button class="btn btn-outline-light btn-lg px-5" type="submit" name="homeBtn">Home</button> <br><br>

                              <p class="mb-0">Don't have an account? <a href="signup.php" class="text-white-50 fw-bold">Sign Up</a>
                            </div>
                            
                            <!-- <div>
                            <p class="mb-0">Don't have an account? <a href="signup.php" class="text-white-50 fw-bold">Sign Up</a>
                            </p>
                            </div> -->

                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </section>
        </form>



    <!--I will like to clearly state that the links below are javascript codes from bootstrap official site and are included as advised on getbootstrap.com. I claim no ownership-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

</body>

<?php

?>

</html>