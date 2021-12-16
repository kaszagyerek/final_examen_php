<?php
require "connection.php";

/*   $trackinglr = isset($_GET['tracking']) ? $_GET['tracking'] : "";
        if($trackinglr == ""){
            die('{	"success": false, "msg" : "Tracking number not found!"}');
        }
        $sql = "SELECT td.`datum`, td.`megjegyzes`
 FROM `tracking` t,`tracking_details` td
WHERE t.`trackingszam` = '$trackinglr'   AND t.`id` = td.`tracking_id` ORDER BY `datum`;";
*/

$action = isset($_GET['action']) ? $_GET['action'] : "";

switch ($action) {
    default:
        $keres = isset($_GET['id']) ? $_GET['id'] : "";
        if($keres == ""){
            die('{	"success": false, "üzenet" : Érvénytelen lekérdezés"!"}');
        }
        $sql = "SELECT `addres`, `totalhprice`, `ownPerson`, `ownMobil`, `username` 
            FROM `house`INNER JOIN `users` ON `house`.`users_id` = `users`.`id` 
            WHERE `house`.`users_id` = '$keres' ORDER BY `totalhprice`;";
        $rs = $con->query($sql);
        if($rs->num_rows == 0){
            die('{	"success": false, "msg" : "Felhasználó nem létezik/ vagy nincsen háza a felhasználónak!"}');
        }
        $resp = array("success" => true, "response" => array());
        while($row = $rs->fetch_assoc()){
            $resp['response'][] = array(
                "username" => $row['username'],
                "addres" => $row['addres'],
                "ownPerson" => $row['ownPerson'],
                "totalhprice" => $row['totalhprice'],
                "ownMobil" => $row['ownMobil'],
            );
        }
        die(json_encode($resp));

}