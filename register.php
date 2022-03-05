<?php
require_once "config.php";
$username = $password = $confirm_password = $phone = $email="";
$username_err = $password_err = $confirm_password_err = $phone_err = $email_err = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // check if user name is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Username cannot be blank";
    } else {
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set the value of param username
            $param_username = trim($_POST['username']);

            // Try to execute the statement
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "This username is already taken";
                } else {
                    $username = trim($_POST['username']);
                }
            } else {
                echo "Something went wrong";
            }
        }
    }
    mysqli_stmt_close($stmt);

    // Check for password
    if (empty(trim($_POST['password']))) {
        $password_err = "Password cannot be blank";
    } elseif (strlen(trim($_POST['password'])) < 6) {
        $password_err = "Password cannot be less than 6 characters";
    } else {
        $password = trim($_POST['password']);
    }

    // check for confirm password
    if (trim($_POST['password']) != trim($_POST['confirm_password'])) {
        $password_err = "Password should match";
    }

    // If there were no errors insert into database
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
        $sql = "INSERT INTO users (username, password, phone, email) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssss", $param_username, $param_password, $param_phone, $param_email);

            // Set these parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $param_phone = $phone;
            $param_email=$email;

            // try to execute the query

            if (mysqli_stmt_execute($stmt)) {
                header("location: login.php");
            } else {
                echo "Something went wrong. Cannot redirect";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
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
    <link rel="stylesheet" href="login-style.css" type="text/css">
    <title>E-Mobile Bazaar</title>
</head>

<body style="background-image: linear-gradient(black, red,black);">
    <nav class="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" id="main-title">Welcome to E-Mobile Bazaar</a>
            <div class="btn-class">
                <a class="navbar-brand nav-btn flex-col" href="login.php"><span class="btn">Login </span></a>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <h3 class="text-center">Sign Up</h3>
        <hr>
        <form action="" method="POST">
            <div class="row g-3">
                <div class="col main-class">
                    <label for="inputEmail4" class="form-label text-white labels">Username</label>
                    <input type="text" class="form-control" id="inputEmail4" name="username" placeholder="Enter your username">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label text-white labels">Password</label>
                    <input type="password" class="form-control" id="inputPassword4" name="password" placeholder="Enter your password">
                </div>
                <div class="col-md-12">
                    <label for="inputPassword" class="form-label text-white pt-2 labels">Confirm Password</label>
                    <input type="password" class="form-control" id="inputPassword" name="confirm_password" placeholder="Re-enter your password">
                </div>

            </div>
            <div class="col mt-2">
                <label for="phone" class="form-label pt-2 text-white labels">Phone No</label>
                <input type="phone" class="form-control" id="phone" name="phone" placeholder="Enter your contact">
            </div>

            <div class="col mt-2">
                <label class="form-label pt-2 text-white labels">Email</label>
                <input class="form-control" type="email" id="email" placeholder="Enter your email" name="email">
            </div> 


            <div class="col mt-2">
                <label class="form-label pt-2 text-white labels">Address</label>
                <input class="form-control" type="address" id="address" placeholder="Enter your address">
            </div>

            <div class="col-12 mt-4">
                <button type="submit" class="btn btn-primary btn-sign">Sign in</button>
            </div>
    </div>
    <div class="special-log-in">
        <a href="login.php">Already a user, log in</a>
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