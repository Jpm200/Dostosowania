<?php
    include 'conn.php';
    include 'errorHandler.php';
    if(in_array($_GET['id'],$_SESSION['dost'])){
    $key = array_search($_GET['id'],$_SESSION['dost']);
    array_splice($_SESSION['dost'], $key, 1,[]);
    }else{
    array_push($_SESSION['dost'],$_GET['id']);
    }

 