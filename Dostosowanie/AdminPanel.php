<?php
include 'conn.php';
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminPanel</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="AdminJS.js"></script>
</head>
<body>
    <div class="header">
        <h1>Admin Panel</h1>
    </div>
    <div class="middle">
    <br><a class="button-13" href="Logowanie.php">Logowanie</a>
    <a class="button-13" href="uczen.php">Uczen</a><br><br>
    <button class="button-13" onClick="refresh()">Odśwież stronę</button>
    <div class="dodawanie">
                <form method="post" id="dodaj">
                    <table class="tabelarekord">
                        <tr>
                        <td class="komorka1">Uczeń : <br><select class="input_pole" name="uczen">
                            <?php
                                $sql="SELECT * FROM `uczniowie` WHERE 1";;
                                $result = mysqli_query( $_SESSION['con'], $sql ); 
                                if($result){
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<option value=".$row['id_ucznia'].">".$row['imie']." ".$row['nazwisko']."</option>";
                                    }
                                }
                            ?>
                            </select></td>
                        <td class="komorka1">Niepełnosprawność : <br><select class="input_pole" name="npspr">
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
                            <input name="dodaj" type="hidden" value="1"></td>
                            <td class="komorka1" > <button class="button-13" onClick="dodaj1()">Dodaj</button></td>
                        </tr>
                    </table>                                                                  
                </form>
            </div>
<?php         
                $sql = "SELECT * FROM `uczniowie` WHERE 1";
                $result = mysqli_query($_SESSION['con'], $sql);
                while($row = mysqli_fetch_assoc($result)){
                    echo $row['imie']." ".$row['nazwisko']."<br>";
                    $sql = "SELECT * FROM `uczn_npspr` join `npspr` USING(`id_npspr`) WHERE `id_ucznia` = ".$row['id_ucznia'].";";
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
                        <tr><form method="post" id="'.$row1['id_npspr'].'">
                        <td class="'.$klasa.'"><select class="input_pole" name="npspr">';
                                $sql="SELECT * FROM `npspr` WHERE 1;";;
                                $result2 = mysqli_query( $_SESSION['con'], $sql ); 
                                if($result2){
                                    while($row2 = mysqli_fetch_array($result2)){
                                        if($row2['id_npspr'] == $row1['id_npspr']){
                                            echo "<option selected value=".$row2['id_npspr'].">".$row2['nazwa']."</option>";
                                        }else{
                                            echo "<option value=".$row2['id_npspr'].">".$row2['nazwa']."</option>";
                                        }
                                    }
                                }
                        echo'</select></td>
                        <td class="'.$klasa.'"><input type="hidden" name="uczen" value='.$row['id_ucznia'].' />
                        <input type="hidden" name="npspr_id" value='.$row1['id_npspr'].' />
                        <input type="hidden" name="Zapisz" value=1 />
                        <button class="button-13" onClick="usun('.$row1['id_npspr'].','.$row['id_ucznia'].')">Usuń</button>
                        <button class="button-13" onClick="zapisz('.$row1['id_npspr'].')">Edytuj</button>
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