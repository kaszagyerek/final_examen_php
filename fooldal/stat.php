<?php
session_start();
require_once "connection.php";


$privateid = $_SESSION['userid'];


$sql2 = "SELECT  *
        FROM crypto INNER JOIN personalcrypto ON crypto.idcrypto = personalcrypto.crypto_idcrypto
        WHERE personalcrypto.users_id = '$privateid' ";

$result2 = $con->query($sql2);


if ($result2->num_rows > 0) {
    // output data of each row
    $dataPoints = array();
    while ($row = $result2->fetch_assoc()) {

        $point = array("label" => $row['cryptosymbol'], "y" => $row['lastprice']);
        array_push($dataPoints, $point);

    }

} else {
    echo "Még nem rögzitette a kiadó házát ha szeretné";
}

?>


<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="/css/bulma.min.css">

    <script>
        window.onload = function () {

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                title: {
                    text: "Kriptó statisztika"
                },
                data: [{
                    type: "pie",
                    legendText: "{label}",
                    indexLabelFontSize: 16,
                    indexLabel: "{label} - #percent%",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });

            chart.render();

        }
    </script>

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


                echo $data['sum1'] + $data2['sum2'] - $data3['sum3'] + $data4['vagyon'] + $data5['vagyon2'] + $data6['vagyon3'];


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
                <a class="link is-info" href="index.php" style="color:red">Fömenű </a>
            </p>
            <p class="level-item has-text-centered">
                <a class="link is-info" href="kapcsolat.php">Kapcsolat</a>
            </p>
        </nav>

    </div>
    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>