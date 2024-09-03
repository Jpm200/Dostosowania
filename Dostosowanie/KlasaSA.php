<?php
include 'conn.php';
if(isset($_POST["idusun"])){
    $sql = "DELETE FROM `klasy` WHERE `id_klasa` = ".$_POST['idusun'].";";
    $result = mysqli_query( $_SESSION['con'], $sql ); 
}
if(isset($_POST["Zapisz"])){
    $sql = "UPDATE `klasy` SET `numer`='".$_POST['numer']."' WHERE `id_klasa` = ".$_POST['id'].";";
    $result = mysqli_query( $_SESSION['con'], $sql ); 
}
if(isset($_POST["dodaj"])){
    $sql="INSERT INTO `klasy`(`id_klasa`, `numer`, `poziom`, `skrot`) VALUES ('','".$_POST["numer"]."','".substr($_POST['numer'],0,1)."','".substr($_POST['numer'],1)."');";
    $result = mysqli_query( $_SESSION['con'], $sql); 
}
