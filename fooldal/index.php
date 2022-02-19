<?php
session_start();
require_once "connection.php";
if (!isset($_SESSION['username'])) {
    header("Location:../log_reg/log_reg.php");
    exit();
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/bulma.min.css">

    <link href="../css/index_szepito.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="rendez">
    <nav class="level">
        <p class="level-item has-text-centered">
            <b class="link is-info"><?php
                echo "Üdvözöllek " . $_SESSION['username'];
                ?></b>
        </p>
        <p class="level-item has-text-centered">
        <p class="link is-info">
            Jelenlegi vagyona :
            <?php
            $sql = "SELECT (SELECT SUM(salary) FROM workplace WHERE users_id = '$_SESSION[userid]') + (SELECT SUM(totalhprice) FROM house WHERE users_id = '$_SESSION[userid]') -  (SELECT SUM(broker+tax+hrenovation) FROM expense WHERE users_id = '$_SESSION[userid]' )AS sum;";
            $result = mysqli_query($con, $sql);
            $data = mysqli_fetch_assoc($result);
            echo $data['sum'];
            ?>
            ron

        </p>
        </p>
        <p class="level-item has-text-centered">
            <img src="../img/fooldal/logo.png" alt="" style="height: 100px;">
        </p>
        <p class="level-item has-text-centered">
            <a class="link is-info">Reservations</a>
        </p>
        <p class="level-item has-text-centered">
            <a class="link is-info">Contact</a>
        </p>
    </nav>
    <div class="vertical-menu">
        <a href="hazbeszuras.php" class="active">Házam rögzítése</a>
        <a href="hazlekerdezes.php" class="active">Házaim listázása</a>
        <a href="munkahelybeszuras.php" class="narancs">Munkahelyem rögzítése</a>
        <a href="munkahelylistazasa.php" class="narancs">Munkahelyem listázása</a>
        <a href="kiadasbeszuras.php" class="lila">Kiadásaim rögzítése</a>
        <a href="kiadaslistazasa.php" class="lila">Kiadásaim listázása</a>
        <a href="elokereses.php" class="active">Kriptó élő keresés</a>
        <a href="stockelokereses.php" class="active">Részvény élő keresés</a>
        <a href="metalskereses.php" class="active">Nemesfém élő keresés</a>
        <a href="../log_reg/kijelentkezes.php">Kijelentkezes</a>
    </div>
    <div class="tile is-ancestor">
        <div class="tile is-4 is-vertical is-parent">
            <div class="tile is-child box">
                <p class="title">One</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare magna eros, eu pellentesque
                    tortor vestibulum ut. Maecenas non massa sem. Etiam finibus odio quis feugiat facilisis.</p>
            </div>
            <div class="tile is-child box">
                <p class="title">Two</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare magna eros, eu pellentesque
                    tortor vestibulum ut. Maecenas non massa sem. Etiam finibus odio quis feugiat facilisis.</p>
            </div>
        </div>
        <div class="tile is-parent">
            <div class="tile is-child box">
                <p class="title">Three</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam semper diam at erat pulvinar, at
                    pulvinar felis blandit. Vestibulum volutpat tellus diam, consequat gravida libero rhoncus ut. Morbi
                    maximus, leo sit amet vehicula eleifend, nunc dui porta orci, quis semper odio felis ut quam.</p>
                <p>Suspendisse varius ligula in molestie lacinia. Maecenas varius eget ligula a sagittis. Pellentesque
                    interdum, nisl nec interdum maximus, augue diam porttitor lorem, et sollicitudin felis neque sit
                    amet erat. Maecenas imperdiet felis nisi, fringilla luctus felis hendrerit sit amet. Aenean vitae
                    gravida diam, finibus dignissim turpis. Sed eget varius ligula, at volutpat tortor.</p>
                <p>Integer sollicitudin, tortor a mattis commodo, velit urna rhoncus erat, vitae congue lectus dolor
                    consequat libero. Donec leo ligula, maximus et pellentesque sed, gravida a metus. Cras ullamcorper a
                    nunc ac porta. Aliquam ut aliquet lacus, quis faucibus libero. Quisque non semper leo.</p>
            </div>
        </div>
    </div>
</div>

</body>
</html>
