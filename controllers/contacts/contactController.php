<?php

require 'models/contactModel.php';

$error = false;
$error_message = "";

if (isset($_POST['delete'])) {
    
    $contactToDelete = getContactById($_POST['delete']);

    $response = deleteContact($contactToDelete->data);

    if ($response->success) {
        
    }
    else {
        $error = true;
        $error_message = $response->error;
    }

}

$response = getContacts();

if ($response->success) {
    $contacts = $response->data;
}
else {
    $error = true;
    $error_message = $response->error;
}

// Template HTML
include_once 'views/contacts/contactView.php';