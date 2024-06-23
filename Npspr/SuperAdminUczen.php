<?php
include 'conn.php';
include 'errorHandler.php';
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Super Admin Uczen</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <p id="demo"></p>
    <div class="header">
        <h1>Super admin panel</h1>
    </div>
    <div class="middle">
    <br><a class="button-13"  href="SuperAdminPanel.html">Panel</a><br><br>
    <form method="post">
        <input class="button-13"  type="submit" name="refresh"value="Odśwież">
    </form>
    <button style="align-self: left;" class="button-13"  onClick="promujWszystkich()">Promuj Wszystkich</button>
    <script src="promocja.js"></script>
    <div class="dodawanie">
                <form action="SuperAdminUczen.php" method="post">
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
                                </select></td>
                                <td class="komorka1"><input class="button-13" type="submit" value="Dodaj" name="dodaj" class="dodaj"></td>                                                           
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
                if(isset($_POST["usun"])){
                    $sql = "DELETE FROM `uczniowie` WHERE `id_ucznia` = ".$_POST['id'].";";
                    $result = mysqli_query( $_SESSION['con'], $sql ); 
                    $sql = "DELETE FROM `uczn_dost` WHERE `id_ucznia` = ".$_POST['id'].";";
                    $result = mysqli_query( $_SESSION['con'], $sql ); 
                    $sql = "DELETE FROM `uczn_npspr` WHERE `id_ucznia` = ".$_POST['id'].";";
                    $result = mysqli_query( $_SESSION['con'], $sql ); 
                }
                if(isset($_POST["zapisz"])){
                    $sql = "UPDATE `uczniowie` SET `imie`='".$_POST['imie']."',`nazwisko`='".$_POST['nazwisko']."',`id_klasa`='".$_POST['klasa']."' WHERE `id_ucznia` = ".$_POST['id'].";";
                    $result = mysqli_query( $_SESSION['con'], $sql ); 
                }
                if(isset($_POST['refresh'])){
                    echo "<meta http-equiv=\"refresh\" content=\"0;URL=SuperAdminUczen.php\">";
                }
                if(isset($_POST["dodaj"])){
                    $sql = "SELECT * FROM `rok_szkolny` WHERE 1";
                    if($result){
                        $result = mysqli_query( $_SESSION['con'], $sql );
                        $row = mysqli_fetch_assoc(mysqli_query( $_SESSION['con'], $sql ));
                        $rok = $row['rok'];
                    }
                    if (!empty($_POST["imie"]) && !empty($_POST["nazwisko"]) && !empty($_POST['id_klasa'])){
                    $sql="INSERT INTO `uczniowie`(`id_ucznia`, `imie`, `nazwisko`, `id_klasa`,`rok_szkolny`) VALUES ('','".$_POST["imie"]."','".$_POST["nazwisko"]."','".$_POST["id_klasa"]."','".$rok."');";
                    mysqli_query( $_SESSION['con'], $sql); 
                    }else{
                        echo "Wpisz wszystkie dane!";
                    }
                }
                if(!isset($_SESSION['promowani'])){
                    $_SESSION['promowani']=[];
                }
                if(isset($_POST["promocja"])){
                    $rok = (intval(substr($_POST['rok'],0,4))+1)."/".(intval(substr($_POST['rok'],5,4))+1);
                    $sql = "SELECT `numer` FROM `klasy` WHERE `id_klasa` = ".$_POST['klasa'].";";
                    $result = mysqli_query($_SESSION['con'],$sql);
                    if($result){
                        $row = mysqli_fetch_assoc($result);
                        $klasa=$row['numer'];
                    }
                    if(intval(substr($klasa,0,1))<5){
                        $sql ="SELECT `id_klasa` FROM `klasy` WHERE `poziom` = ".(intval(substr($klasa,0,1))+1)." and `skrot` = '".substr($klasa,1)."';";
                        $result=mysqli_query( $_SESSION['con'], $sql); 
                        if($result){
                            while($row = mysqli_fetch_assoc($result)){
                                $klasa =$row['id_klasa'];
                            }
                        }
                    }else{
                        $sql ="SELECT `id_klasa` FROM `klasy` WHERE `numer`='A'";
                        $result=mysqli_query( $_SESSION['con'], $sql); 
                        if($result){
                            while($row = mysqli_fetch_assoc($result)){
                                $klasa =$row['id_klasa'];
                            }
                        }
                    }
                    $sql = "INSERT INTO `uczniowie`(`id_ucznia`, `imie`, `nazwisko`, `id_klasa`, `rok_szkolny`) VALUES ('','".$_POST['imie']."','".$_POST['nazwisko']."','".$klasa."','".$rok."')";
                    mysqli_query( $_SESSION['con'], $sql);
                    $sql = "SELECT `id_ucznia` FROM `uczniowie` WHERE `imie` ='".$_POST['imie']."' and `nazwisko`='".$_POST['nazwisko']."' and `id_klasa` = ".$klasa." and `rok_szkolny`= '".$rok."' ;";
                    $result = mysqli_query($_SESSION['con'],$sql);
                    if($result){
                        $row = mysqli_fetch_assoc($result);
                        array_push($_SESSION['promowani'],$row['id_ucznia']);
                    }  
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
                            <tr><form action="SuperAdminUczen.php" method="post">
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
                        <td class="'.$klasa.'" >
                        <input type="submit" class="button-13"  name="usun" value="Usun"/>
                        <input  type="submit" class="button-13"  name="zapisz" value="Zapisz"/>';
                        if($row['id_klasa']!=13){
                            echo '<input type="submit" class="button-13"  name="promocja" value="Promuj"/>';
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