<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Inquiries;
use App\Models\Property;
use Exception;

class InquiriesController extends Controller
{
    private Inquiries $inquiryModel;
    private Property $propertyModel;

    public function __construct($config)
    {
        parent::__construct($config);
        $this->inquiryModel = new Inquiries($this->db);
        $this->propertyModel = new Property($this->db);
    }

    /**
     * @throws Exception
     */
    public function createInquiry(): array
    {
        $validation = $this->validateRequestToken();
        if (!$validation['status']) {
            return $validation;
        }
        $user = $validation['data'];
        $data = $this->request;
        $data['user_id'] = $user->data->id;

        $response = $this->inquiryModel->createInquiry($data);

        if ($response === false) {
            return [
                'status' => false,
                'message' => 'Something went wrong'
            ];
        }

        return [
            'status' => true,
            'message' => 'Inquiry created successfully',
            'data' => $response
        ];
    }

    /**
     * @throws Exception
     */
    public function replyInquiry(): array
    {
        $validation = $this->validateRequestToken();
        if (!$validation['status']) {
            return $validation;
        }
        $user = $validation['data'];
        $data = $this->request;
        $data['user_id'] = $user->data->id;

        $response = $this->inquiryModel->replyInquiry($data);

        if ($response === false) {
            return [
                'status' => false,
                'message' => 'Something went wrong'
            ];
        }

        return [
            'status' => true,
            'message' => 'Inquiry created successfully',
            'data' => $response
        ];
    }

    public function getInquiries(): array
    {
        $validation = $this->validateRequestToken();
        if (!$validation['status']) {
            return $validation;
        }
        $user = $validation['data'];
        $response = $this->inquiryModel->getInquiries($user->data->id);

        if ($response === false) {
            return [
                'status' => false,
                'message' => 'Something went wrong'
            ];
        }

        return [
            'status' => true,
            'message' => 'Inquiries retrieved successfully',
            'data' => $response
        ];
    }


    public function getTenantInquiries(): array
    {
        $validation = $this->validateRequestToken();
        if (!$validation['status']) {
            return $validation;
        }
        $user = $validation['data'];
        $response = $this->inquiryModel->getTenantInquiries($user->data->id);

        if ($response === false) {
            return [
                'status' => false,
                'message' => 'Something went wrong'
            ];
        }

        return [
            'status' => true,
            'message' => 'Inquiries retrieved successfully',
            'data' => $response
        ];
    }

    public function getLandlordInquiries(): array
    {
        $validation = $this->validateRequestToken();
        if (!$validation['status']) {
            return $validation;
        }
        $user = $validation['data'];
        $response = $this->inquiryModel->getLandlordInquiries($user->data->id);

        if ($response === false) {
            return [
                'status' => false,
                'message' => 'Something went wrong'
            ];
        }

        return [
            'status' => true,
            'message' => 'Inquiries retrieved successfully',
            'data' => $response
        ];
    }

    public function getMessages2($property): array
    {
        $validation = $this->validateRequestToken();
        if (!$validation['status']) {
            return $validation;
        }
        $tenantId = $_GET["tenantId"];
        $response = $this->inquiryModel->getMessages2($property, $tenantId);

        if ($response === false) {
            return [
                'status' => false,
                'message' => 'Something went wrong'
            ];
        }
        return [
            'status' => true,
            'message' => 'Messages retrieved successfully',
            'data' => $response
        ];
    }


    public function getMessages($propertyId): array
    {
        $validation = $this->validateRequestToken();
        if (!$validation['status']) {
            return $validation;
        }
        $user = $validation['data'];
        $property = $this->propertyModel->getProperty($propertyId);
        $response = $this->inquiryModel->getMessages($propertyId, $property['landlord_id'], $user->data->id);

        if ($response === false) {
            return [
                'status' => false,
                'message' => 'Something went wrong'
            ];
        }

        return [
            'status' => true,
            'message' => 'Messages retrieved successfully',
            'data' => $response
        ];
    }
}