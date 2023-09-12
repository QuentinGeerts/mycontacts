<?php

$error = false;
$error_message = null;

if (isset($_POST['login'])) {

    require_once 'models/UserModel.php';

    $email = trim(htmlspecialchars($_POST['email']));
    $pwd = trim(htmlspecialchars($_POST['password']));

    $response = signin(['email' => $email, 'password' => $pwd]);

    if ($response->success) {
        $error = false;
        $error_message = null;

        $_SESSION['id'] = $response->data['id'];
        $_SESSION['email'] = $response->data['email'];
        $_SESSION['role'] = $response->data['role'];
        $_SESSION['lastname'] = $response->data['lastname'];
        $_SESSION['firstname'] = $response->data['firstname'];

        header('Location: ?section=home');

    } else {
        $error = true;
        $error_message = $response->error;
    }

}

// Template HTML
include_once 'views/session/loginView.php';
