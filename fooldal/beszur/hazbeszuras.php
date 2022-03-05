<?php
session_start();
require_once "../connection.php";


echo "<br>Felhasználó neve:" . $_SESSION['username'];
echo "<br>Felhasználó ID-ja:" . $_SESSION['userid'];

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <script type="text/javascript" src="../../js/jquery.min.js"></script>
    <link href="../../css/beszuras_szepito.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/css/bulma.min.css">

    <link rel="icon" type="image/x-icon" href="/img/favicon_io/favicon.ico">
    <title>ház beszurás</title>

</head>
<body>
<div class="bbeszur">
        <p class="title"> <a href="../index.php"><img src="/img/fooldal/back.png" alt="hozzaadd" style="width:25px;height:25px;"> vissza a főmenübe</a> </p>
    <form id="fupForm" name="form1" method="post">

        <div class="form-group">
            <label for="pwd">Utca:</label>
            <input type="email" class="input is-link" id="futca" placeholder="utca" name="utca" style="width:200px">
        </div>
        <div class="form-group">
            <label for="pwd">Ház értéke:</label>
            <input type="text" class="input is-link" id="fhaz" placeholder="ertek" name="ertek" style="width:200px">
        </div>
        <div class="form-group">
            <label for="pwd">Gondozó</label>
            <input type="text" class="input is-link" id="fgondozo" placeholder="gondozo" name="gondozo" style="width:200px">
        </div>
        <div class="form-group">
            <label for="pwd">Gondozó telefonszáma:</label>
            <input type="text" class="input is-link" id="ftgondozo" placeholder="gondozo telefonszam" name="gondozotel"  style="width:200px">
        </div>

        <input type="button" class="button is-link"  name="save"  value="beszurás" id="butsave">



    </form>
</div>
<script>
    $(document).ready(function () {
        $('#butsave').on('click', function () {
            $("#butsave").attr("disabled", "disabled");
            var utca = $('#futca').val();
            var ertek = $('#fhaz').val();
            var gondozo = $('#fgondozo').val();
            var gtelefon = $('#ftgondozo').val();
            if (utca != "" && ertek != "" && gondozo != "" && gtelefon != "") {
                $.ajax({
                    url: "beszurapi.php",
                    type: "POST",
                    data: {
                        utca: utca,
                        ertek: ertek,
                        gondozo: gondozo,
                        gtelefon: gtelefon,
                        action: "inserthouse"
                    },
                    cache: false,

                    success: function (dataResult) {
                        var dataResult = JSON.parse(dataResult);
                        if (dataResult.valasz == true) {
                            $("#success").show();
                            $('#success').html('Sikeresen rogzitesre kerult az ugyfel haza');
                            window.location.href = 'index.php';
                        } else if (dataResult.valasz == false) {
                            $("#success").show();
                            $('#success').html('Sikertelenül adta meg az adatokat');
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

