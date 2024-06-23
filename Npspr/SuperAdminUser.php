<?php
include 'conn.php';
include 'errorHandler.php';
if(isset($_POST["usun"])){
    $sql = "DELETE FROM `user` WHERE `id` = ".$_POST['id'].";";
    $result = mysqli_query( $_SESSION['con'], $sql ); 
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=SuperAdminUser.php\">";
}
if(isset($_POST["zapisz"])){
    $sql = "UPDATE `user` SET `imie`='".$_POST['imie']."',`nazwisko`='".$_POST['nazwisko']."',`rola`='".$_POST['rola']."' WHERE `id` = ".$_POST['id'].";";
    $result = mysqli_query( $_SESSION['con'], $sql ); 
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=SuperAdminUser.php\">";
}
if(isset($_POST['refresh'])){
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=SuperAdminUser.php\">";
}
if(isset($_POST["dodaj"])){
    if (!empty($_POST["imie"]) && !empty($_POST["nazwisko"]) && !empty($_POST['rola']) && !empty($_POST['haslo'])){
    $sql="INSERT INTO `user`(`id`, `imie`, `nazwisko`, `rola`,`haslo`) VALUES ('','".$_POST["imie"]."','".$_POST["nazwisko"]."','".$_POST["rola"]."','".md5($_POST['haslo'])."');";
    mysqli_query( $_SESSION['con'], $sql); 
    }else{
        echo "Wpisz wszystkie dane!";
    }
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=SuperAdminUser.php\">";
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Super Admin User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <h1>Super admin panel</h1>
    </div>
    <div class="middle">
    <br><a class="button-13" href="SuperAdminPanel.html">Panel</a><br><br>
    <form method="post" action="SuperAdminUser.php">
        <input class="button-13" type="submit" name="refresh"value="Odśwież">
    </form>
    <div class="dodawanie">
                <form action="SuperAdminUser.php" method="post">
                    <table class="tabelarekord">
                        <tr>
                            <td class="komorka2">Imie :<br> <input class="input_pole" name="imie"></td>
                            <td class="komorka2"> Nazwisko :<br> <input class="input_pole" name="nazwisko"></td>
                            <td class="komorka2">Rola : <br><select class="input_pole" name="rola">
                                <option value="Nauczyciel">Nauczyciel</option>
                                <option value="Pedagog">Pedagog</option>
                            </select></td>
                            <td class="komorka2"> Hasło :<br> <input class="input_pole" name="haslo"></td>
                            <td class="komorka2"><input class="button-13" type="submit" value="Dodaj" name="dodaj" class="dodaj"></td>
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
                        <tr><form action="SuperAdminUser.php" method="post">
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
                        <td class="'.$klasa.'" >
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