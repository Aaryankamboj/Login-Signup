<?php
/*
USER = "root"
PASSWORD = ""
*/
define('DB_SERVER','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','login');

// Connecting to the database
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($conn == false){
    dir('Error : Cannot connect');
}
?>