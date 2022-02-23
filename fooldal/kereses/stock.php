<?php
require_once "connection.php";


if (isset($_POST['lekerdezi'])) {
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


<form method="post">
    <input type="submit" name="lekerdezi" class="button" value="lekerdezi"/>
    <input type="submit" name="torli" class="button" value="torli"/>

</form>
