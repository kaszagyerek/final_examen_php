<?php
require_once "connection.php";

if (isset($_POST['lekerdezi'])) {

    $url = 'https://api.nasdaq.com/api/screener/stocks?tableonly=true&limit=10&offset=0&download=true';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response_json = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response_json, true);
    $products = $response;
    $stock = $products['data']['rows'];

    function floatValue($str){
        if(preg_match("/([0-9\.,-]+)/", $str, $match)){
            $value = $match[0];
            if( preg_match("/(\.\d{1,2})$/", $value, $dot_delim) ){
                $value = (float)str_replace(',', '', $value);
            }
            else if( preg_match("/(,\d{1,2})$/", $value, $comma_delim) ){
                $value = str_replace('.', '', $value);
                $value = (float)str_replace(',', '.', $value);
            }
            else
                $value = (int)$value;
        }
        else {
            $value = 0;
        }
        return $value;
    }


    foreach ($stock as $product) {

        $symbol = $product["symbol"];
        $name = $product["name"];
        $lastsale = $product["lastsale"];
        $marketCap = $product["marketCap"];
        $country = $product["country"];
        $sector = $product["sector"];
        $industry = $product["industry"];
        $url = $product["url"];
        $price = floatValue($lastsale);

        $sql = "INSERT INTO `stocks` (stockname, stocksymbol, newPrice, stockmarketcap, 
                      stockcountry, stockindustry, stocksector, stockurl) 
        VALUES ('$name', '$symbol','$price','$marketCap','$country','$industry','$sector','$url');";

        if ($con->query($sql) === TRUE) {
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    }


}

if (isset($_POST['torli'])) {
    $sql1 = "DELETE FROM stocks";

    if ($con->query($sql1) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
    $sql2 = "ALTER TABLE  stocks AUTO_INCREMENT = 1";
    $gereset = mysqli_query($con, $sql2);

}


?>


<form method="post" action="">
    <input type="submit" name="lekerdezi" class="button" value="lekerdezi"/>
    <input type="submit" name="torli" class="button" value="torli"/>

</form>

