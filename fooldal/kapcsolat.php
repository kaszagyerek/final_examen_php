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

    <title>kapcsolat</title>

    <link href="../css/index_szepito.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="rendez">
    <div class="ballmenu">
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
                <a style="color:red" class="link is-info" href="index.php">Vissza a főmenüre</a>
            </p>
        </nav>

    </div>
    <div class="jobbmenu">
        <section class="hero is-success is-fullheight">
            <div class="tile is-ancestor">
                <div class="tile is-vertical is-8">
                    <div class="tile">
                        <div class="tile is-parent is-vertical">
                            <article class="tile is-child notification is-black">
                                <p class="title">Nyitvatartásunk</p>
                                <p> Cím: Strada Patinoarului 9, Miercurea Ciuc 530003</p>
                                <p>hétfő 10:00–15:00</p>
                                <p>kedd	10:00–15:00</p>
                                <p>szerda 10:00–15:00</p>
                                <p>csütörtök 10:00–15:00</p>
                                <p>péntek 10:00–15:00</p>
                                <p>szombat 12:00–14:00</p>
                                <p>vasárnap 12:00–14:00</p>
                            </article>
                            <article class="tile is-child notification is-black">
                                <br>
                                <p class="subtitle">Telefonszám: 0746064477</p>
                                <p class="subtitle">Emailcím: kaszasandor@uni.sapientia.ro</p>
                            </article>
                            <article class="tile is-child notification is-black">


                                <div class="field">
                                    <p class="subtitle">Ha szeretnél üzenetet küldeni nekünk:</p>
                                    <div class="control">
                                        <textarea class="textarea" placeholder="Üzenetet ide irhatja be "></textarea>
                                    </div>
                                </div>


                                <div class="field is-grouped">
                                    <div class="control">
                                        <button class="button is-link">Elküldés</button>
                                    </div>
                                </div>
                            </article>

                        </div>

                        <div class="tile is-parent">
                            <article class="tile is-child notification is-black">
                                <p class="title">KaszaPortfolio előfizetés</p>
                                <p class="subtitle">A KaszaPortfolió csapatának fő célja, hogy az oldal a jövőben is ingyenes formában, teljes funkcionalitással tudjon működni. Sajnos az ehhez szükséges fenntartási és fejlesztési költségeket jelenleg reklámmentes az oldalunk, ezért találtuk ki a támogatás alapú Prémium tagságot.
                                    Alapelvünk, hogy nem tiltjuk le és nem korlátozzuk az ingyenes verzió funkciót, így megőrizzük az ingyenes verzió teljes körű használhatóságát a továbbiakban is.
                                    A Prémium tagság vásárlására senkit nem célunk rábeszélni, szeretnénk ha ezt inkább az oldal támogatása végett tennétek meg és a vele járó plusz prémium funkciókra köszönetünk jeleként tekintenétek.</p>

                                <p class="subtitle"> Itt teheti meg 5 euró / hónap </p>
                                <p class="subtitle"> Közleménybe írja be a felhasználónevét </p>
                                <form action="https://www.paypal.com" method="post">

                                    <input type="hidden" name="cmd" value="_s-xclick">
                                    <input type="hidden" name="hosted_button_id" value="221">

                                    <input type="image" name="submit"
                                           src="../img/kapcsolat/paypal.png"
                                           alt="PayPal - The safer, easier way to pay online" width="250" height="100">
                                </form>
                            </article>
                        </div>
                    </div>

                </div>
                <div class="tile is-parent">
                    <article class="tile is-child notification is-black">
                        <div class="content">
                            <br>
                            <p class="subtitle">Ha szeretne meglátogatni minket</p>

                            <div class="mapsk">
                                <iframe  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29128.52628189388!2d25.779858691974738!3d46.34996840640623!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x474b2a11ee2d0f9b%3A0x8c9a52dac2586a4b!2sSapientia%20Erd%C3%A9lyi%20Magyar%20Tudom%C3%A1nyegyetem!5e1!3m2!1shu!2sro!4v1645439682001!5m2!1shu!2sro" width="450" height="800" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </section>
    </div>

</div>

</body>
</html>
