<?php
    include 'conn.php';
?>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<div class="header">
    <h1>Koniec</h1>
</div>
<div class="middle">
    <br>
<p> Dokument został utworzony.</p>
<a class="button-13" href="uczen.php">Wróć</a><br><br>
<?php
$_SESSION['uwagi'] = $_POST['uwagi'];
?>
<script>
    window.onload = function(){
            window.open("testpdf.php", "_blank"); 
        }
</script>
</div>
<div class="footer">

</div>
<body>
    
</body>
</html>