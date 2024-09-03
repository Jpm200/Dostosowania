<?php
include 'conn.php';
if(isset($_POST["idusun"])){
    $sql = "DELETE FROM `przedmiot` WHERE `id_przedmiot` = ".$_POST['idusun'].";";
    $result = mysqli_query( $_SESSION['con'], $sql ); 
}
if(isset($_POST["Zapisz"])){
    $sql = "UPDATE `przedmiot` SET `nazwa`='".$_POST['nazwa']."' WHERE `id_przedmiot` = ".$_POST['id'].";";
    $result = mysqli_query( $_SESSION['con'], $sql ); 
}
if(isset($_POST["dodaj"])){
    $sql="INSERT INTO `przedmiot`(`id_przedmiot`, `nazwa`) VALUES ('','".$_POST["nazwa"]."');";
    $result = mysqli_query( $_SESSION['con'], $sql); 
}