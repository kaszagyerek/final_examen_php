<?php
session_start();
require_once "../connect.php";
if (!isset($_SESSION['username'])) {
    header("Location:../log/log.php");
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
    <link rel="stylesheet" href="https://unpkg.com/bulma@0.9.0/css/bulma.min.css" />
    <link rel="stylesheet" type="text/css" href="admin.css">
</head>

<body>

<!-- START NAV -->
<nav class="navbar is-white">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item brand-text">
                Portfolio admin felület <?php
                if ($_SESSION['username'] == 'ksandor'){
                    echo "<div style='color: #FF416C'>";
                    echo "   Az egyetlen superadmin " . $_SESSION['username'];
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
                            <li><a href="admin.php">Felhasználó részletes adatok</a></li>
                            <li><a>Vip felhasználók</a></li>
                        </ul>
                    </li>
                    <li>
                        <p>Admin</p>
                        <ul>
                            <li><a href="crudadmin/beszurasadmin.php">Admin crud</a></li>
                            <li><a href="../adminfoldal/destroyadmin.php">Kijelentkezés</a></li>
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
                                $sql="SELECT count(username) as total from users";
                                $result=mysqli_query($con,$sql);
                                $data=mysqli_fetch_assoc($result);
                                echo $data['total'];
                                ?>
                            </p>
                            <p class="subtitle">Az összes felhasználója eddig az oldalnak</p>
                        </article>
                    </div>
                    <div class="tile is-parent">
                        <article class="tile is-child box">
                            <p class="title">
                                <?php
                                $sql="SELECT (SELECT SUM(salary) FROM workplace) + (SELECT SUM(totalhprice) FROM house) -  (SELECT SUM(broker+tax+hrenovation) FROM expense)AS sum;";                              $result=mysqli_query($con,$sql);
                                $data=mysqli_fetch_assoc($result);
                                echo $data['sum'];
                                ?>
                                ron
                            </p>
                            <p class="subtitle">Teljes vagyona a felhasználóknak</p>
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

                                    $sql = "SELECT * FROM users";
                                    $result = $con->query($sql);

                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        echo "<table border=1>";
                                        echo "<tr>";
                                        echo "<th> id </th>";
                                        echo "<th> firs_name </th>";
                                        echo "<th> last_name </th>";
                                        echo "<th> username </th>";
                                        echo "<th> email </th>";
                                        echo "<th> signup_date </th>";
                                        echo "<th> phone_number </th>";
                                        echo "<th> delete </th>";


                                        echo "</tr>";
                                        while($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>". $row["id"]."</td>";
                                            echo "<td>". $row["firs_name"]."</td>";
                                            echo "<td>". $row["last_name"]."</td>";
                                            echo "<td>". $row["username"]."</td>";
                                            echo "<td>". $row["email"]."</td>";
                                            echo "<td>". $row["signup_date"]."</td>";
                                            echo "<td>". $row["phone_number"]."</td>";
                                            echo "<td class='level-right' ><a class='button is-small is-primary' href=\"delete.php?id=" . $row["id"] . "\">Törlés</a></td>";

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
