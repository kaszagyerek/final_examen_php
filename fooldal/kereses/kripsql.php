<?php
session_start();
require_once "../connection.php";

$privateid = $_SESSION['userid'];
if (isset($_POST['submit'])) {
    $db = mysqli_real_escape_string($con,$_POST['db']);
    $ar = mysqli_real_escape_string($con,$_POST['ar']);
    $cr = $_GET['idcrypto'];
    if(isset($db) && isset($ar) && !empty($db) && !empty($ar) && is_numeric($db) && is_numeric($ar))
    {
        $sql = "INSERT INTO `personalcrypto` ( `dbkrpto`, `oldcrprice`, `users_id`, `crypto_idcrypto`,cryptodate) VALUES ( '$db', '$ar', '$privateid', '$cr',now());";
        $result = $con->query($sql);
        header("Location: ../index.php");
    } else {
        echo "<div class='reszvenyvesz'>";
        if(empty($db)){
            echo "nem lehet üres a darab mező <br>";
        } else if(!empty($db) && !is_numeric($db)){
            echo "a darab mező csak számot tartalmazhat<br>";
        }
        if(empty($ar)){
            echo "nem lehet üres az ár mező <br>";
        }else if(!empty($ar) && !is_numeric($ar)){
            echo "az ár mező csak számot tartalmazhat<br>";
        }
        echo "</div>";
    }

} else {

    $sql = "SELECT * FROM personalcrypto WHERE users_id= '$privateid'";
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
    <title>kritpo beszurás</title>
    <link rel="icon" type="image/x-icon" href="/img/favicon_io/favicon.ico">

    <link href="/css/index_szepito.css" rel="stylesheet" type="text/css">
</head>
<body>

<div class="reszvenyvesz">

    <form method="post" action="">

        Hány darab  <?php
        $ids = $_GET["idcrypto"];
        $a = "SELECT cryptosymbol FROM crypto WHERE idcrypto = '$ids'";
        $result = $con->query($a);
        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
        echo "<b>". $row["cryptosymbol"]."</b>";
        ?> kriptója van:<input class="input is-primary" placeholder="db" type="Text" name="db" style="width:50px"><br>
        Hány dollárért fizetett érte:<input class="input is-primary" placeholder="ár" type="Text" name="ar" style="width:50px"><br>
        <input class="button is-danger"  type="submit" name="submit" value="Elküld">
        <input  type="hidden" name="id" value=<?php echo $_GET['idcrypto']; ?>>
    </form>

</div>
<div class="tile is-parent">
    <article class="tile is-child notification is-danger" style="height:550px">
        <p class="title">Reklám</p>
        <p class="subtitle">Reklám</p>
        <div class="content">
        </div>
    </article>
</div>

<?php
}
} else {
    echo "hiba történt";
}
?>

</body>
</html>

