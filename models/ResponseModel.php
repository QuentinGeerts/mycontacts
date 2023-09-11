<?php

/**
 * 
 */
class ApiResponse
{
    public bool $success;
    public $data;
    public ?string $error;
}

function responseAPI(bool $success, $data = null, ?string $error = null): ApiResponse
{
    $response = new ApiResponse();
    $response->success = $success;
    $response->data = $data;
    $response->error = $error;
    return $response;
}
