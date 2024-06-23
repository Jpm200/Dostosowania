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
<?php         
                if(isset($_POST["zapisz"])){
                    $sql = "UPDATE `rok_szkolny` SET `rok`='".$_POST['rok']."' WHERE 1;";
                    mysqli_query( $_SESSION['con'], $sql ); 
                }
                if(isset($_POST['refresh'])){
                    echo "<meta http-equiv=\"refresh\" content=\"0;URL=SuperAdminRok.php\">";
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