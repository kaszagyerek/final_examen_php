<?php
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Untitled Document</title>

</head>

<body>
<input type="text" name="felhasznaloid" placeholder="felhasználóIDja:" id="felhasznaloAJAX">
<input type="submit" value="listazas" name="flistaz" placeholder="felhasználó listázás" id="lajax">
<div class="result">Eredmény ajax hívás után</div>

</div>
<script type="text/javascript" src="jquery.min.js"></script>
<script>
    $("#lajax").click(function () {
        console.log("hello");
        var id2 = document.getElementById("felhasznaloAJAX"); // Current IP

        $.ajax({
            type: "GET",
            url: 'http://localhost:63342/untitled2/laptopallamvizsga/filep/houseAPI.php/' + '?id=' + id2.value,
            data: {
                id: id2.value
            },
            success: function(data) {
                $('.result').html(data);
            }
        })


    });
</script>
</body>
</html>

