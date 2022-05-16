<?php
require_once "../google/vendor/autoload.php";

$clientID = '972593197134-3l3jfmf6gb90gljsfoep488s0o9ak1n6.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost:8000/laptopallamvizsga/log_reg/googlelogin.php';
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("profile");
$client->addScope("email");

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);
    $gauth = new Google_Service_Oauth2($client);
    $google_account_info = $gauth->userinfo->get();
    $email = $google_account_info->email;
    $name = $google_account_info->name;
    echo "szia " . $name . "  az email cimed  " . $email;
} else {
    echo "<a href='" . $client->createAuthUrl() . "'>Google Login</a>";
}
?>