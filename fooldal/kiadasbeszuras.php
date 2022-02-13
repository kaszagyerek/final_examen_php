<?php
session_start();
require_once "connection.php";
if (!isset($_SESSION['username'])){
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="../css/szepito_hazlekerdezes.css" rel="stylesheet" type="text/css">

</head>
<body>
<div style="margin: auto;width: 60%;">
    <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    </div>
    <form id="fupForm" name="form1" method="post">
<!--       , hrenovationname, hrenovation, users_id
-->
        <div class="form-group">
            <label for="pwd">Brókerem neve:</label>
            <input type="text" class="form-control" id="brokername"  name="brokername">
        </div>
        <div class="form-group">
            <label for="pwd">Brókerem díja havonta:</label>
            <input type="text" class="form-control" id="broker"  name="broker">
        </div>
        <div class="form-group">
            <label for="pwd">Havi befizetni való adóm:</label>
            <input type="text" class="form-control" id="tax"  name="tax">
        </div>
        <div class="form-group">
            <label for="pwd">Havi házfelújítási költség:</label>
            <input type="text" class="form-control" id="hrenovation"  name="hrenovation">
        </div>


        <input type="button" name="save" class="btn btn-primary" value="Save to database" id="butsave">

        <div class="result">Eredmény ajax hívás után</div>


    </form>
</div>
<script>
    $(document).ready(function() {
        $('#butsave').on('click', function() {
            $("#butsave").attr("disabled", "disabled");
            var brokername = $('#brokername').val();
            var broker = $('#broker').val();
            var tax = $('#tax').val();
            var hrenovation = $('#hrenovation').val();

            if(brokername!="" && broker!="" && tax!="" && hrenovation!="" ){
                $.ajax({
                    url: "api.php",
                    type: "POST",
                    data: {
                        brokername: brokername,
                        broker: broker,
                        tax: tax,
                        hrenovation: hrenovation,
                        action:"insertexpense"
                    },
                    cache: false,

                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        if(dataResult.valasz==true){
                            $("#success").show();
                            $('#success').html('Sikeresen rogzitesre kerult az ugyfel haza');

                        }

                        else if(dataResult.valasz==false){
                            $("#success").show();
                            $('#success').html('Sikertelenül adta meg az adatokat');
                        }

                    }
                });
            }
            else{
                alert("Toltsel ki minden mezot");
            }
        });
    });
</script>
</body>
</html>

