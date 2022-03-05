<?php
ob_start();
session_start();
require_once "connection.php";

?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/bulma.min.css">
    <title>főmenü</title>
    <link rel="icon" type="image/x-icon" href="../img/favicon_io/favicon.ico">

    <link href="../css/index_szepito.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="rendez">
    <div>
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
                $sql2 = "SELECT SUM(totalhprice)AS sum2 FROM house WHERE users_id = '$_SESSION[userid]' ;";
                $sql3 = "SELECT SUM(broker+tax+hrenovation)AS sum3 FROM expense WHERE users_id = '$_SESSION[userid]';";

                $sql1 = "SELECT SUM(salary) AS sum1 FROM workplace WHERE users_id = '$_SESSION[userid]';";
                $result = mysqli_query($con, $sql1);
                $data = mysqli_fetch_assoc($result);


                $result2 = mysqli_query($con, $sql2);
                $result3 = mysqli_query($con, $sql3);
                $data2 = mysqli_fetch_assoc($result2);
                $data3 = mysqli_fetch_assoc($result3);

                $sql4 = "SELECT SUM((dbkrpto*lastprice)*4.5) AS vagyon FROM kriptonyereseg WHERE users_id ='$_SESSION[userid]';";
                $result4 = mysqli_query($con, $sql4);
                $data4 = mysqli_fetch_assoc($result4);


                $sql5 = "SELECT SUM((dbmetal*newPrice)*4.5) AS vagyon2 FROM metalsnyereseg WHERE users_id ='$_SESSION[userid]';";
                $result5 = mysqli_query($con, $sql5);
                $data5 = mysqli_fetch_assoc($result5);

                $sql6 = "SELECT SUM((dbstock*newPrice)*4.5) AS vagyon3 FROM stocknyereseg WHERE users_id ='$_SESSION[userid]';";
                $result6 = mysqli_query($con, $sql6);
                $data6 = mysqli_fetch_assoc($result6);


                echo $data['sum1'] + $data2['sum2'] - $data3['sum3'] + $data4['vagyon'] + $data5['vagyon2'] + $data6['vagyon3'] ;


                ?>
                ron
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


    </div>
    <div>
        <div class="tile is-ancestor" >
            <div class="tile is-vertical is-8">
                <div class="tile">

                    <div class="tile is-parent is-vertical">
                        <div> <?php

                            $url = "https://freecurrencyapi.net/api/v2/latest?apikey=5bba8b20-9933-11ec-bb04-e5eb05a9a6ed";
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $url);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                            curl_setopt($ch, CURLOPT_HEADER, FALSE);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            $response = curl_exec($ch);
                            curl_close($ch);
                            $obj = json_decode($response, TRUE);
                            $dev = $obj['data'];

                            echo "<select name='deviza' class='select' style='background-color: rgba(150,206,250,0.46)'>";
                            echo '1  dollár jelenleg ' . $obj['data']['RON'] . '  ROddN';

                            echo '<option value="">' . '1  dollár jelenleg  ' .  $obj['data']['RON'] . '  RON' . '</option>';

                            foreach ($dev as $dname => $dprice) {

                                echo '<option value="">' .'1  dollár jelenleg  '. $dprice .'->' . $dname .' </option>';
                            }
                            echo "</select>";




                            ?>

                        </div>

                        <article class="tile is-child notification is-light">
                            <p class="title">Kriptóvaluta <a href="kereses/kriptokereses.php"><img src="../img/fooldal/icons8-add-96.png" alt="hozzaadd" style="width:25px;height:25px;"></a> </p>
                            <p class="subtitle"></p>
                            <div class="content">
                                <tbody>
                                <?php

                                if (isset($_GET['idpersonalcrypto'])) {
                                    $idpersonalcrypto = $_GET['idpersonalcrypto'];
                                    $sql = "DELETE FROM personalcrypto WHERE idpersonalcrypto=$idpersonalcrypto";

                                    if ($con->query($sql) === TRUE) {
                                        header("Location: index.php");
                                    } else {
                                        echo "Hiba történt: " . $con->error;
                                    }
                                }


                                $privateid = $_SESSION['userid'];
                                $sql = "SELECT  *
                            FROM crypto INNER JOIN personalcrypto ON crypto.idcrypto = personalcrypto.crypto_idcrypto
                            WHERE personalcrypto.users_id = '$privateid' ";
                                $result = $con->query($sql);

                                if ($result->num_rows > 0) {
                                    echo "<table border=1 >";
                                    echo "<tr>";
                                    echo "<th> Kriptó neve </th>";
                                    echo "<th> Kriptó szimbolum </th>";
                                    echo "<th> Kriptó képe </th>";
                                    echo "<th> Jelenlegi ár </th>";
                                    echo "<th> Hány darabom van </th>";
                                    echo "<th> Menyiért vásároltam  </th>";
                                    echo "<th> Mikor vásároltam  </th>";
                                    echo "<th> Profit %  </th>";
                                    echo "<th> Profit $  </th>";
                                    echo "<th> Jelenlegi érték $  </th>";
                                    echo "<th> Törlés </th>";

                                    echo "</tr>";
                                    while ($row = $result->fetch_assoc()) {
                                        $kep = $row["cryptoimg"];
                                        $idcr = $row["idpersonalcrypto"];
                                        echo "<tr>";
                                        echo "<td>" . $row["cryptoname"] . "</td>";
                                        echo "<td>" . $row["cryptosymbol"] . "</td>";
                                        echo "<td>" . "<img src=$kep alt='nem betölthető a kép' width='35' height='35'>" . "</td>";
                                        echo "<td>" . $row["lastprice"] . "</td>";
                                        echo "<td>" . $row["dbkrpto"] . "</td>";
                                        echo "<td>" . $row["oldcrprice"] . "</td>";
                                        echo "<td>" . $row["cryptodate"] . "</td>";
                                        $sql2 = "SELECT kszaz FROM kriptoszazalek WHERE users_id = '$privateid' AND idpersonalcrypto = '$idcr' ";
                                        $res = mysqli_query($con, $sql2);
                                        $dat = mysqli_fetch_assoc($res);
                                        $format1 = round($dat['kszaz'], 2);

                                        if ($format1 >= 100) {
                                            echo "<td style='background-color: rgba(12,255,18,0.48)'>" . $format1 . '%' . "</td>";
                                        } else {
                                            echo "<td style='background-color:rgba(255,39,23,0.44)'>" . $format1 . '%' . "</td>";
                                        }
                                        $sql3 = "SELECT kvagy FROM kriptonyereseg WHERE users_id = '$privateid' AND idpersonalcrypto = '$idcr' ";
                                        $res = mysqli_query($con, $sql3);
                                        $dat = mysqli_fetch_assoc($res);
                                        $format2 = round($dat['kvagy'], 2);

                                        if ($format2 >= 0) {
                                            echo "<td style='background-color: rgba(12,255,18,0.68)'>" . $format2 . '$' . "</td>";
                                        } else {
                                            echo "<td style='background-color:rgba(255,39,23,0.64)'>" . $format2 . '$' . "</td>";
                                        }


                                        $sql3 = "SELECT ktej FROM kriptonyereseg WHERE users_id = '$privateid' AND idpersonalcrypto = '$idcr' ";
                                        $res = mysqli_query($con, $sql3);
                                        $dat = mysqli_fetch_assoc($res);
                                        $format3 = round($dat['ktej'], 2);


                                        echo "<td style='background-color: rgba(150,206,250,0.46)'>" . $format3 . '$' . "</td>";


                                        echo "<td class='level-right' ><a class='button is-black ' href=\"index.php?idpersonalcrypto=" . $row["idpersonalcrypto"] . "\">Törlés</a></td>";
                                        echo "</tr>";


                                    }
                                    echo "</table>";
                                } else {
                                    echo "Még nem rögzitette a munkahelyét ha szeretné" . "<a href='kereses/kriptokereses.php'> kattintson ide </a>";
                                }
                                ?>
                                </tbody>

                            </div>
                        </article>
                        <article class="tile is-child notification is-light">
                            <p class="title">Nemesfém <a href="kereses/metalskereses.php"><img src="../img/fooldal/icons8-add-96.png" alt="hozzaadd" style="width:25px;height:25px;"></a> </p>
                            <p class="subtitle"></p>
                            <div class="content">
                                <tbody>
                                <?php

                                if (isset($_GET['idpersonalmetal'])) {
                                    $idpersonalmetal = $_GET['idpersonalmetal'];
                                    $sql = "DELETE FROM personalmetal WHERE idpersonalmetal=$idpersonalmetal";

                                    if ($con->query($sql) === TRUE) {
                                        header("Location: index.php");
                                    } else {
                                        echo "Hiba történt: " . $con->error;
                                    }
                                }


                                $privateid = $_SESSION['userid'];
                                $sql = "SELECT  *
                                FROM metals INNER JOIN personalmetal ON metals.idmetals = personalmetal.metals_idmetals
                                WHERE personalmetal.users_id = '$privateid' ";
                                $result = $con->query($sql);

                                if ($result->num_rows > 0) {
                                    echo "<table border=1 >";
                                    echo "<tr>";
                                    echo "<th> Nemesfém szimbolum </th>";
                                    echo "<th> Jelenlegi ár </th>";
                                    echo "<th> Hány darabom van </th>";
                                    echo "<th> Menyiért vásároltam  </th>";
                                    echo "<th> Mikor vásároltam  </th>";
                                    echo "<th> Profit %  </th>";
                                    echo "<th> Profit $  </th>";
                                    echo "<th> Jelenlegi érték $  </th>";
                                    echo "<th> Törlés </th>";

                                    echo "</tr>";
                                    while ($row = $result->fetch_assoc()) {
                                        $idcr = $row["idpersonalmetal"];
                                        echo "<tr>";
                                        echo "<td>" . $row["metalsymbol"] . "</td>";
                                        echo "<td>" . $row["newPrice"] . "</td>";
                                        echo "<td>" . $row["dbmetal"] . "</td>";
                                        echo "<td>" . $row["oldprice"] . "</td>";
                                        echo "<td>" . $row["metaldate"] . "</td>";
                                        $sql2 = "SELECT kmet FROM metalszazalek WHERE users_id = '$privateid' AND idpersonalmetal = '$idcr' ";
                                        $res = mysqli_query($con, $sql2);
                                        $dat = mysqli_fetch_assoc($res);
                                        $format4 = round($dat['kmet'], 2);

                                        if ($format4 >= 100) {
                                            echo "<td style='background-color: rgba(12,255,18,0.48)'>" . $format4 . '%' . "</td>";
                                        } else {
                                            echo "<td style='background-color:rgba(255,39,23,0.44)'>" . $format4 . '%' . "</td>";
                                        }
                                        $sql3 = "SELECT mvagy FROM metalsnyereseg WHERE users_id = '$privateid' AND idpersonalmetal = '$idcr' ";
                                        $res = mysqli_query($con, $sql3);
                                        $dat = mysqli_fetch_assoc($res);
                                        $format5 = round($dat['mvagy'], 2);

                                        if ($format5 >= 0) {
                                            echo "<td style='background-color: rgba(12,255,18,0.68)'>" . $format5 . '$' . "</td>";
                                        } else {
                                            echo "<td style='background-color:rgba(255,39,23,0.64)'>" . $format5 . '$' . "</td>";
                                        }


                                        $sql3 = "SELECT mtej FROM metalsnyereseg WHERE users_id = '$privateid' AND idpersonalmetal = '$idcr' ";
                                        $res = mysqli_query($con, $sql3);
                                        $dat = mysqli_fetch_assoc($res);
                                        $format3 = round($dat['mtej'], 2);

                                        echo "<td style='background-color: rgba(150,206,250,0.46)'>" . $format3 . '$' . "</td>";


                                        echo "<td class='level-right' ><a class='button is-black ' href=\"index.php?idpersonalmetal=" . $row["idpersonalmetal"] . "\">Törlés</a></td>";
                                        echo "</tr>";


                                    }
                                    echo "</table>";
                                } else {
                                    echo "Még nem rögzitette a munkahelyét ha szeretné" . "<a href='kereses/metalskereses.php'> kattintson ide </a>";
                                }
                                ?>
                                </tbody>

                            </div>
                        </article>

                        <article class="tile is-child notification is-light">
                            <p class="title">Részvény <a href="kereses/stockelokereses.php"><img src="../img/fooldal/icons8-add-96.png" alt="hozzaadd" style="width:25px;height:25px;"></a> </p>
                            <p class="subtitle"></p>
                            <div class="content">
                                <tbody>
                                <?php

                                if (isset($_GET['idpersonalstock'])) {
                                    $idpersonalstock = $_GET['idpersonalstock'];
                                    $sql = "DELETE FROM personalstock WHERE idpersonalstock=$idpersonalstock";

                                    if ($con->query($sql) === TRUE) {
                                        header("Location: index.php");
                                    } else {
                                        echo "Hiba történt: " . $con->error;
                                    }
                                }

                                $privateid = $_SESSION['userid'];
                                $sql = "SELECT  *
                                FROM stocks INNER JOIN personalstock ON stocks.idstocks = personalstock.stocks_idstocks
                                WHERE personalstock.users_id = '$privateid'; ";
                                $result = $con->query($sql);





                                if ($result->num_rows > 0) {
                                    echo "<table border=1 >";
                                    echo "<tr>";
                                    echo "<th> Részvény neve  </th>";
                                    echo "<th> Részvény szimbolum  </th>";
                                    echo "<th> Részvény szektora  </th>";
                                    echo "<th> Hány darabom van </th>";
                                    echo "<th> Mikor vásároltam  </th>";

                                    echo "<th> Menyiért vásároltam  </th>";
                                    echo "<th> Jelen ár  </th>";

                                    echo "<th> % vagyon  </th>";


                                    echo "<th> Törlés </th>";

                                    echo "</tr>";
                                    while ($row = $result->fetch_assoc()) {
                                        $idcr = $row["idpersonalstock"];
                                        $url =  "http://www.nasdaq.com" . $row["stockurl"] ;
                                        echo "<tr>";
                                        echo "<td>" . $row["stockname"] . "</td>";
                                        echo "<td style='color: #3a51bb'>" .'<a href="'. $url .'" target="_blank">' . $row["stocksymbol"]  ."</a>" ."</td>";
                                        echo "<td>" . $row["stocksector"] . "</td>";
                                        echo "<td>" . $row["dbstock"] . "</td>";
                                        echo "<td>" . $row["stockdata"] . "</td>";

                                        echo "<td>" . $row["oldprice"] . "</td>";
                                        echo "<td>" .$row["newPrice"] . "</td>";




                                        $sql2 = "SELECT szmet FROM stockszazalek WHERE users_id = '$privateid' AND idpersonalstock = '$idcr' ";
                                        $res = mysqli_query($con, $sql2);
                                        $dat = mysqli_fetch_assoc($res);
                                        $format4 = round($dat['szmet'], 2);

                                        if ($format4 >= 100) {
                                            echo "<td style='background-color: rgba(12,255,18,0.48)'>" . $format4 . '%' . "</td>";
                                        } else {
                                            echo "<td style='background-color:rgba(255,39,23,0.44)'>" . $format4 . '%' . "</td>";
                                        }


                                       $sql3 = "SELECT szvagy FROM stocknyereseg WHERE users_id = '$privateid' AND idpersonalstock = '$idcr' ";
                                        $res = mysqli_query($con, $sql3);
                                        $dat = mysqli_fetch_assoc($res);
                                        $format5 = round($dat['szvagy'], 2);

                                        if ($format5 >= 0) {
                                            echo "<td style='background-color: rgba(12,255,18,0.68)'>" . $format5 . '$' . "</td>";
                                        } else {
                                            echo "<td style='background-color:rgba(255,39,23,0.64)'>" . $format5 . '$' . "</td>";
                                        }


                                        $sql3 = "SELECT sztej FROM stocknyereseg WHERE users_id = '$privateid' AND idpersonalstock = '$idcr' ";
                                        $res = mysqli_query($con, $sql3);
                                        $dat = mysqli_fetch_assoc($res);
                                        $format3 = round($dat['sztej'], 2);

                                        echo "<td style='background-color: rgba(150,206,250,0.46)'>" . $format3 . '$' . "</td>";


                                                                                echo "<td class='level-right' ><a class='button is-black ' href=\"index.php?idpersonalstock=" . $row["idpersonalstock"] . "\">Törlés</a></td>";
                                        echo "</tr>";


                                    }
                                    echo "</table>";
                                } else {
                                    echo "Még nem rögzitette a részvényeit ha szeretné" . "<a href='kereses/stockelokereses.php'> kattintson ide </a>";
                                }
                                ?>
                                </tbody>

                            </div>
                        </article>


                        <article class="tile is-child notification is-danger">
                            <div class="card-table">
                                <div class="content">
                                    <table class="table is-fullwidth is-striped">
                                        <p class="title">Ház <a href="beszur/hazbeszuras.php"><img src="../img/fooldal/icons8-add-96.png" alt="hozzaadd" style="width:25px;height:25px;"></a> </p>

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
                        <article class="tile is-child notification is-danger">
                            <div class="card-table">
                                <div class="content">
                                    <table class="table is-fullwidth is-striped">
                                        <p class="title">Munka <a href="beszur/munkahelybeszuras.php"><img src="../img/fooldal/icons8-add-96.png" alt="hozzaadd" style="width:25px;height:25px;"></a> </p>

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
                        <article class="tile is-child notification is-danger">
                            <div class="card-table">
                                <div class="content">
                                    <table class="table is-fullwidth is-striped">
                                        <p class="title">Kiadás <a href="beszur/kiadasbeszuras.php"><img src="../img/fooldal/icons8-add-96.png" alt="hozzaadd" style="width:25px;height:25px;"></a> </p>

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

            </div>


        </div>

    </div>

</body>
</html>
