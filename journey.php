<?php

include "connection.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo 4;

echo "<br>";

$sql = "SELECT `name` FROM `journey`";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
  if($row['name'] == 'dushyant')
  echo $row['name'];
}

echo "<br>";

$expenses = 0;
$final = 0;


if (isset($_POST["add"])) {                                    //here is what happens after 
  $name = trim($_POST["payer"]);                                // add payment button is clicked
  $payment = $_POST["payment"];

  $sql = "SELECT `name`,`expenses` FROM `journey`";
  if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_array()) {
      if ($row['name'] == $name) {
        $expenses = $row['expenses'];
        echo $row['name'];
        $final = $expenses+$payment;

        $sql = "UPDATE `journey` SET `expenses` = '{$final}' WHERE `name` = '{$name}'";
        if($conn->query($sql)){
          echo "<br> update success";
        }
      }
    }
  } else {
    echo $conn->error;
  }
}

if(isset($_POST["endjourney"])){
  $total = 0;$mean = 0;$count = 0;$final = 0;
  $sql = "SELECT `name`,`expenses` FROM `journey`";
  if($result = $conn->query($sql)){
    while($row = $result->fetch_array()){
      $total = $total + $row['expenses'];                   //calculating mean
      $count = $count +1;
    }
    $mean = $total/$count;
  }
  $sql = "SELECT `name`,`expenses` FROM `journey`";
  if($result = $conn->query($sql)){
    while($row = $result->fetch_array()){
      $final = $row['expenses']-$mean;               //updating values
      $final = round($final,2);
      echo $final;
      $sql = "UPDATE `journey` SET `expenses` = '{$final}' WHERE `name` = '{$row["name"]}'";
      $conn->query($sql);
      $conn->error;
    }  
  }
  unset($_POST['endjourney']);
  header("Location:result.php");
}



?>

<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

  <div>
    <form action="" method="post">
      <input type="text" placeholder="name" name="payer">
      <input type="text" placeholder="for" name="for">
      <input type="number" placeholder="0/-" name="payment">
      <input type="submit" value="add payment" name="add">
    </form>
  </div>
  <div>
    <form method="post">
      <button name="endjourney">End journey</button>
    </form>
  </div>
  
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</htm