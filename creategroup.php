<?php

session_start();

echo 3;

include "connection.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



$cre = "CREATE TABLE `journey` ( `id` INT NOT NULL AUTO_INCREMENT , `name` TEXT NOT NULL , `code` TEXT NOT NULL , `expenses` INT NOT NULL DEFAULT '0' , PRIMARY KEY (`id`))";

if ($conn->query($cre) === TRUE) {
  echo "table created";
} else {
  echo $conn->error;
}

if (isset($_POST["add"])) {
  $name = $_POST["name"];
  $code = $_POST["code"];
  trim($name);
  trim($code);

  $sql = "INSERT INTO `journey`(`name`,`code`) VALUES('{$name}','{$code}')";
  if ($conn->query($sql)) {
    echo "success";
  }
  echo $conn->error;
}

if (isset($_POST["creategroup"])) {
  $_POST = array();
  header("Location:journey.php");
}


?>
<!doctype html>
<html lang="en">

<head>
  <title>group</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
  <h1><?php echo $table_name; ?></h1>

  <div>
    ADD MEMEBERS!
    <form method="post">
      <input type="text" name="name">
      <input type="text" name="code">
      <button type="submit" name="add">add</button>

    </form>
  </div>
  <div>
    <form action="" method="post">
      <button name="creategroup">creategroup</button>
    </form>
  </div>
  <div>
    <form method="post">
      <button name="delete">delete table</button>
      <button name="create">create table</button>
    </form>
  </div>



  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>