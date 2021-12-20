<?php
$con = mysqli_connect("localhost","root","","social");
if (mysqli_connect_errno())
{
    echo "Hibás csatlakozás" . mysqli_connect_errno();
}