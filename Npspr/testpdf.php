<?php
include 'conn.php';
include 'errorHandler.php';
// while($row = mysqli_fetch_array($result)){
//     $_SESSION['przedmiot_id'] =$_POST['przedmiot']; 
//     echo $row['nazwa']." , ";
// }

// if(isset($_POST["usun"])){
//     $sql = "DELETE FROM `zapisy` WHERE `id_zapis` = ".$_POST['id'].";";
//     mysqli_query( $_SESSION['con'], $sql );
//     echo "<meta http-equiv=\"refresh\" content=\"0;URL=uczen.php\">";
// }
// if(isset($_POST["wczytaj"])){
//     $_SESSION['przedmiot_id'] = $_POST['przedmiot'];
//     $_SESSION['uczen_id'] = $_POST['uczen'];
//     unset($_SESSION['edycja']);
// }

if(isset($_SESSION['edycja'])){
    $sql = "SELECT * FROM `zapisy` WHERE `id_zapis` = ".$_SESSION['edycja']." ;";
        $result = mysqli_query( $_SESSION['con'], $sql ); 
        while($row = mysqli_fetch_assoc($result)){
            $_SESSION['przedmiot_id'] = $row['id_przedmiot'];
            $_SESSION['uczen_id'] = $row['id_ucznia'];
            $data2 = $row['data'];
            $data2 = substr($data2,0,strlen($data2)-6);
        }

}

if(!isset($_SESSION['user2'])){
    $sql="SELECT * FROM `user` WHERE `id` = ".$_SESSION['user'].";";;
    $result = mysqli_query( $_SESSION['con'], $sql );
    if($result){
        while($row = mysqli_fetch_array($result)){
            $uczacy = $row['imie']." ".$row['nazwisko'];
        }
    }
}else{
    $sql="SELECT * FROM `user` WHERE `id` = ".$_SESSION['user2'].";";;
    $result = mysqli_query( $_SESSION['con'], $sql );
    if($result){
        while($row = mysqli_fetch_array($result)){
            $uczacy = $row['imie']." ".$row['nazwisko'];
        }
    }
}

$sql="SELECT * FROM `uczniowie` join `klasy` using(`id_klasa`) WHERE `id_ucznia` = ".$_SESSION['uczen_id'].";";;
    $result = mysqli_query( $_SESSION['con'], $sql );
    if($result){
        while($row = mysqli_fetch_array($result)){
            $imie = $row['imie']." ".$row['nazwisko'];
            $klasa = $row['numer'];
        }
    }
$npspr = "";
$sql = "SELECT `npspr`.`nazwa` FROM `npspr` join `uczn_npspr` USING(`id_npspr`) WHERE `uczn_npspr`.`id_ucznia` = ".$_SESSION['uczen_id'].";";
$result = mysqli_query( $_SESSION['con'], $sql ); 
        if($result){
            if(mysqli_num_rows($result)>=2){
                $npspr = "Niepełnosprawność sprzężona : ".$npspr;
            }
            while($row = mysqli_fetch_array($result)){
                $npspr = $npspr . $row['nazwa']." , ";  
            }
            $npspr = substr($npspr,0,strlen($npspr)-2);
        }
if(isset($_SESSION['rok'])){
    $data = $_SESSION['rok'];
}else{
    $sql = "SELECT * FROM `rok_szkolny` WHERE 1";
    $result = mysqli_query( $_SESSION['con'], $sql );
    if($result){
        $row = mysqli_fetch_assoc(mysqli_query( $_SESSION['con'], $sql ));
        $data = $row['rok'];
    }
}

// $data = "";        
// if(date("m") < 9){
//     $data = (date("Y")-1)."/".date("Y");
// }else{
//     $data = date("Y")."/".(date("Y")+1);
// }
$przedmiot = "";
for($i = 0;$i<strlen($_SESSION['przedmiot_id']);$i++){
    $przedm = $_SESSION['przedmiot_id'][$i];
    if($przedm != "|" && $przedm!=""){
        $sql="SELECT * FROM `przedmiot` WHERE `id_przedmiot` = ".$przedm." ;";
        $result = mysqli_query( $_SESSION['con'], $sql );
        if($result){
            while($row = mysqli_fetch_array($result)){
                $przedmiot = $przedmiot.$row['nazwa']." , ";
            }
        } 
    }
}
$przedmiot = substr($przedmiot,0,strlen($przedmiot)-3);
$len = strlen($przedmiot) / 40;
// echo $len."<br>";
$n = 15 + (5 * floor($len));
//echo $n;
// if(isset($_POST['uwagi'])){
//     if(isset($_SESSION['uwagi'])){
//         unset($_SESSION['uwagi']);
//     }
//     $uwagi = $_POST['uwagi'];
//     if($uwagi == "/"){
//         $uwagi="";
//     }
// }
// if(isset($_SESSION['uwagi'])){
    $uwagi =  $_SESSION['uwagi'];
    if($uwagi == "/"){
        $uwagi="";
    }
