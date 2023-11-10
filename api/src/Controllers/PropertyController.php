<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Property;
use App\Models\User;
use Exception;

class PropertyController extends Controller
{
    private Property $propertyModel;
    private User $userModel;

    public function __construct($config)
    {
        parent::__construct($config);
        $this->propertyModel = new Property($this->db);
        $this->userModel = new User($this->db);
    }

    public function viewProperties(): array
    {
        $response = $this->propertyModel->getProperties();

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

    public function viewProperty($propertyId): array
    {
        $response = $this->propertyModel->getProperty($propertyId);

        if ($response === false) {
            return [
                'status' => false,
                'message' => 'Something went wrong'
            ];
        }

        return [
            'status' => true,
            'message' => 'Property retrieved successfully',
            'data' => $response
        ];
    }

    /**
     * @throws Exception
     */
    public function favoriteProperty(): array
    {
        $validation = $this->validateRequestToken();
        if (!$validation['status']) {
            return $validation;
        }
        $user = $validation['data'];
        $propertyId = $this->request['property_id'];

        $response = $this->propertyModel->favoriteProperty($propertyId, $user->data->id);

        if ($response === false) {
            return [
                'status' => false,
                'message' => 'Something went wrong'
            ];
        }

        return [
            'status' => true,
            'message' => 'Property favorited successfully',
            'data' => $response
        ];
    }

    public function getFavorites(): array
    {
        $validation = $this->validateRequestToken();
        if (!$validation['status']) {
            return $validation;
        }
        $user = $validation['data'];

        $response = $this->propertyModel->getFavorites($user->data->id);

        if ($response === false) {
            return [
                'status' => false,
                'message' => 'Something went wrong'
            ];
        }

        return [
            'status' => true,
            'message' => 'Favorites retrieved successfully',
            'data' => $response
        ];
    }

    /**
     * @throws Exception
     */
    public function createProperty(): array
    {
        $validation = $this->validateRequestToken();
        if (!$validation['status']) {
            return $validation;
        }
        $user = $validation['data'];

        $userDetails = $this->userModel->getUser($user->data->id);
        if ($this->validateLandlord($userDetails) || $this->validateAdmin($userDetails)) {
            return [
                'status' => false,
                'message' => 'You are not a landlord'
            ];
        }

        $data = $this->request;

        $data['landlord_id'] = $user->data->id;

        $response = $this->propertyModel->createProperty($data);

        if ($response === false) {
            return [
                'status' => false,
                'message' => 'Something went wrong'
            ];
        }

        return [
            'status' => true,
            'message' => 'Property created successfully',
            'data' => $response
        ];
    }

    public function updateProperty($propertyId): array
    {
        $data = $_POST;

        $response = $this->propertyModel->updateProperty($propertyId, $data);

        return [
            'status' => true,
            'message' => 'Property updated successfully',
            'data' => $response
        ];
    }

    public function deleteProperty($propertyId): array
    {
        $response = $this->propertyModel->deleteProperty($propertyId);

        return [
            'status' => true,
            'message' => 'Property deleted successfully',
            'data' => $response
        ];
    }
}
