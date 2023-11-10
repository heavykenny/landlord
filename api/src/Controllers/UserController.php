<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Property;
use App\Models\User;
use Exception;

class UserController extends Controller
{
    private User $userModel;

    public function __construct($config)
    {
        parent::__construct($config);
        $this->userModel = new User($this->db);
    }

    /**
     * @throws Exception
     */
    public function createUser(): array
    {
        $data = $this->request;

        return $this->userModel->createUser($data);
    }

    public function getUser($userId): array
    {
        $response = $this->userModel->getUser($userId);

        if ($response === false) {
            return [
                'status' => false,
                'message' => 'Something went wrong'
            ];
        }

        return [
            'status' => true,
            'message' => 'User retrieved successfully',
            'data' => $response
        ];
    }

    /**
     * @throws Exception
     */
    public function updateUser($userId): array
    {
        $data = $this->request;

        $response = $this->userModel->updateUser($userId, $data);

        if ($response === false) {
            return [
                'status' => false,
                'message' => 'Something went wrong'
            ];
        }
        return [
            'status' => true,
            'message' => 'User updated successfully',
            'data' => $this->userModel->getUser($response)
        ];
    }

    public function loginUser(): array
    {
        $data = $this->request;

        return $this->userModel->loginUser($data);
    }

    public function deleteUser($userId): array
    {
        $response = $this->userModel->deleteUser($userId);

        if ($response === false) {
            return [
                'status' => false,
                'message' => 'Something went wrong'
            ];
        }
        return [
            'status' => true,
            'message' => 'User deleted successfully',
            'data' => $response
        ];
    }
}
