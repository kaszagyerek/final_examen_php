<?php
session_start();
require_once "connect.php";

?>


<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>login</title>

    <link href="szepitoadmin.css" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/x-icon" href="/img/favicon_io/favicon.ico">

    <title>admin belépés</title>

</head>

<body>


<div class="form-container sign-in-container">
    <form id="fupForm">
        <h1>Admin bejelentkezés</h1>

        <input type="email" id="emailajax" name="log_email" placeholder="emailcímd"/>
        <input type="password" id="passwordajax" name="log_password" placeholder="jelszód"/>
        <button name="login_button" id="btnLoginResponse">Bejelentkezés</button>
        <a class="visszafelh" href="/laptopallamvizsga/log_reg/log_reg.php"> Felhasználó bejelentkezés </a>


    </form>
</div>

<script type="text/javascript" src="../js/jquery.min.js"></script>

<script>

    $(document).ready(function () {
        $('#btnLoginResponse').on('click', function () {
            $("#btnLoginResponse").attr("disabled", "disabled");
            var email = $('#emailajax').val();
            var password = $('#passwordajax').val();

            if (email != "" && password != "") {
                $.ajax({
                    url: "api.php",
                    type: "POST",
                    data: {
                        email: email,
                        password: password,
                        action: "admin"
                    },
                    cache: false,

                    success: function (dataResult) {

                        var dataResult = JSON.parse(dataResult);
                        console.log(dataResult);

                        if (dataResult.valasz == true) {
                            console.log("hello");

                            window.location.href = "../adminfoldal/admin.php";


                            $("#btnLoginResponse").removeAttr("disabled");
                            $("#success").show();
                            $('#success').html('Sikeresen bejelentkezett')

                        } else if (dataResult.valasz == false) {
                            alert("Nem jol adta meg az adatokat");

                        }

                    }
                });
            } else {
                alert("Toltsel ki minden mezot");
            }
        });
    });
</script>


</body>
</html>