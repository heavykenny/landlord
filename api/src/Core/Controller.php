<?php

namespace App\Core;

use PDO;

class Controller
{
    protected PDO $db;
    protected mixed $request;
    protected Authentication $auth;

    public function __construct($config)
    {
        $this->connectDatabase($config);
        $this->auth = new Authentication($config);
        $this->request = json_decode(file_get_contents("php://input"), true);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (count($_POST) > 0) {
                $this->request = $_POST;
            } else {
                $this->request = json_decode(file_get_contents("php://input"), true);
            }
        }
        // log to file
        $log = date("Y-m-d H:i:s") . " " . $_SERVER['REQUEST_METHOD'] . " "
            . $_SERVER['REQUEST_URI'] . " " . json_encode($this->request) . "\n";
        file_put_contents(__DIR__ . "/api.log", $log, FILE_APPEND);
    }

    protected function connectDatabase($config): void
    {
        $dsn = "{$config['driver']}:host={$config['host']};port={$config['port']};dbname={$config['database']};charset={$config['charset']}";
        $options = $config['options'];
        $this->db = new PDO($dsn, $config['username'], $config['password'], $options);
    }

    protected function validateRequestToken(): array
    {
        $headers = getallheaders();
        $token = $headers['Bearer'] ?? null;
        if (!$token) {
            return [
                'status' => false,
                'message' => 'Token not provided'
            ];
        }

        if (!$this->auth->validateToken($token)) {
            return [
                'status' => false,
                'message' => 'Invalid token'
            ];
        }

        return [
            'status' => true,
            'message' => 'Valid token',
            'data' => $this->auth->decodeToken($token)
        ];
    }

    protected function validateLandlord($user): bool
    {
        return ($user['role_id'] != 2);
    }

    protected function validateUser($user): bool
    {
        return ($user['role_id'] != 1);
    }

    protected function validateAdmin($user): bool
    {
        return ($user['role_id'] != 3);
    }
}
