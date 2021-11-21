<?php
session_start();
$con = mysqli_connect("localhost","root","","social");
if (mysqli_connect_errno())
{
    echo "Hibás csatlakozás" . mysqli_connect_errno();
}
// létrehozni változokat hibák kiszűrésére
$fname=""; // Vezetéknév
$lname=""; // Keresztnév
$em=""; // Mailcim
$em2=""; // Mailcim2
$password=""; // jelszo
$password2=""; // jelszo2
$date=""; //regisztracios ido
$phone="";
$error_arrays=array(); //hibak

if (isset($_POST['register_button'])){
// Regisztracios form ertekek
//vezeteknev
$fname = strip_tags($_POST['reg_fname']); //kitorli html tageket
$fname =str_replace(' ','',$fname); // kitorli feher karakterek
$fname = ucfirst(strtolower($fname)); //az elsp betut nagybetuve alakitja at
$_SESSION['reg_fname'] = $fname;

//keresztnev
$lname = strip_tags($_POST['reg_lname']); //kitorli html tageket
$lname =str_replace(' ','',$lname); // kitorli feher karakterek
$lname = ucfirst(strtolower($lname)); //az elsp betut nagybetuve alakitja at
$_SESSION['reg_lname'] = $lname;

//email
$em = strip_tags($_POST['reg_email']); //kitorli html tageket
$em =str_replace(' ','',$em); // kitorli feher karakterek
$em = ucfirst(strtolower($em)); //az elsp betut nagybetuve alakitja at
$_SESSION['reg_email'] = $em;

//megerosito mail
$em2 = strip_tags($_POST['reg_email2']); //kitorli html tageket
$em2 =str_replace(' ','',$em2); // kitorli feher karakterek
$em2 = ucfirst(strtolower($em2)); //az elsp betut nagybetuve alakitja at
$_SESSION['reg_email2'] = $em2;
//telefonszam
$phone =strip_tags($_POST['phone_number']);

//jelszo
$password = strip_tags($_POST['reg_password']); //kitorli html tageket

// megerosito jelszo
$password2 = strip_tags($_POST['reg_password2']); //kitorli html tageket

$date = date("Y-m-d"); // Jelenlegi ido

if ($em == $em2){
    // elenorizni mail helyes e
    if (filter_var($em, FILTER_VALIDATE_EMAIL)){
        $em= filter_var($em,FILTER_VALIDATE_EMAIL);
        // ellenőrizük az email cim létezik e
        $e_check = mysqli_query($con, "SELECT email FROM users WHERE email = '$em'");
        // megszamolja visszadott sorokat
        $num_rows = mysqli_num_rows($e_check);

        if ($num_rows > 0){
            array_push($error_arrays,"Email cimet már használták<br>");
        }

    }else {
        array_push($error_arrays,"Helytelen formátum<br>");
    }
}else {
    array_push($error_arrays,"Az email címek nem találnak<br>");
}
if (strlen($fname)>25 || strlen($fname)<2){
    array_push($error_arrays,"Vezeték neve 2 és 25 karakter között kell legyen<br>");
}
if (strlen($lname)>25 || strlen($lname)<2){
    array_push($error_arrays,"Kereszt neve 2 és 25 karakter között kell legyen<br>");
}
if ($password != $password2){
    array_push($error_arrays,"A jelszavai nem egyeznek meg<br>");
} else { // mit tartalmaz a jelszo
    if (preg_match('/[^A-Za-z0-9]/',$password)){
        array_push($error_arrays,"Jelszava csak angol karaktereket tartalmazhat<br>");
    }
}
if (strlen($password)>30 || strlen($password <5)){
    array_push($error_arrays,"Jelszava nagyobb kell legyen mint 5 karakter és kisebb kell legyen mint 50 karakter<br>");

}

if (empty($error_arrays)){
    $password = md5($password2); // Titokositas mielott elkuldi az adatbazisba
    $username = strtolower($fname ."_".$lname);
    $check_username_query = mysqli_query($con,"SELECT username FROM users WHERE username='$username'");
    $usernameexits=0;
    while(mysqli_num_rows($check_username_query)!=0){
        $usernameexits++;
        $username = $username . "_" . $usernameexits;
        $check_username_query = mysqli_query($con,"SELECT username FROM users WHERE username='$username'");
    }
    $rand = rand(1,3);
    if ($rand ==1){
        $profile_pic ="img/profile_pics/r1.png";
    } else if ($rand ==2){
        $profile_pic ="img/profile_pics/r2.png";
    }else {
        $profile_pic ="img/profile_pics/r3.png";
    }

    $query = mysqli_query($con,"INSERT INTO users VALUES ('', '$fname', '$lname', '$username', '$em', '$password', '$date', '$profile_pic', '$phone')" );
    }

}

