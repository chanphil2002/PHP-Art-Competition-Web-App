<?php
    $servername="localhost";
    $username="root";
    $password="";
    $database="virtualx_competition";

    $conn = mysqli_connect($servername, $username, $password, $database);
    
    if (!$conn) {
        die("<script>alert('Connection Fails.')</script>");
    }

?>