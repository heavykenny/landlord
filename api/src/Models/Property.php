<?php

namespace App\Models;

use App\Core\Model;
use Exception;

class Property extends Model
{
    private string $propertyTableName = 'properties';
    private string $contactRequestTableName = 'contact_requests';

    /**
     * @throws Exception
     */
    public function createProperty($data)
    {
        $criteria = [
            'image_path' => $data['image_path'],
            'name' => $data['name'],
            'landlord_id' => $data['landlord_id'],
            'location' => $data['location'],
            'price' => $data['price'],
            'address' => $data['address'],
            'points_of_interest' => $data['points_of_interest'],
            'description' => $data['description'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude']
        ];

        $this->insert($this->propertyTableName, $criteria);
        return $this->db->lastInsertId();
    }

    public function getProperties()
    {
        $sql = "SELECT 
                        $this->propertyTableName.*,
                        users.first_name as landlord_first_name,
                        users.last_name as landlord_last_name,
                        users.email as landlord_email,
                        users.phone_number as landlord_phone_number,
                        users.id as landlord_id,
                        types.type_name,
                        property_type.property_type

                FROM $this->propertyTableName JOIN users ON $this->propertyTableName.landlord_id = users.id
                JOIN types ON $this->propertyTableName.type_id = types.type_id
                JOIN property_type ON $this->propertyTableName.property_type_id = property_type.id";
        return $this->query($sql)->fetchAll();
    }

    public function getProperty($propertyId)
    {
        $sql = "SELECT 
                        $this->propertyTableName.*,
                        users.first_name as landlord_first_name,
                        users.last_name as landlord_last_name,
                        users.email as landlord_email,
                        users.phone_number as landlord_phone_number,
                        users.id as landlord_id,
                        types.type_name,
                        property_type.property_type

                FROM $this->propertyTableName JOIN users ON $this->propertyTableName.landlord_id = users.id
                JOIN types ON $this->propertyTableName.type_id = types.type_id
                JOIN property_type ON $this->propertyTableName.property_type_id = property_type.id
                WHERE $this->propertyTableName.id = :id";
        return $this->query($sql, ['id' => $propertyId])->fetch();
    }

    public function updateProperty($propertyId, $data)
    {
        $criteria = [
            'id' => $propertyId,
            'image_path' => $data['image_path'],
            'name' => $data['name'],
            'landlord_id' => $data['landlord_id'],
            'location' => $data['location'],
            'price' => $data['price'],
            'address' => $data['address'],
            'points_of_interest' => $data['points_of_interest'],
            'description' => $data['description'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude']
        ];

        $this->update($this->propertyTableName, $criteria);
        return $this->db->lastInsertId();
    }

    public function deleteProperty($propertyId)
    {
        $this->delete($this->propertyTableName, ['id' => $propertyId]);
        return $this->db->lastInsertId();
    }

    /**
     * @throws Exception
     */
    public function createContactRequest($propertyId, $data)
    {
        $criteria = [
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'message' => $data['message'],
            'property_id' => $propertyId
        ];

        $this->insert($this->contactRequestTableName, $criteria);
        return $this->db->lastInsertId();
    }

    public function readProperty($propertyId)
    {
        return $this->selectOne($this->propertyTableName, ['id' => $propertyId]);
    }
}