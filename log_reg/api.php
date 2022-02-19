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

                      /* fname: fname,
                        lname: lname,
                        em: em,
                        em2: em2,
                        password: password,
                        password2: password2,
                        phone: phone,*/

// Regisztracios form ertekek
//vezeteknev
        $fname = strip_tags($_POST['fname']); //kitorli html tageket
        $fname = str_replace(' ', '', $fname); // kitorli feher karakterek
        $fname = ucfirst(strtolower($fname)); //az elsp betut nagybetuve alakitja at

//keresztnev
        $lname = strip_tags($_POST['lname']); //kitorli html tageket
        $lname = str_replace(' ', '', $lname); // kitorli feher karakterek
        $lname = ucfirst(strtolower($lname)); //az elsp betut nagybetuve alakitja at

//email
        $em = strip_tags($_POST['em']); //kitorli html tageket
        $em = str_replace(' ', '', $em); // kitorli feher karakterek
        $em = strtolower($em); //minden betu kisbetű lessz

//megerosito mail
        $em2 = strip_tags($_POST['em2']); //kitorli html tageket
        $em2 = str_replace(' ', '', $em2); // kitorli feher karakterek
        $em2 = strtolower($em2); //minden betü kisbetű lessz
//telefonszam
        $phone = strip_tags($_POST['phone']);

//jelszo
        $password = strip_tags($_POST['password']); //kitorli html tageket

// megerosito jelszo
        $password2 = strip_tags($_POST['password2']); //kitorli html tageket

        $date = date("Y-m-d"); // Jelenlegi ido
        $responseresult = "";
        $responsboolean = "";
        if ($em == $em2) {
// elenorizni mail helyes e
            if (filter_var($em, FILTER_VALIDATE_EMAIL)) {
                $em = filter_var($em, FILTER_VALIDATE_EMAIL);
// ellenőrizük az email cim létezik e
                $e_check = mysqli_query($con, "SELECT email FROM users WHERE email = '$em'");
// megszamolja visszadott sorokat
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
                } else { // mit tartalmaz a jelszo
                    if (preg_match('/[^A-Za-z0-9]/', $password)) {
                        array_push($error_arrays, "Jelszava csak angol karaktereket tartalmazhat<br>");
                    }
                }
                if (strlen($password) > 30 || strlen($password < 5)) {
                    array_push($error_arrays, "Jelszava nagyobb kell legyen mint 5 karakter és kisebb kell legyen mint 50 karakter<br>");

                }

                $password = md5($password2); // Titokositas mielott elkuldi az adatbazisba
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

                array_push($error_arrays, "<span style='color: black '>Sikerült regiszrálni! Most már bejelentkezhet!</span><br>"); // felhasználónak egy értesítés hogy sikeresen regisztrált
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