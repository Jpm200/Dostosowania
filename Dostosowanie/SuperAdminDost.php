<?php
include 'conn.php';
?>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Super Admin Dost</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="SuperAdminJS.js"></script>
</head>
<body>
    <div class="header">
        <h1>Super admin panel</h1>
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
                <td class="Adminmenu4"><a href="SuperAdminDost.php">Dostosowania</a></td>
                <td class="Adminmenu1"><a href="SuperAdminUser.php">Użytkownicy</a></td>
                <td class="Adminmenu1"><a href="SuperAdminZapis.php">Zapisy</a></td>
                <td class="Adminmenu1"><a href="SuperAdminZapisyArch.php">Archiwa</a></td>
                <td class="Adminmenu1"><a href="SuperAdminRok.php">Rok szkolny</a></td>
                <td class="Adminmenu1"><a href="SuperAdminKlasy.php">Przypisanie klas</a></td>
                <td class="Adminmenu1"><a href="SuperAdminKlasa.php">Klasy</a></td>
                <td class="Adminmenu1"><a href="SuperAdminPrzedm.php">Przedmioty</a></td>
                <td class="Adminmenu1"><a href="SuperAdminSympt.php">Symptomy</a></td>
            </tr>
        </table><br>
    <div class="dodawanie">
                <form action="SuperAdminDost.php" method="post" id="dodaj">
                    
                    <table class="tabelarekord">
                        <tr>
                            <td class="komorka2"> Tekst :<br> <input class="input_pole" name="text"></td>
                            <td class="komorka2">Npspr : <br><select class="input_pole" name="npspr">
                            <?php
                                $sql="SELECT * FROM `npspr` WHERE 1;";;
                                $result = mysqli_query( $_SESSION['con'], $sql ); 
                                if($result){
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<option value=".$row['id_npspr'].">".$row['nazwa']."</option>";
                                    }
                                }
                            ?>
                            </select></td>
                            <td class="komorka2">kategoria : <br><select  class="input_pole" name="id_kat">
                            <?php
                                $sql="SELECT * FROM `kategoria` WHERE 1;";;
                                $result = mysqli_query( $_SESSION['con'], $sql ); 
                                if($result){
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<option value=".$row['id_kat'].">".$row['nazwa_kat']."</option>";
                                    }
                                }
                            ?>
                            </select></td>
                            <input name="dodaj" type="hidden" value="1"></td>
                            <td class="komorka2" > <button class="button-13" onClick="dodajDost()">Dodaj</button></td>
                        </tr>
                    </table>                                                                  
                </form>
            </div>
<?php         
                if(isset($_POST['refresh'])){
                    echo "<meta http-equiv=\"refresh\" content=\"0;URL=SuperAdminDost.php\">";
                }
                $sql = "SELECT * FROM `dostosowania` left join `npspr_dost` using(`id_dost`) left join `npspr` using(id_npspr) left join `kategoria` using(`id_kat`) order by `nazwa`,`nazwa_kat`;";      
                $klasa = "komorka1";
                $p=0;
                $result = mysqli_query($_SESSION['con'], $sql);
                if($result){
                    while($row = mysqli_fetch_array($result)){
                        if($p % 2 == 0){
                            $klasa = "komorka1";
                            $p++;
                        }else{
                            $klasa = "komorka2";
                            $p++;
                        }
                            echo '<div class="rekord">
                            <table class="tabelarekord">
                                <tr><form action="SuperAdminDost.php" method="post" id="'.$row['id_dost'].'">
                                    <td class="'.$klasa.'"><select class="input_pole" name="npspr">';
                                            $sql="SELECT * FROM `npspr` WHERE 1;";;
                                            $result1 = mysqli_query( $_SESSION['con'], $sql ); 
                                            if($result1){
                                                while($row1 = mysqli_fetch_array($result1)){
                                                    if($row['id_npspr'] == $row1['id_npspr']){
                                                        echo "<option selected value=".$row1['id_npspr'].">".$row1['nazwa']."</option>";
                                                    }else{
                                                        echo "<option value=".$row1['id_npspr'].">".$row1['nazwa']."</option>";
                                                    }
                                                    
                                                }
                                            }
                            echo'</select></td>
                            <td class="'.$klasa.'"><input class="input_pole" name="text" value="'.$row["text"].'"></td> 
                            <td class="'.$klasa.'"><select class="input_pole" name="id_kat">';
                                $sql="SELECT * FROM `kategoria` WHERE 1;";;
                                $result1 = mysqli_query( $_SESSION['con'], $sql ); 
                                if($result1){
                                    while($row1 = mysqli_fetch_array($result1)){
                                        if($row['id_kat'] == $row1['id_kat']){
                                            echo "<option selected value=".$row1['id_kat'].">".$row1['nazwa_kat']."</option>";
                                        }else{
                                            echo "<option value=".$row1['id_kat'].">".$row1['nazwa_kat']."</option>";
                                        }
                                    }
                                }
                            echo'</select></td>
                            <input type="hidden" name="id" value='.$row['id_dost'].' />
                            <input type="hidden" name="Zapisz" value=1 />
                            <td class="'.$klasa.'" >
                            <button class="button-13" onClick="usunDost('.$row['id_dost'].')">Usuń</button>
                            <button class="button-13" onClick="zapiszDost('.$row['id_dost'].')">Zapisz</button>
                            </form></td>
                                </tr>
                            </table>
                            </div>';
                    }
                }else{
                    echo"Nie ma żadnych rekordów";
                }
        ?>    
        </div>
        <div class="footer">

        </div>
</body>
</html>