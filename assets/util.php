<?php

/* Reference

Terry, M. (2016). Signing In. [online] www.youtube.com. Available at:
 https://www.youtube.com/watch?v=PKXkcu8Z5eI&list=PL9mwDhhLGZilsMTm1POos9aXjvorie3Me&index=8 [Accessed 13 Mar. 2023]. */


function empty_field_val($requiredFields_array) {

  // initailizing an empty array
  $signupErr = array();

  //looping through the required field array
  foreach($requiredFields_array as $nameOfField){
    if(!isset($_POST[$nameOfField]) || $_POST[$nameOfField] == NULL) {
      $signupErr[] = $nameOfField . " is a required field"; 
?>
       <div class="alert alert-warning alert-dismissible fade show" role="alert">
         <strong>All fields are required</strong>
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>
<?php
    };
  }
  return $signupErr;
}

function field_min_ln($minFieldLenght) {

  // initailizing an empty array
  $signupErr = array();

  foreach($minFieldLenght as $nameOfField => $min_lenght_required){
    if(strlen(trim($_POST[$nameOfField])) < $min_lenght_required){
        $signupErr[] = $nameOfField . " must be {$min_lenght_required} character long";
    }
  }
  return $signupErr;
}

function email_val($data) {
  // initailizing an empty array
  $signupErr = array();

  $key = 'email';

  if(array_key_exists($key, $data)){
    if($_POST[$key] != null) {

        $key = filter_var($key, FILTER_SANITIZE_EMAIL);

        if(filter_var($_POST[$key], FILTER_VALIDATE_EMAIL) === false){
            $signupErr[] = $key . " is not a valid email address";
        }
    }
  }
  return $signupErr;
}

function display_errors($signupErr_array){
    $errors = "<p><ul> style='color: red;'>";

    foreach($signupErr_array as $an_error){
        $errors .= "<li>{$an_error}</li>";
    }
    $errors .= "</ul></p>";

    return $errors;
}

?>