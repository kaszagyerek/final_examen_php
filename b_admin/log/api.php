<?php
session_start();
require_once "connection.php";


$action2 = isset($_POST['action']) ? $_POST['action'] : "";

switch ($action2) {
    case "admin" :
        $email = mysqli_real_escape_string($con, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
        $password = mysqli_real_escape_string($con,$_POST['password']);

        $check_database_query = mysqli_query($con, "SELECT * FROM admin WHERE email ='$email'
                                                    AND password ='$password'");
        $check_login_query = mysqli_num_rows($check_database_query);
        $responseresult = "";
        $responsboolean = "";
        if ($check_login_query > 0) {
            $responseresult = "sikeres bejelentkezes";
            $responsboolean = true;
            $row = mysqli_fetch_array($check_database_query);
            $_SESSION['username'] = $row['username'];
            $_SESSION['userid'] = $row['idadmin'];
        } else {
            $responseresult = "sikertelen felhasznalonev/jelszo hibas";
            $responsboolean = false;
        }

        $result = array("valasz" => $responsboolean, "uzenet" => $responseresult);
        die(json_encode($result));
}