<html lang="pl">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Logowanie</title>
</head>
<body>
    <div class="header">
        <h1>Logowanie</h1>
    </div>
    <div class="middle">
        <?php
            include 'conn.php';
            include 'errorHandler.php';
            unset($_SESSION['dost']);
            unset($_SESSION['user']);
            unset($_SESSION['przedmiot_id']);
            unset($_SESSION['uwagi']);
            if (isset($_SESSION['odp'])) {
                echo "<p class='alert'>".$_SESSION['odp']."<p><br>";
                unset($_SESSION['odp']);
            }

        ?>
        <br>
        <form method="post" action="logowanie2.php">
            Imie i nazwisko : <select name="nazwa">
                <?php
                    $sql="SELECT * FROM `user` WHERE 1;";;
                    $result = mysqli_query( $_SESSION['con'], $sql ); 
                    if($result){
                        while($row = mysqli_fetch_array($result)){
                            echo "<option value=".$row['id'].">".$row['imie']." ".$row['nazwisko']."</option>";
                        }
                    }else{
                        echo "Nie ma żadnych rekordó albo coś jest źle :<";
                    }
                ?>
            </select><br>
            Hasło : <input name="haslo" ><br>
            <input type="submit" name="Zaloguj" class="button-13" value="Zaloguj">
        </form>
    </div>
    <div class="footer">

    </div>
</body>
</html>