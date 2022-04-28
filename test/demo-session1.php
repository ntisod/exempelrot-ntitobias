<?php session_start();?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sessioner 1</title>
    <style>
        div{background-color: pink;}
        nav ul{
            color:purple;
        }
    </style>
</head>
<body>

<div>
<?php
    //Visa meny
    include "demo-session-menu.php";
    //Spara sessionsvariabler
    $_SESSION["favcolor"] = "grön";
    $_SESSION["favanimal"] = "hund";
    echo "Sessionsvariabler satta.";
?>
</div>
</body>
</html>