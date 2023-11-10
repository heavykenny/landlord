<?php

namespace App\Models;

use App\Core\Model;
use Exception;

class Inquiries extends Model
{
    private string $inquiriesTableName = 'inquiries';

    /**
     * @throws Exception
     */
    public function createInquiry($data): bool|string
    {
        $criteria = [
            'tenant_id' => $data['user_id'],
            'landlord_id' => $data['landlord_id'],
            'created_by' => $data['user_id'],
            'property_id' => $data['property_id'],
            'message' => $data['message']
        ];

        $this->insert($this->inquiriesTableName, $criteria);
        return $this->db->lastInsertId();
    }

    public function getInquiries($userId): bool|array
    {
        $sql = "SELECT 
                    sub.*,
                    users.first_name as tenant_first_name,
                    users.last_name as tenant_last_name,
                    users.email as tenant_email,
                    users.phone_number as tenant_phone_number,
                    users.id as tenant_id,
                    users2.first_name as landlord_first_name,
                    users2.last_name as landlord_last_name,
                    users2.email as landlord_email,
                    users2.phone_number as landlord_phone_number,
                    users2.id as landlord_id,
                    properties.name as property_name,
                    properties.image_path as property_image_path
                FROM (
                    SELECT *
                    FROM $this->inquiriesTableName
                    WHERE $this->inquiriesTableName.tenant_id = $userId OR $this->inquiriesTableName.landlord_id = $userId
                    ORDER BY $this->inquiriesTableName.id DESC
                ) as sub
                JOIN users ON sub.tenant_id = users.id
                JOIN users as users2 ON sub.landlord_id = users2.id
                JOIN properties ON sub.property_id = properties.id
                GROUP BY sub.property_id";

        return $this->query($sql)->fetchAll();
    }

    public function getMessages($propertyId, $landlordId, $tenantId): bool|array
    {
        $sql = "SELECT 
                    sub.*,
                    users.first_name as tenant_first_name,
                    users.last_name as tenant_last_name,
                    users.email as tenant_email,
                    users.phone_number as tenant_phone_number,
                    users.id as tenant_id,
                    users2.first_name as landlord_first_name,
                    users2.last_name as landlord_last_name,
                    users2.email as landlord_email,
                    users2.phone_number as landlord_phone_number,
                    users2.id as landlord_id,
                    properties.name as property_name,
                    properties.image_path as property_image_path
                FROM (
                    SELECT *
                    FROM $this->inquiriesTableName
                    WHERE $this->inquiriesTableName.property_id = $propertyId AND $this->inquiriesTableName.landlord_id = $landlordId AND $this->inquiriesTableName.tenant_id = $tenantId
                    ORDER BY $this->inquiriesTableName.id DESC
                ) as sub
                JOIN users ON sub.tenant_id = users.id
                JOIN users as users2 ON sub.landlord_id = users2.id
                JOIN properties ON sub.property_id = properties.id";

        return $this->query($sql)->fetchAll();
    }

    public function getTenantInquiries($id): bool|array
    {
        $sql = "SELECT DISTINCT
                    properties.id AS property_id,
                    properties.name AS property_name,
                    tenant.first_name AS tenant_first_name,
                    tenant.last_name AS tenant_last_name,
                    tenant.email AS tenant_email,
                    tenant.phone_number AS tenant_phone_number,
                    tenant.id AS tenant_id,
                    landlord.first_name AS landlord_first_name,
                    landlord.last_name AS landlord_last_name,
                    landlord.email AS landlord_email,
                    landlord.phone_number AS landlord_phone_number,
                    landlord.id AS landlord_id
                FROM inquiries
                JOIN properties ON inquiries.property_id = properties.id
                JOIN users AS tenant ON inquiries.tenant_id = tenant.id
                JOIN users AS landlord ON inquiries.landlord_id = landlord.id
                WHERE inquiries.tenant_id = $id";

        return $this->query($sql)->fetchAll();
    }

    public function getLandlordInquiries($id): bool|array
    {
        $sql = "SELECT DISTINCT
                    properties.id AS property_id,
                    properties.name AS property_name,
                    tenant.first_name AS tenant_first_name,
                    tenant.last_name AS tenant_last_name,
                    tenant.email AS tenant_email,
                    tenant.phone_number AS tenant_phone_number,
                    tenant.id AS tenant_id,
                    landlord.first_name AS landlord_first_name,
                    landlord.last_name AS landlord_last_name,
                    landlord.email AS landlord_email,
                    landlord.phone_number AS landlord_phone_number,
                    landlord.id AS landlord_id
                FROM inquiries
                JOIN properties ON inquiries.property_id = properties.id
                JOIN users AS tenant ON inquiries.tenant_id = tenant.id
                JOIN users AS landlord ON inquiries.landlord_id = landlord.id
                WHERE inquiries.landlord_id = $id";

        return $this->query($sql)->fetchAll();
    }

    public function getMessages2($property, $user_id): bool|array
    {
        $sql = "SELECT 
    inquiries.id AS inquiry_id,
    properties.id AS property_id,
    properties.name AS property_name,
    landlord.id AS landlord_id,
    landlord.first_name AS landlord_first_name,
    landlord.last_name AS landlord_last_name,
    landlord.email AS landlord_email,
    landlord.phone_number AS landlord_phone_number,
    inquiries.message,
    inquiries.created_at,
    tenant.id AS tenant_id,
    tenant.first_name AS tenant_first_name,
    tenant.last_name AS tenant_last_name
FROM inquiries
JOIN properties ON inquiries.property_id = properties.id
JOIN users AS landlord ON properties.landlord_id = landlord.id
JOIN users AS tenant ON inquiries.tenant_id = tenant.id
WHERE inquiries.tenant_id = $user_id AND properties.id = $property";

        return $this->query($sql)->fetchAll();
    }

    /**
     * @throws Exception
     */
    public function replyInquiry(mixed $data): bool|string
    {
        $criteria = [
            'tenant_id' => $data['tenant_id'],
            'landlord_id' => $data['user_id'],
            'property_id' => $data['property_id'],
            'created_by' => $data['user_id'],
            'message' => $data['message']
        ];

        $this->insert($this->inquiriesTableName, $criteria);
        return $this->db->lastInsertId();
    }
}