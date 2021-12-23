<?php
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<div style="margin: auto;width: 60%;">
    <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    </div>
    <form id="fupForm" name="form1" method="post">
        <div class="form-group">
            <label for="email">Tulajdonos egyedi ID ja:</label>
            <input type="text" class="form-control" id="fid" placeholder="id" name="id">
        </div>
        <div class="form-group">
            <label for="pwd">Utca:</label>
            <input type="email" class="form-control" id="futca" placeholder="utca" name="utca">
        </div>
        <div class="form-group">
            <label for="pwd">Ház értéke:</label>
            <input type="text" class="form-control" id="fhaz" placeholder="ertek" name="ertek">
        </div>
        <div class="form-group">
            <label for="pwd">Gondozó</label>
            <input type="text" class="form-control" id="fgondozo" placeholder="gondozo" name="gondozo">
        </div>
        <div class="form-group">
            <label for="pwd">Gondozó telefonszáma:</label>
            <input type="text" class="form-control" id="ftgondozo" placeholder="gondozo telefonszam" name="gondozotel">
        </div>

        <input type="button" name="save" class="btn btn-primary" value="Save to database" id="butsave">

        <div class="result">Eredmény ajax hívás után</div>


    </form>
</div>

<script>
    $(document).ready(function() {
        $('#butsave').on('click', function() {
            $("#butsave").attr("disabled", "disabled");
            var id = $('#fid').val();
            var utca = $('#futca').val();
            var ertek = $('#fhaz').val();
            var gondozo = $('#fgondozo').val();
            var gtelefon = $('#ftgondozo').val();
            if(id!="" && utca!="" && ertek!="" && gondozo!="" && gtelefon!="" ){
                $.ajax({
                    url: "insertapi.php",
                    type: "POST",
                    data: {
                        id: id,
                        utca: utca,
                        ertek: ertek,
                        gondozo: gondozo,
                        gtelefon: gtelefon,
                    },
                    cache: false,

                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        if(dataResult.Valasz==true){
                            $("#butsave").removeAttr("disabled");
                            $('#fupForm').find('input:text').val('');
                            $("#success").show();
                            $('#success').html('Sikeresen rogzitesre kerult az ugyfel haza');

                        }
                        else if(dataResult.Valasz==false){
                            alert("Nem jol adta meg az adatokat");
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

