<?php
require_once "../log_reg/connection.php";


if (isset($_POST['lekerdezi'])) {
    $url = 'https://api2.binance.com/api/v3/ticker/24hr';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response_json = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response_json, true);
    $products = $response;
    foreach ($products as $product) {
        $sym = $product["symbol"];
        $price = $product["lastPrice"];

        $sql = "INSERT INTO `crypto` (cryptosymbol, lastprice) VALUES ( '$sym','$price');";

        if ($con->query($sql) === TRUE) {
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    }
}

if (isset($_POST['torli'])) {
    $sql = "DELETE FROM crypto";

    if ($con->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
    $sql1 = "ALTER TABLE  crypto AUTO_INCREMENT = 1";
    $gereset = mysqli_query($con, $sql1);

}

/*
define("INTERVAL", 50 ); // 1 óra

function runIt() { // Your function to run every 5 seconds
    $url = 'https://api2.binance.com/api/v3/ticker/24hr';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response_json = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response_json, true);
    $products = $response;

    foreach ($products as $product) {
        $sym = $product["symbol"];
        $price = $product["lastPrice"];
        $sql = "UPDATE `crypto` SET `cryptosymbol`='$sym',`lastprice`='$price'";

        if ($con->query($sql) === TRUE) {
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }

    }

}
function frisites()
{
    $active = true;
    $nextTime = microtime(true) + INTERVAL; // Set initial delay

    while ($active) {
        usleep(1000); // optional, if you want to be considerate

        if (microtime(true) >= $nextTime) {
            runIt();
            $nextTime = microtime(true) + INTERVAL;
        }
    }
}

frisites();
*/
?>


<form method="post">
    <input type="submit" name="lekerdezi" class="button" value="lekerdezi"/>
    <input type="submit" name="torli" class="button" value="torli"/>

</form>

