<?php


$error = false;
$error_message = "";

# Création d'un contact
if (isset($_POST['contact-add'])) {
    
    require 'models/contactModel.php';

    $contactData = [
        'lastname' => $_POST['lastname'],
        'firstname' => $_POST['firstname'],
        'pseudo' => $_POST['pseudo'],
        'phone_number' => $_POST['phone_number'],
        'email' => $_POST['email'],
        'street_address' => $_POST['street_address'],
        'number_address' => $_POST['number_address'],
        'zip_address' => $_POST['zip_address'],
        'city_address' => $_POST['city_address'],
        'contact-image' => $_FILES['contact-image'],
    ];
    
    $response = createContact($contactData);

    if ($response->success) {
        # Création d'un contact réussi
        header("Location: ?section=contacts");
    }
    else {
        # Création d'un contact échoué
        $error = true;
        $error_message = $response->error;
    }

}

# Template HTML
include_once 'views/contacts/contactAddView.php';