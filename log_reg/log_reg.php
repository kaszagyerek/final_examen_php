<?php
session_start();
?>


<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>login</title>

    <link href="../css/szepito.css" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/x-icon" href="/img/favicon_io/favicon.ico">

    <title>bejelentkezés</title>
</head>

<body>

<div class="container" id="container">
    <div class="form-container sign-up-container">


        <form id="regi">
            <h1>Regisztráció</h1>


            <input type="text" name="reg_fname" id="fname" placeholder="Vezetéknév" required/>
            <input type="text" name="reg_lname" id="lname" placeholder="Keresztnév" required/>
            <input type="tel" name="phone_number" id="phone" placeholder="Telefonszám" required/>
            <input type="email" name="reg_email" id="em" placeholder="Mailcím" required/>
            <input type="email" name="reg_email2" id="em2" placeholder="Mailcím megerősítés" required/>
            <input type="password" name="reg_password" id="password" placeholder="Jelszó"/>
            <input type="password" name="reg_password2" id="password2" placeholder="Jelszó megerősítés"/>
            <button name="register_button" id="regbut" value="Register"> Regisztráció</button>
        </form>

    </div>


    <div class="form-container sign-in-container">
        <form id="fupForm">
            <h1>Bejelentkezés</h1>

            <input type="email" id="emailajax" name="log_email" placeholder="emailcímd"/>
            <input type="password" id="passwordajax" name="log_password" placeholder="jelszód"/>
            <a href="#">Elfelejtetted a jelszavad?</a>
            <button name="login_button" id="btnLoginResponse">Bejelentkezés</button>
            <a class="visszadm" href="../b_admin/log/log.php"> Admin bejelentkezés </a>


        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Ha van fiókod</h1>

                <button class="ghost" id="signIn">Vissza a bejelentkezésre!</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>Ha szeretnél regisztrálni</h1>

                <button class="ghost" id="signUp">Regisztácíó</button>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });

    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });</script>
<script>

    $(document).ready(function () {
        $('#regbut').on('click', function () {
            $("#regbut").attr("disabled", "disabled");
            var fname = $('#fname').val();
            var lname = $('#lname').val();
            var em = $('#em').val();
            var em2 = $('#em2').val();
            var password = $('#password').val();
            var password2 = $('#password2').val();
            var phone = $('#phone').val();


            if (fname != "" && lname != "" && em != "" && em2 != "" && password != "" && password2 != "" && phone != "") {
                $.ajax({
                    url: "api.php",
                    type: "POST",
                    data: {
                        fname: fname,
                        lname: lname,
                        em: em,
                        em2: em2,
                        password: password,
                        password2: password2,
                        phone: phone,
                        action: "regisztracio"

                    },
                    cache: false,

                    success: function (dataResult) {
                        var dataResult = JSON.parse(dataResult);
                        if (dataResult.valasz == true) {
                            $("#regbut").removeAttr("disabled");
                            $('#regi').find('input:text').val('');
                            $("#success").show();

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
                        action: "bejelentkezes"
                    },
                    cache: false,
                    success: function (dataResult) {
                        var dataResult = JSON.parse(dataResult);
                        console.log(dataResult);

                        if (dataResult.valasz == true) {
                            window.location.href = "../fooldal/index.php";
                            $("#btnLoginResponse").removeAttr("disabled");
                            $("#success").show();
                            $('#success').html('Sikeresen bejelentkezett');

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