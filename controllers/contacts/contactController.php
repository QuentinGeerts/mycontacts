<?php

require 'models/contactModel.php';

$error = false;
$error_message = "";

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