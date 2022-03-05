<?php
session_start();
require_once "connection.php";

if (!isset($_SESSION['username'])) {
    header("Location:/laptopallamvizsga/b_admin/log/log.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <!-- Bulma Version 0.9.0-->
    <link rel="stylesheet" href="https://unpkg.com/bulma@0.9.0/css/bulma.min.css"/>
    <link rel="stylesheet" type="text/css" href="../admin.css">
    <script type="text/javascript" src="/js/jquery.min.js"></script>

</head>

<body>

<!-- START NAV -->
<nav class="navbar is-white">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item brand-text">
                Portfolio admin felület <?php
                if ($_SESSION['username'] == 'ksandor') {
                    echo "<div style='color: #FF416C'>";
                    echo "  Az egyetlen superadmin " . $_SESSION['username'];
                    echo "</div>";

                } else {
                    echo "   Üdvözölek kedves admin :  " . $_SESSION['username'];
                }

                ?>
            </a>
        </div>
    </div>
</nav>
<!-- END NAV -->
<div class="container">
    <div class="columns">
        <div class="column is-3 " id="cl3">
            <aside class="menu is-hidden-mobile">
                <ul class="menu-list">
                    <li>
                        <p>Felhasználók</p>
                        <ul>
                            <li><a href="../admin.php">Felhasználó részletes adatok</a></li>
                            <li><a>Vip felhasználók</a></li>
                        </ul>
                    </li>
                    <li>
                        <p>Admin</p>
                        <ul>
                            <li><a href="beszurasadmin.php">Admin crud</a></li>
                            <li><a href="../destroyadmin.php">Kijelentkezés</a></li>
                        </ul>
                    </li>

                </ul>

            </aside>
        </div>
        <div class="column is-9" id="9clc">

            <section class="hero is-info welcome is-small">
                <div class="hero-body">
                    <div class="container">
                        <h1 class="title">
                            Admin felület

                        </h1>
                        <h2 class="subtitle">
                        </h2>
                    </div>
                </div>
            </section>
            <section class="info-tiles">
                <div class="tile is-ancestor has-text-centered">
                    <div class="tile is-parent">
                        <article class="tile is-child box">
                            <p class="title">
                                <?php
                                $sql = "SELECT count(username) as total from admin WHERE NOT username='ksandor';";
                                $result = mysqli_query($con, $sql);
                                $data = mysqli_fetch_assoc($result);
                                echo $data['total'];
                                ?>
                            </p>
                            <p class="subtitle">Adminok száma</p>
                        </article>
                    </div>
                    <?php

                    if (isset($_POST['submit'])) {
                        $username = $_POST['username'];
                        $email = $_POST['email'];
                        $password = $_POST['password'];
                        $password2 = $_POST['password2'];

                        if (isset($username) && isset($email) && isset($password) && isset($password2) && !empty($username) && !empty($email) && !empty($password) && !empty($password2)
                            && strlen($username) >= 5 && strlen($email) >= 7) {
                            if ($password == $password2) {
                                $query = mysqli_query($con, "SELECT `username`, `email`, `password` FROM `admin` WHERE '$username' = username OR '$email' = email");
                                if (!(mysqli_num_rows($query) > 0)) {
                                    $sql = "INSERT INTO `admin`( `username`, `email`, `password`) VALUES ('$username','$email','$password')";
                                    if ($con->query($sql) === TRUE) {
                                        $con->close();
                                        echo "Köszönjük! Az adatokat elmentettük.<br>";
                                        header("Location:beszurasadmin.php");
                                    }
                                } else {
                                    echo "Az email cím vagy a felhasználonév már foglalt";
                                }

                            } else {
                                echo "A 2 jelszó nem egyezik meg<br>";
                            }
                        } else {
                            if (empty($username)) {
                                echo "A felhasználonév nem lehet üres<br> ";
                            } else if (!empty($username) && strlen($username) < 5) {
                                echo "A felhasználonév legalább 6 karakter hosszú<br>";
                            }
                            if (empty($email)) {
                                echo "Az emailcím nem lehet üres<br>";
                            } else if (!empty($email) && strlen($email) < 7) {
                                echo "Az emailcím minimum 7 karakter kell legyen<br>";
                            }
                            if (empty($password)) {
                                echo "A jelszó nem lehet üres<br>";
                            } else if (!empty($password) && strlen($password) < 5) {
                                echo "A jelszó minimum 5 karakter kell legyen<br>";
                            }
                            if (empty($password2)) {
                                echo "A megerősítő jelszó nem lehet üres<br>";
                            } else if (!empty($password2) && strlen($password2) < 5) {
                                echo "A megerősítő jelszó minimum 5 karakter kell legyen<br>";
                            }
                        }
                    }


                    if (isset($_GET['idadmin'])) {
                        $idadmin = $_GET['idadmin'];
                        $sql = "DELETE FROM admin WHERE idadmin=$idadmin";

                        if ($con->query($sql) === TRUE) {
                            header("Location: beszurasadmin.php");
                        } else {
                            echo "Hiba történt: " . $con->error;
                        }
                    }


                    ?>
                    <div class="tile is-parent">
                        <article class="tile is-child box">
                            <form method="post" action="">
                                <!--                             idadmin, username, email, password-->
                                Felhasználónév: <input type="text" name="username"> <br>
                                Emailcím: <input type="email" name="email"> <br>
                                Jelszó: <input type="password" name="password"> <br>
                                Megerősítő jelszó: <input type="password" name="password2"> <br>
                                <input type="submit" name="submit" value="Elküld">
                            </form>
                        </article>
                    </div>
                </div>
            </section>
            <div class="columns">
                <div class="column is-6" id="userlista">
                    <div class="card events-card">
                        <header class="card-header">
                            <p class="card-header-title">
                                Felhasználók:
                            </p>
                            <a href="#" class="card-header-icon" aria-label="more options">
                  <span class="icon">
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                  </span>
                            </a>
                        </header>
                        <div class="card-table">
                            <div class="content">
                                <table class="table is-fullwidth is-striped">
                                    <tbody>
                                    <?php

                                    /* idadmin, username, email, password */
                                    /*'1', 'ksandor', 'kasza@kasza.com', 'admin' */
                                    $sql = "SELECT * FROM admin WHERE NOT username='ksandor';";
                                    $result = $con->query($sql);

                                    if ($result->num_rows > 0) {
                                        echo "<table border=1>";
                                        echo "<tr>";
                                        echo "<th> idadmin </th>";
                                        echo "<th> username </th>";
                                        echo "<th> email </th>";
                                        echo "<th> delete </th>";


                                        echo "</tr>";
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row["idadmin"] . "</td>";
                                            echo "<td>" . $row["username"] . "</td>";
                                            echo "<td>" . $row["email"] . "</td>";
                                            echo "<td class='level-right' ><a class='button is-small is-primary' href=\"beszurasadmin.php?idadmin=" . $row["idadmin"] . "\">Törlés</a></td>";

                                            echo "</tr>";
                                        }
                                        echo "</table>";
                                    } else {
                                        echo "0 results";
                                    }
                                    $con->close();
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>
