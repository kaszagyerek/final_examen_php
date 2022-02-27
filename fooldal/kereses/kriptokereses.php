<?php
session_start();
require_once "connection.php";
if (!isset($_SESSION['username'])) {
    header("Location:../log_reg/log_reg.php");
    exit();
}
?>
<html>
<head>
    <script type="text/javascript" src="../../js/jquery.min.js"></script>
    <link rel="stylesheet" href="/css/bulma.min.css">
    <link rel="icon" type="image/x-icon" href="/img/favicon_io/favicon.ico">

    <title>kriptóvaluta keresés</title>
    <script>
        $(document).ready(function () {
            load_data();

            function load_data(query) {
                $.ajax({
                    url: "keresesapi.php",
                    method: "POST",
                    data: {
                        query: query,
                        action: "kriptokereses"

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
            <h1>Kriptóvalutáim rögzítése</h1>
            <div class="row">
                <div class="col-xs-12">
                    <input type="text" name="search" id="search" placeholder="keresés" class="input is-info"/>
                    <div id="result"></div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>