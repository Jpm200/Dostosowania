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
                <form action="SuperAdminKlasy.php" method="post">
                    <table class="tabelarekord">
                        <tr>
                        <td class="komorka1">Nauczyciel : <br><select class="input_pole" name="user">
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
                        <td class="komorka1">Klasa : <br><select class="input_pole" name="klasa">
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
                        </tr>
                    </table>                                                                  
                </form>
            </div>
<?php         
                if(isset($_POST["usun"])){
                    $sql = "DELETE FROM `user_klasa` WHERE `id_klasa` = ".$_POST['klasa']." and  `id_user` = ".$_POST['user'].";";
                    $result = mysqli_query( $_SESSION['con'], $sql ); 
                }
                if(isset($_POST["zapisz"])){
                    $sql = "UPDATE `user_klasa` SET `id_klasa`=".$_POST['klasa']." WHERE `id_user` = ".$_POST['user']." and `id` = ".$_POST['klasa_id'].";";
                    $result = mysqli_query( $_SESSION['con'], $sql ); 
                }
                if(isset($_POST['refresh'])){
                    echo "<meta http-equiv=\"refresh\" content=\"0;URL=SuperAdminKlasy.php\">";
                }
                if(isset($_POST["dodaj"])){
                    $sql="INSERT INTO `user_klasa`(`id`,`id_klasa`, `id_user`) VALUES ('','".$_POST["klasa"]."','".$_POST["user"]."');";
                    $result = mysqli_query( $_SESSION['con'], $sql); 
                }

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
                        <tr><form action="SuperAdminKlasy.php" method="post">
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
                        <input type="submit" class="button-13" name="usun" value="Usun"/>
                        <input  type="submit" class="button-13" name="zapisz" value="Zapisz"/></td>
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