<?php

require_once 'models/ResponseModel.php';
require_once 'models/database/database.php';

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
function signIn(array $credentials): ApiResponse
{
    $email = $credentials['email'];
    $pwd = $credentials['password'];

    if (empty($email) || empty($pwd)) {
        return response(false, null, "Veuillez entrer un email et/ou password");
    }

    try {
        $database = getConnection();

        $query = "SELECT * FROM user WHERE email = :email AND password = sha2(:password, 256)";
        $stmt = $database->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $pwd);

        if ($stmt->execute()) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                # Email et password OK
                return response(true, $user);
            } else {
                # Email et password KO
                return response(false, null, "Email / password incorrect");

            }
        } else {
            # Requête mal passée
            return response(false, null, "Erreur lors de la connexion");

        }
    } catch (PDOException $e) {
        return response(false, null, "Error: " . $e->getMessage());
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
function getUserByEmail(string $email): ApiResponse
{

    $query = "SELECT id, lastname, firstname, birthdate, email, role FROM user WHERE email = :email";

    $database = getConnection();
    $stmt = $database->prepare($query);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);

    if ($stmt->execute()) {
        return response(true, $stmt->fetch(PDO::FETCH_ASSOC));
    }

    return response(false, null, "Error lors de la récupération de l'utilisateur");
}

/**
 * Création d'un utilisateur
 *
 * @param array $userData Tableau associatif reprenant les informations d'inscription
 *
 * @return ApiResponse
 */
function signUp(array $userData): ApiResponse
{

    $query = "INSERT INTO user (lastname, firstname, birthdate, email, password) VALUES (:lastname, :firstname, :birthdate, :email, sha2(:password, 256))";

    $database = getConnection();
    $stmt = $database->prepare($query);
    $stmt->bindParam(":lastname", $userData["lastname"]);
    $stmt->bindParam(":firstname", $userData["firstname"]);
    $stmt->bindParam(":birthdate", $userData["birthdate"]);
    $stmt->bindParam(":email", $userData["email"]);
    $stmt->bindParam(":password", $userData["password"]);

    try {
        if ($stmt->execute()) {
            return response(true);
        }
    } catch (\PDOException $e) {

        # Permet de passer en revue les différents codes d'erreur et d'attribuer au cas par cas un message personnalisé
        switch ($e->getCode()) {
            case "23000":
                return response(false, null, "L'émail existe déjà.");

            default:
                return response(false, null, $e->getMessage());
        }
    }


    return response(false, null, "Error lors de la création de l'utilisateur");
}