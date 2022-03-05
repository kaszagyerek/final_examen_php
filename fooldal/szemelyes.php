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
    <link rel="icon" type="image/x-icon" href="../img/favicon_io/favicon.ico">


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
        <p class="level-item has-text-centered"></p>

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
            <a class="link is-info" href="index.php" style="color:red">Vissza a főmenüre</a>
        </p>
        <p class="level-item has-text-centered">
            <a class="link is-info" href="stat.php">Statisztika</a>
        </p>
        <p class="level-item has-text-centered">
            <a class="link is-info" href="kapcsolat.php">Kapcsolat</a>
        </p>
    </nav>
    <div class="vertical-menu">
        <a href="beszur/hazbeszuras.php" class="dark">Házam rögzítése</a>
        <a href="beszur/munkahelybeszuras.php" class="narancs">Munkahelyem rögzítése</a>
        <a href="beszur/kiadasbeszuras.php" class="lila">Kiadásaim rögzítése</a>
        <a href="kereses/kriptokereses.php" class="active">Kriptó élő keresés</a>
        <a href="kereses/stockelokereses.php" class="active">Részvény élő keresés</a>
        <a href="kereses/metalskereses.php" class="active">Nemesfém élő keresés</a>
        <a href="../log_reg/kijelentkezes.php">Kijelentkezes</a>
    </div>
    <div class="tile is-ancestor">
        <div class="tile is-vertical is-8">
            <div class="tile">
                <div class="tile is-parent is-vertical">
                    <article class="tile is-child notification is-danger">
                        <div class="card-table">
                            <div class="content">
                                <?php
                                $privateid = $_SESSION['userid'];
                                if (isset($_POST['vezeteknev'])) {
                                    $vnev = $_POST['vnev'];
                                    if (isset($vnev) && !empty($vnev) && strlen($vnev) >= 3) {
                                        $sql = "UPDATE `users` SET `firs_name`='$vnev' WHERE id = '$privateid' ";

                                        if ($con->query($sql) === TRUE) {
                                            header("Location: szemelyes.php");
                                        } else {
                                            echo "Hiba történt: " . $con->error;
                                        }
                                    } else {
                                        if (empty($vnev)) {
                                            echo "A vezetéknév nem lehet üres<br>";
                                        } else if (!empty($vnev) && strlen($vnev) < 3) {
                                            echo "A vezetéknév minimum 4 karakter hosszú kell legyen<br>";
                                        }
                                    }
                                }
                                $sql = "SELECT firs_name FROM users WHERE id = '$privateid' ";
                                $result = $con->query($sql);

                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    echo "<table border=1 >";
                                    echo "<tr>";
                                    echo "<th> Vezetékneve </th>";


                                    /*idhouse, addres, totalhprice, ownPerson, ownMobil, users_id, housedate */
                                    echo "</tr>";
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row["firs_name"] . "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</table>";
                                }
                                ?>
                                <form method="post" action="">
                                    Új vezetékneve:<input type="Text" name="vnev"><br>
                                    <input class="button is-black" type="submit" name="vezeteknev" value="szerkeszt">
                                </form>
                            </div>
                        </div>

                    </article>
                    <article class="tile is-child notification is-danger">
                        <div class="card-table">
                            <div class="content">
                                <?php
                                $privateid = $_SESSION['userid'];
                                if (isset($_POST['keresztnev'])) {
                                    $knev = $_POST['knev'];
                                    if (isset($knev) && !empty($knev) && strlen($knev) >= 3) {
                                        $sql = "UPDATE `users` SET `last_name`='$knev' WHERE id = '$privateid' ";

                                        if ($con->query($sql) === TRUE) {
                                            header("Location: szemelyes.php");
                                        } else {
                                            echo "Hiba történt: " . $con->error;
                                        }
                                    } else {
                                        if (empty($knev)) {
                                            echo "A keresztnév nem lehet üres<br>";
                                        } else if (!empty($knev) && strlen($knev) < 3) {
                                            echo "A keresztnév minimum 4 karakter hosszú kell legyen<br>";
                                        }
                                    }
                                }
                                $sql = "SELECT last_name FROM users WHERE id = '$privateid' ";
                                $result = $con->query($sql);

                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    echo "<table border=1 >";
                                    echo "<tr>";
                                    echo "<th> Keresztneve </th>";


                                    /*idhouse, addres, totalhprice, ownPerson, ownMobil, users_id, housedate */
                                    echo "</tr>";
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row["last_name"] . "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</table>";
                                }
                                ?>
                                <form method="post" action="">
                                    Új keresztneve:<input type="Text" name="knev"><br>
                                    <input class="button is-black" type="submit" name="keresztnev" value="szerkeszt">
                                </form>
                            </div>
                        </div>

                    </article>

                </div>
            </div>
            <div class="tile is-parent">
                <article class="tile is-child notification is-info">
                    <p class="title"></p>
                    <p class="subtitle"></p>
                    <div class="content">
                        <?php
                        $privateid = $_SESSION['userid'];
                        if (isset($_POST['em'])) {
                            $email = $_POST['email'];
                            $email2 = $_POST['email2'];
                            if (isset($email) && !empty($email) && strlen($email) >= 6
                                && isset($email2) && !empty($email2) && strlen($email2) >= 6) {
                                if ($email == $email2) {
                                    $query = mysqli_query($con, "SELECT  `email` FROM `users` WHERE  '$email' = email");
                                    if (!(mysqli_num_rows($query) > 0)) {
                                        $sql = "UPDATE `users` SET `email`='$email' WHERE id = '$privateid' ";

                                        if ($con->query($sql) === TRUE) {
                                            header("Location: szemelyes.php");
                                        } else {
                                            echo "Hiba történt: " . $con->error;
                                        }
                                    } else {
                                        echo "Ez a mail cím már foglalt";
                                    }
                                } else {
                                    echo "2 emailcím nem egyezik meg<br>";
                                }

                            } else {
                                if (empty($email)) {
                                    echo "A email nem lehet üres<br>";
                                } else if (!empty($email) && strlen($email) < 6) {
                                    echo "Az email minimum 6 karakter hosszú kell legyen<br>";
                                }
                                if (empty($email2)) {
                                    echo "Az email2 nem lehet üres<br>";
                                } else if (!empty($email2) && strlen($email2) < 6) {
                                    echo "A email2 minimum 6 karakter hosszú kell legyen<br>";
                                }
                            }
                        }
                        $sql = "SELECT email FROM users WHERE id = '$privateid' ";
                        $result = $con->query($sql);

                        if ($result->num_rows > 0) {
                            // output data of each row
                            echo "<table border=1 >";
                            echo "<tr>";
                            echo "<th> Emailcíme </th>";

                            echo "</tr>";
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["email"] . "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        }
                        ?>
                        <form method="post" action="">
                            Új emailcíme:<input type="email" name="email"><br>
                            Kérem mégegyszer adja meg:<input type="email" name="email2"><br>
                            <input class="button is-black" type="submit" name="em" value="szerkeszt">
                        </form>
                    </div>
                </article>
            </div>
            <div class="tile is-parent">
                <article class="tile is-child notification is-danger">
                    <p class="title"></p>
                    <p class="subtitle"></p>
                    <div class="content">
                        <?php
                        $privateid = $_SESSION['userid'];
                        if (isset($_POST['pas'])) {
                            $password = mysqli_real_escape_string($con, $_POST['password']);
                            $password2 = mysqli_real_escape_string($con, $_POST['password2']);
                            /*                           $jelenlegi = mysqli_real_escape_string($con,$_POST['jelenlegi']);*/

                            if (isset($password) && !empty($password) && strlen($password) >= 5
                                && isset($password2) && !empty($password2) && strlen($password2) >= 5) {
//                               /* && isset($jelenlegi) && !empty($jelenlegi) && strlen($jelenlegi) >= 4*/
                                if ($password == $password2) {
                                    $password = md5($password);
                                    /* $query = mysqli_query($con, "SELECT `password` FROM `users` WHERE  '$jelenlegi' = $pr ");
                                     if (mysqli_num_rows($query) > 0) {*/
                                    $sql = "UPDATE `users` SET `password`='$password' WHERE id = '$privateid' ";

                                    if ($con->query($sql) === TRUE) {
                                        echo "<br>sikeresen megváltozott a jelszava<br>";
                                    } else {
                                        echo "Hiba történt: " . $con->error;
                                    }
                                } else {
                                    echo "a 2 jelszó nem egyezik";
                                }
                            } /* else {
}
                                        echo "Nem jól adta meg a jelszavát";
                            }*/
                            else {
                                if (empty($password)) {
                                    echo "A jelszó nem lehet üres<br>";
                                } else if (!empty($password) && strlen($password) < 5) {
                                    echo "A jelszó minimum 6 karakter hosszú kell legyen<br>";
                                }
                                if (empty($password2)) {
                                    echo "A megerősítő jelszó nem lehet üres<br>";
                                } else if (!empty($password2) && strlen($password2) < 5) {
                                    echo "A megerőstő jelszó minimum 6 karakter hosszú kell legyen<br>";
                                }
                            }
                        }

                        echo "Jelszó megváltoztatása:<br>";
                        ?>
                        <form method="post" action="">
                            <!--                            Jelenlegi jelszava:<input type="text" name="jelenlegi"><br>-->
                            Új jelszó:<input type="password" name="password"><br>
                            Jelszó megerősítés:<input type="password" name="password2"><br>
                            <input class="button is-black" type="submit" name="pas" value="szerkeszt">
                        </form>
                    </div>
                </article>
            </div>
            <div class="tile is-parent">
                <article class="tile is-child notification is-danger">
                    <p class="title"></p>
                    <p class="subtitle"></p>
                    <div class="content">
                        <?php
                        $privateid = $_SESSION['userid'];
                        if (isset($_POST['vtelefon'])) {
                            $telefon = mysqli_real_escape_string($con, $_POST['telefon']);
                            if (isset($telefon) && !empty($telefon) && strlen($telefon) >= 8 && is_numeric($telefon)) {
                                $sql = "UPDATE `users` SET `phone_number`='$telefon' WHERE id = '$privateid' ";

                                if ($con->query($sql) === TRUE) {
                                    echo "sikeresen rögzitettük a telefonszámát<br>";
                                } else {
                                    echo "Hiba történt: " . $con->error;
                                }
                            } else {
                                if (empty($telefon)) {
                                    echo "A telefonszám nem lehet üres<br>";
                                } else if (!empty($telefon) && strlen($telefon) < 8) {
                                    echo "A telefonszám minimum 8 számot  kell legyen<br>";
                                }
                            }
                        }
                        $sql = "SELECT phone_number FROM users WHERE id = '$privateid' ";
                        $result = $con->query($sql);

                        if ($result->num_rows > 0) {
                            // output data of each row
                            echo "<table border=1 >";
                            echo "<tr>";
                            echo "<th> Telefonszáma </th>";


                            echo "</tr>";
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["phone_number"] . "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        }
                        ?>
                        <form method="post" action="">
                            Új telefonszáma:<input type="Text" name="telefon"><br>
                            <input class="button is-black" type="submit" name="vtelefon" value="szerkeszt">
                        </form>
                    </div>
                </article>
            </div>
            <div class="tile is-parent">
                <article class="tile is-child notification is-danger">
                    <p class="title"></p>
                    <p class="subtitle"></p>
                    <div class="content">
                        <?php

                        $privateid = $_SESSION['userid'];
                        /*                        if (isset($_POST['submit'])) {
                                                    $valid_formats = array("image/jpg", "image/jpeg","image/png", "image/bmp");
                                                    if(!in_array($_FILES["kep"]["type"], $valid_formats)) {
                                                        die("Csak JPG, PNG vagy BMP!");
                                                    }

                                                    if ($_FILES["kep"]["error"] != 0){
                                                        die("Hiba a feltöltés során");
                                                    }


                                                    if($_FILES["kep"]["size"] > 10*1024*1024) {
                                                        die("Túl nagy méretű fájl");
                                                    }
                                                    move_uploaded_file($_FILES["kep"]["tmp_name"], "laptopallamvizsga/img/profile_pics/" . $_FILES["kep"]["name"]);


                                                    $fenykep = mysqli_real_escape_string($con,$_POST['img']);
                                                    if (isset($fenykep) && !empty($fenykep)) {
                                                        $image = file_get_contents($fenykep);
                                                        file_put_contents('laptopallamvizsga/img/profile_pics', $image);

                                                        $sql = "UPDATE `users` SET `profile_pic`='$fenykep' WHERE id = '$privateid' ";

                                                        if ($con->query($sql) === TRUE) {
                                                            echo "sikeresen rögzitettük a fényképét<br>";
                                                        } else {
                                                            echo "Hiba történt: " . $con->error;
                                                        }
                                                    } else {
                                                        if (empty($fenykep)) {
                                                            echo "A fényképet üresen nem lehet beküldeni<br>";
                                                        }
                                                    }
                                                }*/
                        $sql = "SELECT profile_pic FROM users WHERE id = '$privateid' ";
                        $result = $con->query($sql);

                        if ($result->num_rows > 0) {
                            echo "<table border=1 >";
                            echo "<tr>";
                            echo "<th> Profilképe </th>";


                            echo "</tr>";
                            while ($row = $result->fetch_assoc()) {
                                $kep = $row["profile_pic"];
                                echo "<tr>";
                                echo "<td>" . "<img src=../img/profile_pics/$kep width='100' height='100''>" . "</td>";
                                echo "</tr>";

                            }
                            echo "</table>";
                        }
                        ?>
                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="file" name="kep"/>
                            <input type="submit" value="Upload!"/>
                        </form>
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

</body>
</html>
