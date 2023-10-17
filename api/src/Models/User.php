<?php

namespace App\Models;

use App\Core\Model;
use Exception;

class User extends Model
{
    private string $userTable = 'users';

    /**
     * @throws Exception
     */
    public function createUser($data)
    {
        $criteria = [
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password']
        ];

        $this->insert($this->userTable, $criteria);
        return $this->db->lastInsertId();
    }

    public function updateUser($userId, $data)
    {
        $criteria = [
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password']
        ];

        $this->update($this->userTable, $criteria, ['id' => $userId]);

        return $this->db->lastInsertId();
    }

    public function deleteUser($userId)
    {
        $this->delete($this->userTable, ['id' => $userId]);
        return $this->db->lastInsertId();
    }

    public function getUser($userId)
    {
        return $this->selectOne($this->userTable, ['id' => $userId]);
    }
}
