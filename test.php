<?php
session_start();
$table_name = $_SESSION['tablecode'];

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$final = 10;

echo $_POST["add"];

include "connection.php";

if (isset($_POST['add'])) {
  echo $_POST['add'];
  echo 123456;
}
if (isset($_POST['unset'])) {
  unset($_POST['add']);
}
$sql = "SELECT `name`,`code`,`expenses` FROM `" . $table_name . "`";
if ($result = $conn->query($sql)) {
  echo $table_name;
  echo "fuck you";
  while ($row = $result->fetch_array()) {
    echo "fuck you";
    echo $row['code'];

    $conn->query("INSERT INTO `".$row['code']."` (`groupname`,`groupcode`,`money`) VALUES ('','".$table_name."','".$final."')")or die($conn->error);
    
  };
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
  <form method="post">
    <button name="add">add</button>
    <button name="unset">unset</button>
  </form>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>