<?php
    // create short variable names
    $tireqty = $_POST['tireqty'];
    $oilqty = $_POST['oilqty'];
    $sparkqty = $_POST['sparkqty'];
    $notes = $_POST['notes'];
    $find = $_POST['find'];

    $error = 0;
    if ($tireqty < 0 || $oilqty < 0 || $sparkqty < 0) {
        $error++;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Bob's Auto Parts - Order Results</title>
</head>
<body>
    <h1>Bob's Auto Parts</h1>
    <h2>Order Results</h2>

    <?php
    echo "<p>Order processed at ";
    echo date('H:i, jS F Y');
    echo "</p>";

    echo '<p>Your order is as follows: </p>';

    echo htmlspecialchars($tireqty).' tires<br />';
    echo htmlspecialchars($oilqty).' bottles of oil<br />';
    echo htmlspecialchars($sparkqty).' spark plugs<br />';
    echo 'Customer notes: ' . htmlspecialchars($notes) . '<br />';

    $findArray = array(
        'a' => 'I\'m a regular customer',
        'b' => 'TV advertising',
        'c' => 'Phone directory',
        'd' => 'Word of mouth',
    );
    echo "Found by: " . $findArray[$find] . '<br /><br />';

    echo 'Type of each variable: <br />';
    echo 'tireqty: ' . gettype($tireqty) . '<br />';
    echo 'oilqty: ' . gettype($oilqty) . '<br />';
    echo 'sparkqty: ' . gettype($sparkqty) . '<br />';
    echo 'notes: ' . gettype($notes) . '<br /><br />';

    $tireqty = (int)$tireqty;
    $oilqty = (int)$oilqty;
    $sparkqty = (int)$sparkqty;

    echo 'The type of each variable after converting tireqty, oilqty, and sparkqty to an int:<br />';
    echo 'tireqty: ' . gettype($tireqty) . '<br />';
    echo 'oilqty: ' . gettype($oilqty) . '<br />';
    echo 'sparkqty: ' . gettype($sparkqty) . '<br />';
    echo 'notes: ' . gettype($notes) . '<br />';

    $totalamount = 0.00;
    define('TIREPRICE', 100);
    define('OILPRICE', 10);
    define('SPARKPRICE', 4);

    $totalqty = 0;
    $totalqty = $tireqty + $oilqty + $sparkqty;
    $totalamount = $tireqty * TIREPRICE
                 + $oilqty * OILPRICE
                 + $sparkqty * SPARKPRICE;

    if ($error > 0) {
        echo "Error: Quantity can't be negative.<br />";
    } else if ($totalqty === 0) {
        echo "Error: Total quantity can't be zero.<br />";
    } else {
        echo "<p>Items ordered: " . $totalqty . "<br />";

        echo "Subtotal: $" . number_format($totalamount, 2) . "<br />";
        $taxrate = 0.10;  // local sales tax is 10%
        $totalamount = $totalamount * (1 + $taxrate);
        echo "Total including tax: $" . number_format($totalamount, 2) . "</p>";
    }

    ?>
</body>
</html>
