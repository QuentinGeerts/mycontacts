<?php

require 'models/ResponseModel.php';

function getContacts(): ApiResponse {

    require 'database/database.php';
    
    $query = "SELECT c.id, c.lastname, c.firstname, c.email, c.phone_number, c.pseudo, c.filename, c.filepath FROM contact c JOIN user u ON u.id = c.user_id WHERE u.id = :id";

    $database = getConnection();
    $stmt = $database->prepare($query);
    $stmt->bindParam(":id", $_SESSION['id'], PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return responseAPI(true, $contacts);
    }
    else {
        return responseAPI(false, null, "Erreur lors de la récupération des contacts");
    }

}

function getContactById (int $id): ApiResponse {
    require 'database/database.php';

    $query = "SELECT * FROM contact WHERE id = :id";
    $stmt = $database->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $contact = $stmt->fetch(PDO::FETCH_ASSOC);
        return responseAPI(true, $contact);
    }
    else {
        return responseAPI(false, null, "Erreur lors de la récupération du contact");
    }
}

function createContact($contactData): ApiResponse {

    require 'database/database.php';
    require 'functions/upload.php';

    # Gestion de l'upload d'image
    $imageInfo = $contactData['contact-image'];

    $path = "assets/img/upload/" . $_SESSION['id'] . "/contacts/";
    $response = uploadImage($imageInfo, $path);

    if (!$response->success) return responseAPI(false, null, $response->error);

    $database = getConnection();

    $query = "INSERT INTO contact (lastname, firstname, pseudo, phone_number, email, street_address, number_address, zip_address, city_address, filename, filepath, user_id) VALUES (:lastname, :firstname, :pseudo, :phone_number, :email, :street_address, :number_address, :zip_address, :city_address, :filename, :filepath, :user_id);";

    $stmt = $database->prepare($query);
    $stmt->bindParam(":lastname", $contactData['lastname'], PDO::PARAM_STR);
    $stmt->bindParam(":firstname", $contactData['firstname'], PDO::PARAM_STR);
    $stmt->bindParam(":pseudo", $contactData['pseudo'], PDO::PARAM_STR);
    $stmt->bindParam(":phone_number", $contactData['phone_number'], PDO::PARAM_STR);
    $stmt->bindParam(":email", $contactData['email'], PDO::PARAM_STR);
    $stmt->bindParam(":street_address", $contactData['street_address'], PDO::PARAM_STR);
    $stmt->bindParam(":number_address", $contactData['number_address'], PDO::PARAM_STR);
    $stmt->bindParam(":zip_address", $contactData['zip_address'], PDO::PARAM_STR);
    $stmt->bindParam(":city_address", $contactData['city_address'], PDO::PARAM_STR);
    $stmt->bindParam(":filename", $response->data, PDO::PARAM_STR);
    $stmt->bindParam(":filepath", $path, PDO::PARAM_STR);
    $stmt->bindParam(":user_id", $_SESSION['id'], PDO::PARAM_INT);


    if ($stmt->execute()) {
        return responseAPI(true);
    }
    else {
        return responseAPI(false, null, "Erreur lors de la création du contact.");
    }

}

function deleteContact ($contact): ApiResponse {

    require 'database/database.php';
    
    if (!unlink(getcwd() . DIRECTORY_SEPARATOR . $contact['filepath'] . $contact['filename'])) {
        return responseAPI(false, null, "Erreur lors de la suppression de l'image.");
    }

    $query = "DELETE FROM contact WHERE id = :id";

    $database = getConnection();
    $stmt = $database->prepare($query);
    $stmt->bindParam(":id", $contact['id'], PDO::PARAM_INT);

    if ($stmt->execute()) {
        return responseAPI(true);
    }
    else {
        return responseAPI(false, null, "Erreur lors de la création du contact.");
    }
}
