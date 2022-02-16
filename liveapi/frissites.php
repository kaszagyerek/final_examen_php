<?php

define("INTERVAL", 5000);

function runIt()
{ // Your function to run every 5 seconds
    $url = 'https://api2.binance.com/api/v3/ticker/24hr';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response_json = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response_json, true);
    $products = $response;
    $con = mysqli_connect("localhost", "root", "", "social");
    if (mysqli_connect_errno()) {
        echo "Hibás csatlakozás" . mysqli_connect_errno();
    }

    $sql1 = "DELETE FROM crypto";

    if ($con->query($sql1) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
    $sql1 = "ALTER TABLE  crypto AUTO_INCREMENT = 1";

    if ($con->query($sql1) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
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

function frisites()
{
    $active = true;
    $nextTime = microtime(true) + INTERVAL; // Set initial delay

    while ($active) {
        usleep(20); // optional, if you want to be considerate

        if (microtime(true) >= $nextTime) {
            runIt();
            $nextTime = microtime(true) + INTERVAL;
        }
    }
}

frisites();