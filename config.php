<?php

$conn = mysqli_connect("localhost", "root", "", "e-shop");

if (!$conn) {
    echo "Connection Failed";
}