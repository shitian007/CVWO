<?php
    // Database Handler
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "blog";

    $conn = mysqli_connect($servername, $username, $password, $database);
    // Error handling if connection fails
    if (!$conn) {
        die("Connection failed:" . mysqli_connect_error());
    }
?>