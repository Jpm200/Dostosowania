<?php
include 'conn.php';
include 'errorHandler.php';
$_SESSION['promowani']=[];
$sql="SELECT * from `uczniowie` join `klasy` using(`id_klasa`) where 1";
$res = mysqli_query( $_SESSION['con'], $sql ); 
if($res){
    while($r = mysqli_fetch_assoc($res)){
        $rok = (intval(substr($r['rok_szkolny'],0,4))+1)."/".(intval(substr($r['rok_szkolny'],5,4))+1);
        $sql = "SELECT `numer` FROM `klasy` WHERE `id_klasa` = ".$r['id_klasa'].";";
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
        $sql = "INSERT INTO `uczniowie`(`id_ucznia`, `imie`, `nazwisko`, `id_klasa`, `rok_szkolny`) VALUES ('','".$r['imie']."','".$r['nazwisko']."','".$klasa."','".$rok."')";
        mysqli_query( $_SESSION['con'], $sql);    
        // $sql = "SELECT `id_ucznia` FROM `uczniowie` WHERE `imie` ='".$r['imie']."' and `nazwisko`='".$r['nazwisko']."' and `id_klasa` = ".$klasa." and `rok_szkolny`= '".$rok."' ;";
        // $result1 = mysqli_query($_SESSION['con'],$sql);
        // if($result1){
        //     $row1 = mysqli_fetch_assoc($result1);
        //     array_push($_SESSION['promowani'],$row1['id_ucznia']);
        //}    
    }
}