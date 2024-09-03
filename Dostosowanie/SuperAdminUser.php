<?php
include 'conn.php';

?>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Super Admin User</title>
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
                <td class="Adminmenu4"><a href="SuperAdminUser.php">Użytkownicy</a></td>
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
                <form action="SuperAdminUser.php" method="post" id="dodaj">
                    <table class="tabelarekord">
                        <tr>
                            <td class="komorka2">Imie :<br> <input class="input_pole" name="imie"></td>
                            <td class="komorka2"> Nazwisko :<br> <input class="input_pole" name="nazwisko"></td>
                            <td class="komorka2">Rola : <br><select class="input_pole" name="rola">
                                <option value="Nauczyciel">Nauczyciel</option>
                                <option value="Pedagog">Pedagog</option>
                            </select></td>
                            <td class="komorka2"> Hasło :<br> <input class="input_pole" name="haslo"></td>
                            <input name="dodaj" type="hidden" value="1">
                            <td class="komorka2"><button class="button-13" onClick="dodajUser()">Dodaj</button></td>
                        </tr>
                    </table>                                                                  
                </form>
            </div>
<?php         
                $sql = "SELECT * FROM `user` WHERE 1;";
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
                        <tr><form action="SuperAdminUser.php" method="post" id="'.$row['id'].'">
                        <td class="'.$klasa.'"><input class="input_pole" name="imie" value="'.$row["imie"].'"></td>
                        <td class="'.$klasa.'"><input class="input_pole" name="nazwisko" value="'.$row["nazwisko"].'"></td>
                        <td class="'.$klasa.'"><select class="input_pole" name="rola">';
                            if($row["rola"] == "Nauczyciel"){
                                echo'<option selected value="Nauczyciel">Nauczyciel</option>';
                                echo'<option value="Pedagog">Pedagog</option>';
                            }else if($row["rola"] == "Pedagog"){
                                echo'<option value="Nauczyciel">Nauczyciel</option>';
                                echo'<option selected value="Pedagog">Pedagog</option>';
                            }else{
                                echo'<option value="Nauczyciel">SuperAdmin</option>';
                            }
                                
                        echo'</select></td>
                        </td><input type="hidden" name="id" value='.$row['id'].' />
                        <input type="hidden" name="Zapisz" value=1 />
                        <td class="'.$klasa.'" >
                        <button class="button-13" onClick="usunUser('.$row['id'].')">Usuń</button>
                        <button class="button-13" onClick="zapiszUser('.$row['id'].')">Edytuj</button>
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