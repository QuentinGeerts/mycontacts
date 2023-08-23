<?php

if (isset($_GET['section'])) {

    $section = $_GET['section'];

    switch ($section) {
        case 'home':
            include_once 'views/pages/homeView.php';
            break;


        /*
            User
        */


        /*
            Session
        */

        case 'login':
            include_once 'controllers/session/loginController.php';
            break;

        case 'logout':
            include_once 'controllers/session/logoutController.php';
            break;

        /*
            404
        */

        default:
            include_once 'views/partials/fourofour.php';
    }
} else {
    include_once 'views/pages/homeView.php';
}
