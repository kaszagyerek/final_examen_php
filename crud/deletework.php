<?php
session_start();
require_once "../fooldal/connection.php";
if (!isset($_SESSION['username'])) {
    header("Location:../log_reg/log_reg.php");
    exit();
}

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $sql = "DELETE FROM workplace WHERE users_id =$id";

    if ($con->query($sql) === TRUE) {
        header("Location: ../fooldal/index.php");
    } else {
        echo "Error deleting record: " . $con->error;
    }
}

$con->close();