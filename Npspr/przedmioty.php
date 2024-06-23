<?php
include 'conn.php';
include 'errorHandler.php';
if(!isset($_SESSION['przedmiot_id'])){
    $_SESSION['przedmiot_id'] = "";
}
if(isset($_GET['p'])){
    $sql = "SELECT * FROM `przedmiot` WHERE `id_przedmiot` = ".$_GET['p']." ;";
            $result = mysqli_query( $_SESSION['con'], $sql ); 
            if($result){    
            while($row = mysqli_fetch_array($result)){
                if(!str_contains(strval($_SESSION['przedmiot_id']),$row['id_przedmiot'])){
                    $_SESSION['przedmiot_id'] = $_SESSION['przedmiot_id']."|".$row['id_przedmiot'] ;
                    echo "<div class='przedmiot' id=".$row['id_przedmiot']."><button class='button-13' style='width:105px;' onClick='usunPrzedmiot(".$row['id_przedmiot'].")'>".$row['nazwa']."</button></div> ";
                }
                
            }
        }else{
            echo "Nie ma żadnych rekordó albo coś jest źle :<";
        }
} 
if(isset($_GET['q'])){
    $x = str_replace("|".$_GET['q'],"",$_SESSION['przedmiot_id']);
    $_SESSION['przedmiot_id'] = $x;
}
