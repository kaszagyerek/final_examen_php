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

    <title>munkahely beszurása</title>

</head>
<body>
<div class="bbeszur">
    <p class="title"> <a href="../index.php"><img src="/img/fooldal/back.png" alt="hozzaadd" style="width:25px;height:25px;"> vissza a főmenübe</a> </p>

    <form method="post" action="">


        <div class="form-group">
            <label for="pwd">Munkahelyem neve:</label>
            <input type="text"  class="input is-link" style="width:200px" id="fmunka" name="munka">
        </div>
        <div class="form-group">
            <label for="pwd">Munkahelyem címe:</label>
            <input type="text"  class="input is-link" style="width:200px" id="fcim" name="cim">
        </div>
        <div class="form-group">
            <label for="pwd">Munkahelyi pozició:</label>
            <input type="text"  class="input is-link" style="width:200px" id="beosztas" name="beosztas">
        </div>
        <div class="form-group">
            <label for="pwd">Munkahelyi fizetés:</label>
            <input type="text"  class="input is-link" style="width:200px" id="fizetes" name="fizetes">
        </div>


        <input type="button" class="button is-link" value="mentés" id="butsave">


    </form>
</div>
<script>
    $(document).ready(function () {
        $('#butsave').on('click', function () {
            $("#butsave").attr("disabled", "disabled");
            var munka = $('#fmunka').val();
            var fizetes = $('#fizetes').val();
            var cim = $('#fcim').val();
            var beosztas = $('#beosztas').val();

            if (munka != "" && cim != "" && beosztas != "" && fizetes != "") {
                $.ajax({
                    url: "beszurapi.php",
                    type: "POST",
                    data: {
                        munka: munka,
                        cim: cim,
                        beosztas: beosztas,
                        fizetes: fizetes,
                        action: "insertworkplace"
                    },
                    cache: false,

                    success: function (dataResult) {
                        var dataResult = JSON.parse(dataResult);
                        if (dataResult.valasz == true) {
                            $("#success").show();
                            $('#success').html('Sikeresen rogzitesre kerult az ugyfel haza');

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

