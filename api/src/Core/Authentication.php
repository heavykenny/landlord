<?php

namespace App\Core;

use Exception;
use Firebase\JWT\JWT;

class Authentication
{
    private string $secretKey;

    public function __construct($config)
    {
        $this->secretKey = $config['secretKey'];
    }

    public function generateToken($data): string
    {
        $payload = [
            'iss' => 'localhost',
            'sub' => $data['id'],
            'iat' => time(),
            'exp' => time() + (120 * 60), // 120 minutes
        ];

        return JWT::encode($payload, $this->secretKey, 'HS256');
    }

    public function validateToken($token): bool
    {
        try {
            JWT::decode($token, $this->secretKey);
            return true;
        } catch (Exception $exception) {
            return false;
        }
    }

    public function decodeToken($token)
    {
        return JWT::decode($token, $this->secretKey);
    }
}