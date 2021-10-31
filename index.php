<?php

session_start();
if(isset($_COOKIE['email'])){
  $_SESSION['email'] = $_COOKIE['email'];
  header("Location:home.php");
}


include "connection.php";

if (isset($_POST['signupbutton'])) {
  unset($_POST['signupbutton']);
  
  if ($_POST['email'] == '' or $_POST['password'] == '' or $_POST['name'] == '' or $_POST['re-password' == '']) {
    echo "</br>please fill the required fields";
  } elseif ($_POST['password'] != $_POST['re-password']) {
    echo "<br>passwords do not match";
  } else {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5(mysqli_real_escape_string($conn, $_POST['password']));

    /* this is the line to generate random 5 digit alpha numeric code*/    
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $code = substr(str_shuffle($str_result), 0, 5);
    $checkcode = $conn->query("SELECT `code` FROM `login` WHERE `code` = '{$code}'") or exit($conn->error);
    if(mysqli_num_rows($checkcode)){
      $code = substr(str_shuffle($str_result), 0, 5);
    }
    //end here

    $test = $conn->query("SELECT * FROM `login` WHERE `email` = '{$email}'");
    if (mysqli_num_rows($test) > 0) {
      echo "email already exist";
    } else {

      $insertquery = "INSERT INTO `login` (`name`,`email`,`password`,`code`) VALUES ('{$name}','{$email}','{$pass}','{$code}')";
      $conn->query($insertquery);

      $createuser = "CREATE TABLE `".$code."`( `groupname` TEXT NOT NULL , `groupcode` TEXT NOT NULL , `money` INT NOT NULL )";
      $conn->query($createuser);
      echo $conn->error;

      if(!empty($_POST['checkbox'])){
        setcookie("email",$email,time()+5*60*60);
        setcookie("pass",$pass,time()+5*60*60); 
        $_SESSION['email'] = $email;
      }else{
        setcookie("email",$email,time()+60*60);
        setcookie("pass",$pass,time()+60*60);
        $_SESSION['email'] = $email;
      }
      header("location:home.php");
    }
  }
} // for signing up
//................................................................
if (isset($_POST['loginbutton'])) {
  unset($_POST['loginbutton']);

  if ($_POST['emailcheck'] == '' or $_POST['passwordcheck'] == '') {
    echo "</br>please fill  fields";
  } else {

    $email = mysqli_real_escape_string($conn, $_POST['emailcheck']);
    $pass = md5(mysqli_real_escape_string($conn, $_POST['passwordcheck']));
    $checkquery = "SELECT * FROM `login` WHERE `email` = '{$email}' AND `password` = '{$pass}'";
    $result = $conn->query($checkquery);
    echo $conn->error;

    if (mysqli_num_rows($result) > 0) {
      if (!empty($_POST['checkbox'])) {
        setcookie("email", $email, time() + 5 * 60 * 60);
        setcookie("pass", $pass, time() + 5 * 60 * 60);
        $_SESSION['email'] = $email;
      } else {
        setcookie("email", $email, time() + 60*60);
        setcookie("pass", $pass, time() + 60*60);
        $_SESSION['email'] = $email;
      }
      
      header("location:home.php");
    } else {
      echo "email or password is wrong";
    }
  }
} // for login


?>



<!DOCTYPE html>
<html>

<head>
  <title>Login Form</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/index.css">
  <link rel="icon" href="images/logo.jpg" type="image/x-icon">
</head>

<body>
  <div class="container" id="gtyh">
    <div class="row px-3">
      <div class="col-lg-10 col-xl-9 card flex-row mx-auto px-0">
        <div class="img-left d-none d-md-flex"></div>

        <div class="card-body" id='login-card'>
          <h4 class="title text-center mt-4">
            Login into account
          </h4>
          <form class="form-box px-3" method="post">
            <div class="form-input">
              <span><i class="fa fa-envelope-o"></i></span>
              <input type="email" name="emailcheck" placeholder="Email Address" tabindex="10" required>
            </div>
            <div class="form-input">
              <span><i class="fa fa-key"></i></span>
              <input type="password" name="passwordcheck" placeholder="Password" required>
            </div>

            <div class="mb-3">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="cb1" name="checkbox">
                <label class="custom-control-label" for="cb1">Remember me</label>
              </div>
            </div>

            <div class="mb-3">
              <button type="submit" class="btn btn-block text-uppercase" name="loginbutton">
                Login
              </button>
            </div>


            <hr class="my-4">

            <div class="text-center mb-2">
              Don't have an account?
              <p id='register-link'>Register here</p>
            </div>
          </form>
        </div>
        




        

        <div class="card-body" id='signup-card'>
          <h4 class="title text-center mt-4">
            Sign Up!
          </h4>
          <form class="form-box px-3" method="post">
            
            <div class="form-input">
              <span><i class="fa fa-envelope-o"></i></span>
              <input type="text" name="name" placeholder="Full Name" tabindex="10" required>
            </div>
            
            <div class="form-input">
              <span><i class="fa fa-envelope-o"></i></span>
              <input type="email" name="email" placeholder="Email Address" tabindex="10" required>
            </div>
            <div class="form-input">
              <span><i class="fa fa-key"></i></span>
              <input type="password" name="password" placeholder="Password" required>
            </div>
            
            <div class="form-input">
              <span><i class="fa fa-key"></i></span>
              <input type="password" name="re-password" placeholder="Renter Password" required>
            </div>

            
            <div class="mb-3">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="cb2" name="checkbox">
                <label class="custom-control-label" for="cb1">Remember me</label>
              </div>
            </div>
            
            <div class="mb-3">
              <button type="submit" class="btn btn-block text-uppercase" name="signupbutton">
                signup
              </button>
            </div>

            
            <hr class="my-4">
            
            <div class="text-center mb-2">
              Already have an account?
              <p id='login-link'>Login</p>
            </div>
          </form>
        </div>

        
        
        

        

        

        
      </div>
    </div>
  </div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="./js/index.js"></script>

</html>