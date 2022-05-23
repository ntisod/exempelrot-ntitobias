<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo $title ?></title>
    <!-- Load an icon library to show a hamburger menu (bars) on small screens -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Min Coola Sajt</h1>
    <div class="topnav" id="myTopnav">
        <a href="." class="active">Hem</a>
        <a href="login.php">Logga in</a>
        <a href="reg.php">Registrera</a>
        <a href="logout.php">Logga ut</a>
        <a href="#about">About</a>
        <a href="javascript:void(0);" class="icon" onclick="hideTopNav()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
    
