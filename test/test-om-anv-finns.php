<?php
    //Hämta hemliga värden
    require("../includes/settings.php");
 
    //Testa om det går att ansluta till databasen
    try {
        //Skapa anslutningsobjekt
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbuser, $dbpw);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Förbered SQL-kommando
        $sql = "SELECT username FROM users WHERE username='ntitobias5'  LIMIT 1";
        $stmt = $conn->prepare($sql);
        //Skicka frågan till databasen
        $stmt->execute();
 
        // Ta emot resultatet från databasen
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
 
        $row1 = $stmt->fetch();
        if(empty($row1))
            echo "Användaren finns inte.";
        else
            echo "Användaren finns.";
    }
    catch(PDOException $e) {
        //Om något i anslutningen går fel
        echo "Error: " . $e->getMessage();
    }
    //Stäng anslutningen
    $conn = null;
?>
