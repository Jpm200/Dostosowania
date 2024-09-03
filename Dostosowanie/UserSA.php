<?php
include 'conn.php';

if(isset($_POST["idusun"])){
    $sql = "DELETE FROM `user` WHERE `id` = ".$_POST['idusun'].";";
    $result = mysqli_query( $_SESSION['con'], $sql ); 
}
if(isset($_POST["Zapisz"])){
    $sql = "UPDATE `user` SET `imie`='".$_POST['imie']."',`nazwisko`='".$_POST['nazwisko']."',`rola`='".$_POST['rola']."' WHERE `id` = ".$_POST['id'].";";
    $result = mysqli_query( $_SESSION['con'], $sql ); 
}
if(isset($_POST["dodaj"])){
    $sql="INSERT INTO `user`(`id`, `imie`, `nazwisko`, `rola`,`haslo`) VALUES ('','".$_POST["imie"]."','".$_POST["nazwisko"]."','".$_POST["rola"]."','".md5($_POST['haslo'])."');";
    mysqli_query( $_SESSION['con'], $sql); 
}