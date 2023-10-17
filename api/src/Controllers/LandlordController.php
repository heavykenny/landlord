<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Landlord;
use Exception;

class LandlordController extends Controller
{
    private Landlord $landlordModel;

    public function __construct($config)
    {
        parent::__construct($config);
        $this->landlordModel = new Landlord($this->db);
    }

    /**
     * @throws Exception
     */
    public function createLandlord(): array
    {
        $data = $_POST;

        $response = $this->landlordModel->createLandlord($data);

        if ($response === false) {
            return [
                'status' => 'error',
                'message' => 'Something went wrong'
            ];
        }

        return [
            'status' => 'success',
            'message' => 'Landlord created successfully',
            'data' => $response
        ];
    }


    public function viewLandlords(): array
    {
        $response = $this->landlordModel->viewLandlords();

        if ($response === false) {
            return [
                'status' => 'error',
                'message' => 'Something went wrong'
            ];
        }

        return [
            'status' => 'success',
            'message' => 'Landlords retrieved successfully',
            'data' => $response
        ];
    }

    public function readLandlord($landlordId): array
    {
        $response = $this->landlordModel->readLandlord(["id" => $landlordId]);

        if ($response === false) {
            return [
                'status' => 'error',
                'message' => 'Something went wrong'
            ];
        }

        return [
            'status' => 'success',
            'message' => 'Landlord retrieved successfully',
            'data' => $response
        ];
    }

    public function updateLandlord($landlordId): array
    {
        $data = $_POST;
        $response = $this->landlordModel->updateLandlord($landlordId, $data);

        if ($response) {
            return [
                'status' => 'error',
                'message' => 'Something went wrong'
            ];
        }

        return [
            'status' => 'success',
            'message' => 'Landlord updated successfully',
            'data' => $response
        ];
    }

    public function deleteLandlord($landlordId): array
    {
        $response = $this->landlordModel->deleteLandlord($landlordId);

        if ($response) {
            return [
                'status' => 'error',
                'message' => 'Something went wrong'
            ];
        }

        return [
            'status' => 'success',
            'message' => 'Landlord deleted successfully',
            'data' => $response
        ];
    }
}
