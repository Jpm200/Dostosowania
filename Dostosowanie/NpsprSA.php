<?php
include 'conn.php';
if(isset($_POST['dodaj'])){
        $sql="INSERT INTO `npspr`(`id_npspr`, `nazwa`) VALUES ('','".$_POST["nazwa"]."');";
        $result = mysqli_query( $_SESSION['con'], $sql);      
}
if(isset($_POST["idusun"])){
    $sql = "DELETE FROM `npspr` WHERE `id_npspr` = ".$_POST['idusun'].";";
    $result = mysqli_query( $_SESSION['con'], $sql ); 
    $sql = "DELETE FROM `npspr_dost` WHERE `id_npspr` = ".$_POST['idusun'].";";
    $result = mysqli_query( $_SESSION['con'], $sql ); 
    $sql = "DELETE FROM `uczn_npspr` WHERE `id_npspr` = ".$_POST['idusun'].";";
    $result = mysqli_query( $_SESSION['con'], $sql ); 
}
if($_POST['Zapisz']){
    $sql = "UPDATE `npspr` SET `nazwa`='".$_POST['nazwa']."' WHERE `id_npspr` = ".$_POST['id'].";";
    $result = mysqli_query( $_SESSION['con'], $sql ); 
}