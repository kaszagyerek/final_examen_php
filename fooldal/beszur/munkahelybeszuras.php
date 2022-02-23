<?php
session_start();
require_once "connection.php";
if (!isset($_SESSION['username'])) {
    header("Location:../log_reg/log_reg.php");
    exit();
}

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

</head>
<body>
<div style="margin: auto;width: 60%;">

    <form id="fupForm" name="form1" method="post">


        <div class="form-group">
            <label for="pwd">Munkahelyem neve:</label>
            <input type="text" class="form-control" id="fmunka" name="munka">
        </div>
        <div class="form-group">
            <label for="pwd">Munkahelyem címe:</label>
            <input type="text" class="form-control" id="fcim" name="cim">
        </div>
        <div class="form-group">
            <label for="pwd">Munkahelyi pozició:</label>
            <input type="text" class="form-control" id="beosztas" name="beosztas">
        </div>
        <div class="form-group">
            <label for="pwd">Munkahelyi fizetés:</label>
            <input type="text" class="form-control" id="fizetes" name="fizetes">
        </div>


        <input type="button" class="hero is-danger" value="Save to database" id="butsave">

        <div class="result">Eredmény ajax hívás után</div>


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

