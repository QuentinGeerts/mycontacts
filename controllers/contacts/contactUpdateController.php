<?php

require_once 'models/ContactModel.php';

$error = false;
$error_message = "";

# Récupération des informations du contact à modifier
if (isset($_POST['update'])) {

    $id = $_POST['id'];

    $response = getContactById($id);

    if ($response->success) {
        $contact = $response->data;
    } else {
        $error = true;
        $error_message = $response->error;
    }
}

# Mise à jour du contact
if (isset($_POST['contact-update'])) {

    $id = $_POST['id'];

    $contact = [
        'lastname' => $_POST['lastname'],
        'firstname' => $_POST['firstname'],
        'pseudo' => $_POST['pseudo'],
        'phone_number' => $_POST['phone_number'],
        'email' => $_POST['email'],
        'street_address' => $_POST['street_address'],
        'number_address' => $_POST['number_address'],
        'zip_address' => $_POST['zip_address'],
        'city_address' => $_POST['city_address'],
    ];

    if (is_uploaded_file($_FILES['contact-image']['tmp_name'])) {

        # Suppression de l'ancienne photo
        $responseUnlink = unlinkImage($_POST['filepath'], $_POST['filename']);

        # Upload de la nouvelle photo
        $responseSI = setImage($id, $_FILES['contact-image']);

        if (!$responseSI->success) {
            $error = true;
            $error_message = $responseSI->error;
            exit();
        }
    }

    foreach ($contact as $field => $value) {
        $response = patchField($id, $field, $value);
        if (!$response->success) {
            $error = true;
            $error_message = $response->error;
        }

    }

    header("Location: ?section=contacts");


}

// Template
require_once 'views/contacts/contactUpdateView.php';