<?php
include 'conn.php';
include 'errorHandler.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>AdminPanel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <h1>Admin Panel</h1>
    </div>
    <div class="middle">
    <br><a class="button-13" href="Logowanie.php">Logowanie</a>
    <a class="button-13" href="uczen.php">Uczen</a><br><br>
    <form method="post" action="Admin2.php">
        <select name="uczen">
            <?php

                $sql = "SELECT * FROM `uczniowie` ;";
                $result = mysqli_query( $_SESSION['con'], $sql ); 
                if($result){
                    while($row = mysqli_fetch_array($result)){
                        echo "<option value=".$row['id_ucznia'].">".$row['imie']." ".$row['nazwisko']." ".$row['klasa']."</option>";
                    }
                }else{
                    echo "Nie ma żadnych rekordów albo coś jest źle :<";
                }
            ?>
          </select><br>
          <input class="button-13" type="submit" name="Wybierz" value="Wybierz">
    </form>
    </div>
    <div class="footer">

    </div>
</body>
</html>