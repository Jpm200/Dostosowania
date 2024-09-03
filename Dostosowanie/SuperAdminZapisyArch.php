<?php
include 'conn.php';

?>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Super Admin Zapis</title>
    <link rel="stylesheet" href="style.css">
</head>
<script src="zapisy.js"></script>
<body>
    <div class="header">
        <h1>Super admin panel archiwa</h1>
    </div>
    <div class="middle">
    <?php
    echo '<script type="text/javascript">sprawdzRole("'.$_SESSION['rola'].'");</script>';
    ?>
        <table class="Adminmenu2">
            <tr class="Adminmenu3">
                <td class="Adminmenu1"><a href="Logowanie.php">Logowanie</a></td>
                <td class="Adminmenu1"><a href="SuperAdminUczen.php">Uczen</a></td>
                <td class="Adminmenu1"><a href="SuperAdminNpspr.php">Npspr</a></td>
                <td class="Adminmenu1"><a href="SuperAdminDost.php">Dostosowania</a></td>
                <td class="Adminmenu1"><a href="SuperAdminUser.php">Użytkownicy</a></td>
                <td class="Adminmenu1"><a href="SuperAdminZapis.php">Zapisy</a></td>
                <td class="Adminmenu4"><a href="SuperAdminZapisyArch.php">Archiwa</a></td>
                <td class="Adminmenu1"><a href="SuperAdminRok.php">Rok szkolny</a></td>
                <td class="Adminmenu1"><a href="SuperAdminKlasy.php">Przypisanie klas</a></td>
                <td class="Adminmenu1"><a href="SuperAdminKlasa.php">Klasy</a></td>
                <td class="Adminmenu1"><a href="SuperAdminPrzedm.php">Przedmioty</a></td>
                <td class="Adminmenu1"><a href="SuperAdminSympt.php">Symptomy</a></td>
            </tr>
        </table><br>
<?php         
                $sql = "SELECT `zapisy_archiwa`.*,`uczniowie`.`imie`,`uczniowie`.`nazwisko`,`user`.`imie`as 'user_imie',`user`.`nazwisko`as 'user_nazwisko' FROM `zapisy_archiwa` join `uczniowie` using(`id_ucznia`) join `user` on `id_user` = `id`;";      
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
                                    <td class="'.$klasa.'">'.$row["user_nazwisko"].' '.$row["user_imie"].' </td> 
                                    <td class="'.$klasa.'">'.$row["imie"].' '.$row["nazwisko"].' </td> 
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
                            <button class="button-13" onClick="wczytajZapisArch('.$row['id_zapis'].')">Wczytaj</button>
                            <button class="button-13" onClick="przywroc('.$row['id_zapis'].')">Przywróć</button>
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