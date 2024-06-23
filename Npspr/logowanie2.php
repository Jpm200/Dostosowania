<?php
    include 'conn.php';
    include 'errorHandler.php';
    if(isset($_SESSION['przedmiot_id'])){
        unset($_SESSION['przedmiot_id']);
    }
    if(isset($_POST['Zaloguj'])){
        $sql="SELECT * FROM `user` WHERE `haslo` LIKE '".md5($_POST['haslo'])."' and `id` = ".$_POST['nazwa'].";";
        $result = mysqli_query( $_SESSION['con'], $sql ); 
        if(mysqli_num_rows($result) >=1){
            while($row = mysqli_fetch_array($result)){
                $_SESSION['user'] = $_POST['nazwa'];
                $_SESSION['rola'] = $row['rola'];  
            }
            if($_SESSION['rola']=="Pedagog"){
                header('Location: AdminPanel.php'); 
            }else if($_SESSION['rola']=="superadmin"){
                header('Location: SuperAdminPanel.html'); 
            }else{
               header('Location: uczen.php'); 
            }
            
        }else{
            $_SESSION['odp'] = "Nie udało sie zalogować!";
            header('Location: Logowanie.php');
        }    
    }
?>