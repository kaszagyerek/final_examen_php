<?php
require_once "connection.php";

$sql = "SELECT * FROM house";
$result = $con->query($sql);

echo "<a href='houseapi.php'>Új ház</a>"
;
if ($result->num_rows > 0) {
    // output data of each row
    echo "<table border=1>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
         //idhouse, addres, totalhprice, ownPerson, ownMobil, users_id
        echo "<td>". $row["users_id"]."</td>";
        echo "<td>". $row["addres"]."</td>";
        echo "<td>". $row["totalhprice"]."</td>";
        echo "<td>". $row["ownPerson"]."</td>";
        echo "<td>". $row["ownMobil"]."</td>";


        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$con->close();
?>


