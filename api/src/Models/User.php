<?php

namespace App\Models;

use App\Core\Authentication;
use App\Core\Model;
use Exception;

class User extends Model
{
    private string $userTable = 'users';

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
            'profile_image_url' => $data['profile_image_url'] ?? "null"
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
        // create default role for user

        // making sure you can not create an admin user or a user with a role that does not exist
         $role_id = $data['role_id'] ?? 1;
         if ($role_id > 2 || $role_id < 1) {
             $role_id = 1;
         }

        $this->insert('user_roles', ['user_id' => $response, 'role_id' => $role_id]);

        if ($response === false) {
            return [
                'status' => false,
                'message' => 'Something went wrong'
            ];
        }

        return [
            'status' => true,
            'message' => 'User created successfully',
            'data' => $this->getUser($response)
        ];
    }

    public function getUser($userId)
    {
        $sql = "SELECT 
                    users.*,
                    roles.role_name,
                    roles.role_id
                FROM users
                LEFT JOIN user_roles ON users.id = user_roles.user_id
                LEFT JOIN roles ON user_roles.role_id = roles.role_id
                WHERE users.id = :id";

        return $this->fetchOne($sql, ['id' => $userId]);
    }

    public function loginUser($data): array
    {
        $user = $this->getUserByEmail($data['email']);

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

    /**
     * @param $email
     * @return mixed
     */
    public function getUserByEmail($email): mixed
    {
        $sql = "SELECT 
                    users.*,
                    roles.role_name,
                    roles.role_id
                FROM users
                LEFT JOIN user_roles ON users.id = user_roles.user_id
                LEFT JOIN roles ON user_roles.role_id = roles.role_id
                WHERE users.email = :email AND users.deleted_at IS NULL";

        return $this->fetchOne($sql, ['email' => $email]);
    }

    private function generateToken($user): string
    {
        $auth = new Authentication($this->loadConfig());
        return $auth->generateToken($user);
    }

    private function loadConfig()
    {
        return require __DIR__ . '/../config/config.php';
    }

    /**
     * @throws Exception
     */
    public function updateUser($userId, $data): bool|string
    {
        $criteria = [
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'] ?? "null",
            'address' => $data['address'] ?? "null",
            'profile_image_url' => $data['profile_image_url'] ?? "null",
        ];

        $this->update($this->userTable, $criteria, ['id' => $userId]);
        // clear previous roles and create new ones if any or default to user
        $this->delete('user_roles', ['user_id' => $userId]);
        $this->insert('user_roles', ['user_id' => $userId, 'role_id' => $data['role_id'] ?? 1]);

        return $userId;
    }

    public function deleteUser($userId): bool|string
    {
        $this->softDelete($this->userTable, $userId);
        return $this->db->lastInsertId();
    }

    public function getLandlords(): bool|array
    {
        $sql = "SELECT
                    users.*,
                    roles.role_name,
                    roles.role_id,
                    COUNT(properties.id) AS properties
                FROM users
                LEFT JOIN user_roles ON users.id = user_roles.user_id
                LEFT JOIN roles ON user_roles.role_id = roles.role_id
                LEFT JOIN properties ON users.id = properties.landlord_id
                WHERE roles.role_name = 'landlord' AND users.deleted_at IS NULL
                GROUP BY users.id, roles.role_name, roles.role_id";

        return $this->fetchAll($sql);
    }

    public function getUsers(): bool|array
    {
        $sql = "SELECT
                    users.*,
                    roles.role_name,
                    roles.role_id
                FROM users
                LEFT JOIN user_roles ON users.id = user_roles.user_id
                LEFT JOIN roles ON user_roles.role_id = roles.role_id
                WHERE roles.role_name = 'user' AND users.deleted_at IS NULL";

        return $this->fetchAll($sql);
    }

    /**
     * @throws Exception
     */
    public function createLandlord($data): array
    {
        $password = str_replace(' ', '', $data['last_name']) . '123';
        $criteria = [
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'hashed_password' => password_hash($password, PASSWORD_DEFAULT),
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
        $userId = $this->db->lastInsertId();

        // create landlord role for user
        $this->insert('user_roles', ['user_id' => $userId, 'role_id' => 2]);

        if ($userId === false) {
            return [
                'status' => false,
                'message' => 'Something went wrong'
            ];
        }

        return [
            'status' => true,
            'message' => 'Landlord created successfully',
            'data' => $this->getUser($userId)
        ];
    }

    public function isAdministrator($user): bool
    {
        return $user['role_name'] === 'admin';
    }

    public function isLandlord($user): bool
    {
        return $user['role_name'] === 'landlord';
    }

    private function isUser($user): bool
    {
        return $user['role_name'] === 'user';
    }


}
