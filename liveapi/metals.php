<?php
require_once "../log_reg/connection.php";


if (isset($_POST['lekerdezi'])) {
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://www.metals-api.com/api/latest?access_key=89j70sw8fp5atnw6q4v2uk7yyqurtmi2t4wy6l040jjlmjx1y2ohhe5vy1jj&base=USD&symbols=XAU%2CXAG%2CXPD%2CXPT%2CXRH",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",

    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);
    $response1 = json_decode($response, true);
    $products = $response1;
    var_dump($products);


    foreach ($products as $product) {
        $metal = $product["metal"];
        $price = $product["price"];

        $sql = "INSERT INTO `metals` (metalsymbol, newPrice) VALUES ( '$metal','$price');";

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

