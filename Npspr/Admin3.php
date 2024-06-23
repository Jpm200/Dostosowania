<?php
    include 'conn.php';
    include 'errorHandler.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Objawy</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <h1>Dodano npspr do ucznia </h1>
    </div>
    <div class="middle">
        <?php
            foreach($_POST as $num =>$id){
                if($num!="Wybierz"){
                    $sql = "DELETE FROM `uczn_npspr` WHERE `id_ucznia` = ".$_SESSION['uczen_id']." and `id_npspr` = ".$id.";";
                    $result = mysqli_query( $_SESSION['con'], $sql ); 
                    $sql = "INSERT INTO `uczn_npspr`(`id`,`id_ucznia`, `id_npspr`) VALUES ('',".$_SESSION['uczen_id'].",".$id.");";
                    $result = mysqli_query( $_SESSION['con'], $sql ); 
                }
            }
            echo "<br>Dodano npspr do ucznia!<br><br>";
        ?>
    <a class="button-13" href="uczen.php">Uczen</a>
    <a class="button-13"  href="AdminPanel.php">Panel</a>
    <a class="button-13"  href="Logowanie.php">Logowanie</a>
    </div>
    <div class="footer">

    </div>
</body>
</html>