<?php

$routes = [
    'home' => ['controllers/pages/homeController.php', false],

    # Contacts
    'contact' => ['controllers/contacts/contactController.php', true],
    'contacts' => ['controllers/contacts/contactsController.php', true],
    'contact-add' => ['controllers/contacts/contactAddController.php', true],
    'contact-update' => ['controllers/contacts/contactUpdateController.php', true],

    # Session
    'login' => ['controllers/session/loginController.php', false],
    'logout' => ['controllers/session/logoutController.php', true],
    'signup' => ['controllers/session/signupController.php', false],
];

if (isset($_GET['section'])) {

    $currentRoute = $_GET['section'];
    $loggedIn = isset($_SESSION['id']);

    if (!array_key_exists($currentRoute, $routes)) {
        include('views/partials/fourofour.php');
        exit;
    }

    foreach ($routes as $routeName => $route) {
        if ($currentRoute === $routeName) {

            if ($route[1] && $loggedIn) {
                include_once $route[0];
                exit;
            } 
            else if ($route[1] && !$loggedIn) {
                header('Location: ?section=login');
                exit;
            }
            else {
                include_once $route[0];
                exit;
            }

        }
    }

} else {
    include_once 'controllers/pages/homeController.php';
}
