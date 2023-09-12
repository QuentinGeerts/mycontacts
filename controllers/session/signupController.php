<?php

$success = false;
$error = false;
$error_message = null;

if (isset ($_POST['signup'])) {

    require 'models/UserModel.php';

    $lastname = htmlspecialchars(trim($_POST['lastname']));
    $firstname = htmlspecialchars(trim($_POST['firstname']));
    $birthdate = htmlspecialchars(trim($_POST['birthdate']));
    $email = htmlspecialchars(trim($_POST['email']));
    $pwd = htmlspecialchars(trim($_POST['password']));

    $userData = [
        "lastname" => $lastname,
        "firstname" => $firstname,
        "birthdate" => $birthdate,
        "email" => $email,
        "password" => $pwd,
    ];

    $response = signup($userData);

    if ($response->success) {
        $success = $response->success;
        header("Location: ?section=login");
    }
    else {
        $error = true;
        $error_message = $response->error;
    }

}

# Template HTML
include_once 'views/session/signupView.php';