<?php
require_once "connection.php";

        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $password = md5($_POST['password']);

        $check_database_query = mysqli_query($con, "SELECT * FROM users WHERE email ='$email'
                                                    AND password ='$password'");
        $check_login_query = mysqli_num_rows($check_database_query);
        $responseresult = "";
        $responsboolean = "";
        if ($check_login_query > 0) {
            $responseresult = "sikeres";
            $responsboolean = true;
            $row = mysqli_fetch_array($check_database_query);
            $_SESSION['username'] = $row['username'];
            $_SESSION['userid'] = $row['id'];
            //  header("Location: menu.php"); //   exit();
        } else {
            $responseresult = "sikertelen";
            $responsboolean = false;
        }

        $result = array("valasz" => $responsboolean, "uzenet" => $responseresult);
        $result = array("valasz" => $responsboolean, "uzenet" => $responseresult);
        die(json_encode($result));


    ?>

