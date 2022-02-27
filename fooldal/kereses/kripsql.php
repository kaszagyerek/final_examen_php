<?php
session_start();
require_once "connection.php";
if (!isset($_SESSION['username'])) {
    header("Location:../log_reg/log_reg.php");
    exit();
}
$privateid = $_SESSION['userid'];
echo "dadada " . $privateid;
if (isset($_POST['submit'])) {
    $db = $_POST['db'];
    $ar = $_POST['ar'];
    $cr = $_GET['idcrypto'];
    echo "dadada2 " . $cr;

    $sql = "INSERT INTO `personalcrypto` ( `dbkrpto`, `oldcrprice`, `users_id`, `crypto_idcrypto`,cryptodate) VALUES ( '$db', '$ar', '$privateid', '$cr',now());";

    $result = $con->query($sql);
    echo "sikeres";
} else {

    $sql = "SELECT * FROM personalcrypto WHERE users_id= '$privateid'";
    $result = $con->query($sql);
    $row1 = $result->fetch_assoc();
    $con->close();
}
?>

<form method="post" action="">
    db:<input type="Text" name="db"><br>
    ar:<input type="Text" name="ar"><br>
    <input type="submit" name="submit" value="Elkuld">
    <input type="hidden" name="id" value=<?php echo $_GET['idcrypto']; ?>>
</form>

