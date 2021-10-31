<?php
session_start();
if (!isset($_COOKIE['email'])) {
  header("Location:index.php");
}
include "connection.php";


// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

$select = $conn->query("SELECT * FROM `login` WHERE `email` = '{$_SESSION['email']}'") or die($conn->error);
$row = $select->fetch_array();


$name = $row['name'];
$code = $row['code'];

$_SESSION['groupname'] = $_POST['groupname'];


if (isset($_POST['creategroup'])) {
  unset($_POST['creategroup']);
  $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
  $table_name = substr(str_shuffle($str_result), 0, 6);
  $_SESSION['tablecode'] = $table_name;
  $cre = "CREATE TABLE `" . $table_name . "` ( `id` INT NOT NULL AUTO_INCREMENT , `name` TEXT NOT NULL , `code` TEXT NOT NULL , `expenses` INT NOT NULL DEFAULT '0' , PRIMARY KEY (`id`))";

  if ($conn->query($cre) === TRUE) {
    echo "table created";
  } else {
    echo $conn->error;
  }
  header("Location:creategroup.php");
}
// if(isset)

if (isset($_POST['logout'])) {
  unset($_POST['logout']);
  setcookie("email", $email, time() - 5 * 60 * 60);
  setcookie("pass", $pass, time() - 5 * 60 * 60);
  unset($_SESSION['email']);
  header("Location:index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewreport" content="width=device-width, initial-scale=1.0">
  <title>index</title>
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/project1_index.css">
  <link rel="icon" href="images/logo.jpg" type="image/x-icon"
</head>

<body>
  <div class="container-fluid banner">
    <div class="row">
      <div class="col-md-12">
        <nav class="navbar navbar-md">
          <div class="navbar-brand">DealOut</div>
          <div class="name-code-class">
            <div class='name-code'>
              Name: <?php echo $name; ?>
            </div>
            <div class='name-code'>
              Code: <?php echo $code; ?>
            </div>
          </div>
          <ul class="nav">
            <div>
              <form method="post">
                <input class="form-control mr-sm-2" id='groupname'name="groupname" placeholder="Group Name" required>
                <button class='navButtons btn btn-light' name="creategroup">Create Group</button>
                
              </form>
              <form method="post"><button class='navButtons btn btn-light' name="logout">Logout</button></form>
            </div>
          </ul>
        </nav>
      </div>
    </div>
    <div class="main-content">
      <div id='tagline'>
        <h1>Ease Your Accounting using DEALOUT!</h1>
        <p>
          "Without Community, there is no liberation."
        </p>
      </div>
      <div class="group-table">
        <table class='table table-striped'>
          <thead>
            <tr>
              <th scope="col">Previous Group Name</th>
              <th scope="col">Previous Exchanges</th>
            </tr>
          </thead>
          <tbody>
            <!-- PHP CODE TO FETCH DATA FROM ROWS-->
            <?php   // LOOP TILL END OF DATA 
            $result = $conn->query("SELECT * FROM `" . $code . "`") or die($conn->error);
            while ($rows = $result->fetch_assoc()) {
            ?>
              <tr>
                <!--FETCHING DATA FROM EACH 
            ROW OF EVERY COLUMN-->
                <td><?php echo $rows['groupname']; ?></td>
                <td><?php echo $rows['money']; ?></td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>





  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on the button, open the modal
    btn.onclick = function() {
      modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  </script>
</body>

</html>