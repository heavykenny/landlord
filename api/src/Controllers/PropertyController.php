<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Property;
use Exception;

class PropertyController extends Controller
{
    private Property $propertyModel;

    public function __construct($config)
    {
        parent::__construct($config);
        $this->propertyModel = new Property($this->db);
    }

    public function viewProperties(): array
    {
        $response = $this->propertyModel->getProperties();

        if ($response === false) {
            return [
                'status' => 'error',
                'message' => 'Something went wrong'
            ];
        }

        return [
            'status' => 'success',
            'message' => 'Properties retrieved successfully',
            'data' => $response
        ];
    }

    public function viewProperty($propertyId): array
    {
        $response = $this->propertyModel->getProperty($propertyId);

        if ($response === false) {
            return [
                'status' => 'error',
                'message' => 'Something went wrong'
            ];
        }

        return [
            'status' => 'success',
            'message' => 'Property retrieved successfully',
            'data' => $response
        ];
    }

    /**
     * @throws Exception
     */
    public function contactLandlord($propertyId): array
    {
        $data = $_POST;

        $response = $this->propertyModel->createContactRequest($propertyId, $data);

        if ($response === false) {
            return [
                'status' => 'error',
                'message' => 'Something went wrong'
            ];
        }

        return [
            'status' => 'success',
            'message' => 'Contact request created successfully',
            'data' => $response
        ];
    }


    /**
     * @throws Exception
     */
    public function createProperty(): array
    {
        $data = $_POST;

        $response = $this->propertyModel->createProperty($data);

        if ($response === false) {
            return [
                'status' => 'error',
                'message' => 'Something went wrong'
            ];
        }

        return [
            'status' => 'success',
            'message' => 'Property created successfully',
            'data' => $response
        ];
    }

    public function readProperty($propertyId): array
    {
        $response = $this->propertyModel->readProperty($propertyId);

        if ($response === false) {
            return [
                'status' => 'error',
                'message' => 'Something went wrong'
            ];
        }

        return [
            'status' => 'success',
            'message' => 'Property retrieved successfully',
            'data' => $response
        ];
    }

    public function updateProperty($propertyId): array
    {
        $data = $_POST;

        $response = $this->propertyModel->updateProperty($propertyId, $data);

        return [
            'status' => 'success',
            'message' => 'Property updated successfully',
            'data' => $response
        ];
    }

    public function deleteProperty($propertyId): array
    {
        $response = $this->propertyModel->deleteProperty($propertyId);

        return [
            'status' => 'success',
            'message' => 'Property deleted successfully',
            'data' => $response
        ];
    }
}