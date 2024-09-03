<?php
include 'conn.php';

if(isset($_POST["idusun"])){
    $sql = "DELETE FROM `uczn_npspr` WHERE `id_npspr` = ".$_POST['npspr']." and  `id_ucznia` = ".$_POST['uczen'].";";
    $result = mysqli_query( $_SESSION['con'], $sql ); 
}
if(isset($_POST["Zapisz"])){
    $sql = "UPDATE `uczn_npspr` SET `id_npspr`=".$_POST['npspr']." WHERE `id_ucznia` = ".$_POST['uczen']." and `id_npspr` = ".$_POST['npspr_id'].";";
    $result = mysqli_query( $_SESSION['con'], $sql ); 
}
if(isset($_POST["dodaj"])){
    $sql="INSERT INTO `uczn_npspr`(`id`,`id_npspr`, `id_ucznia`) VALUES ('','".$_POST["npspr"]."','".$_POST["uczen"]."');";
    $result = mysqli_query( $_SESSION['con'], $sql); 
}
