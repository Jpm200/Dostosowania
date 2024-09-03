<?php
include 'conn.php';
if(isset($_POST["idusun"])){
    $sql = "DELETE FROM `symptomy` WHERE `id_sympt` = ".$_POST['idusun'].";";
    $result = mysqli_query( $_SESSION['con'], $sql ); 
}
if(isset($_POST["Zapisz"])){
    $sql = "UPDATE `symptomy` SET `tekst`='".$_POST["tekst"]."',`id_npspr`='".$_POST["npspr"]."' WHERE `id_sympt` = ".$_POST['id'].";";
    $result = mysqli_query( $_SESSION['con'], $sql ); 
    
}
if(isset($_POST["dodaj"])){
    $sql="INSERT INTO `symptomy`(`id_sympt`, `tekst`,`id_npspr`) VALUES ('','".$_POST["tekst"]."','".$_POST["npspr"]."');";
    mysqli_query( $_SESSION['con'], $sql); 
}