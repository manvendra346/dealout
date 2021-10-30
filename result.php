<?php
session_start();
include "connection.php";
if(!isset($_COOKIE['email'])){
  header("Location:index.php");
}

$table_name = $_SESSION['tablecode'];

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST["home"])) {
  unset($_POST['home']);
  $del = "DROP TABLE  `" . $table_name . "`";
  if ($conn->query($del)) {
    echo "table destroyed";
  } else {
    echo $conn->error;
  }
  header("Location:index.php");
}

?>



<!doctype html>
<html lang="en">

<head>
  <title>Result</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <style>
    table {

      margin: 0 auto;

      font-size: large;

      border: 1px solid black;

    }



    h1 {

      text-align: center;

      color: #006600;

      font-size: xx-large;

      font-family: 'Gill Sans', 'Gill Sans MT',

        ' Calibri', 'Trebuchet MS', 'sans-serif';

    }



    td {

      background-color: #E4F5D4;

      border: 1px solid black;

    }



    th,

    td {

      font-weight: bold;

      border: 1px solid black;

      padding: 10px;

      text-align: center;

    }



    td {

      font-weight: lighter;

    }
  </style>



  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
  <table>
    <tr>
      <th>Name</th>
      <th>Gains</th>
    </tr>
    <!-- PHP CODE TO FETCH DATA FROM ROWS-->
    <?php   // LOOP TILL END OF DATA 
    $result = $conn->query("SELECT `name`,`expenses` FROM `" . $table_name . "`") or die($conn->error);
    while ($rows = $result->fetch_assoc()) {
    ?>
      <tr>
        <!--FETCHING DATA FROM EACH 
                    ROW OF EVERY COLUMN-->
        <td><?php echo $rows['name']; ?></td>
        <td><?php echo $rows['expenses']; ?></td>
      </tr>
    <?php
    }
    ?>
  </table>

  <div>
    <form method="post">
      <button name="home">return to home page</button>

    </form>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>