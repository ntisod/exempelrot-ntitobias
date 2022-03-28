<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reg-formulär</title>
  <style>
    .error{background-color: #ff0000;color: #ffd;}
  </style>
</head>
<body>
  

<h1>Registrering</h1>

<?php
// define variables and set to empty values
$name = $email = $gender = $comment = $website = "";
$nameErr = $emailErr = $genderErr = $websiteErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if(empty($_POST["name"])){
    $nameErr = "Du måste ange namn!";
  } else{
  $name = test_input($_POST["name"]);
  }    
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
  }

  if (empty($_POST["website"])) {
    $website = "";
  } else {
    $website = test_input($_POST["website"]);
  }

  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }

}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <p>Namn: <input type="text" name="name"><span class="error">*<?php echo $nameErr;?></span></p>
    <p>E-post: <input type="text" name="email"><span class="error">*<?php echo $emailErr;?></span></p>
    <p>Webbsajt: <input type="text" name="website"><span class="error"><?php echo $websiteErr;?></span></p>
    <p>Kommentar: <textarea name="comment" rows="5" cols="40"></textarea></p>
    <p>Kön:
    <input type="radio" name="gender" value="female">Kvinna
    <input type="radio" name="gender" value="male">Man
    <input type="radio" name="gender" value="other">Annat<span class="error">*<?php echo $genderErr;?></span></p>
    <p><input type="submit"></p>
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $name;
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
