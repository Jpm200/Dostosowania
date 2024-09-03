<?php
    include 'conn.php';

    $odp = "<p class='sympt'>Symptomy : <br>";
    $sql = "SELECT * from `symptomy` where `id_npspr` = ".$_GET['id'].";";
    $result = mysqli_query( $_SESSION['con'], $sql ); 
    if($result){
        while($row = mysqli_fetch_assoc($result)){
            $odp= $odp. "-".$row['tekst']."<br>";
        }
    }
    echo $odp."</p>";