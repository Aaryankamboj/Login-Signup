<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<style>
    .log-head{
        text-align: center;
        margin-top: 40px;
        margin-bottom: 20px;
        font-size: 20px;
    }
    
</style>
<!-- form section start -->
<section class="w3l-mockup-form">
    <div class="container">
        <h3 class="title-heading">E-Mobile Plaza</h3>
        <div class="log-head">

            <?php
            session_start();
            if (!isset($_SESSION['SESSION_EMAIL'])) {
                header("Location: ./index.php");
                die();
            }

            include 'config.php';

            $query = mysqli_query($conn, "SELECT * FROM users WHERE email='{$_SESSION['SESSION_EMAIL']}'");
            if (mysqli_num_rows($query) > 0) {
                $row = mysqli_fetch_assoc($query);

                echo "Do you really want to log out " . $row['name'] . " ?<br> <a href='logout.php'>Logout</a>";
            }

            ?>
        </div>

    </div>
</section>