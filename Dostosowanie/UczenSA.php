<?php
include 'conn.php';

if(isset($_POST["dodaj"])){
    $sql = "SELECT * FROM `rok_szkolny` WHERE 1";
    $result = mysqli_query( $_SESSION['con'], $sql );
    if($result){
        $row = mysqli_fetch_assoc($result);
        $rok = $row['rok'];
    }
    $sql="INSERT INTO `uczniowie`(`id_ucznia`, `imie`, `nazwisko`, `id_klasa`,`rok_szkolny`) VALUES ('','".$_POST["imie"]."','".$_POST["nazwisko"]."','".$_POST["id_klasa"]."','".$rok."');";
    mysqli_query( $_SESSION['con'], $sql); 
}
if(isset($_POST['idusun'])){
    $sql = "DELETE FROM `uczniowie` WHERE `id_ucznia` = ".$_POST['idusun'].";";
    mysqli_query( $_SESSION['con'], $sql ); 
    $sql = "DELETE FROM `uczn_dost` WHERE `id_ucznia` = ".$_POST['idusun'].";";
    mysqli_query( $_SESSION['con'], $sql ); 
    $sql = "DELETE FROM `uczn_npspr` WHERE `id_ucznia` = ".$_POST['idusun'].";";
    mysqli_query( $_SESSION['con'], $sql ); 
}
if(isset($_POST['Zapisz'])){
    $sql = "UPDATE `uczniowie` SET `imie`='".$_POST['imie']."',`nazwisko`='".$_POST['nazwisko']."',`id_klasa`='".$_POST['klasa']."' WHERE `id_ucznia` = ".$_POST['id'].";";
    mysqli_query( $_SESSION['con'], $sql ); 
}
if(isset($_POST['promocja'])){
    $_SESSION['promowani']=[];
    if(isset($_POST["promocja"])){
        $rok = (intval(substr($_POST['rok'],0,4))+1)."/".(intval(substr($_POST['rok'],5,4))+1);
        $sql = "SELECT `numer` FROM `klasy` WHERE `id_klasa` = ".$_POST['klasa'].";";
        $result = mysqli_query($_SESSION['con'],$sql);
        if($result){
            $row = mysqli_fetch_assoc($result);
            $klasa=$row['numer'];
        }
        if(intval(substr($klasa,0,1))<5){
            $sql ="SELECT `id_klasa` FROM `klasy` WHERE `poziom` = ".(intval(substr($klasa,0,1))+1)." and `skrot` = '".substr($klasa,1)."';";
            $result=mysqli_query( $_SESSION['con'], $sql); 
            if($result){
                while($row = mysqli_fetch_assoc($result)){
                    $klasa =$row['id_klasa'];
                }
            }
        }else{
            $sql ="SELECT `id_klasa` FROM `klasy` WHERE `numer`='A'";
            $result=mysqli_query( $_SESSION['con'], $sql); 
            if($result){
                while($row = mysqli_fetch_assoc($result)){
                    $klasa =$row['id_klasa'];
                }
            }
        }
        $sql = "INSERT INTO `uczniowie`(`id_ucznia`, `imie`, `nazwisko`, `id_klasa`, `rok_szkolny`) VALUES ('','".$_POST['imie']."','".$_POST['nazwisko']."','".$klasa."','".$rok."')";
        mysqli_query( $_SESSION['con'], $sql);
        $sql = "SELECT `id_ucznia` FROM `uczniowie` WHERE `imie` ='".$_POST['imie']."' and `nazwisko`='".$_POST['nazwisko']."' and `id_klasa` = ".$klasa." and `rok_szkolny`= '".$rok."' ;";
        $result = mysqli_query($_SESSION['con'],$sql);
        if($result){
            $row = mysqli_fetch_assoc($result);
            array_push($_SESSION['promowani'],$row['id_ucznia']);
        }  
    }
}