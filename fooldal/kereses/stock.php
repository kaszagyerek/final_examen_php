<?php
require_once "connection.php";


if (isset($_POST['lekerdezi'])) {
    /*
    $url = 'https://house-stock-watcher-data.s3-us-west-2.amazonaws.com/data/all_transactions.json';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response_json = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response_json, true);
    $products = $response;
    foreach ($products as $product) {

        $tikcer = $product["ticker"];
        $asset_description = $product["asset_description"];

        $sql = "INSERT INTO `stocks` (stockname, stocksymbol) VALUES ( '$asset_description','$tikcer');";

        if ($con->query($sql) === TRUE) {
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    } */

    set_time_limit(0);

    $url_info = "https://financialmodelingprep.com/api/v3/quote/AAPL,FB,GOOG?apikey=ce47caa60855cdc17aac857a4bb987af";

    $channel = curl_init();

    curl_setopt($channel, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($channel, CURLOPT_HEADER, 0);
    curl_setopt($channel, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($channel, CURLOPT_URL, $url_info);
    curl_setopt($channel, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($channel, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
    curl_setopt($channel, CURLOPT_TIMEOUT, 0);
    curl_setopt($channel, CURLOPT_CONNECTTIMEOUT, 0);
    curl_setopt($channel, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($channel, CURLOPT_SSL_VERIFYPEER, FALSE);

    $output = curl_exec($channel);

    if (curl_error($channel)) {
        return 'error:' . curl_error($channel);
    } else {
        $outputJSON = json_decode($output);
        var_dump($outputJSON);
    }

}

if (isset($_POST['torli'])) {
    $sql = "DELETE FROM stocks";

    if ($con->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
    $sql1 = "ALTER TABLE  stocks AUTO_INCREMENT = 1";
    $gereset = mysqli_query($con, $sql1);

}


?>


<form method="post" action="">
    <input type="submit" name="lekerdezi" class="button" value="lekerdezi"/>
    <input type="submit" name="torli" class="button" value="torli"/>

</form>

