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
    <link rel="stylesheet" href="../../css/bulma.min.css">
    <link rel="icon" type="image/x-icon" href="/img/favicon_io/favicon.ico">

    <title>kiadás beszurás</title>

</head>
<body>
<div style="margin: auto;width: 60%;">
    <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    </div>
    <form id="fupForm" name="form1" method="post">
        <!--       , hrenovationname, hrenovation, users_id
        -->
        <div class="control">
            <label for="pwd">Brókerem neve:</label>
            <input type="text" class="form-control" id="brokername" name="brokername">
        </div>
        <div class="control">
            <label for="pwd">Brókerem díja havonta:</label>
            <input type="text" class="form-control" id="broker" name="broker">
        </div>
        <div class="control">
            <label for="pwd">Havi befizetni való adóm:</label>
            <input type="text" class="form-control" id="tax" name="tax">
        </div>
        <div class="control">
            <label for="pwd">Havi házfelújítási költség:</label>
            <input type="text" class="form-control" id="hrenovation" name="hrenovation">
        </div>

        <div class="control">
            <input type="button" value="Save to database" id="butsave">
        </div>


    </form>
</div>
<script>
    $(document).ready(function () {
        $('#butsave').on('click', function () {
            $("#butsave").attr("disabled", "disabled");
            var brokername = $('#brokername').val();
            var broker = $('#broker').val();
            var tax = $('#tax').val();
            var hrenovation = $('#hrenovation').val();

            if (brokername != "" && broker != "" && tax != "" && hrenovation != "") {
                $.ajax({
                    url: "beszurapi.php",
                    type: "POST",
                    data: {
                        brokername: brokername,
                        broker: broker,
                        tax: tax,
                        hrenovation: hrenovation,
                        action: "insertexpense"
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

