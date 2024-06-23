<?php
include 'conn.php';
include 'errorHandler.php';
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Super Admin Npspr</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <h1>Super admin panel</h1>
    </div>
    <div class="middle">
    <br><a class="button-13" href="SuperAdminPanel.html">Panel</a><br><br>
    <form method="post">
        <input class="button-13" type="submit" name="refresh"value="Odśwież">
    </form>
    <div class="dodawanie">
                <form action="SuperAdminKlasa.php" method="post">
                    Numer :<br><input name="numer"><br>
                    <input type="submit" class="button-13" value="Dodaj" name="dodaj" class="dodaj">                                                              
                </form>
            </div>
<?php         
                if(isset($_POST["usun"])){
                    $sql = "DELETE FROM `klasy` WHERE `id_klasa` = ".$_POST['id'].";";
                    $result = mysqli_query( $_SESSION['con'], $sql ); 
                }
                if(isset($_POST["zapisz"])){
                    $sql = "UPDATE `klasy` SET `numer`='".$_POST['numer']."' WHERE `id_klasa` = ".$_POST['id'].";";
                    $result = mysqli_query( $_SESSION['con'], $sql ); 
                }
                if(isset($_POST['refresh'])){
                    echo "<meta http-equiv=\"refresh\" content=\"0;URL=SuperAdminKlasa.php\">";
                }
                if(isset($_POST["dodaj"])){
                    if (!empty($_POST['numer'])){
                    $sql="INSERT INTO `klasy`(`id_klasa`, `numer`, `poziom`, `skrot`) VALUES ('','".$_POST["numer"]."','".substr($_POST['numer'],0,1)."','".substr($_POST['numer'],1)."');";
                    $result = mysqli_query( $_SESSION['con'], $sql); 
                    }
                }
               
                $sql = "SELECT * FROM `klasy` ORDER BY `skrot`,`poziom` asc;";      
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
                        <tr><form action="SuperAdminKlasa.php" method="post">
                        <td class="'.$klasa.'"><input class="input_pole" name="numer" value="'.$row["numer"].'"></td>
                        <td class="'.$klasa.'"><input class="input_pole" type="hidden" name="id" value='.$row['id_klasa'].' />
                        <input type="submit" class="button-13" name="usun" value="Usun"/>
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