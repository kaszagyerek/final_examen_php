<?php
require_once "connection.php";
?>
<html>
<head>
    <script type="text/javascript" src="../../js/jquery.min.js"></script>
    <link rel="stylesheet" href="/css/bulma.min.css">
    <link rel="icon" type="image/x-icon" href="/img/favicon_io/favicon.ico">

    <title>részvény keresés</title>
    <script>
        $(document).ready(function () {
            load_data();

            function load_data(query) {
                $.ajax({
                    url: "keresesapi.php",
                    method: "POST",
                    data: {
                        query: query,
                        action: "stocksearch"

                    },
                    success: function (data) {
                        $('#result').html(data);
                    }
                });
            }

            $('#search').keyup(function () {
                var search = $(this).val();
                if (search != '') {
                    load_data(search);
                } else {
                    load_data();
                }
            });
        });
    </script>
</head>
<body>
<div class="container-fluid">
    <div class="content-wrapper">
        <div class="container">
            <p class="title"> <a href="../index.php"><img src="/img/fooldal/back.png" alt="hozzaadd" style="width:25px;height:25px;"> vissza a főmenübe</a> </p>
            <h1 class="subtitle is-3">Részvények közti keresés</h1>
            <div class="row">
                <div class="col-xs-12">
                    <input type="text" name="search" id="search" placeholder="keresés"  class="input is-info"/>
                    <div id="result"></div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>