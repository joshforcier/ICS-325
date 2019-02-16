<?php

$fruits = array(
    0 => 'Pear',
    1 => 'Apple',
    2 => 'Grape',
    3 => 'Banana',
    4 => 'Mango'
);
echo 'print_r output of the Fruit array:<br />';
echo '<pre>'; print_r($fruits); echo '</pre>';

echo 'Fruit array printed with a for loop:<br />';
for ($i = 0; $i <= count($fruits); $i++) {
    echo $fruits[$i] . '<br />';
}

asort($fruits);

echo 'Sorted Fruit array printed with a foreach loop:<br />';
foreach ($fruits as $fruit) {
    echo $fruit . '<br />';
}

echo '<br />';
$fruits[] = 'Cherry';
echo 'Fruit array with Cherry appended printed with a foreach loop:<br />';
foreach ($fruits as $fruit) {
    echo $fruit . '<br />';
}

$veggies = array(
    'Carrot' => 'crunchy',
    'Pea' => 'soft',
    'Broccoli' => 'green',
    'Asparagus' => 'thin'
);

echo '<br />';
echo 'print_r output of the Veggies array:<br />';
echo '<pre>'; print_r($veggies); echo '</pre>';

echo 'Sorted by key Veggies array printed with a foreach loop:<br />';
ksort($veggies);
foreach ($veggies as $key => $veggie) {
    echo $key . ' is ' . $veggie . '<br />';
}

echo '<br />';
echo 'Sorted by value Veggies array printed with a foreach loop:<br />';
asort($veggies);
foreach ($veggies as $key => $veggie) {
    echo $key . ' is ' . $veggie . '<br />';
}

echo '<br />';
echo 'Veggies array with Radish appended printed with a foreach loop:<br />';
$veggies['Radish'] = 'red';
foreach ($veggies as $key => $veggie) {
    echo $key . ' is ' . $veggie . '<br />';
}

$food = array(
    'Fruit' => $fruits,
    'Veggies' => $veggies
);

echo '<pre>'; print_r($food); echo '</pre>';
echo 'The value for $food[\'Veggies\'][\'Carrot\'] is: ' . $food['Veggies']['Carrot'];
