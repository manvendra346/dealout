<?php

session_start();
if(isset($_COOKIE['email'])){
  $_SESSION['email'] = $_COOKIE['email'];
  $_SESSION['pass'] = $_COOKIE['pass'];
  header("Location:home.php");
}

echo 1;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include "connection.php";

if (isset($_POST['signupbutton'])) {
  
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
      $insertquery = "INSERT INTO `login` (`name`,`email`,`password`,`code`,`data`) VALUES ('{$name}','{$email}','{$pass}','{$code}','')";
      $conn->query($insertquery);
      echo $conn->error;
      if(!empty($_POST['checkbox'])){
        setcookie("email",$email,time()+5*60*60);
        setcookie("pass",$pass,time()+5*60*60); 
      }else{
        setcookie("email",$email,time()+3*60);
        setcookie("pass",$pass,time()+3*60);
      }
      header("location:home.php");
    }
  }
} // for signing up

if (isset($_POST['loginbutton'])) {

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
        $_SESSION['user'] = $email;
      } else {
        setcookie("email", $email, time() + 3 * 60);
        setcookie("pass", $pass, time() + 3 * 60);
      }
      header("location:home.php");
    } else {
      echo "email or password is wrong";
    }
  }
} // for login


?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style type="text/css">

      .b{
        margin-top: 10px;
      }

      #logina{
        color: blue;
        transition: color,0.5s;
        
      }
      #logina:hover{
        color :cadetblue;
        cursor: pointer;
      }

      .container{
        padding-top: 250px;
        width: 270px;

      }
      .defaultinput{
        margin-bottom: 10px;
      }
    </style>

    <script type="text/javascript" src="jquery.min.js"></script>

    <title>Login</title>
  </head>
  <body>
    <div class="container">
        <form method="post">
            <input type="text" class="form-control defaultinput" name="name" placeholder="Full Name" >
            <input type="email" class="form-control defaultinput" name="email" placeholder="Email" >
            <input type="password" class="form-control defaultinput" name="password" placeholder="Password" >
            <input type="password" class="form-control defaultinput" name="re-password" placeholder="Renter Password" >
            <input type="checkbox" name="checkbox" id="kmlisignup"><label for="kmlisignup">Keep me logged in</label></input></br>
            <button type="submit" class="btn btn-primary b" name="signupbutton">sign up!</button></br>
            <a id="logina" class="logina">Login</a>
        </form>
    </div>
    <div class="container">
        <form method="post">
            <input type="email" class="form-control defaultinput" name="emailcheck" placeholder="Email" >
            <input type="password" class="form-control defaultinput" name="passwordcheck" placeholder="Password" >
            <input type="checkbox" name="checkbox" id="kmlilogin"><label for="kmlilogin">Keep me logged in</label></input></br>
            <button type="submit" class="btn btn-primary b" name="loginbutton" >login</button></br>
            <a id="logina" class="logina">Signup</a>
        </form>
    </div>



    <script type="text/javascript">
      $(".logina").click(function(){
        $("#login").toggle();
        $("#signup").toggle();
      })
    
    </script>
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>