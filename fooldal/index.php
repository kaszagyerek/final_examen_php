<?php
session_start();
if (!isset($_SESSION['username'])){
    header("Location:../log_reg/log_reg.php");
    exit();
}
echo "<div class='felhasznalo'>" . "Üdvözöllek " . $_SESSION['username'] . "</div>";
echo "<div class='felhasznalo'>" . "Az ID-ja " . $_SESSION['userid'] . "</div>";

?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">

    <link href="../css/index_szepito.css" rel="stylesheet" type="text/css"></head>
<body>

<h1>PORTFOLIÓ KÖVETÉSE</h1>

<div class="vertical-menu">
    <a href="hazbeszuras.php" class="active">Házam rögzítése</a>
    <a href="hazlekerdezes.php" class="active">Házaim listázása</a>
    <a href="../log_reg/kijelentkezes.php">Kijelentkezes</a>
</div>

</body>
</html>
