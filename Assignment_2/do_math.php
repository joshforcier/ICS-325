<?php

require_once('add.php');
require_once('subtract.php');

$array_one = array(3, 4, 9, 1, 3, 4);
$array_two = array(28, 92, 6, -4, 1, 4);

for ($i = 0; $i < count($array_one); $i++) {
    echo 'Arguments: ' . $array_one[$i] . ' and ' . $array_two[$i] . '<br />';
    echo 'Sum: ' . add_two_numbers($array_one[$i], $array_two[$i]) . '<br />';
    echo 'Difference: ' . subtract_two_numbers($array_one[$i], $array_two[$i]) . '<br /><br />';
}