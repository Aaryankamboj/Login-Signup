<?php
session_start();
if (!(isset($_SESSION['loggedin']) || $_SESSION(['loggedin'] != true))) {
    header("location: welcome.php");
}
?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="login-style.css">

    <title>E-Mobile Bazaar</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark navi">
        <div class="container-fluid">
            <a class="navbar-brand" href="#" id="main-title">Welcome to E-Mobile Bazaar</a>
            <div class="btn-class">
                <a class="navbar-brand nav-btn" href="logout.php"> <span class="btn">Logout </span></a>
            </div>

        </div>
    </nav>
    <div class="container mt-5">
        <h3 class="text-center"><?php echo "Welcome " . $_SESSION['username']; ?> You can now use this website</h3>
        <hr>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>