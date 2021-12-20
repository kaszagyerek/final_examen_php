<?php
require_once "connection.php";

    if(isset($_POST['login_button'])){
        $email = filter_var($_POST['log_email'],FILTER_VALIDATE_EMAIL);
        // $_SESSION['log_email'] = $email;
        $password = md5($_POST['log_password']);
        $check_database_query=mysqli_query($con,"SELECT * FROM users WHERE email ='$email'
                                                    AND password ='$password'");
        $check_login_query = mysqli_num_rows($check_database_query);
        $responseresult="";
        $responsboolean="";
        if ($check_login_query ==1){
        $responseresult = "sikeres";
        $responsboolean = true;
            $row = mysqli_fetch_array($check_database_query);
            $_SESSION['username'] = $row['username'];
            $_SESSION['userid'] = $row['id'];
            //  header("Location: menu.php");
            //   exit();
        } else {
            $responseresult = "sikertelen";
            $responsboolean = false;
            array_push($error_arrays ,"Emailcíme vagy a jelszava helytelen<br>");
        }

        $result = array("valasz"=>$responsboolean , "uzenet"=>$responseresult);
        die(json_encode($result));

    }
echo "nem megy bele";

    ?>

