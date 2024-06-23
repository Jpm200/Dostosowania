<?php
    include 'conn.php';
    include 'errorHandler.php';
    if(!isset($_SESSION['uczen_id'])){
        $_SESSION['uczen_id'] =$_POST['uczen']; 
    }
    if(isset($_POST['Wybierz'])){
        $_SESSION['uczen_id'] =$_POST['uczen']; 
    }
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
        <h1>Wybierz </h1>
    </div>
    <div class="middle">
    <form method="post" action="Admin3.php"> 
        <?php
            $sql = "SELECT * FROM `npspr`;";
            $result = mysqli_query( $_SESSION['con'], $sql ); 
            $i=0;
            if($result){
                while($row = mysqli_fetch_array($result)){
                    echo "<input class='checkbox-all' type='checkbox' name=".$i." value=".$row['id_npspr'].">".$row['nazwa']."<br>";   
                    $i++;
                }
            }
        ?>
        <input class="button-13" type="submit" name="Wybierz" value="Wybierz">
    </form> 
    <br><a class="button-13" href="AdminPanel.php">Wróć</a><br>
    </div>
    <div class="footer">

    </div>
</body>
</html>