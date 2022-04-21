<?php

setcookie("wsp1-user", "Tobias", 86400);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php
    if(!isset($_COOKIE["wsp1-user"])){
        echo "<p>Kakan är inte satt.</p>";
    }else{
        echo "<p>Kakan har värdet " . $_COOKIE["wsp1-user"];
    }
?>

</body>
</html>