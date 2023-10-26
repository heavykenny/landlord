<?php

namespace App\Models;

use App\Core\Authentication;
use App\Core\Model;
use Exception;

class User extends Model
{
    private Authentication $auth;
    private string $userTable = 'users';

    private function loadConfig() {
        return $config['secretKey'] = require __DIR__ . '/../config/config.php';
    }

    /**
     * @throws Exception
     */
    public function createUser($data): array
    {
        $criteria = [
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'hashed_password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'phone_number' => $data['phone_number'] ?? "null",
            'address' => $data['address'] ?? "null",
            'profile_image_url' => $data['profile_image_url'] ?? "null",
        ];

        $user = $this->selectOne($this->userTable, ['email' => $data['email']]);

        if ($user) {
            return [
                'status' => false,
                'message' => 'User already exists'
            ];
        }

        $this->insert($this->userTable, $criteria);
        $response = $this->db->lastInsertId();

        if ($response === false) {
            return [
                'status' => false,
                'message' => 'Something went wrong'
            ];
        }

        return [
            'status' => true,
            'message' => 'User created successfully',
            'data' => $this->getUser($response),
        ];
    }

    public function getUser($userId)
    {
        return $this->selectOne($this->userTable, ['id' => $userId]);
    }

    public function loginUser($data): array
    {
        $user = $this->selectOne($this->userTable, ['email' => $data['email']]);
        if ($user && password_verify($data['password'], $user['hashed_password'])) {
            return [
                'status' => true,
                'message' => 'User logged in successfully',
                'data' => $user,
                'token' => $this->generateToken($user)
            ];
        }

        return [
            'status' => false,
            'message' => 'Invalid email or password'
        ];
    }

    public function updateUser($userId, $data)
    {
        $criteria = [
            'id' => $userId,
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password']
        ];

        $this->update($this->userTable, $criteria);

        return $this->db->lastInsertId();
    }

    public function deleteUser($userId)
    {
        $this->delete($this->userTable, ['id' => $userId]);
        return $this->db->lastInsertId();
    }

    private function generateToken($user): string
    {
        $this->auth = new Authentication($this->loadConfig());
        return $this->auth->generateToken($user);
    }
}
