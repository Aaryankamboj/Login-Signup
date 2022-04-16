<?php

$conn = mysqli_connect("localhost", "root", "", "e-shop") or die("Connection failed");

if (!$conn) {
    echo "Connection Failed";
}