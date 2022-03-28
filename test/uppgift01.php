<?php
header("Content-type: text/html; charset=utf-8");
if(empty($_GET['namn'])){
    echo '<h1>Välkommen!</h1>';
}
else{
    $namn=filter_input(INPUT_GET, 'namn');
    echo "<h1>Välkommen till {$namn}s webbsida!</h1>";
    echo "<p>Namnet $namn innehåller ", strlen($namn), " tecken.<p>";
    echo "<p>Namnet $namn består av ", str_word_count($namn), " ord.";

}

