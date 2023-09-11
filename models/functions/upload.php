<?php

include_once 'models/ResponseModel.php';

function uploadImage($file, $path = "assets/img/upload/"): ApiResponse
{


    $targetDir = $path; // Dossier où vous souhaitez stocker les images

    $targetFileName = time() . "-" . rand(100000, 1000000) . "." . pathinfo($file['name'], PATHINFO_EXTENSION);
    $targetFile = $targetDir . $targetFileName;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if (!isset($file['error']) || $file['error'] !== UPLOAD_ERR_OK) {
        return responseAPI(false, null, "Erreur de fichier.");
    }

    // Vérifier si le fichier est une image réelle ou une fausse image
    $check = getimagesize($file["tmp_name"]);
    if ($check === false) {
        return responseAPI(false, null, "Le fichier n'est pas une image.");
    }

    // Limiter la taille de l'image
    if ($file["size"] > 3000000) {
        return responseAPI(false, null, "Désolé, votre fichier est trop volumineux.");
    }

    // Autoriser certains formats d'image
    $allowedFormats = array("jpg", "jpeg", "png");
    if (!in_array($imageFileType, $allowedFormats)) {
        return responseAPI(false, null, "Désolé, seuls les fichiers JPG, JPEG et PNG sont autorisés.");
    }

    if (!file_exists($targetDir)) {
        // Créez le répertoire s'il n'existe pas
        if (!mkdir($targetDir, 0777, true)) {
            responseAPI(false, null, "Échec de la création du répertoire.");
        }
    }

    echo getcwd() . DIRECTORY_SEPARATOR . $targetFile;

    // Si tout est OK, uploader le fichier
    if (move_uploaded_file($file["tmp_name"], getcwd() . DIRECTORY_SEPARATOR . $targetFile)) {
        return responseAPI(true, $targetFileName);
    } else {
        return responseAPI(false, null, "Une erreur est survenue lors de l'upload du fichier.");
    }
}
