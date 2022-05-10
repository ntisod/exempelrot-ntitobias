<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrera ny användare</title>
    <style>
        .error {color: #900;}
    </style>
</head>
<body>
    
<?php
// define variables and set to empty values
$fnameErr = $lnameErr = $emailErr = $genderErr = $websiteErr = $pwErr = $pwTestErr = $usernameErr = "";
$fname = $lname = $email = $gender = $comment = $website = $pw = $pwTest = $username = "";
//Antal fel
$errors = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["username"])) {
    $usernameErr = "Du måste skriva användarnamn";
    $errors++;
  } else {
    $username = test_input($_POST["username"]);
    // check if name only contains letters, numbers and underscores
    if (!preg_match("/^[a-zA-Z-_åäöÅÄÖ0123456789]*$/",$username)) {
      $usernameErr = "Endast bokstäver, siffor och understrykning.";
      $errors++;
    }
  }

/*
  if (empty($_POST["pw"])) {
    $pwErr = "Du måste ange lösenord.";
    $errors++;
  } else {
    if($_POST["pw"]!=$_POST["pwTest"]){
      $pwErr = "Du måste skriva samma lösenord på båda raderna.";
      $errors++;  
    }
  }
*/

  if (empty($_POST["fname"])) {
    $fnameErr = "Du måste skriva namn.";
    $errors++;
  } else {
    $fname = test_input($_POST["fname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' åäöÅÄÖ]*$/",$fname)) {
      $fnameErr = "Endast bokstäver och mellanslag tillåtet.";
      $errors++;
    }
  }

  if (empty($_POST["lname"])) {
    $lnameErr = "Du måste skriva namn";
    $errors++;
  } else {
    $lname = test_input($_POST["lname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' åäöÅÄÖ]*$/",$lname)) {
      $lnameErr = "Endast bokstäver och mellanslag tillåtet.";
      $errors++;
    }
  }

  if (empty($_POST["email"])) {
    $emailErr = "Du måste skriva e-post.";
    $errors++;
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Felaktigt e-post-format.";
      $errors++;
    }
  }
    
  if (empty($_POST["website"])) {
    $website = "";
  } else {
    $website = test_input($_POST["website"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
      $websiteErr = "Felaktig URL";
      $errors++;
    }
  }

  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Kön måste anges.";
    $errors++;
  } else {
    $gender = test_input($_POST["gender"]);
  }

  echo "Antal fel: $errors" ;
    
  //Kontrollera om det inte finns errors
  if($errors<1){
    //Skicka data till databasen
    require("..\includes\settings.php");
    $dbname = "wsp1ex";

    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbuser, $dbpw);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "INSERT INTO users (`username`) VALUES ('$username');";
      // use exec() because no results are returned
      $conn->exec($sql);
      echo "New record created successfully";
    } catch(PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }

      $conn = null;
    //Gå till välkommen-sida
    header("welcome.php");
  }

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
} 

?>

<h2>Registrera ny användare</h2>
<p><span class="error">* Obligatorisk uppgift</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  
  <p>
    <label for="username"> Användarnamn:</label> 
    <input type="text" name="username" value="<?php echo $username;?>">
    <span class="error">* <?php echo $usernameErr;?></span>
  </p>
  
  <p>
    <label for="pw"> Lösenord:</label> 
    <input type="password" name="pw" value="<?php echo $pw;?>">
    <span class="error">* <?php echo $pwErr;?></span>
  </p>

  <p>
    <label for="pwTest"> Lösenord en gång till:</label> 
    <input type="password" name="pwTest" value="<?php echo $pwTest;?>">
    <span class="error">* <?php echo $pwTestErr;?></span>
  </p>


  <p>
    <label for="fname"> Förnamn:</label> 
    <input type="text" name="fname" value="<?php echo $fname;?>">
    <span class="error">* <?php echo $fnameErr;?></span>
  </p>
  <p>
    <label for="lname"> Efternamn:</label> 
    <input type="text" name="lname" value="<?php echo $lname;?>">
    <span class="error">* <?php echo $lnameErr;?></span>
  </p>
  E-mail: <input type="text" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  Website: <input type="text" name="website" value="<?php echo $website;?>">
  <span class="error"><?php echo $websiteErr;?></span>
  <br><br>
  Comment: <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
  <br><br>
  Gender:
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">Other  
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $fname;
echo "<br>";
echo $lname;
echo "<br>";
echo $email;
echo "<br>";
echo $website;
echo "<br>";
echo $comment;
echo "<br>";
echo $gender;



?>

</body>
</html>

