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
                return responseAPI(true, $user);
            } else {
                # Email et password KO
                return responseAPI(false, null, "Email / password incorrect");

            }
        } else {
            # Requête mal passée
            return responseAPI(false, null, "Erreur lors de la connexion");

        }
    } catch (PDOException $e) {
        return responseAPI(false, null, "Error: " . $e->getMessage());
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

    $query = "SELECT id, lastname, firstname, birthdate, email, role FROM user WHERE email = :email";

    $database = getConnection();
    $stmt = $database->prepare($query);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);

    if ($stmt->execute()) {
        return responseAPI(true, $stmt->fetch(PDO::FETCH_ASSOC));
    }

    return responseAPI(false, null, "Error lors de la récupération de l'utilisateur");
}

/**
 * Création d'un utilisateur
 *
 * @param array $userData Tableau associatif reprenant les informations d'inscription
 *
 * @return ApiResponse
 */
function signup($userData): ApiResponse
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
            return responseAPI(true);
        }
    } catch (\PDOException $e) {
        var_dump($e->getCode());
        var_dump($e->getMessage());

        switch ($e->getCode()) {
            case "23000":
                return responseAPI(false, null, "L'émail existe déjà.");
        }
    }


    return responseAPI(false, null, "Error lors de la création de l'utilisateur");
}