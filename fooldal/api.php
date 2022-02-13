<?php
session_start();
require_once "connection.php";
if (!isset($_SESSION['username'])){
    header("Location:../log_reg/log_reg.php");
    exit();
}

$action = isset($_GET['action']) ? $_GET['action'] : "";
$action2 = isset($_POST['action']) ? $_POST['action'] : "";
if (isset($con)) {
    $con;
}
switch($action) {

    case "listazas" :
        $privateid = $_SESSION['userid'];

        $sql="SELECT idhouse, addres, totalhprice, ownPerson, ownMobil, users_id FROM house WHERE users_id = '$privateid' ";
        $result = mysqli_query($con, $sql);
        while($obj=$result->fetch_assoc()){
            $res[] =$obj;}
        echo json_encode($res);
        break;
    case "munkahelylistazas" :
        $privateid = $_SESSION['userid'];

        $sql="SELECT idworkplace, workplacename, workplaceaddres, users_id, position,salary FROM workplace WHERE users_id = '$privateid' ";
        $result = mysqli_query($con, $sql);
        while($obj=$result->fetch_assoc()){
            $res[] =$obj;}
        echo json_encode($res);
        break;

    case "kiadaslistazasa" :
        $privateid = $_SESSION['userid'];

        $sql="SELECT idexpense, broker, brokername, tax, hrenovation, users_id FROM expense WHERE users_id = '$privateid' ";
        $result = mysqli_query($con, $sql);
        while($obj=$result->fetch_assoc()){
            $res[] =$obj;}
        echo json_encode($res);
        break;
}
switch($action2){
    case "inserthouse":
        $addres = mysqli_real_escape_string ($con,$_POST['utca']);
        $totalhprice = mysqli_real_escape_string($con, $_POST['ertek']);
        $ownPerson = mysqli_real_escape_string($con,$_POST['gondozo']);
        $ownMobil = mysqli_real_escape_string($con,$_POST['gtelefon']);

        $privateid = $_SESSION['userid'];
        $sql = "INSERT INTO `house` ( `users_id`,`addres`, `totalhprice`, `ownPerson`, `ownMobil`) VALUES ('$privateid','$addres','$totalhprice','$ownPerson','$ownMobil')";


        if (mysqli_query($con, $sql)) {
            echo json_encode(array("Valasz"=>True, "Uzenet"=>"Sikeresen rogzitett adat"));
        }
        else {
            echo json_encode(array("Valasz"=>False ,"Uzenet"=>"Sikertelenul rogzitett adat"));
        }
        mysqli_close($con);

        break;
    case "insertworkplace":
        $munka = mysqli_real_escape_string ($con,$_POST['munka']);
        $cim = mysqli_real_escape_string($con, $_POST['cim']);
        $beosztas = mysqli_real_escape_string($con, $_POST['beosztas']);
        $salary = mysqli_real_escape_string($con, $_POST['fizetes']);


        $privateid = $_SESSION['userid'];
        $sql = "INSERT INTO `workplace` (`workplacename`, `workplaceaddres`, `users_id`,`position` ,`salary`) VALUES ('$munka', '$cim', '$privateid','$beosztas','$salary')";


        if (mysqli_query($con, $sql)) {
            echo json_encode(array("Valasz"=>True, "Uzenet"=>"Sikeresen rogzitett adat"));
        }
        else {
            echo json_encode(array("Valasz"=>False ,"Uzenet"=>"Sikertelenul rogzitett adat"));
        }
        mysqli_close($con);

        break;

    case "insertexpense":
        $brokername = mysqli_real_escape_string ($con,$_POST['brokername']);
        $broker = mysqli_real_escape_string($con, $_POST['broker']);
        $tax = mysqli_real_escape_string($con, $_POST['tax']);
        $hrenovation = mysqli_real_escape_string($con, $_POST['hrenovation']);


        $privateid = $_SESSION['userid'];
        $sql = "INSERT INTO `expense` ( broker, brokername, tax, hrenovation, users_id) VALUES ('$broker', '$brokername', '$tax','$hrenovation', '$privateid')";

        var_dump($sql);
        if (mysqli_query($con, $sql)) {
            echo json_encode(array("Valasz"=>True, "Uzenet"=>"Sikeresen rogzitett adat"));
        }
        else {
            echo json_encode(array("Valasz"=>False ,"Uzenet"=>"Sikertelenul rogzitett adat"));
        }
        mysqli_close($con);

        break;

}


?>