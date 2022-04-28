<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
//Visa meny
include "demo-session-menu.php";

// remove all session variables
session_unset();
?>

</body>
</html>