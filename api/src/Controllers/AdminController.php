<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Property;
use App\Models\User;
use Exception;

class AdminController extends Controller
{
    private User $userModel;
    private Property $propertyModel;

    public function __construct($config)
    {
        parent::__construct($config);
        $this->userModel = new User($this->db);
        $this->propertyModel = new Property($this->db);
    }

    public function getLandlords(): array
    {
        $response = $this->userModel->getLandlords();

        if ($response === false) {
            return [
                'status' => false,
                'message' => 'Something went wrong'
            ];
        }

        return [
            'status' => true,
            'message' => 'Landlords retrieved successfully',
            'data' => $response
        ];
    }

    public function getUsers(): array
    {
        $response = $this->userModel->getUsers();

        if ($response === false) {
            return [
                'status' => false,
                'message' => 'Something went wrong'
            ];
        }

        return [
            'status' => true,
            'message' => 'Users retrieved successfully',
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

    /**
     * @throws Exception
     */
    public function createLandlord(): array
    {
        $data = $this->request;

        return $this->userModel->createLandlord($data);
    }

    public function getProperties(): array
    {
        $validation = $this->validateRequestToken();
        if (!$validation['status']) {
            return $validation;
        }
        $user = $validation['data'];

        $userDetails = $this->userModel->getUser($user->data->id);

        if ($this->userModel->isLandlord($userDetails)) {
            $response = $this->propertyModel->getPropertiesByLandlord($user->data->id);
        } elseif ($this->userModel->isAdministrator($userDetails)) {
            $response = $this->propertyModel->getProperties();
        } else {
            return [
                'status' => false,
                'message' => 'You are not a landlord'
            ];
        }

        if ($response === false) {
            return [
                'status' => false,
                'message' => 'Something went wrong'
            ];
        }

        return [
            'status' => true,
            'message' => 'Properties retrieved successfully',
            'data' => $response
        ];
    }

    public function deleteProperty($propertyId): array
    {
        $response = $this->propertyModel->deleteProperty($propertyId);

        if ($response === false) {
            return [
                'status' => false,
                'message' => 'Something went wrong'
            ];
        }
        return [
            'status' => true,
            'message' => 'Property deleted successfully',
            'data' => $response
        ];
    }
}