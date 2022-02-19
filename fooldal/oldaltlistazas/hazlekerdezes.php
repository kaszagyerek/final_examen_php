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

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Untitled Document</title>
    <link href="../../css/szepito_hazlekerdezes.css" rel="stylesheet" type="text/css">


</head>

<body>

<form method="GET" action="">
    <h2>Kilistázás</h2>
    <div class="input-group">
        <button type="button" class="btn" id="butsave" onclick="listazas()">Kilistazas</button>
    </div>
</form>
<div id="hazak">


</div>
<script type="text/javascript" src="../../js/jquery.min.js"></script>
<script>
    function listazas() {
        document.getElementById('butsave').onclick = function () {
            this.disabled = true;
        }

        $.ajax(
            {
                url: "api.php",
                type: "GET",
                data: {
                    "action": "listazas"
                },
                contentType: "application/json",
                complete: adatfeldolgoz
            });
    }

    var adatfeldolgoz = function (data) {

        console.log(data);
        console.log(data.status);
        console.log(data.responseText);

        if (data.status != 200) {
            console.error("Hiba tortent:" + data.statusText);
            return;
        }
        var adat = JSON.parse(data.responseText);
        if (adat == null)
            console.error("Hiba");


        for (var i = 0; i < adat.length; i++) {
            var elem = adat[i];
            $('#hazak').append('<div class="haz" style="margin-bottom: 20px;">Házaim:<br>Címem: ' + elem.addres + '<br>Gondozó személy neve : ' + elem.ownPerson + '<br>Gondozó telefonszáma : ' + elem.ownMobil + '<br>A házam teljes értéke : ' + elem.totalhprice + '<br>A házamamat amikor rögzitettem : ' + elem.housedate + '</div>');
        }

    }

</script>
</body>
</html>