//}

$dost =[];
$str="";
if(isset($_SESSION['wczytaj'])){
    $j=0;
    for($i = 0;$i<strlen($_SESSION['dost']);$i++){
        if($_SESSION['dost'][$j]=="|"){
            $dost[$i]=$str;
            $str="";
        }else{
            $str = $str.$_SESSION['dost'][$j];
        }
        $j++;
    }
}else{
   $i = 1;
foreach($_SESSION['dost'] as $id =>$val){
    if($id != "Wybierz" && $id != "uwagi"){
       $dost[$i] = $val; 
        $i++; 
    }
} 
}

$kat1  ="";
$kat2 = "";
$kat3 = "";
$kat4 = "";
$kat5 = "";

foreach($dost as $dos){
    mysqli_query( $_SESSION['con'], "DELETE FROM `uczn_dost` WHERE `id_ucznia` = ".$_SESSION['uczen_id']." and `id_dost` = ".intval($dos).";" ); 
    mysqli_query( $_SESSION['con'], "INSERT INTO `uczn_dost`(`id`,`id_ucznia`, `id_dost`) VALUES ('',".$_SESSION['uczen_id'].",".intval($dos).");" ); 
    $sql="SELECT * FROM `dostosowania`join`kategoria`using(`id_kat`) WHERE `id_dost` = ".intval($dos).";";;
    $result = mysqli_query( $_SESSION['con'], $sql );
    if($result){
        while($row = mysqli_fetch_array($result)){
            if($row['id_kat']==1){
                $kat1 = $kat1.$row['text']." , ";
                
            }else if($row['id_kat']==2){
                $kat2 = $kat2.$row['text']." , ";
                
            }else if($row['id_kat']==3){
                $kat3 = $kat3.$row['text']." , ";
                
            }else if($row['id_kat']==9){
                $kat4 = $kat4.$row['text']." , ";
                
            }else if($row['id_kat']==10){
                $kat5 = $kat5.$row['text']." , ";
                
            }
        }
        
    }

}
$kat1 = substr($kat1,0,strlen($kat1)-2);
$kat2 = substr($kat2,0,strlen($kat2)-2);
$kat3 = substr($kat3,0,strlen($kat3)-2);
$kat4 = substr($kat4,0,strlen($kat4)-2);
$kat5 = substr($kat5,0,strlen($kat5)-2);

if(!isset($_SESSION['wczytaj'])&&!isset($_SESSION['edycja'])){
   $dostosowania="";
    foreach($dost as $dos){
        $dostosowania = $dostosowania.$dos."|";
    }

$sql = "INSERT INTO `zapisy`(`id_zapis`, `id_user`, `id_ucznia`, `id_przedmiot`, `dostosowania`,`uwagi`, `data`,`rok_szkolny`) VALUES ('','".$_SESSION['user']."','".$_SESSION['uczen_id']."','".$_SESSION['przedmiot_id']."','".$dostosowania."','".$uwagi."','".$date = date('d/m/Y H:i')."','".$data."');";
mysqli_query($_SESSION['con'],$sql); 
unset($_SESSION['edycja']);
}
if(!isset($_SESSION['data'])){
    $_SESSION['data'] = date('d/m/Y H:i');   
}
if(isset($_SESSION['edycja'])){
    $dostosowania="";
    foreach($dost as $dos){
        $dostosowania = $dostosowania.$dos."|";
    }


    $sql = "UPDATE `zapisy` SET `dostosowania`='".$dostosowania."',`uwagi`='".$uwagi."',`data`='".$_SESSION['data']."' WHERE `id_zapis` = ".$_SESSION['edycja'].";";
    mysqli_query($_SESSION['con'],$sql); 
}
$_SESSION['data'] =  mb_substr($_SESSION['data'], 0, 10);
// if(isset($_POST["edycja"])){
//     $_SESSION['edycja'] = $_POST['id'];
//     echo "<meta http-equiv=\"refresh\" content=\"0;URL=Dostosowania.php\">";
// }

