<?php

require_once 'models/ResponseModel.php';
require_once 'models/database/database.php';
require 'models/functions/upload.php';

/**
 * Permet de récupérer la liste des contacts sous forme d'un tableau reprenant toutes les colonnes de la base de données
 * @return ApiResponse
 */
function getContacts(): ApiResponse
{
    $query = "
        SELECT 
            c.id, c.lastname, c.firstname, c.email, c.phone_number, c.pseudo, c.filename, c.filepath 
        FROM 
            contact c 
                JOIN user u 
                    ON u.id = c.user_id 
        WHERE u.id = :id";

    // Ouverture du flux
    $database = getConnection();
    $stmt = $database->prepare($query);
    $stmt->bindParam(":id", $_SESSION['id'], PDO::PARAM_INT);
    $isDone = $stmt->execute();

    // Nettoyage du flux
    $database = null;

    if ($isDone) {
        $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return response(true, $contacts);
    } else {
        return response(false, null, "Erreur lors de la récupération des contacts");
    }

}


/**
 * Permet de récupérer un contact sur base de son identifiant
 * @param int $id Identifiant du contact
 * @return ApiResponse
 */
function getContactById(int $id): ApiResponse
{
    $query = "SELECT * FROM contact WHERE id = :id";

    $database = getConnection();
    $stmt = $database->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $isDone = $stmt->execute();

    // Nettoyage du flux
    $database = null;

    if ($isDone) {
        $contact = $stmt->fetch(PDO::FETCH_ASSOC);
        return response(true, $contact);
    } else {
        return response(false, null, "Erreur lors de la récupération du contact");
    }
}


/**
 * Permet de créer un contact
 * @param $contactData array Tableau associatif contenant les informations du contact
 * @return ApiResponse
 */
function createContact(array $contactData): ApiResponse
{
    // Récupération de la base de données
    $database = getConnection();

    $query = "
        INSERT INTO contact 
            (lastname, firstname, pseudo, phone_number, email, street_address, number_address, zip_address, city_address, user_id) 
        VALUES 
            (:lastname, :firstname, :pseudo, :phone_number, :email, :street_address, :number_address, :zip_address, :city_address, :user_id);";

    $stmt = $database->prepare($query);
    $stmt->bindParam(":lastname", $contactData['lastname']);
    $stmt->bindParam(":firstname", $contactData['firstname']);
    $stmt->bindParam(":pseudo", $contactData['pseudo']);
    $stmt->bindParam(":phone_number", $contactData['phone_number']);
    $stmt->bindParam(":email", $contactData['email']);
    $stmt->bindParam(":street_address", $contactData['street_address']);
    $stmt->bindParam(":number_address", $contactData['number_address']);
    $stmt->bindParam(":zip_address", $contactData['zip_address']);
    $stmt->bindParam(":city_address", $contactData['city_address']);
    $stmt->bindParam(":user_id", $_SESSION['id'], PDO::PARAM_INT);

    $isDone = $stmt->execute();

    if ($isDone) {
        if (is_uploaded_file($_FILES['contact-image']['tmp_name'])) {
            $response = setImage($database->lastInsertId(), $_FILES['contact-image']);
            if (!$response->success) throw new Exception($response->error);
        }
        $database = null;
        $stmt = null;

        return response(true);
    } else {
        return response(false, null, "Erreur lors de la création du contact.");
    }


}

/**
 * @param $id int
 * @return ApiResponse
 */
function deleteContact(int $id): ApiResponse
{

    $response = getContactById($id);

    if (!$response->success) return response(false, null, "Id incorrect");

    $contactToDelete = $response->data;


    if ($contactToDelete['filename'] != null) {
        $responseImage = unlinkImage($contactToDelete['filepath'], $contactToDelete['filename']);

        if (!$responseImage->success) return response(false, null, $responseImage->error);
    }

    $query = "DELETE FROM contact WHERE id = :id";

    $database = getConnection();
    $stmt = $database->prepare($query);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);

    $isDone = $stmt->execute();

    if ($isDone) {
        return response(true);
    } else {
        return response(false, null, "Erreur lors de la création du contact.");
    }
}

/**
 * Permet de mettre à jour un champ du contact en fonction du nom de la colonne fourni
 * @param $id int Identifiant du contact à modifier
 * @param $columnName string Le nom de la colonne à modifier
 * @param $newValue mixed La nouvelle valeur
 * @return ApiResponse
 */
function patchField(int $id, string $columnName, mixed $newValue): ApiResponse
{

    $allowedColumns = ["lastname", "firstname", "pseudo", "phone_number", "email", "street_address", "number_address", "zip_address", "city_address", "filename", "filepath"];

    // Vérifier si le nom de colonne est autorisé
    if (!in_array($columnName, $allowedColumns)) {
        return response(false, null, "Nom de colonne non autorisé");
    }

    $query = "UPDATE contact SET $columnName = :newValue WHERE id = :id";
    $database = getConnection();

    $stmt = $database->prepare($query);
    $stmt->bindParam(":newValue", $newValue);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);

    $database->beginTransaction();

    try {
        $isDone = $stmt->execute();

        if ($isDone) {
            $database->commit();
            $database = null;
            $stmt = null;

            return response(true);
        } else {
            throw new Exception("Erreur lors de la mise à jour");
        }
    } catch (Exception $e) {
        $database->rollBack();
        $database = null;
        return response(false, null, $e->getMessage());
    }
}

/**
 * Paramètre l'image upload au contact créé
 * @param int $id Identifiant du contact
 * @param array $file Fichier à paramétrer
 * @return ApiResponse
 */
function setImage(int $id, array $file): ApiResponse
{
    # Gestion de l'upload d'image
    $path = "assets/img/upload/" . $_SESSION['id'] . "/contacts/" . $id . "/";

    # Upload de l'image
    $response = uploadImage($file, $path);
    if (!$response->success) return response(false, null, $response->error);

    # Mise à jour des champs dans la DB
    patchField($id, "filepath", $path);
    patchField($id, "filename", $response->data);

    return response(true);
}