<?php
include 'conn.php';

if(isset($_SESSION['edycja'])){
    $_SESSION['dost'] = [];
    unset($_SESSION['edycja']);
    unset($_SESSION['uwagi']);
}
?>
<html lang="pl">
<head>
    <script src="jquery-3.7.1.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Uczen</title>
    <link rel="stylesheet" href="style.css">
</head>
<script src="przedmiotyJS.js"></script>
<script src="zapisy.js"></script>
<body>
    <div class="header">
        <h1>Wybierz ucznia</h1>
    </div>
    <div class="middle">
    <br>
    <p>Udało ci sie zalogować! Twoja rola to <?php echo $_SESSION['rola']?></p>
    <a class="button-13" href="Logowanie.php">Wróć</a><br><br>
    <?php
        if($_SESSION['rola'] == "Pedagog"){
            echo '<a class="button-13" href="AdminPanel.php">Panel</a><br><br>';
        }
    ?>
    <p>Wybierz ucznia:</p>
    <form method="post" action="Dostosowania.php">
        <select name="uczen">
            <?php
                    $sql = "SELECT * FROM `uczniowie` join `klasy` USING(`id_klasa`) WHERE `id_klasa` in (SELECT `id_klasa` from `klasy` join `user_klasa` using(`id_klasa`) where `id_user` = ".$_SESSION['user'].");";             
                    $result = mysqli_query( $_SESSION['con'], $sql ); 
                if($result){
                    while($row = mysqli_fetch_array($result)){
                        echo "<option value=".$row['id_ucznia'].">".$row['imie']." ".$row['nazwisko']." ".$row['numer']."</option>";
                    }
                }else{
                    echo "Nie ma żadnych rekordó albo coś jest źle :<";
                }
                if(isset($_SESSION['sprawdz'])){
                    echo " Prosze wybrać co najmniej jeden przedmiot!";
                    unset($_SESSION['sprawdz']);
                }
            ?>
          </select><br>
          <br><p>Wybierz przedmiot:</p>
          <select id="przedmiot" name="przedmiot" onchange="przedmiotyfunc(this.value)">
          <option value="" selected disabled hidden>Wybierz przedmiot:</option>
            <?php
                $sql = "SELECT * FROM `przedmiot` ;";
                $result = mysqli_query( $_SESSION['con'], $sql ); 
                if($result){
                    while($row = mysqli_fetch_array($result)){
                        if(isset($_SESSION['przedmiot_id'])){
                            echo "<option value=".$row['id_przedmiot'].">".$row['nazwa']."</option>";
                        }else{
                            echo "<option value=".$row['id_przedmiot'].">".$row['nazwa']."</option>";
                        }
                       
                    }
                }else{
                    echo "Nie ma żadnych rekordó albo coś jest źle :<";
                }
                
            ?>
          </select><br><br>
          <input  class="button-13"  type="submit" name="Wybierz" onclick="sprawdz()" value="Wybierz">
    </form>
    <p id="przedm">
    <?php
    if(isset($_SESSION['przedmiot_id'])){
        foreach($_SESSION['przedmiot_id'] as $key => $value){
            $sql="SELECT * FROM `przedmiot` WHERE `id_przedmiot` = ".$value." ;";
                $result = mysqli_query( $_SESSION['con'], $sql );
                if($result){
                    while($row = mysqli_fetch_array($result)){
                        echo "<div class='przedmiot' id=".$row['id_przedmiot']."> <button style='width:105px;' class='button-13' onClick='usunPrzedmiot(".$row['id_przedmiot'].")'>".$row['nazwa']."</button></div> ";
                    }
                } 
        }
    }
    if (isset($_SESSION['odp'])) {
        echo $_SESSION['odp']."<br>";
        unset($_SESSION['odp']);
    }
    ?>
    </p>
    <h2>Wcześniejsze dokumenty : </h2>
    <div id="zapis">
    <?php
        $sql = "SELECT *,zapisy.rok_szkolny as rok FROM `zapisy` join `uczniowie` using(`id_ucznia`) where `id_user` = ".$_SESSION['user'].";";      
        $p=0;
        $klasa = "komorka1";
        $result = mysqli_query($_SESSION['con'], $sql);
        if($result && mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_array($result)){
                if($p % 2 == 0){
                    $klasa = "komorka1";
                }else{
                    $klasa = "komorka2";
                }
                    echo '<div class="zapis" id="'.$row['id_zapis'].'">
                    <table class="tabelarekord">
                        <tr class="rekord">
                            <td class="'.$klasa.'" style="width:10%;">'.$row["rok"].'</td>
                            <td class="'.$klasa.'">'.$row["imie"].' '.$row["nazwisko"].'</td> 
                            <td class="'.$klasa.'">';
                            $przedmiot_id = $row['id_przedmiot']."|";
                            $przedm1 = "";
                            for($i = 1;$i<strlen($przedmiot_id);$i++){
                                if($przedmiot_id[$i] != "|" && $przedmiot_id[$i]!=""){
                                    $przedm1 = $przedm1.$przedmiot_id[$i];
                                }else{
                                    $sql="SELECT * FROM `przedmiot` WHERE `id_przedmiot` = ".$przedm1." ;";
                                    $result1 = mysqli_query( $_SESSION['con'], $sql );
                                    if($result1){
                                        while($row1 = mysqli_fetch_assoc($result1)){
                                            echo $row1['nazwa'].", ";
                                        }
                                    } 
                                    $przedm1 = "";
                                }
                            }
                    echo'</td> 
                    <td class="'.$klasa.'">'.$row["data"].'</td>
                    <td class="'.$klasa.'" >
                    <button class="button-13"  onClick="usunZapis('.$row['id_zapis'].')">Usun</button>
                    <button class="button-13"  onClick="wczytajZapis('.$row['id_zapis'].')">Wczytaj</button>
                    <button class="button-13"  onClick="edytujZapis('.$row['id_zapis'].')">Edytuj</button>
                    </td>
                    </tr>
                    </table>
                    </div>';
                $p++;
            }
        }else{
            echo"Nie ma żadnych zapisów";
        }
    ?>
    </div>
    </div>
    <div class="footer">

    </div>
</body>
</html>