<?php
$con = mysqli_connect("localhost", "root", "", "social");
if (mysqli_connect_errno()) {
    echo "Hibás csatlakozás" . mysqli_connect_errno();
}

if (!isset($_SESSION['username'])) {
    header("Location:/laptopallamvizsga/log_reg/log_reg.php");
    exit();
}