<?php
require_once "connection.php";
$addres = $_POST['utca'];
$totalhprice = $_POST['ertek'];
$ownPerson = $_POST['gondozo'];
$ownMobil = $_POST['gtelefon'];
$users_id = $_POST['id'];
$sql = "INSERT INTO `house` ( `users_id`,`addres`, `totalhprice`, `ownPerson`, `ownMobil`) VALUES ('$users_id','$addres','$totalhprice','$ownPerson','$ownMobil')";

if (mysqli_query($con, $sql)) {
    echo json_encode(array("Valasz"=>True, "Uzenet"=>"Sikeresen rogzitett adat"));
}
else {
    echo json_encode(array("Valasz"=>False ,"Uzenet"=>"Sikeresen rogzitett adat"));
}
mysqli_close($con);

