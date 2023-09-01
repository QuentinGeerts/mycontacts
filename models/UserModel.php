<?php

require 'models/ResponseModel.php';

/*
Fonctionnalités liées aux utilisateurs
*/

/**
 * Se connecter en tant qu'utilisateur
 * 
 * @param array $credentials Tableau associatif contenant les informations de connexion.
 * Exemple ['email' => 'utilisateur@example.com', 'password' => 'motdepasse ]
 * 
 * @return ApiResponse
 */
function signin(array $credentials): ApiResponse
{
    $email = $credentials['email'];
    $pwd = $credentials['password'];

    if (empty($email) || empty($pwd)) {
        return responseAPI(false, null, "Veuillez entrer un email et/ou password");
    }

    require_once 'database.php';

    $query = "SELECT * FROM user WHERE email = :email AND password = sha2(:password, 256)";
    $stmt = $database->prepare($query);
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->bindParam(":password", $pwd, PDO::PARAM_STR);
    
    if ($stmt->execute()) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {
            # Email et password OK
            return responseAPI(true, $user);
        } else {
            # Email et password KO
            return responseAPI(false, null, "Email / password incorrect");
            
        }
    } else {
        # Requête mal passée
        return responseAPI(false, null, "Erreur lors de la connexion");

    }
}


/**
 * Récupération d'un utilisateur sur base de son email
 * 
 * Cette fonctionnalité prend en paramètre une chaine de caractère
 * 
 * @param string $email Adresse email de connexion
 * 
 * @return ApiResponse
 */
function getUserByEmail($email): ApiResponse
{
    require_once 'database.php';

    $query = "SELECT id, lastname, firstname, birthdate, email, role FROM user WHERE email = :email";

    $stmt = $database->prepare($query);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);

    if ($stmt->execute()) {
        return responseAPI(true, $stmt->fetch(PDO::FETCH_ASSOC));
    }

    return responseAPI(false, null, "Error lors de la récupération de l'utilisateur");
}
