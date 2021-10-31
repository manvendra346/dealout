<?php
session_start();
include "connection.php";
if (!isset($_COOKIE['email'])) {
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

<!DOCTYPE html>
<html class="no-js">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Lastpage</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="shortcut icon" href="favicon.ico">
  <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700,300' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="css/project1_lastpage.css">
  <link rel="stylesheet" href="css/project1_lastpage2.css">
  <link rel="icon" href="images/logo.jpg" type="image/x-icon">
</head>

<body>
  <div id="fh5co-wrapper">
    <div id="fh5co-page">
      <div id="fh5co-header">
        <header id="fh5co-header-section">
          <div class="container">
            <div class="nav-header">
              <a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle"><i></i></a>
              <h1 id="fh5co-logo"><a href="project1_index.html">Deal<span>Out</span></a></h1>
              <!-- START #fh5co-menu-wrap -->
              <nav id="fh5co-menu-wrap" role="navigation">
                <form method="post"><button id='home' class='btn btn-light' name="home">Home</button>
              </nav>
            </div>
          </div>
        </header>
      </div>
      <div class="fh5co-hero">
        <div class="fh5co-overlay"></div>
        <div class="fh5co-cover text-center" data-stellar-background-ratio="0.5" style="background-image: url(images/4389.jpg);">
        </div>
      </div>

      <div id="result">
        <h1><?php echo $_SESSION['groupname']; ?></h1>
        <h2>Results</h2>
        <table id='result-table' class='table table-striped'>
          <thead>
            <tr>
              <th scope='col'>Name</th>
              <th scope='col'>Gains</th>
            </tr>
          </thead>
          <tbody>
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
          </tbody>
        </table>
      </div>

      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>