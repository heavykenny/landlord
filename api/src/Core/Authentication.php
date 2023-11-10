<?php

namespace App\Core;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use stdClass;

class Authentication
{
    private string $secretKey;

    public function __construct($config)
    {
        $this->secretKey = $config['secretKey'];
    }

    public function generateToken($data): string
    {
        $userToEncode = new stdClass();
        $userToEncode->id = $data['id'];
        $userToEncode->email = $data['email'];
        $userToEncode->role_id = $data['role_id'];

        $payload = [
            'iss' => 'localhost',
            'sub' => $data['id'],
            'iat' => time(),
            'exp' => time() + (60 * 60 * 24 * 365), // 1 year
            'data' => $userToEncode
        ];
        return JWT::encode($payload, $this->secretKey, 'HS256');
    }

    public function validateToken($token): bool
    {
        try {
            JWT::decode($token, new Key($this->secretKey, 'HS256'));
            return true;
        } catch (Exception $exception) {
            return false;
        }
    }

    public function decodeToken($token): stdClass
    {
        return JWT::decode($token, new Key($this->secretKey, 'HS256'));
    }
}