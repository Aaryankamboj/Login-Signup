<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<style>
    h3{
        font-family: "Work Sans ", cursive;

    }
    #id-user{
        font-size: 24px;
        font-family: "Work Sans ", cursive;
        font-weight: 300;

    }
    #id-message{
        font-size: 24px;
        font-family: "Work Sans ", cursive;
        font-weight: 300;
        margin-top: 20px;

    }
    .log-head {
        text-align: center;
        margin-top: 20px;
        margin-bottom: 20px;
        font-size: 20px;
        font-family: "Work Sans ", cursive;
    }
    .btns{
        margin-top: 10px;
        font-size: 22px;
        display: flex;
        justify-content: center;
        align-items: center;
        align-content: space-around;
        
        
    }
    .btns a{
        padding: 2px;
        margin: 5px;
        border: 2px solid black;
        background-color: greenyellow;

        border-radius: 15px;
        width: 100px;
        color: black;
    }
    .btns a:hover{
        background-color: grey;
        color: white;
        border-color: white;
    }
</style>

<head>

    <script>
        function preventBack() {
            window.history.forward();
        }
        setTimeout("preventBack()", 0);
        window.onunload = function() {
            null
        };
    </script>
</head>
<!-- form section start -->
<section class="w3l-mockup-form">
    <div class="container">
        <h3 class="title-heading">E-Mobile Plaza</h3>
        <div class="log-head">

            <?php
            session_start();
            // if(!isset($_SESSION['loggedin'])){
            //     header("location: index.php");
            //     die();
            // }
            if (!isset($_SESSION['SESSION_EMAIL'])) {
                header("Location: ./index.php");
                die();
            }

            include 'config.php';

            $query = mysqli_query($conn, "SELECT * FROM users WHERE email='{$_SESSION['SESSION_EMAIL']}'");
            if (mysqli_num_rows($query) > 0) {
                $row = mysqli_fetch_assoc($query);

                echo "<div id='id-user'>User Id: " . $row['user_id'] ."<br></div>";
                echo "<div id='id-message'>Do you really want to log out " . $row['name'] ." ?</div> <br><div class='btns'><a href='logout.php'>Yes</a>" ."&nbsp;<a href='../index.php'>No</a></div>";
            }

            ?>
        </div>

    </div>
</section>