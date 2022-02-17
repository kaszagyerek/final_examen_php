<?php
session_start();
require_once "../log/connection.php";
if (!isset($_SESSION['username'])) {
    header("Location:log.php");
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
                Portfolio admin felület
            </a>
        </div>
    </div>
</nav>
<!-- END NAV -->
<div class="container">
    <div class="columns">
        <div class="column is-3 ">
            <aside class="menu is-hidden-mobile">
                <ul class="menu-list">
                    <li>
                        <a>Felhasználók</a>
                        <ul>
                            <li><a>Felhasználó törlése</a></li>
                            <li><a>Vip felhasználók</a></li>
                        </ul>
                    </li>
                    <li>
                        <a>Adminok kezelése</a>
                        <ul>
                            <li><a>Admin törlése</a></li>
                            <li><a>Admin hozzáadása</a></li>
                            <li><a href="destroyadmin.php">Kijelentkezés</a></li>
                        </ul>
                    </li>

                </ul>

            </aside>
        </div>
        <div class="column is-9">
            <nav class="breadcrumb" aria-label="breadcrumbs">
                <ul>
                    <li class="is-active"><a href="#" aria-current="page">Admin</a></li>
                </ul>
            </nav>
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
                            <p class="title">439k</p>
                            <p class="subtitle">Felhasználók</p>
                        </article>
                    </div>
                    <div class="tile is-parent">
                        <article class="tile is-child box">
                            <p class="title">59k</p>
                            <p class="subtitle">Teljes vagyona a felhasználóknak</p>
                        </article>
                    </div>
                </div>
            </section>
            <div class="columns">
                <div class="column is-6">
                    <div class="card events-card">
                        <header class="card-header">
                            <p class="card-header-title">
                                Events
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
                                    <tr>
                                        <td width="5%"><i class="fa fa-bell-o"></i></td>
                                        <td>Lorum ipsum dolem aire</td>
                                        <td class="level-right"><a class="button is-small is-primary" href="#">Action</a></td>
                                    </tr>
                                    <tr>
                                        <td width="5%"><i class="fa fa-bell-o"></i></td>
                                        <td>Lorum ipsum dolem aire</td>
                                        <td class="level-right"><a class="button is-small is-primary" href="#">Action</a></td>
                                    </tr>
                                    <tr>
                                        <td width="5%"><i class="fa fa-bell-o"></i></td>
                                        <td>Lorum ipsum dolem aire</td>
                                        <td class="level-right"><a class="button is-small is-primary" href="#">Action</a></td>
                                    </tr>
                                    <tr>
                                        <td width="5%"><i class="fa fa-bell-o"></i></td>
                                        <td>Lorum ipsum dolem aire</td>
                                        <td class="level-right"><a class="button is-small is-primary" href="#">Action</a></td>
                                    </tr>
                                    <tr>
                                        <td width="5%"><i class="fa fa-bell-o"></i></td>
                                        <td>Lorum ipsum dolem aire</td>
                                        <td class="level-right"><a class="button is-small is-primary" href="#">Action</a></td>
                                    </tr>
                                    <tr>
                                        <td width="5%"><i class="fa fa-bell-o"></i></td>
                                        <td>Lorum ipsum dolem aire</td>
                                        <td class="level-right"><a class="button is-small is-primary" href="#">Action</a></td>
                                    </tr>
                                    <tr>
                                        <td width="5%"><i class="fa fa-bell-o"></i></td>
                                        <td>Lorum ipsum dolem aire</td>
                                        <td class="level-right"><a class="button is-small is-primary" href="#">Action</a></td>
                                    </tr>
                                    <tr>
                                        <td width="5%"><i class="fa fa-bell-o"></i></td>
                                        <td>Lorum ipsum dolem aire</td>
                                        <td class="level-right"><a class="button is-small is-primary" href="#">Action</a></td>
                                    </tr>
                                    <tr>
                                        <td width="5%"><i class="fa fa-bell-o"></i></td>
                                        <td>Lorum ipsum dolem aire</td>
                                        <td class="level-right"><a class="button is-small is-primary" href="#">Action</a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <footer class="card-footer">
                            <a href="#" class="card-footer-item">View All</a>
                        </footer>
                    </div>
                </div>
                <div class="column is-6">
                    <div class="card">
                        <header class="card-header">
                            <p class="card-header-title">
                                Inventory Search
                            </p>
                            <a href="#" class="card-header-icon" aria-label="more options">
                  <span class="icon">
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                  </span>
                            </a>
                        </header>
                        <div class="card-content">
                            <div class="content">
                                <div class="control has-icons-left has-icons-right">
                                    <input class="input is-large" type="text" placeholder="">
                                    <span class="icon is-medium is-left">
                      <i class="fa fa-search"></i>
                    </span>
                                    <span class="icon is-medium is-right">
                      <i class="fa fa-check"></i>
                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <header class="card-header">
                            <p class="card-header-title">
                                User Search
                            </p>
                            <a href="#" class="card-header-icon" aria-label="more options">
                  <span class="icon">
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                  </span>
                            </a>
                        </header>
                        <div class="card-content">
                            <div class="content">
                                <div class="control has-icons-left has-icons-right">
                                    <input class="input is-large" type="text" placeholder="">
                                    <span class="icon is-medium is-left">
                      <i class="fa fa-search"></i>
                    </span>
                                    <span class="icon is-medium is-right">
                      <i class="fa fa-check"></i>
                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script async type="text/javascript" src="bulma.js"></script>
</body>

</html>
