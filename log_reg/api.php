<?php
session_start();
require_once "connection.php";
$action = isset($_GET['action']) ? $_GET['action'] : "";
$action2 = isset($_POST['action']) ? $_POST['action'] : "";

if (isset($con)) {
    $con;
}

switch ($action2) {
    case "bejelentkezes" :
        $email = mysqli_real_escape_string($con, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
        $password = mysqli_real_escape_string($con, md5($_POST['password']));

        $check_database_query = mysqli_query($con, "SELECT * FROM users WHERE email ='$email'
                                                    AND password ='$password'");
        $check_login_query = mysqli_num_rows($check_database_query);
        $responseresult = "";
        $responsboolean = "";
        if ($check_login_query > 0) {
            $responseresult = "sikeres bejelentkezes";
            $responsboolean = true;
            $row = mysqli_fetch_array($check_database_query);
            $_SESSION['username'] = $row['username'];
            $_SESSION['userid'] = $row['id'];
        } else {
            $responseresult = "sikertelen felhasznalonev/jelszo hibas";
            $responsboolean = false;
        }

        $result = array("valasz" => $responsboolean, "uzenet" => $responseresult);
        die(json_encode($result));
    case "regisztracio" :

        $fname = strip_tags($_POST['fname']);
        $fname = str_replace(' ', '', $fname);
        $fname = ucfirst(strtolower($fname));

        $lname = strip_tags($_POST['lname']);
        $lname = str_replace(' ', '', $lname);
        $lname = ucfirst(strtolower($lname));

        $em = strip_tags($_POST['em']);
        $em = str_replace(' ', '', $em);
        $em = strtolower($em);

        $em2 = strip_tags($_POST['em2']);
        $em2 = str_replace(' ', '', $em2);
        $em2 = strtolower($em2);

        $phone = strip_tags($_POST['phone']);

        $password = strip_tags($_POST['password']);

        $password2 = strip_tags($_POST['password2']);

        $date = date("Y-m-d");
        $responseresult = "";
        $responsboolean = "";
        if ($em == $em2) {
            if (filter_var($em, FILTER_VALIDATE_EMAIL)) {
                $em = filter_var($em, FILTER_VALIDATE_EMAIL);
                $e_check = mysqli_query($con, "SELECT email FROM users WHERE email = '$em'");
                $num_rows = mysqli_num_rows($e_check);
            }

            if (strlen($fname) > 25 || strlen($fname) < 2) {
                array_push($error_arrays, "Vezeték neve 2 és 25 karakter között kell legyen<br>");
            }
            if (strlen($lname) > 25 || strlen($lname) < 2) {
                array_push($error_arrays, "Kereszt neve 2 és 25 karakter között kell legyen<br>");
            }
            if ($password != $password2) {
                array_push($error_arrays, "A jelszavai nem egyeznek meg<br>");
            } else {
                if (preg_match('/[^A-Za-z0-9]/', $password)) {
                    array_push($error_arrays, "Jelszava csak angol karaktereket tartalmazhat<br>");
                }
            }
            if (strlen($password) > 30 || strlen($password < 5)) {
                array_push($error_arrays, "Jelszava nagyobb kell legyen mint 5 karakter és kisebb kell legyen mint 50 karakter<br>");

            }
            $password = md5($password2);
            $username = strtolower($fname . "_" . $lname);

            $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
            $usernameexits = 0;
            while (mysqli_num_rows($check_username_query) != 0) {
                $usernameexits++;
                $username = $username . "_" . $usernameexits;
                $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
            }
            $rand = rand(0, 4);
            if ($rand == 1) {
                $profile_pic = "r1.png";
            } else if ($rand == 2) {
                $profile_pic = "r2.png";
            } else {
                $profile_pic = "r3.png";
            }
            $query = mysqli_query($con, "INSERT INTO users VALUES ('', '$fname', '$lname', '$username', '$em', '$password', '$date', '$profile_pic', '$phone')");

            $_SESSION['fname'] = "";
            $_SESSION['lname'] = "";
            $_SESSION['em'] = "";
            $_SESSION['em2'] = "";

            $responseresult = "sikeres";
            $responsboolean = true;
        } else {
            $responseresult = "sikertelen";
            $responsboolean = false;
        }
        $result = array("valasz" => $responsboolean, "uzenet" => $responseresult);
        die(json_encode($result));

}