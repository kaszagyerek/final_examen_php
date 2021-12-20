
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
</head>
<body>
<?php
require_once "connection.php";
if (isset($_POST['submit'])) {
    $addres = $_POST['addres'];
    $totalhprice = $_POST['totalhprice'];
    $ownPerson = $_POST['ownPerson'];
    $ownMobil = $_POST['ownMobil'];
    $users_id = $_POST['users_id'];
    //idhouse, addres, totalhprice, ownPerson, ownMobil, users_id
    $sql = "INSERT INTO `house` ( `users_id`,`addres`, `totalhprice`, `ownPerson`, `ownMobil`) VALUES ('$users_id','$addres','$totalhprice','$ownPerson','$ownMobil')";

    if ($con->query($sql) === TRUE) {
        $con->close();
        echo "Köszönjük! Az adatokat elmentettük.<br>";
        echo "<a href='houseapi.php'>Uj adat</a><br>";
        echo "<a href='listazas.php'>Adatok listazasa</a><br>";
    }else{
        echo "Muveleti hiba.\n";
    }
} else {
    // formot megmutat:
    ?>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
        Tulajdonos egyedi ID ja: <input type="Text" name="users_id"><br>
        Utca:<input type="Text" name="addres"><br>
        Ház értéke:<input type="Text" name="totalhprice"><br>
        Gondozó:<input type="Text" name="ownPerson"><br>
        Gondozó telefonszáma:<input type="Text" name="ownMobil"><br>
        <input type="Submit" name="submit" value="Elkuld">
    </form>

    <?php
} // end if
?>

</body>
</html>

