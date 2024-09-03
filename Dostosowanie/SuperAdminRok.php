<?php
include 'conn.php';

?>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Super Admin Npspr</title>
    <link rel="stylesheet" href="style.css">
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
                <td class="Adminmenu4"><a href="SuperAdminRok.php">Rok szkolny</a></td>
                <td class="Adminmenu1"><a href="SuperAdminKlasy.php">Przypisanie klas</a></td>
                <td class="Adminmenu1"><a href="SuperAdminKlasa.php">Klasy</a></td>
                <td class="Adminmenu1"><a href="SuperAdminPrzedm.php">Przedmioty</a></td>
                <td class="Adminmenu1"><a href="SuperAdminSympt.php">Symptomy</a></td>
            </tr>
        </table><br>
<?php         
                if(isset($_POST["zapisz"])){
                    $sql = "UPDATE `rok_szkolny` SET `rok`='".$_POST['rok']."' WHERE 1;";
                    mysqli_query( $_SESSION['con'], $sql ); 
                }
               
                $sql = "SELECT * FROM `rok_szkolny`;";      
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
                        <tr><form action="SuperAdminRok.php" method="post">
                        <td class="'.$klasa.'"><input name="rok" class="input_pole" value="'.$row["rok"].'" placeholder="YYYY/YYYY"></td>
                        <td class="'.$klasa.'" >
                        <input  type="submit" class="button-13" name="zapisz" value="Zapisz"/></td>
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