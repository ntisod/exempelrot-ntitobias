<?php
function add_ten(&$value){
    $value += 10;
}

$num=5;
add_ten($num);
echo $num;
