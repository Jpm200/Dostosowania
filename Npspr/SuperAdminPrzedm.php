<?php
include 'conn.php';
include 'errorHandler.php';
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Super Admin Przedmioty</title>
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
                <form action="SuperAdminPrzedm.php" method="post">
                            Nazwa :<br> <input name="nazwa"><br>
                            <input class="button-13" type="submit" value="Dodaj" name="dodaj" class="dodaj">                                                                 
                </form>
            </div>
<?php         
                if(isset($_POST["usun"])){
                    $sql = "DELETE FROM `przedmiot` WHERE `id_przedmiot` = ".$_POST['id'].";";
                    $result = mysqli_query( $_SESSION['con'], $sql ); 
                }
                if(isset($_POST["zapisz"])){
                    $sql = "UPDATE `przedmiot` SET `nazwa`='".$_POST['nazwa']."' WHERE `id_przedmiot` = ".$_POST['id'].";";
                    $result = mysqli_query( $_SESSION['con'], $sql ); 
                }
                if(isset($_POST['refresh'])){
                    echo "<meta http-equiv=\"refresh\" content=\"0;URL=SuperAdminPrzedm.php\">";
                }
                if(isset($_POST["dodaj"])){
                    if (!empty($_POST['nazwa'])){
                    $sql="INSERT INTO `przedmioty`(`id_przedmiot`, `nazwa`) VALUES ('','".$_POST["nazwa"]."');";
                    $result = mysqli_query( $_SESSION['con'], $sql); 
                    }else{
                    }
                }
               
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
                        <tr><form action="SuperAdminPrzedm.php" method="post">
                        <td class="'.$klasa.'"><input name="nazwa" class="input_pole" value="'.$row["nazwa"].'"></td>
                        <input type="hidden" name="id" value='.$row['id_przedmiot'].' />
                        <td class="'.$klasa.'" >
                        <input type="submit" name="usun" class="button-13" value="Usun"/>
                        <input  type="submit" name="zapisz" class="button-13" value="Zapisz"/></td>
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