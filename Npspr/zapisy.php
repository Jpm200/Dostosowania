<?php
include 'conn.php';
include 'errorHandler.php';
if(isset($_GET["id"])){
    $sql = "DELETE FROM `zapisy` WHERE `id_zapis` = ".$_GET["id"].";";
    mysqli_query( $_SESSION['con'], $sql );
}

if(isset($_GET["id2"])){
    $sql = "SELECT * FROM `zapisy` WHERE `id_zapis` = ".$_GET["id2"].";";
    $result = mysqli_query( $_SESSION['con'], $sql );
    if($result){
        while($row = mysqli_fetch_assoc($result)){
            $_SESSION['wczytaj'] = "";
            $_SESSION['rok'] = $row['rok_szkolny'];
            $_SESSION['user2'] = $row['id_user'];
            $_SESSION['dost'] = $row['dostosowania'];
            $_SESSION['przedmiot_id'] = $row['id_przedmiot'];
            $_SESSION['uczen_id'] = $row['id_ucznia'];
            $_SESSION['uwagi'] = $row['uwagi'];
            $_SESSION['data'] = $row['data'];
            $_SESSION['data'] =  mb_substr($_SESSION['data'], 0, 10);
        }
    }
    unset($_SESSION['edycja']);
}
if(isset($_GET["id3"])){
    $sql = "SELECT * FROM `zapisy` WHERE `id_zapis` = ".$_GET["id3"].";";
    $result = mysqli_query( $_SESSION['con'], $sql );
    if($result){
        while($row = mysqli_fetch_assoc($result)){
            $_SESSION['edycja'] = $_GET["id3"];
            $_SESSION['user2'] = $row['id_user'];
            // $_SESSION['data'] = $row['data'];
            //$_SESSION['data'] =  mb_substr($_SESSION['data'], 0, 10);
        }
    }
    //echo "<meta http-equiv=\"refresh\" content=\"0;URL=testpdf.php\">";
}
if(isset($_GET["id4"])){
    $sql = "SELECT * FROM `zapisy_archiwa` WHERE `id_zapis` = ".$_GET["id4"].";";
    $result = mysqli_query( $_SESSION['con'], $sql );
    if($result){
        while($row = mysqli_fetch_assoc($result)){
            $_SESSION['wczytaj'] = "";
            $_SESSION['rok'] = $row['rok_szkolny'];
            $_SESSION['user2'] = $row['id_user'];
            $_SESSION['dost'] = $row['dostosowania'];
            $_SESSION['przedmiot_id'] = $row['id_przedmiot'];
            $_SESSION['uczen_id'] = $row['id_ucznia'];
            $_SESSION['uwagi'] = $row['uwagi'];
            $_SESSION['data'] = $row['data'];
            $_SESSION['data'] =  mb_substr($_SESSION['data'], 0, 10);
        }
    }
    unset($_SESSION['edycja']);
}
if(isset($_GET["id5"])){
    $sql = "INSERT INTO `zapisy` SELECT * from `zapisy_archiwa` where `id_zapis` = ".$_GET["id5"].";";
    mysqli_query( $_SESSION['con'], $sql );
    $sql = "DELETE FROM `zapisy_archiwa` WHERE `id_zapis` = ".$_GET["id5"].";";
    mysqli_query( $_SESSION['con'], $sql );
}