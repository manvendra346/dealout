<?php
session_start();
include "connection.php";

echo 2;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$select = $conn->query("SELECT * FROM `login` WHERE `email` = '{$_SESSION['email']}'") or die($conn->error);
$row = $select->fetch_array();


$name = $row['name'];
$code = $row['code'];


if (isset($_POST['creategroup'])) {
  header("Location:creategroup.php");
}

?>
<!doctype html>
<html lang="en">

<head>


  <title>create group</title>
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


  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#">Name: <?php echo $name; ?><span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Code: <?php echo $code; ?></a>
        </li>

      </ul>
    </div>
  </nav>

  <table>
    <tr>
      <th>Name</th>
      <th>Code</th>
    </tr>
    <!-- PHP CODE TO FETCH DATA FROM ROWS-->
    <?php   // LOOP TILL END OF DATA 
    $result = $conn->query("SELECT * FROM `".$code."`") or die($conn->error);
    while ($rows = $result->fetch_assoc()) {
    ?>
      <tr>
        <!--FETCHING DATA FROM EACH 
                    ROW OF EVERY COLUMN-->
        <td><?php echo $rows['groupname']; ?></td>
        <td><?php echo $rows['groupcode']; ?></td>
        <td><?php echo $rows['money']; ?></td>
      </tr>
    <?php
    }
    ?>
  </table>


  <div>
    <form method="post">
      <button name="creategroup">create group</button>
    </form>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>