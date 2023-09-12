<?php


/**
 * Structure d'une réponse retournée par la base de donnéess
 */
class ApiResponse
{
    /**
     * @var bool État d'une requête
     */
    public bool $success;

    /**
     * @var mixed Données retournées
     */
    public mixed $data;

    /**
     * @var string|null Message d'erreur
     */
    public ?string $error;
}

/**
 * @param $success bool Requête réussie ou non
 * @param $data mixed|null Données retournées
 * @param $error string|null Message d'erreur
 * @return ApiResponse Structure d'une réponse retournée par la base de donnéess
 */
function response(bool $success, mixed $data = null, ?string $error = null): ApiResponse
{
    $response = new ApiResponse();
    $response->success = $success;
    $response->data = $data;
    $response->error = $error;
    return $response;
}
