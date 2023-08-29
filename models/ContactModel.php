<?php

require 'models/ResponseModel.php';

function getContacts(): ApiResponse {

    require_once 'database.php';
    
    $query = "
    SELECT 
        c.id, c.lastname, c.firstname, c.email, c.phone_number, c.pseudo 
    FROM contact c 
    JOIN user u ON u.id = c.user_id 
    WHERE u.id = :id";
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

?>