unset($_SESSION['przedmiot_id']);
unset($_SESSION['uwagi']);
unset($_SESSION['rok']);
unset($_SESSION['user2']);
unset($_SESSION['dost']);
if(isset($_SESSION['wczytaj'])){
    unset($_SESSION['wczytaj']);
}
if(isset($_SESSION['edycja'])){
    unset($_SESSION['edycja']);
}

require('mc_table.php');

$pdf = new PDF_MC_Table();
$pdf->AddPage();

$pdf->AddFont('Myfont','','Myfont.ttf',true);
$pdf->SetFont('Myfont','',13);
$pdf->SetLeftMargin(25);
$pdf->Write(6,"              Dostosowanie wymagań do indywidualnych potrzeb rozwojowych\n                      i edukacyjnych oraz możliwości psychofizycznych ucznia\n");
$pdf->Ln(12);
$pdf->SetFillColor(255, 255, 255); 
$pdf->SetFont('Myfont','',10);
$pdf->Cell(60, 15, 'Imię i nazwisko ucznia', 1, 0, 'C', true);
$pdf->Cell(100, 15,"$imie", 1, 1, 'C', true); 

$pdf->Cell(60, 15, 'Klasa', 1, 0, 'C', true);
$pdf->Cell(100, 15, "$klasa", 1, 1, 'C', true); 

$pdf->Cell(60, 15, 'Rok szkolny', 1, 0, 'C', true);
$pdf->Cell(100, 15, "$data", 1, 1, 'C', true); 

$pdf->SetWidths(array(60, 100));
for($i=0;$i<1;$i++){
    $pdf->Row(array("\n      Podstawa dostosowania wymagań\n    ","\n$npspr"));
}

$pdf->Ln(12);

$pdf->SetFont('Myfont','',12);
$pdf->Cell(80, $n, 'Przedmiot', 1, 0, 'C', true); 
$pdf->SetFont('Myfont','',10);
$pdf->SetWidths(array(80, 80));
//$pdf->Row(array("\nPrzedmiot\n   "));
$pdf->Row(array("\n$przedmiot\n  "));
// $pdf->Cell(80, 8, 'Przedmiot', 1, 0, 'C', true); 
// $pdf->SetFont('Myfont','',10);
// $pdf->Cell(80, 8, "$przedmiot", 1, 1, 'C', true); 

$pdf->SetFont('Myfont','',12);
$pdf->Cell(80, 12, 'Uczący', 1, 0, 'C', true); 
$pdf->SetFont('Myfont','',10);
$pdf->Cell(80, 12, "$uczacy", 1, 1, 'C', true); 

$pdf->AddFont('Myfont','','NotoSerif-Medium.ttf',true);
$pdf->SetFont('Myfont','',10);
$pdf->SetWidths(array(80, 80));
for($i=0;$i<1;$i++){
    $pdf->Row(array("\n1. Sposób dostosowania wymagań wynikających \n z realizowanego programu nauczania\n   ","$kat1"));
    $pdf->Row(array("\n2. Warunki organizacji kształcenia, \ndostosowanie przestrzeni edukacyjnej do\n potrzeb ucznia\n    ","$kat2"));
    $pdf->Row(array("\n3. Metody i formy pracy z uczniem\n  ","$kat3"));
    $pdf->Row(array("\n4. Środki dydaktyczne\n  ","$kat4"));
    $pdf->Row(array("\n5. Sposoby sprawdzania osiągnięć edukacyjnych\n  ","$kat5"));
    $pdf->Row(array("\n6. Uwagi\n   ","$uwagi"));
}

$pdf->Ln(12);
$pdf->SetFont('Myfont','',11);
$pdf ->Write(6,$_SESSION['data']);
$pdf->SetFont('Myfont','',9);
$pdf ->Write(5,"                                                                                                                                              ............................................................
                                                                                                                                                                                       podpis nauczyciela");
unset($_SESSION['data']);                                                                                                                                                                                      
$pdf->Output("I","doc.pdf",true);