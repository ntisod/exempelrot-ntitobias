<?php
$cookiename="wsp1-user";
setcookie($cookiename, "Tobias", time() + 60*5, "/");
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
    if(!isset($_COOKIE[$cookiename])){
        echo "<p>Kakan är inte satt.</p>";
    }else{
        echo "<p>Kakan har värdet " . $_COOKIE[$cookiename];
    }
?>

</body>
</html>