<?php
include 'conn.php';
include 'errorHandler.php';
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Super Admin Dost</title>
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
                <form action="SuperAdminDost.php" method="post">
                    
                    <table class="tabelarekord">
                        <tr>
                            <td class="komorka2"> Tekst :<br> <input class="input_pole" name="text"></td>
                            <td class="komorka2">Npspr : <br><select class="input_pole" name="npspr">
                            <?php
                                $sql="SELECT * FROM `npspr` WHERE 1;";;
                                $result = mysqli_query( $_SESSION['con'], $sql ); 
                                if($result){
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<option value=".$row['id_npspr'].">".$row['nazwa']."</option>";
                                    }
                                }
                            ?>
                            </select></td>
                            <td class="komorka2">kategoria : <br><select  class="input_pole" name="id_kat">
                            <?php
                                $sql="SELECT * FROM `kategoria` WHERE 1;";;
                                $result = mysqli_query( $_SESSION['con'], $sql ); 
                                if($result){
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<option value=".$row['id_kat'].">".$row['nazwa_kat']."</option>";
                                    }
                                }
                            ?>
                            </select></td>
                            <td class="komorka2"><input class="button-13" type="submit" value="Dodaj" name="dodaj" class="dodaj"></td>
                        </tr>
                    </table>                                                                  
                </form>
            </div>
<?php         
                if(isset($_POST["usun"])){
                    $sql = "DELETE FROM `dostosowania` WHERE `id_dost` = ".$_POST['id'].";";
                    $result = mysqli_query( $_SESSION['con'], $sql ); 
                    $sql = "DELETE FROM `uczn_dost` WHERE `id_dost` = ".$_POST['id'].";";
                    $result = mysqli_query( $_SESSION['con'], $sql ); 
                    $sql = "DELETE FROM `npspr_dost` WHERE `id_dost` = ".$_POST['id'].";";
                    $result = mysqli_query( $_SESSION['con'], $sql ); 
                }
                if(isset($_POST["zapisz"])){
                    $sql = "UPDATE `dostosowania` SET `text`='".$_POST["text"]."',`id_kat`='".$_POST["id_kat"]."' WHERE `id_dost` = ".$_POST['id'].";";
                    $result = mysqli_query( $_SESSION['con'], $sql ); 
                    $sql = "UPDATE `npspr_dost` SET `id_npspr`='".$_POST['npspr']."' WHERE `id_dost` = ".$_POST['id'].";";
                    $result = mysqli_query( $_SESSION['con'], $sql ); 
                }
                if(isset($_POST['refresh'])){
                    echo "<meta http-equiv=\"refresh\" content=\"0;URL=SuperAdminDost.php\">";
                }
                if(isset($_POST["dodaj"])){
                    if (!empty($_POST['text'])){
                    $sql="INSERT INTO `dostosowania`(`id_dost`, `text`,`id_kat`) VALUES ('','".$_POST["text"]."','".$_POST["id_kat"]."');";
                    mysqli_query( $_SESSION['con'], $sql); 
                    $sql = "SELECT `id_dost` FROM `dostosowania` WHERE `text`= '".$_POST["text"]."'and `id_kat` = '".$_POST["id_kat"]."';";
                    $result1 = mysqli_query( $_SESSION['con'], $sql); 
                    if($result1){
                        while($row = mysqli_fetch_array($result1)){
                            $sql = "DELETE FROM `npspr_dost` WHERE `id_dost` = ".$row['id_dost']." AND `id_npspr` = ".$_POST['npspr'].";";
                            mysqli_query( $_SESSION['con'], $sql); 
                            $sql = "INSERT INTO `npspr_dost`(`id`, `id_npspr`, `id_dost`) VALUES ('','".$_POST['npspr']."','".$row['id_dost']."');";
                            mysqli_query( $_SESSION['con'], $sql); 
                        }
                    }
                    }else{
                        echo "Podaj wszystkie dane";
                    }
                    //echo "<meta http-equiv=\"refresh\" content=\"0;URL=SuperAdminDost.php\">";
                }

                $sql = "SELECT * FROM `dostosowania` join `npspr_dost` using(`id_dost`) join `npspr` using(id_npspr) join `kategoria` using(`id_kat`) order by `nazwa`;";      
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
                                <tr><form action="SuperAdminDost.php" method="post">
                                    <td class="'.$klasa.'"><select class="input_pole" name="npspr">';
                                            $sql="SELECT * FROM `npspr` WHERE 1;";;
                                            $result1 = mysqli_query( $_SESSION['con'], $sql ); 
                                            if($result1){
                                                while($row1 = mysqli_fetch_array($result1)){
                                                    if($row['id_npspr'] == $row1['id_npspr']){
                                                        echo "<option selected value=".$row1['id_npspr'].">".$row1['nazwa']."</option>";
                                                    }else{
                                                        echo "<option value=".$row1['id_npspr'].">".$row1['nazwa']."</option>";
                                                    }
                                                    
                                                }
                                            }
                            echo'</select></td>
                            <td class="'.$klasa.'"><input class="input_pole" name="text" value="'.$row["text"].'"></td> 
                            <td class="'.$klasa.'"><select class="input_pole" name="id_kat">';
                                $sql="SELECT * FROM `kategoria` WHERE 1;";;
                                $result1 = mysqli_query( $_SESSION['con'], $sql ); 
                                if($result1){
                                    while($row1 = mysqli_fetch_array($result1)){
                                        if($row['id_kat'] == $row1['id_kat']){
                                            echo "<option selected value=".$row1['id_kat'].">".$row1['nazwa_kat']."</option>";
                                        }else{
                                            echo "<option value=".$row1['id_kat'].">".$row1['nazwa_kat']."</option>";
                                        }
                                    }
                                }
                            echo'</select></td>
                            <input type="hidden" name="id" value='.$row['id_dost'].' />
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