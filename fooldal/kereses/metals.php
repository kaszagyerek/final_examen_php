<?php
require_once "connection.php";


   if (isset($_POST['lekerdezi'])) {
       $endpoint = 'latest';
       $access_key = '89j70sw8fp5atnw6q4v2uk7yyqurt
    mi2t4wy6l040jjlmjx1y2ohhe5vy1jj';
       $from = 'USD';
       $to = 'EUR';
       $amount = 50;
       $ch = curl_init('https://www.metals-api.com/api/' .
           $endpoint . '?access_key=' . $access_key);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

       $json = curl_exec($ch);
       $err = curl_error($ch);
       curl_close($ch);

       $obj = json_decode($json, TRUE);
       $rates = $obj['rates'];

       foreach ($rates as $x => $val) {
        $metal = $x;
        $price = $val;
        $sql = "INSERT INTO `metals` (metalsymbol, newPrice) VALUES ( '$metal','$price');";

        if ($con->query($sql) === TRUE) {
            echo "sikeres";
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

