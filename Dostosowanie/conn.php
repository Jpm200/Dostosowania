<?php
include 'errorHandler.php';
session_start();
    $con = mysqli_connect("localhost","root","","dostosowanie");
    $_SESSION['con'] = $con;
    
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
      }