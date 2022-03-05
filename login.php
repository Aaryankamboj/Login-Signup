<?php
// Handle login
session_start();
// if the user is already logged in

if (isset($_SESSION['username'])) {
  header("location: welcome.php");
  exit;
}
require_once "config.php";

$username = $password = "";
$err = "";

// if request method is POST
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  if (empty(trim($_POST['username'])) || empty(trim($_POST['password']))) {
    $err = "Please enter username and password";
  } else {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
  }

  if (empty($err)) {
    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $param_username);
    $param_username = $username;
    // Try to execute the statement
    if (mysqli_stmt_execute($stmt)) {
      mysqli_stmt_store_result($stmt);
      if (mysqli_stmt_num_rows($stmt) == 1) {
        mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
        if (mysqli_stmt_fetch($stmt)) {
          if (password_verify($password, $hashed_password)) {
            // It means the password is correct allow user to login
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $id;
            $_SESSION['loggedin'] = true;

            // Redirect user to welcome page
            header("location: welcome.php");
          }
        }
      }
    }
  }
}



?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="login-style.css">

  <title>E-Mobile Bazaar</title>
</head>

<body style="background-image: linear-gradient(to right,red,black);">

  <nav class="navbar navbar-expand-lg navbar-dark navi">
    <div class="container-fluid">

      <a class="navbar-brand" id="main-title">Welcome to E-Mobile Bazaar</a>
      <div class="btn-class">
        <a class="navbar-brand nav-btn flex-col" href="register.php"><span class="btn">Sign Up</span></a>
        <!-- <a class="navbar-brand nav-btn" href="logout.php"> <span class="btn">Logout </span></a> -->
      </div>



    </div>
  </nav>
  <div class="container mt-5">
    <h3 class="text-center">Login</h3>
    <hr>

    <form action="" method="POST">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label labels">Username </label>
        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter your username" name="username">

      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label labels">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Enter your password">
      </div>

      <button type="submit" class="btn btn-primary btn-sign" id="btn-login">Log in</button>
      <div class="special-log-in">
        <a href="register.php">New user, Please sign in</a>
      </div>
    </form>



  </div>
  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>