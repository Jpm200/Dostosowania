<?php
session_start();
    $con = mysqli_connect("localhost","root","","dostosowanie");
    $_SESSION['con'] = $con;
