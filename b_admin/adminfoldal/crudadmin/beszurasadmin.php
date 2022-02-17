<?php
$con = mysqli_connect("localhost", "root", "", "social");
if (mysqli_connect_errno()) {
    echo "Hibás csatlakozás" . mysqli_connect_errno();
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
    <link rel="stylesheet" type="text/css" href="../admin.css">
    <script type="text/javascript" src="/js/jquery.min.js"></script>

</head>

<body>

<!-- START NAV -->
<nav class="navbar is-white">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item brand-text">
<!--                Portfolio admin felület --><?php /*echo "<br>Admin neve:   " . $_SESSION['username']; */?>
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
                            <li><a>Felhasználó részletes adatok</a></li>
                            <li><a>Vip felhasználók</a></li>
                        </ul>
                    </li>
                    <li>
                        <p>Adminok kezelése</p>
                        <ul>
                            <li><a>Admin törlése</a></li>
                            <li><a>Admin hozzáadása</a></li>
                            <li><a>Admin listázása</a></li>
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
                                $sql="SELECT count(username) as total from admin";
                                $result=mysqli_query($con,$sql);
                                $data=mysqli_fetch_assoc($result);
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



                        if ($con->connect_error) {
                            die("Connection failed: " . $con->connect_error);
                        }
                        $sql = "INSERT INTO `admin`( `username`, `email`, `password`) VALUES ('$username','$email','$password')";

                        if ($con->query($sql) === TRUE) {
                            $con->close();
                            echo "Köszönjük! Az adatokat elmentettük.<br>";
                            header("Location:beszurasadmin.php");
                        } else {
                            echo "Muveleti hiba.\n";
                        }
                    }


                    ?>
                    <div class="tile is-parent">
                        <article class="tile is-child box">
                         <form method="post" action="">
<!--                             idadmin, username, email, password-->
                            Username: <input type="text" name="username"> <br>
                           Email:  <input type="email" name="email"> <br>
                           Password  <input type="password" name="password"> <br>
                           Password2  <input type="password" name="password2"> <br>
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
                                    $sql = "SELECT * FROM admin";
                                    $result = $con->query($sql);

                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        echo "<table border=1>";
                                        echo "<tr>";
                                        echo "<th> idadmin </th>";
                                        echo "<th> username </th>";
                                        echo "<th> email </th>";
                                        echo "<th> delete </th>";


                                        echo "</tr>";
                                        while($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>". $row["idadmin"]."</td>";
                                            echo "<td>". $row["username"]."</td>";
                                            echo "<td>". $row["email"]."</td>";
                                            echo "<td class='level-right' ><a class='button is-small is-primary' href=\"delete.php?id=" . $row["idadmin"] . "\">Törlés</a></td>";

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
