<?php
ob_start();
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
    <div >
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
                $sql1 = "SELECT SUM(salary) AS sum1 FROM workplace WHERE users_id = '$_SESSION[userid]';";
                $sql2 = "SELECT SUM(totalhprice)AS sum2 FROM house WHERE users_id = '$_SESSION[userid]' ;";
                $sql3 = "SELECT SUM(broker+tax+hrenovation)AS sum3 FROM expense WHERE users_id = '$_SESSION[userid]';";
                $result = mysqli_query($con, $sql1);
                $result2 = mysqli_query($con, $sql2);
                $result3 = mysqli_query($con, $sql3);
                $data = mysqli_fetch_assoc($result);
                $data2 = mysqli_fetch_assoc($result2);
                $data3 = mysqli_fetch_assoc($result3);
                echo $data['sum1'] + $data2['sum2'] - $data3['sum3'];
                ?>
                ron

            </p>
            </p>
            <p class="level-item has-text-centered">
                <img src="../img/fooldal/logo.png" alt="" style="height: 100px;">
            </p>
            <p class="level-item has-text-centered">
                <?php
                $privateid = $_SESSION['userid'];
                $sql = "SELECT profile_pic FROM users WHERE id = '$privateid' ";
                $result = $con->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $kep = $row["profile_pic"];
                        echo "<img src=../img/profile_pics/$kep width='100' height='100''>";
                    }
                }
                ?>
            </p>
            <p class="level-item has-text-centered">
                <a class="link is-info" href="szemelyes.php">Személyes adatok módosítása</a>
            </p>
            <p class="level-item has-text-centered">
                <a class="link is-info" href="kapcsolat.php">Kapcsolat</a>
            </p>
        </nav>

    </div>
    <div>
        <div class="vertical-menu">
            <a href="beszur/hazbeszuras.php" class="dark">Házam rögzítése</a>
            <a href="beszur/munkahelybeszuras.php" class="narancs">Munkahelyem rögzítése</a>
            <a href="beszur/kiadasbeszuras.php" class="lila">Kiadásaim rögzítése</a>
            <a href="kereses/kriptokereses.php" class="active">Kriptó élő beszurás</a>
            <a href="kereses/stockelokereses.php" class="active">Részvény élő keresés</a>
            <a href="kereses/metalskereses.php" class="active">Nemesfém élő keresés</a>
            <a href="../log_reg/kijelentkezes.php">Kijelentkezes</a>
        </div>

    </div>
    <div>
        <div class="tile is-ancestor">
            <div class="tile is-vertical is-8">
                <div class="tile">
                    <div class="tile is-parent is-vertical">
                        <article class="tile is-child notification is-light">
                            <div class="card-table">
                                <div class="content">
                                    <table class="table is-fullwidth is-striped">
                                        <tbody>
                                        <?php
                                        if (isset($_GET['idhouse'])) {
                                            $idhouse = $_GET['idhouse'];
                                            $sql = "DELETE FROM house WHERE idhouse=$idhouse";

                                            if ($con->query($sql) === TRUE) {
                                                header("Location: index.php");
                                            } else {
                                                echo "Hiba történt: " . $con->error;
                                            }
                                        }

                                        $privateid = $_SESSION['userid'];
                                        $sql = "SELECT idhouse, addres, totalhprice, ownPerson, ownMobil, users_id ,housedate FROM house WHERE users_id = '$privateid' ";
                                        $result = $con->query($sql);

                                        if ($result->num_rows > 0) {
                                            // output data of each row
                                            echo "<table border=1 >";
                                            echo "<tr>";
                                            echo "<th> Háza címe </th>";
                                            echo "<th> Háza teljes összege </th>";
                                            echo "<th> Háza gondozója </th>";
                                            echo "<th> Gondozó telefonszáma </th>";
                                            echo "<th> Házat rögzitette </th>";
                                            echo "<th> Törlés </th>";

                                            /*idhouse, addres, totalhprice, ownPerson, ownMobil, users_id, housedate */
                                            echo "</tr>";
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . $row["addres"] . "</td>";
                                                echo "<td>" . $row["totalhprice"] . "</td>";
                                                echo "<td>" . $row["ownPerson"] . "</td>";
                                                echo "<td>" . $row["ownMobil"] . "</td>";
                                                echo "<td>" . $row["housedate"] . "</td>";
                                                echo "<td class='level-right' ><a class='button is-dark ' href=\"index.php?idhouse=" . $row["idhouse"] . "\">Törlés</a></td>";
                                                echo "</tr>";
                                            }
                                            echo "</table>";
                                        } else {
                                            echo "Még nem rögzitette a kiadó házát ha szeretné" . "<a href='beszur/hazbeszuras.php'> kattintson ide </a>";
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </article>
                        <article class="tile is-child notification is-light">
                            <div class="card-table">
                                <div class="content">
                                    <table class="table is-fullwidth is-striped">
                                        <tbody>
                                        <?php
                                        if (isset($_GET['idworkplace'])) {
                                            $idworkplace = $_GET['idworkplace'];
                                            $sql = "DELETE FROM workplace WHERE idworkplace=$idworkplace";

                                            if ($con->query($sql) === TRUE) {
                                                header("Location: index.php");
                                            } else {
                                                echo "Hiba történt: " . $con->error;
                                            }
                                        }

                                        $privateid = $_SESSION['userid'];
                                        $sql = "SELECT idworkplace, workplacename, workplaceaddres, users_id, position,salary,workdate FROM workplace WHERE users_id = '$privateid' ";
                                        $result = $con->query($sql);

                                        if ($result->num_rows > 0) {
                                            // output data of each row
                                            echo "<table border=1 >";
                                            echo "<tr>";
                                            echo "<th> Munkahelye neve </th>";
                                            echo "<th> Munkahelye címe </th>";
                                            echo "<th> Munkahelyi poziciója </th>";
                                            echo "<th> Munkahelyi fizetése </th>";
                                            echo "<th> Rögzítés dátuma  </th>";

                                            echo "<th> Törlés </th>";

                                            echo "</tr>";
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . $row["workplacename"] . "</td>";
                                                echo "<td>" . $row["workplaceaddres"] . "</td>";
                                                echo "<td>" . $row["position"] . "</td>";
                                                echo "<td>" . $row["salary"] . "</td>";
                                                echo "<td>" . $row["workdate"] . "</td>";
                                                echo "<td class='level-right' ><a class='button is-black ' href=\"index.php?idworkplace=" . $row["idworkplace"] . "\">Törlés</a></td>";
                                                echo "</tr>";
                                            }
                                            echo "</table>";
                                        } else {
                                            echo "Még nem rögzitette a munkahelyét ha szeretné" . "<a href='beszur/munkahelybeszuras.php'> kattintson ide </a>";
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </article>
                        <article class="tile is-child notification is-light">
                            <div class="card-table">
                                <div class="content">
                                    <table class="table is-fullwidth is-striped">
                                        <tbody>
                                        <?php
                                        if (isset($_GET['idexpense'])) {
                                            $idexpense = $_GET['idexpense'];
                                            $sql = "DELETE FROM expense WHERE idexpense=$idexpense";

                                            if ($con->query($sql) === TRUE) {
                                                header("Location: index.php");
                                            } else {
                                                echo "Hiba történt: " . $con->error;
                                            }
                                        }

                                        $privateid = $_SESSION['userid'];
                                        $sql = "SELECT idexpense, broker, brokername, tax, hrenovation, users_id,expensedate FROM expense WHERE users_id = '$privateid' ";
                                        $result = $con->query($sql);

                                        if ($result->num_rows > 0) {
                                            // output data of each row
                                            echo "<table border=1 >";
                                            echo "<tr>";
                                            echo "<th> Brókere neve </th>";
                                            echo "<th> Brókere díja/hó </th>";
                                            echo "<th> Havi adó </th>";
                                            echo "<th> Havi lakásfelújítás </th>";
                                            echo "<th> Rögzítés dátuma  </th>";

                                            echo "<th> Törlés </th>";

                                            echo "</tr>";
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . $row["brokername"] . "</td>";
                                                echo "<td>" . $row["broker"] . "</td>";
                                                echo "<td>" . $row["tax"] . "</td>";
                                                echo "<td>" . $row["hrenovation"] . "</td>";
                                                echo "<td>" . $row["expensedate"] . "</td>";
                                                echo "<td class='level-right' ><a class='button is-black ' href=\"index.php?idexpense=" . $row["idexpense"] . "\">Törlés</a></td>";
                                                echo "</tr>";
                                            }
                                            echo "</table>";
                                        } else {
                                            echo "Még nem rögzitette a kiadásait ha szeretné" . "<a href='beszur/kiadasbeszuras.php'> kattintson ide </a>";
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </article>

                    </div>
                </div>
                <div class="tile is-parent">
                    <article class="tile is-child notification is-danger">
                        <p class="title">Részvény</p>
                        <p class="subtitle"></p>
                        <div class="content">
                            <!-- Content -->
                        </div>
                    </article>
                </div>
                <div class="tile is-parent">
                    <article class="tile is-child notification is-danger">
                        <p class="title">Kriptóvaluta</p>
                        <p class="subtitle"></p>
                        <div class="content">
                            <!-- Content -->
                        </div>
                    </article>
                </div>
                <div class="tile is-parent">
                    <article class="tile is-child notification is-info">
                        <p class="title">Nemesfém</p>
                        <p class="subtitle"></p>
                        <div class="content">
                            <!-- Content -->
                        </div>
                    </article>
                </div>
            </div>
            <div class="tile is-parent">
                <article class="tile is-child notification is-success">
                    <div class="content">
                        <p class="title">Hírek</p>
                        <p class="subtitle">Statisztikák</p>

                        <div class="content">
                            <!-- Content -->
                        </div>
                    </div>
                </article>
            </div>
        </div>

    </div>
</div>

</body>
</html>
