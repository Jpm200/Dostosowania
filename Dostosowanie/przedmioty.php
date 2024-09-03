<?php
include 'conn.php';

if(!isset($_SESSION['przedmiot_id'])){
    $_SESSION['przedmiot_id'] = array("0");
}
if(isset($_GET['p'])){
    $sql = "SELECT * FROM `przedmiot` WHERE `id_przedmiot` = ".$_GET['p']." ;";
            $result = mysqli_query( $_SESSION['con'], $sql ); 
            if($result){    
            while($row = mysqli_fetch_array($result)){
                if(!in_array($row['id_przedmiot'], $_SESSION['przedmiot_id'])){
                    $_SESSION['przedmiot_id'][] = $row['id_przedmiot'];
                    echo "<div class='przedmiot' id=".$row['id_przedmiot']."><button class='button-13' style='width:105px;' onClick='usunPrzedmiot(".$row['id_przedmiot'].")'>".$row['nazwa']."</button></div> ";
                }
                
            }
        }
} 
if(isset($_GET['q'])){
    foreach ($_SESSION['przedmiot_id'] as $key => $value) {
        if ($value == $_GET['q']) {
            unset($_SESSION['przedmiot_id'][$key]);
            break;
        }
    }
}
