<?php
include 'conn.php';

?>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Super Admin Przedmioty</title>
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
                <td class="Adminmenu1"><a href="SuperAdminKlasy.php">Przypisanie klas</a></td>
                <td class="Adminmenu1"><a href="SuperAdminKlasa.php">Klasy</a></td>
                <td class="Adminmenu4"><a href="SuperAdminPrzedm.php">Przedmioty</a></td>
                <td class="Adminmenu1"><a href="SuperAdminSympt.php">Symptomy</a></td>
            </tr>
        </table><br>
    <div class="dodawanie">
                <form action="SuperAdminPrzedm.php" method="post" id="dodaj">
                            Nazwa :<br> <input name="nazwa"><br>
                            <input name="dodaj" type="hidden" value="1"></td>
                            <button class="button-13" onClick="dodajPrzedm()">Dodaj</button>                                                                
                </form>
            </div>
<?php         
                $sql = "SELECT * FROM `przedmiot`;";      
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
                        <tr><form action="SuperAdminPrzedm.php" method="post" id="'.$row['id_przedmiot'].'">
                        <td class="'.$klasa.'"><input name="nazwa" class="input_pole" value="'.$row["nazwa"].'"></td>
                        <input type="hidden" name="id" value='.$row['id_przedmiot'].' />
                        <input type="hidden" name="Zapisz" value=1 />
                        <td class="'.$klasa.'" >
                        <button class="button-13" onClick="usunPrzedm('.$row['id_przedmiot'].')">Usuń</button>
                        <button class="button-13" onClick="zapiszPrzedm('.$row['id_przedmiot'].')">Edytuj</button></td>
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