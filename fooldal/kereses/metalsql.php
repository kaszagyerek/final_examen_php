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
    $cr = $_GET['idmetals'];
    echo "dadada2 " . $cr;

    $sql = "INSERT INTO `personalmetal` ( dbmetal, oldprice, metaldate, metals_idmetals, users_id) VALUES ( '$db', '$ar', now() , '$cr' ,'$privateid');";

    $result = $con->query($sql);
    echo "sikeres";
} else {

    $sql = "SELECT * FROM personalmetal WHERE users_id= '$privateid'";
    $result = $con->query($sql);
    $row1 = $result->fetch_assoc();
    $con->close();
}
?>

<form method="post" action="">
    db:<input type="Text" name="db"><br>
    ar:<input type="Text" name="ar"><br>
    <input type="submit" name="submit" value="Elkuld">
    <input type="hidden" name="id" value=<?php echo $_GET['idmetals']; ?>>
</form>

