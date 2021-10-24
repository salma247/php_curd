<?php

$host = "localHost";
$user = "root";
$password = "";
$dbname = "crud";

$conn = mysqli_connect($host, $user, $password, $dbname);

// $insert = "INSERT INTO `users` VALUES (NULL,'Salma',5000)";
// $i = mysqli_query($conn,$insert);
// if($i) echo "true";
if (isset($_POST['send'])) {
  $name = $_POST['userName'];
  $salary = $_POST['salary'];
  $insert = "INSERT INTO `users` VALUES (NULL,'$name',$salary)";
  $i = mysqli_query($conn, $insert);
}


// $select = "SELECT * FROM users";
// $s = mysqli_query($conn, $select);
// foreach ($s as $data) {
//   echo $data['id'] . " ";
//   echo $data['name'] . " ";
//   echo $data['salary'] . "<br>";
// }
$select = "SELECT * FROM users";
$s = mysqli_query($conn, $select);


// $update = "UPDATE users SET name = 'Mohammed', salary = 5000 WHERE id = 11";
// mysqli_query($conn, $update);
$name = "";
$salary = "";
$update = false;
if (isset($_GET['edit'])) {
  $update = true;
  $id = $_GET['edit'];
  $select = "SELECT * FROM users where id = $id";
  $ss = mysqli_query($conn, $select);
  $row = mysqli_fetch_assoc($ss);
  $name = $row['name'];
  $salary = $row['salary'];
  if (isset($_POST['update'])) {
    $name = $_POST['userName'];
    $salary = $_POST['salary'];
    $update = "UPDATE users SET name = '$name', salary = $salary where id = $id";
    $u = mysqli_query($conn, $update);
    if ($u) header("location:/crud/index.php");
  }
}

// $delete = "DELETE from users WHERE id > 10";
// mysqli_query($conn, $delete);

if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $delete = "DELETE from users WHERE id = $id";
  $d = mysqli_query($conn, $delete);
  if($d) header("location:/crud/index.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Andada+Pro:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <link rel="stylesheet" href="/crud/style.css">
  <title>CRUD</title>
</head>

<body>

  <div class="container col-md-6 mt-5">
    <div class="card">
      <div class="card-body">
        <form method="POST">
          <div class="form-group">
            <label>User Name</label>
            <input type="text" placeholder="User Name" name="userName" class="form-control" value="<?php echo $name ?>">
          </div>
          <div class="form-group">
            <label>User Salary</label>
            <input type="text" placeholder="User Salary" name="salary" class="form-control" value="<?php echo $salary ?>">
          </div>
          <?php if ($update) : ?>
            <button class="btn send mr-3" name="update"> Update Data </button>
          <?php else : ?>
            <button class="btn send" name="send"> Send Data </button>
          <?php endif ?>
        </form>
      </div>
    </div>
  </div>

  <div class="container col-md-7 mt-5">
    <div class="card">
      <div class="card-body pt-0">
        <table class="table">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Salary</th>
            <th colspan="2">Action</th>
          </tr>
          <?php
          foreach ($s as $data) {
          ?>
            <tr>
              <th> <?php echo $data['id'] ?></th>
              <th><?php echo $data['name'] ?></th>
              <th><?php echo $data['salary'] ?></th>
              <th><a href="/crud/index.php?edit=<?php echo $data['id'] ?>" class="btn btn-info edit mr-4 mb-1 ">Edit</a>
              <a href="/crud/index.php?delete=<?php echo $data['id'] ?>" class="btn del mb-1">Delete</a>
              </th>
              
            </tr>
          <?php } ?>
        </table>
      </div>

    </div>
  </div>


  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
</body>

</html>