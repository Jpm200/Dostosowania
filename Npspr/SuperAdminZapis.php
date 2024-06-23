<?php
include 'conn.php';
include 'errorHandler.php';
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Super Admin Zapis</title>
    <link rel="stylesheet" href="style.css">
</head>
<script src="zapisy.js"></script>
<body>
    <div class="header">
        <h1>Super admin panel</h1>
    </div>
    <div class="middle">
    <br><a href="SuperAdminPanel.html" class="button-13">Panel</a><br><br>
<?php         
                if(isset($_POST['refresh'])){
                    echo "<meta http-equiv=\"refresh\" content=\"0;URL=SuperAdminZapis.php\">";
                }
                $sql = "SELECT `zapisy`.*,`uczniowie`.`imie`,`uczniowie`.`nazwisko`,`user`.`imie`as 'user_imie',`user`.`nazwisko`as 'user_nazwisko' FROM `zapisy` join `uczniowie` using(`id_ucznia`) join `user` on `id_user` = `id`;";      
                $p=0;
                $klasa = "komorka1";
                $result = mysqli_query($_SESSION['con'], $sql);
                if($result && mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_array($result)){
                        if($p % 2 == 0){
                            $klasa = "komorka1";
                        }else{
                            $klasa = "komorka2";
                        }
                            echo '<div id="'.$row['id_zapis'].'" class="rekord">
                            <table class="tabelarekord">
                                <tr>
                                    <td class="'.$klasa.'">'.$row["rok_szkolny"].'</td>
                                    <td class="'.$klasa.'">'.$row["user_nazwisko"].' '.$row["user_imie"].'</td> 
                                    <td class="'.$klasa.'">'.$row["imie"].' '.$row["nazwisko"].'</td> 
                                    <td class="'.$klasa.'">';
                                    for($i = 0;$i<strlen($row['id_przedmiot']);$i++){
                                        if($row['id_przedmiot'][$i] != "|" && $row['id_przedmiot'][$i]!=""){
                                            $sql="SELECT * FROM `przedmiot` WHERE `id_przedmiot` = ".$row['id_przedmiot'][$i]." ;";
                                            $result1 = mysqli_query( $_SESSION['con'], $sql );
                                            if($result1){
                                                while($row1 = mysqli_fetch_assoc($result1)){
                                                    echo $row1['nazwa']." , ";
                                                }
                                            } 
                                        }
                                    }
                            echo'</td> 
                            <td class="'.$klasa.'">'.$row["data"].'</td>
                            <td class="'.$klasa.'" >
                            <button class="button-13" onClick="wczytajZapis('.$row['id_zapis'].')">Wczytaj</button>
                            </td>
                            </tr>
                            </table>
                            </div>';
                        $p++;
                    }
                }else{
                    echo"Nie ma żadnych zapisów";
                }
                
        ?>    
        </div>
        <div class="footer">

        </div>
</body>
</html>