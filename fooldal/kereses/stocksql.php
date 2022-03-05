<?php
session_start();
require_once "../connection.php";


$privateid = $_SESSION['userid'];
$cr = $_GET['idstocks'];



if (isset($_POST['submit'])) {
    $db = $_POST['db'];
    $ar = $_POST['ar'];
    echo "dadada2 " . $cr;


    $sql = "INSERT INTO `personalstock` ( dbstock, oldprice, stockdata, stocks_idstocks, users_id) VALUES ( '$db', '$ar',now(),'$cr', '$privateid');";

    $result = $con->query($sql);
    header("Location: ../index.php");
} else {

    $sql = "SELECT * FROM personalstock WHERE users_id= '$privateid'";
    $result = $con->query($sql);
    $row1 = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/bulma.min.css">
    <title>főmenü</title>
    <link rel="icon" type="image/x-icon" href="/img/favicon_io/favicon.ico">

    <link href="/css/index_szepito.css" rel="stylesheet" type="text/css">
</head>
<body>

        <div class="reszvenyvesz">

            <form method="post" action="">
                <?php
                $ids = $_GET["idstocks"];
                $a = "SELECT stockname FROM stocks WHERE idstocks = '$ids'";
                $result = $con->query($a);
                if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                echo "<p>". $row["stockname"]."</p>";
                ?>
                Hány darab részvénye van:<input class="input is-primary"  type="Text" name="db" style="width:50px"><br>
                Hány dollárért fizetett érte:<input class="input is-primary" type="Text" name="ar" style="width:50px"><br>
                <input class="button is-danger"  type="submit" name="submit" value="Elkuld">
                <input  type="hidden" name="id" value=<?php echo $_GET['idstocks']; ?>>
            </form>

        </div>

        <?php
    }
} else {
    echo "hiba történt";
}
?>


</body>
</html>


