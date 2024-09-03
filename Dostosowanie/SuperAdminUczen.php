<?php
include 'conn.php';

?>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Super Admin Uczen</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="SuperAdminJS.js"></script>
</head>
<body>
    <p id="demo"></p>
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
                <td class="Adminmenu4"><a href="SuperAdminUczen.php">Uczen</a></td>
                <td class="Adminmenu1"><a href="SuperAdminNpspr.php">Npspr</a></td>
                <td class="Adminmenu1"><a href="SuperAdminDost.php">Dostosowania</a></td>
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
    <button style="align-self: left;" class="button-13"  onClick="promujWszystkich()">Promuj Wszystkich</button><br><br>
    <div class="dodawanie">
                <form action="SuperAdminUczen.php" method="post" id="dodaj">
                <table class="tabelarekord">
                    <tr>
                            <td class="komorka1">Imie :<br> <input name="imie" class="input_pole"></td> 
                            <td class="komorka1">Nazwisko :<br> <input name="nazwisko" class="input_pole"></td>
                            <td class="komorka1">Klasa : <br><select name="id_klasa" class="input_pole">
                                <?php
                                    $sql="SELECT * FROM `klasy` WHERE 1;";;
                                    $result = mysqli_query( $_SESSION['con'], $sql ); 
                                    if($result){
                                        while($row = mysqli_fetch_array($result)){
                                            echo "<option value=".$row['id_klasa'].">".$row['numer']."</option>";
                                        }
                                    }
                                ?>
                                </select><input name="dodaj" type="hidden" value="1"></td>
                                <td class="komorka1" > <button class="button-13" onClick="dodajUczen()">Dodaj</button></td>
                        </form>
                    </tr>
                </table>
            </div>
            <div class="wyszukaj">
                <form action="SuperAdminUczen.php" method="post">
                    <table class="tabelarekord">
                        <tr>
                            <td class="komorka2">Imie :<br><input name="imie" class="input_pole"></td>
                            <td class="komorka2">Nazwisko :<br><input name="nazwisko" class="input_pole"></td>
                            <td class="komorka2">Klasa : <br><select name="klasa" class="input_pole">
                            <option value="" selected></option>
                            <?php
                                $sql="SELECT * FROM `klasy` WHERE 1;";;
                                $result = mysqli_query( $_SESSION['con'], $sql ); 
                                if($result){
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<option value=".$row['id_klasa'].">".$row['numer']."</option>";
                                    }
                                }
                            ?>
                            </select></td>
                            <td class="komorka2"><input class="button-13" type="submit" value="Wyszukaj" name="wyszukaj" class="wyszukaj"></td>
                        </tr>
                    </table>                                                                  
                </form>
            </div>
<?php         
                if(!isset($_SESSION['promowani'])){
                    $_SESSION['promowani']=[];
                }
                if(isset($_POST["wyszukaj"])){
                        $sql="SELECT * FROM `uczniowie` WHERE";
                        if(!empty($_POST['imie'])){
                            $sql = $sql .  "`imie` = '$_POST[imie]' AND " ;
                        }
                        if(!empty($_POST['nazwisko'])){
                            $sql = $sql .  "`nazwisko` = '$_POST[nazwisko]' AND " ;
                        }
                        if(!empty($_POST['klasa'])){
                            $sql = $sql . "`id_klasa` = '$_POST[klasa]' AND ";
                        }
                        $sql = $sql . " 1 ";  
                    }else{
                        $sql = "SELECT * FROM `uczniowie` order by `id_klasa`,`imie`,`nazwisko`;";   
                    }
                $p=0;
                $klasa = "komorka1";
                $result = mysqli_query($_SESSION['con'], $sql);
                if($result){
                    while($row = mysqli_fetch_assoc($result)){
                        if(in_array($row['id_ucznia'],$_SESSION['promowani'])){
                            $klasa1 = "promowany";
                        }else{
                            $klasa1 = "tabelarekord";
                        }
                        if($p % 2 == 0){
                            $klasa = "komorka1";
                            $p++;
                        }else{
                            $klasa = "komorka2";
                            $p++;
                        }
                        echo '<div class="rekord">
                        <table class="'.$klasa1.'">
                            <tr><form action="SuperAdminUczen.php" method="post" id="'.$row['id_ucznia'].'">
                                <td class="'.$klasa.'">'.$row["rok_szkolny"].'</td>
                                <td class="'.$klasa.'"><input class="input_pole" name="imie" value="'.$row["imie"].'"></td>
                                <td class="'.$klasa.'"><input class="input_pole" name="nazwisko" value="'.$row["nazwisko"].'"></td>
                                <input type="hidden" name="rok" value="'.$row["rok_szkolny"].'">
                                <td class="'.$klasa.'"><select class="input_pole" name="klasa">';
                                $sql="SELECT * FROM `klasy` WHERE 1 ORDER BY `skrot`,`poziom` asc;";;
                                $result1 = mysqli_query( $_SESSION['con'], $sql ); 
                                if($result1){
                                    while($row1 = mysqli_fetch_array($result1)){
                                        if($row1['id_klasa'] == $row['id_klasa']){
                                            echo "<option selected value=".$row1['id_klasa'].">".$row1['numer']."</option>";
                                        }else{
                                            echo "<option value=".$row1['id_klasa'].">".$row1['numer']."</option>";
                                        }
                                    }
                                }
                        echo '</select></td>
                        <input type="hidden" name="id" value='.$row['id_ucznia'].' />
                        <input type="hidden" name="Zapisz" value=1 />
                        <td class="'.$klasa.'" >
                        <button class="button-13" onClick="usunUczen('.$row['id_ucznia'].')">Usuń</button>
                        <button class="button-13" onClick="zapiszUczen('.$row['id_ucznia'].')">Edytuj</button>';
                        if($row['id_klasa']!=13){
                            echo '<button class="button-13" onClick="promuj('.$row['id_ucznia'].')">Promuj</button>';
                        }else{
                            echo"<br><br>";
                        }
                        echo'</form></td>
                            </tr>
                        </table>
                        </div>';
                    }
                }else{
                    echo"Nie ma żadnych rekordów";
                }
                unset($_SESSION['promowani']);
        ?>   
        </div>
        <div class="footer">

        </div> 
</body>
</html>