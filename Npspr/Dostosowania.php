<?php
    include 'conn.php';
    include 'errorHandler.php';

    if(!isset($_SESSION['uczen_id'])){
        $_SESSION['uczen_id'] =$_POST['uczen'];
    }     
    
    if(!isset($_SESSION['edycja'])){
        if($_SESSION['przedmiot_id'] == "" || $_SESSION['przedmiot_id'] == " "){
            $_SESSION['odp'] = "Proszę wybrać co najmniej jeden przedmiot";
            header('Location: uczen.php'); 
        } 
    }
    if(isset($_POST['Wybierz'])){
        $_SESSION['uczen_id'] =$_POST['uczen']; 
        unset($_SESSION['edycja']);
    }
    if(!isset($_SESSION['dost'])){
        $_SESSION['dost'] =[];
    }
        // print_r($_SESSION['dost']);
    $_SESSION['uwagi'] = "";
    $uwagi = $_SESSION['uwagi'];

    if(isset($_SESSION['edycja'])){
        unset($_SESSION['dost']);
        $_SESSION['dost'] = [];
        $sql = "SELECT * FROM `zapisy` WHERE `id_zapis` = ".$_SESSION['edycja']." ;";
        $result = mysqli_query( $_SESSION['con'], $sql ); 
        while($row = mysqli_fetch_assoc($result)){
            $str="";
            $j=0;
            for($i = 0;$i<strlen($row['dostosowania']);$i++){
                if($row['dostosowania'][$i]=="|"){
                    $_SESSION['dost'][$j]=$str;
                    $j++;
                    $str="";
                }else{
                    $str = $str.$row['dostosowania'][$i];
                }
            }
            $uwagi = $row['uwagi'];
            $_SESSION['uczen_id'] =$row['id_ucznia']; 
        }
        
    }
?>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Dostosowania</title>
    <link rel="stylesheet" href="style.css">
</head>
<script src="dost.js"></script>
<script src="pdf.js"></script>
<body>
<?php
        if(isset($_SESSION['edycja'])){
            echo "<p class='edit'>Edycja</p>";
        }
    ?>
    <div class="header">
        <h1>Wybierz dostosowania</h1>
    </div>
    <div class="middle">
        <br>
        <a class="button-13" href="uczen.php">Wróć</a><br><br>
    <form method="post" action="Koniec.php">
        <?php
            $npspr = array();
            $sql = "SELECT `npspr`.`nazwa`,`npspr`.`id_npspr` FROM `npspr` join `uczn_npspr` USING(`id_npspr`) WHERE `uczn_npspr`.`id_ucznia` = ".$_SESSION['uczen_id'].";";
            $result = mysqli_query( $_SESSION['con'], $sql ); 
            if($result){
                $i = 0;
                while($row = mysqli_fetch_array($result)){
                    echo"<b>".$row['nazwa']." :?</b><br>";
                    $sql = "SELECT * FROM `kategoria`";
                    $result1 = mysqli_query( $_SESSION['con'], $sql ); 
                    if($result1){
                        while($row2 = mysqli_fetch_array($result1)){
                            echo"       -<b> ".$row2['nazwa_kat']."</b><br>";
                            $sql = "SELECT * FROM `dostosowania` join `npspr_dost` using(`id_dost`) join `npspr` USING(`id_npspr`) join `uczn_npspr` using(`id_npspr`) where `uczn_npspr`.`id_ucznia` = ".$_SESSION['uczen_id']." and `uczn_npspr`.`id_npspr` = ".$row['id_npspr']." and `id_kat` =".$row2['id_kat']." ;";
                            $result2 = mysqli_query( $_SESSION['con'], $sql ); 
                            if($result2){
                                while($row3 = mysqli_fetch_array($result2)){
                                    if(in_array($row3['id_dost'],$_SESSION['dost'])){
                                        echo "<input class='checkbox-all' type='checkbox' name=".$i." value=".$row3['id_dost']." id='".$row3['id_dost']."' onChange='zapiszDost(".$row3['id_dost'].")' checked>".$row3['text']."<br>";
                                        $i++;
                                    }else{
                                        echo "<input class='checkbox-all' type='checkbox' name=".$i." value=".$row3['id_dost']." id='".$row3['id_dost']."' onChange='zapiszDost(".$row3['id_dost'].")'>".$row3['text']."<br>";
                                        $i++;
                                    }
                                    
                                }
                            }else{
                                echo "Nie ma żadnych rekordów albo coś jest źle :<";
                            }
                        }
                    }
                }
            }
            echo' Uwagi : <textarea name="uwagi" id="uwagi">'.$uwagi.'</textarea><br>';
        ?>
        <input class="button-13" type="submit" name="wybierz"value="Wybierz">
    </form>    
    </div>
    <div class="footer">

    </div>
    
</body>
</html>