<?php
include 'conn.php';
if(isset($_POST["dodaj"])){
                    $sql="INSERT INTO `dostosowania`(`id_dost`, `text`,`id_kat`) VALUES ('','".$_POST["text"]."','".$_POST["id_kat"]."');";
                    mysqli_query( $_SESSION['con'], $sql); 
                    $sql = "SELECT `id_dost` FROM `dostosowania` WHERE `text`= '".$_POST["text"]."'and `id_kat` = '".$_POST["id_kat"]."';";//Uwaga tu jest błąd!! Jak jest ten sam tekst i kategoria dochodzi do zduplikowania rekordu ponieważ to polecenie zwraca wiecej niz jeden rekord!
                    $result1 = mysqli_query( $_SESSION['con'], $sql); 
                    if($result1){
                        while($row = mysqli_fetch_array($result1)){
                            $sql = "DELETE FROM `npspr_dost` WHERE `id_dost` = ".$row['id_dost']." AND `id_npspr` = ".$_POST['npspr'].";";
                            mysqli_query( $_SESSION['con'], $sql); 
                            $sql = "INSERT INTO `npspr_dost`(`id`, `id_npspr`, `id_dost`) VALUES ('','".$_POST['npspr']."','".$row['id_dost']."');";
                            mysqli_query( $_SESSION['con'], $sql); 
                        }
                    }
                }
                if(isset($_POST["idusun"])){
                    $sql = "DELETE FROM `dostosowania` WHERE `id_dost` = ".$_POST['idusun'].";";
                    $result = mysqli_query( $_SESSION['con'], $sql ); 
                    $sql = "DELETE FROM `uczn_dost` WHERE `id_dost` = ".$_POST['idusun'].";";
                    $result = mysqli_query( $_SESSION['con'], $sql ); 
                    $sql = "DELETE FROM `npspr_dost` WHERE `id_dost` = ".$_POST['idusun'].";";
                    $result = mysqli_query( $_SESSION['con'], $sql ); 
                }     
                if(isset($_POST["Zapisz"])){
                    $sql = "UPDATE `dostosowania` SET `text`='".$_POST["text"]."',`id_kat`='".$_POST["id_kat"]."' WHERE `id_dost` = ".$_POST['id'].";";
                    $result = mysqli_query( $_SESSION['con'], $sql ); 
                    $sql = "DELETE FROM `npspr_dost` WHERE `id_npspr` = ".$_POST['npspr']." and `id_dost` = ".$_POST['id'].";";
                    $result = mysqli_query( $_SESSION['con'], $sql ); 
                    $sql = "INSERT INTO `npspr_dost`(`id`, `id_npspr`, `id_dost`) VALUES ('','".$_POST['npspr']."','".$_POST['id']."')";
                    $result = mysqli_query( $_SESSION['con'], $sql ); 
                    
                }