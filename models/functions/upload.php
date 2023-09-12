<?php

include_once 'models/ResponseModel.php';

/**
 * Permet d'upload une image à un chemin spécifique
 * @param $file array Image à upload
 * @param $path string Chemin d'accès où upload l'image
 * @return ApiResponse
 */
function uploadImage(array $file, string $path = "assets/img/upload/"): ApiResponse
{
    # Génération d'un nom aléatoire basé sur le timestamp et un nombre aléatoire
    $targetFileName = time() . "-" . rand(100000, 1000000) . "." . pathinfo($file['name'], PATHINFO_EXTENSION);
    $targetFile = $path . $targetFileName;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    # Vérification s'il n'y a pas eu d'erreur d'upload sur le serveur
    if (!isset($file['error']) || $file['error'] !== UPLOAD_ERR_OK) {
        return response(false, null, "Erreur de fichier.");
    }

    // Vérifier si le fichier est une image réelle ou une fausse image
    $check = getimagesize($file["tmp_name"]);
    if ($check === false) {
        return response(false, null, "Le fichier n'est pas une image.");
    }

    // Limiter la taille de l'image
    if ($file["size"] > 3000000) {
        return response(false, null, "Désolé, votre fichier est trop volumineux.");
    }

    // Autoriser certains formats d'image
    $allowedFormats = array("jpg", "jpeg", "png");
    if (!in_array($imageFileType, $allowedFormats)) {
        return response(false, null, "Désolé, seuls les fichiers JPG, JPEG et PNG sont autorisés.");
    }

    # Vérification si le répertoire existe déjà ou non
    # S'il n'existe pas, on le crée
    if (!file_exists($path)) {
        // Créez le répertoire s'il n'existe pas
        if (!mkdir($path, 0777, true)) {
            response(false, null, "Échec de la création du répertoire.");
        }
    }

    // Si tout est OK, uploader le fichier
    if (move_uploaded_file($file["tmp_name"], getcwd() . DIRECTORY_SEPARATOR . $targetFile)) {
        return response(true, $targetFileName);
    } else {
        return response(false, null, "Une erreur est survenue lors de l'upload du fichier.");
    }
}

/**
 * Permet de supprimer une image en fournissant le chemin d'accès et le nom de l'image
 * @param $filepath string Chemin d'accès jusqu'à l'image
 * @param $filename string Nom de l'image
 * @return ApiResponse
 */
function unlinkImage (string $filepath, string $filename): ApiResponse
{
    # Si le fichier n'existe pas, erreur
    if (!file_exists(getcwd() . DIRECTORY_SEPARATOR . $filepath . $filename)) {
        return response(false, null, "Fichier introuvable.");
    }

    # S'il y a un soucis durant la suppression
    if (!unlink(getcwd() . DIRECTORY_SEPARATOR . $filepath . $filename)) {
        return response(false, null, "Erreur lors de la suppression de l'image.");
    }

    return response(true);
}