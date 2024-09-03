<?php
include 'conn.php';

if(isset($_POST["idusun"])){
    $sql = "DELETE FROM `user_klasa` WHERE `id_klasa` = ".$_POST['klasa']." and  `id_user` = ".$_POST['user'].";";
    $result = mysqli_query( $_SESSION['con'], $sql ); 
}
if(isset($_POST["Zapisz"])){
    $sql = "UPDATE `user_klasa` SET `id_klasa`=".$_POST['klasa']." WHERE `id_user` = ".$_POST['user']." and `id` = ".$_POST['klasa_id'].";";
    $result = mysqli_query( $_SESSION['con'], $sql ); 
}
if(isset($_POST["dodaj"])){
    $sql="INSERT INTO `user_klasa`(`id`,`id_klasa`, `id_user`) VALUES ('','".$_POST["klasa"]."','".$_POST["user"]."');";
    $result = mysqli_query( $_SESSION['con'], $sql); 
}
