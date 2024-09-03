<?php
include 'conn.php';
?>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Super Admin Npspr</title>
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
                <td class="Adminmenu1"><a href="SuperAdminDost.php">Dostosowania</a></td>
                <td class="Adminmenu1"><a href="SuperAdminUser.php">Użytkownicy</a></td>
                <td class="Adminmenu1"><a href="SuperAdminZapis.php">Zapisy</a></td>
                <td class="Adminmenu1"><a href="SuperAdminZapisyArch.php">Archiwa</a></td>
                <td class="Adminmenu1"><a href="SuperAdminRok.php">Rok szkolny</a></td>
                <td class="Adminmenu4"><a href="SuperAdminKlasy.php">Przypisanie klas</a></td>
                <td class="Adminmenu1"><a href="SuperAdminKlasa.php">Klasy</a></td>
                <td class="Adminmenu1"><a href="SuperAdminPrzedm.php">Przedmioty</a></td>
                <td class="Adminmenu1"><a href="SuperAdminSympt.php">Symptomy</a></td>
            </tr>
        </table><br>
    <div class="dodawanie">
                <form action="SuperAdminKlasy.php" method="post" id="dodaj">
                    <table class="tabelarekord">
                        <tr>
                        <td class="komorka2">Nauczyciel : <br><select class="input_pole" name="user">
                            <?php
                                $sql="SELECT * FROM `user` WHERE `rola` not like 'SuperAdmin';";;
                                $result = mysqli_query( $_SESSION['con'], $sql ); 
                                if($result){
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<option value=".$row['id'].">".$row['imie']." ".$row['nazwisko']."</option>";
                                    }
                                }
                            ?>
                            </select></td>
                        <td class="komorka2">Klasa : <br><select class="input_pole" name="klasa">
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
                            <input name="dodaj" type="hidden" value="1"></td>
                            <td class="komorka2" > <button class="button-13" onClick="dodajKlasy()">Dodaj</button></td>
                        </tr>
                    </table>                                                                  
                </form>
            </div>
<?php         
                $sql = "SELECT `id` as 'user_id', `imie`, `nazwisko`, `rola` FROM `user` WHERE `rola` not like 'SuperAdmin';";
                $result = mysqli_query($_SESSION['con'], $sql);
                while($row = mysqli_fetch_assoc($result)){
                    echo $row['imie']." ".$row['nazwisko']."<br>";
                    $sql = "SELECT * FROM `user_klasa` join `klasy` USING(`id_klasa`) WHERE `id_user` = ".$row['user_id'].";";
                    $result1 = mysqli_query($_SESSION['con'], $sql);
                    $klasa = "komorka1";
                    $p=0;
                    while($row1 = mysqli_fetch_assoc($result1)){
                        if($p % 2 == 0){
                            $klasa = "komorka1";
                            $p++;
                        }else{
                            $klasa = "komorka2";
                            $p++;   
                        }
                        echo '<div class="rekord"><table class="tabelarekord">
                        <tr><form action="SuperAdminKlasy.php" method="post" id="'.$row1['id'].'">
                        <td class="'.$klasa.'"><select class="input_pole" name="klasa">';
                                $sql="SELECT * FROM `klasy` WHERE 1;";;
                                $result2 = mysqli_query( $_SESSION['con'], $sql ); 
                                if($result2){
                                    while($row2 = mysqli_fetch_array($result2)){
                                        if($row2['id_klasa'] == $row1['id_klasa']){
                                            echo "<option selected value=".$row2['id_klasa'].">".$row2['numer']."</option>";
                                        }else{
                                            echo "<option value=".$row2['id_klasa'].">".$row2['numer']."</option>";
                                        }
                                    }
                                }
                        echo'</select></td>
                        <td class="'.$klasa.'"><input type="hidden" name="user" value='.$row['user_id'].' />
                        <input type="hidden" name="klasa_id" value='.$row1['id'].' />
                        <input type="hidden" name="Zapisz" value=1 />
                        <button class="button-13" onClick="usunKlasy('.$row1['id_klasa'].','.$row['user_id'].')">Usuń</button>
                        <button class="button-13" onClick="zapiszKlasy('.$row1['id'].')">Edytuj</button>
                        </form></td>
                        </tr>
                        </table></div>';
                    }
                    echo "<br>";
                }
        ?>    
        </div>
        <div class="footer">

        </div>
</body>
</html>