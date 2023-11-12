<?php

CONST ADMIN = 3;
CONST LANDLORD = 2;
CONST USER = 1;

function isLogin(): bool
{
    return isset($_COOKIE['token']);
}

function isAdmin(): bool
{
    if (!isLogin()) {
        return false;
    }

    $payload = decodeJWT();
    return $payload->data->role_id === ADMIN;
}

function isLandlord(): bool
{
    if (!isLogin()) {
        return false;
    }

    $payload = decodeJWT();
    return $payload->data->role_id === LANDLORD;
}

function decodeJWT()
{
    $jwt = $_COOKIE['token'] ?? '';
    $config = require __DIR__ . '/../../api/src/config/config.php';
    $secretKey = $config['secretKey'];
    $tokenParts = explode('.', $jwt);
    $header = base64_decode($tokenParts[0]);
    $payload = base64_decode($tokenParts[1]);
    $signatureProvided = $tokenParts[2];

    // Build a signature based on the header and payload using the secret
    $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], $tokenParts[0]);
    $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], $tokenParts[1]);
    $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $secretKey, true);
    $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

    // Verify it matches the signature provided in the token
    if ($base64UrlSignature !== $signatureProvided) {
        return false; // Token failed validation
    }

    return json_decode($payload);
}

function getToken(): string
{
    return $_COOKIE['token'] ?? '';
}
