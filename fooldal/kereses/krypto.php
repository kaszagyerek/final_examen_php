<?php
require_once "connection.php";

if (isset($_POST['lekerdezi'])) {

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.coinranking.com/v2/coins/",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "x-api-key: coinranking75ff28e7df9b412035d559c3ff9dab9ea9e4f95ce351aa94"
        ],
    ]);
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        echo $response;
    }


    $obj = json_decode($response, TRUE);
    $coins = $obj['data']['coins'];

    foreach ($coins as $product) {
        $cryptosymbol = $product["symbol"];
        $lastprice = $product["price"];
        $cryptoimg = $product["iconUrl"];
        $marketCap = $product["marketCap"];
        $rank = $product["rank"];
        $cryptoname = $product["name"];
        $color = $product["color"];


        $sql = "INSERT INTO `crypto` (cryptosymbol, lastprice, cryptoimg, marketCap, rank, cryptoname, color) VALUES
                 ( '$cryptosymbol','$lastprice','$cryptoimg','$marketCap','$rank','$cryptoname','$color');";

        if ($con->query($sql) === TRUE) {
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    }

    if (isset($_POST['torli'])) {
        $sql = "DELETE FROM crypto";

        if ($con->query($sql) === TRUE) {
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
        $sql = "ALTER TABLE  crypto AUTO_INCREMENT = 1";
        $gereset = mysqli_query($con, $sql);

    }
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

