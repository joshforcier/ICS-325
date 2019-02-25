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

        if (file_exists("orders.txt") && is_readable("orders.txt")) {
            $orders = fopen("orders.txt", "w") or die(print_r(error_get_last(), true));;
        }

        $date = new \DateTime();
        $date = $date->format('H:i, jS F Y');
        if (flock($orders, LOCK_EX)) {
            fputs($orders, "$date, $tireqty, $oilqty, $sparkqty, $totalamount, $find, $notes\n");
            fflush($orders);
            flock($orders, LOCK_UN);
        } else {
            echo "Error";
        }

        fclose($orders);

        echo "Order was successfully placed.<br />";

        $fp = fopen("orders.txt",'rb');
        if (flock($fp, LOCK_EX)) {

            while(!feof($fp)) {
                $c = fgetc($fp);
                trim($c, "\n");
                $array = explode(" ", $c);
                list($day, $tireQty, $oilQty, $sparkQty, $totalCost, $findArray[$find], $notes) = $c;
            }

            echo "Date: " . $date . "<br />";
            echo "Tire Qty: " . $tireqty . "<br />";
            echo "Oil Qty: " . $oilqty . "<br />";
            echo "Spark Qty: " . $sparkqty . "<br />";
            echo "Total Cost: " . $totalamount . "<br />";
            echo "How did you find Bob's?: " . $findArray[$find] . "<br />";
            echo "Notes: " . $notes;

            flock($fp, LOCK_UN);
        }

        fclose($fp);
    }

    ?>
</body>
</html>
