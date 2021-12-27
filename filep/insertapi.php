<?php
require_once "connection.php";
$addres = mysqli_real_escape_string ($con,$_POST['utca']);
$totalhprice = mysqli_real_escape_string($con, $_POST['ertek']);
$ownPerson = mysqli_real_escape_string($con,$_POST['gondozo']);
$ownMobil = mysqli_real_escape_string($con,$_POST['gtelefon']);
$users_id =mysqli_real_escape_string($con,$_POST['id']);
$sql = "INSERT INTO `house` ( `users_id`,`addres`, `totalhprice`, `ownPerson`, `ownMobil`) VALUES ('$users_id','$addres','$totalhprice','$ownPerson','$ownMobil')";

if (mysqli_query($con, $sql)) {
    echo json_encode(array("Valasz"=>True, "Uzenet"=>"Sikeresen rogzitett adat"));
}
else {
    echo json_encode(array("Valasz"=>False ,"Uzenet"=>"Sikertelenul rogzitett adat"));
}
mysqli_close($con);

