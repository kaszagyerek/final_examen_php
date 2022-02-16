<?php
require_once "../log_reg/connection.php";


if (isset($_POST['lekerdezi'])) {
    /*
         $GCM_SERVER_API_KEY = $_ENV["GCM_SERVER_API_KEY"];
    $url = 'https://fcm.googleapis.com/fcm/send';
    $fields = array('registration_ids' => $registration_ids, 'data' => $message);
    // Update your Google Cloud Messaging API Key
    if (!defined('GOOGLE_API_KEY')) {
        define("GOOGLE_API_KEY", $GCM_SERVER_API_KEY);
    }
    $headers = array('Authorization: key=' . GOOGLE_API_KEY, 'Content-Type: application/json');
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
     */
    $url = 'https://www.goldapi.io/api//XAU/USD';
    $apiKey = 'goldapi-bztpzctkvr8im3j-io';
    $headers = array(
        'Authorization: '.$apiKey
    );
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPGET, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response_json = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response_json, true);
    $products = $response;
    foreach ($products as $product) {
        $metal = $product["metal"];
        $symbol = $product["symbol"];
        $price = $product["price"];

        $sql = "INSERT INTO `metals` (metalname, metalsymbol, newPrice) VALUES ( '$metal','$symbol','$price');";

        if ($con->query($sql) === TRUE) {
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    }
}

if (isset($_POST['torli'])) {
    $sql = "DELETE FROM metals";

    if ($con->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
    $sql1 = "ALTER TABLE  metals AUTO_INCREMENT = 1";
    $gereset = mysqli_query($con, $sql1);

}

?>


<form method="post">
    <input type="submit" name="lekerdezi" class="button" value="lekerdezi"/>
    <input type="submit" name="torli" class="button" value="torli"/>

</form>