?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>login</title>

    <link href="css/szepito.css" rel="stylesheet" type="text/css">
</head>

<body>

<div class="container" id="container">
    <div class="form-container sign-up-container">
        <form action="index.php" method="post">
            <h1>Regisztráció</h1>
            <input type="text" name="reg_fname" placeholder="Vezetéknév"
                   value="<?php if(isset($_SESSION['reg_fname'])){
                       echo $_SESSION['reg_fname'];
                   }
                   ?>"   required/>
            <?php if (in_array("Vezeték neve 2 és 25 karakter között kell legyen<br>",$error_arrays)) echo "Email cimet már használták<br>";   ?>


            <input type="text" name="reg_lname" placeholder="Keresztnév" value="<?php if(isset($_SESSION['reg_lname'])){
                echo $_SESSION['reg_lname'];
            }
            ?>" required/>
            <?php if (in_array("Kereszt neve 2 és 25 karakter között kell legyen<br>",$error_arrays)) echo "Kereszt neve 2 és 25 karakter között kell legyen<br>";   ?>

            <input type="tel" name="phone_number" placeholder="Telefonszám" required/>
            <input type="email" name="reg_email"  placeholder="Mailcím" value="<?php if(isset($_SESSION['reg_email'])){
                echo $_SESSION['reg_email'];
            }
            ?>" required/>
            <?php if (in_array("Email cimet már használták<br>",$error_arrays)) echo "Email cimet már használták<br>";
            else if (in_array("Helytelen formátum<br>",$error_arrays)) echo "Helytelen formátum<br>";
            else if (in_array("Az email címek nem találnak<br>",$error_arrays)) echo "Az email címek nem találnak<br>";

            ?>

            <input type="email" name="reg_email2"  placeholder="Mailcím megerősítés" value="<?php if(isset($_SESSION['reg_email2'])){
                echo $_SESSION['reg_email2'];
            }
            ?>" required/>
            <input type="password" name="reg_password"  placeholder="Jelszó" />
            <input type="password" name="reg_password2"  placeholder="Jelszó megerősítés" />
            <?php if (in_array("A jelszavai nem egyeznek meg<br>",$error_arrays)) echo "A jelszavai nem egyeznek meg<br>";
            else if (in_array("Jelszava csak angol karaktereket tartalmazhat<br>",$error_arrays)) echo "Jelszava csak angol karaktereket tartalmazhat<br>";
            else if (in_array("Jelszava nagyobb kell legyen mint 5 karakter és kisebb kell legyen mint 50 karakter<br>",$error_arrays)) echo "Jelszava nagyobb kell legyen mint 5 karakter és kisebb kell legyen mint 50 karakter<br>"; ?>

            <input type="submit" name="register_button" value="Register">
        </form>
    </div>


    <div class="form-container sign-in-container">
        <form action="#">
            <h1>Bejelentkezés</h1>


            <input type="email" placeholder="emailcím" />
            <input type="password" placeholder="jelszó" />
            <a href="#">Elfelejtetted a jelszavad?</a>
            <button>Bejelentkezés</button>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Ha van fiókod</h1>

                <button class="ghost" id="signIn">Vissza a bejelentkezésre!</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>Ha szeretnél regisztrálni</h1>

                <button class="ghost" id="signUp">Regisztácíó</button>
            </div>
        </div>
    </div>
</div>

<script>const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });

    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });</script>
</body>
</html>